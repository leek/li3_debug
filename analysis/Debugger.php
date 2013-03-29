<?php

namespace li3_debug\analysis\logger;

use lithium\analysis\Logger;
use lithium\action\Dispatcher;

use lithium\core\Environment;
use lithium\core\Libraries;

use lithium\data\Connections;
use lithium\net\http\Media;
use lithium\security\Auth;
use lithium\storage\Cache;
use lithium\storage\Session;
use lithium\util\collection\Filters;

use li3_debug\util\File;

/**
 * @todo
 * - Use library configuration for most constants
 * - Cleaner use of syslog levels and facilities
 */
class Debugger extends \lithium\core\StaticObject {

	/**
	 * Possible syslog facilities
	 */
	const SYSLOG_DEBUG = 'LI3_DEBUG';
	const SYSLOG_CACHE = 'LI3_CACHE';
	const SYSLOG_PAGE = 'LI3_SLOW';
	const SYSLOG_WEBSERVICE = 'LI3_WEBSERVICE';
	const SYSLOG_CRON = 'LI3_CRON';

	/**
	 * Possible logged data types
	 */
	const TYPE_CACHE = 'CACHE';
	const TYPE_LITHIUM = 'LITHIUM';
	const TYPE_RENDER = 'RENDER';
	const TYPE_SESSION = 'SESSION';
	const TYPE_SQL = 'SQL';
	const TYPE_WEBSERVICE = 'WEBSERVICE';

	/**
	 * Pages that take more time than this (in ms) to completely render will be logged.
	 */
	const SLOW_PAGE_THRESHOLD = 2000;

	/**
	 * Cache queries that take more time than this (in ms) to completely execute will be logged.
	 */
	const SLOW_CACHE_THRESHOLD = 1000;

	/**
	 *
	 */
	protected static $_config = array();
	protected static $_counts = array();
	protected static $_displayed = false;
	protected static $_log = array();
	protected static $_logCount = 0;
	protected static $_request = null;
	protected static $_startTime = 0;

	/**
	 *
	 */
	protected static $_classes = array('router' => 'li3_debug\net\http\Router'));

	/**
	 *
	 */
	public static function init($options = array()) {
		$defaults = array(
			'display' => false,
			'displaySession' => false,
			'displayFileStack' => false,
			'logCache' => false,
			'logQueries' => false,
			'logSession' => true,
			'logSlowPages' => false,
			'sendSyslog' => false
		);
		$options += $defaults;

		self::$_startTime = microtime(true);
		self::$_config = $options;
		self::$_log = array();

		register_shutdown_function(function() { Debugger::onShutdown(); });

		if ($options['display']) {
			// Force PHP error display
			// error_reporting(E_ALL);
			// ini_set('display_errors', TRUE);
			// ini_set('display_startup_errors', TRUE);
		}

		Dispatcher::config(array('classes' => self::$_classes));

		Connections::applyFilter('_initAdapter', function ($self, $params, $chain) {
			$id = Debugger::log('Adaptable::_initAdapter (' . $params['class'] . ')', Debugger::TYPE_LITHIUM);
			$adapter = $chain->next($self, $params, $chain);
			Debugger::end($id);
			return $adapter;
		});

		// Attach to the `Connections` and `Cache` adapters after dispatch.
		Dispatcher::applyFilter('run', function($self, $params, $chain) use ($options) {
			Debugger::log('Dipatcher::run', Debugger::TYPE_LITHIUM, null, true);

			Debugger::setRequest(!empty($params['request']) ? $params['request'] : array());

			if ($options['logCache']) {
				Cache::applyFilter('write', function ($self, $params, $chain) {
					$id = Debugger::log('Write : ' . $params['key'], Debugger::TYPE_CACHE);
					$result = $chain->next($self, $params, $chain);
					Debugger::end($id);
					return $result;
				});

				Cache::applyFilter('read', function ($self, $params, $chain) {
					$id = Debugger::log('Read : ' . $params['key'], Debugger::TYPE_CACHE);
					$result = $chain->next($self, $params, $chain);
					Debugger::end($id, array('count' => count($result)));
					return $result;
				});
			}

			if ($options['logSession']) {
				Session::applyFilter('read', function ($self, $params, $chain) {
					$id = Debugger::log('Read : ' . $params['key'], Debugger::TYPE_SESSION);
					$result = $chain->next($self, $params, $chain);
					Debugger::end($id, array('count' => count($result)));
					return $result;
				});

				Session::applyFilter('write', function ($self, $params, $chain) {
					$id = Debugger::log('Write : ' . $params['key'], Debugger::TYPE_SESSION);
					$result = $chain->next($self, $params, $chain);
					Debugger::end($id, array('count' => count($result)));
					return $result;
				});
			}

			/**
			 * Loop over all defined `Connections` adapters and tack in our
			 * filter on the `_execute` method.
			 */
			if ($options['logQueries']) {
				foreach (Connections::get() as $connection) {
					$connection = Connections::get($connection);
					$connection->applyFilter('_execute', function($self, $params, $chain) {
						$id = Debugger::log($params['sql'], Debugger::TYPE_SQL);
						$result = $chain->next($self, $params, $chain);
						Debugger::end($id, array('sql' => $params['sql'], 'count' => $result->resource()->rowCount()));
						return $result;
					});
				}
			}

			// Return the controller.
			$result = $chain->next($self, $params, $chain);

			return $result;
		});

		Media::applyFilter('render', function ($self, $params, $chain) {
			$id = Debugger::log('View', Debugger::TYPE_RENDER);
			$results = $chain->next($self, $params, $chain);
			Debugger::end($id);
			Debugger::afterRender();
			return $results;
		});
	}

	/**
	 *
	 */
	public static function setRequest($request) {
		self::$_request = $request;
	}

	/**
	 *
	 */
	public static function syslog($log, $facility = self::SYSLOG_DEBUG, $data = array()) {
		if (!self::$_config['sendSyslog']) {
			return false;
		}

		Logger::config(array(
			'li3_debug' => array(
				'adapter' => '\li3_gelf\extensions\adapter\logger\Gelf',
				'host' => Environment::get('log.host'),
				'defaults' => compact('facility'),
			)
		));

		Logger::warning($log, $data, array('name' => 'li3_debug'));
	}

	/**
	 *
	 */
	public static function log($str, $type, $data = null, $end = false) {
		$id = self::$_logCount;
		self::$_log[$id] = array(
			'start' => microtime(true),
			'log' => $str,
			'data' => $data,
			'type' => $type,
			'time' => 0,
			'diff' => 0,
			'timeline' => 0
		);

		self::$_logCount++;

		if ($end) {
			Debugger::end($id);
		}

		return $id;
	}

	/**
	 *
	 */
	public static function end($id, $data = null) {
		$log = null;

		if (!empty(self::$_log[$id])) {
			$log = &self::$_log[$id];

			$log['end'] = microtime(true);
			$log['time'] = $log['end'] - $log['start'];
			$log['timeline'] = round($log['start'] - self::$_startTime, 3);

			if (!empty($data)) {
				$log['data'] = $data;
			}
		}

		return $log;
	}

	/**
	 *
	 */
	protected static function _calculateCounts() {
		if (!empty(self::$_counts)) {
			return false;
		}

		$includedFiles = get_included_files();

		self::$_counts = array(
			self::TYPE_LITHIUM => 0,
			self::TYPE_CACHE => 0,
			self::TYPE_SQL => 0,
			self::TYPE_LITHIUM => 0,
			self::TYPE_RENDER => 0,
			self::TYPE_WEBSERVICE => 0,
			'files' => count($includedFiles),
			'time' => 0,
			'logic' => 0,
			'nbRequests' => 0
		);

		self::$_counts['time'] = round(microtime(true) - self::$_startTime, 3);

		$last = null;

		foreach (self::$_log as &$log) {
			if (!empty($log['end'])) {
				$log['diff'] = !empty($last['end']) ? round($log['start'] - $last['end'], 3) : 0;

				if (empty(self::$_counts[$log['type']])) {
					self::$_counts[$log['type']] = 0;
				}

				self::$_counts[$log['type']] += $log['time'];

				$log['time'] = round($log['time'], 3);
			}

			if ($log['type'] == self::TYPE_SQL) {
				self::$_counts['nbRequests']++;
			}

			$last = $log;
		}

		self::$_counts['logic'] = self::$_counts['time'];
		self::$_counts['logic'] -= self::$_counts[self::TYPE_SQL];
		self::$_counts['logic'] -= self::$_counts[self::TYPE_CACHE];
		self::$_counts['logic'] -= self::$_counts[self::TYPE_WEBSERVICE];

		foreach (self::$_counts as &$count) {
			$count = round($count, 3);
		}

		return true;
	}

	/**
	 *
	 */
	public static function onShutdown() {
		self::_calculateCounts();

		if (self::$_counts[self::TYPE_CACHE] * 1000 > self::SLOW_CACHE_THRESHOLD) {
			self::syslog(self::$_counts[self::TYPE_CACHE] . ' secondes', self::SYSLOG_CACHE);
		}

		self::display();
	}

	/**
	 *
	 */
	public static function afterRender() {
		global $_SERVER;

		if (self::$_config['logSlowPages']) {
			$execTime = round(microtime(true) - self::$_startTime, 3);

			if ($execTime * 1000 > self::SLOW_PAGE_THRESHOLD) {
				$user = Auth::check('default');

				$log = $execTime . ' secondes: ';
				$log .= empty($_SERVER['REQUEST_URI']) ? 'Unknown request' : $_SERVER['REQUEST_URI'];

				self::_calculateCounts();

				$additional = array(
					'user_agent' => empty($_SERVER['HTTP_USER_AGENT']) ? 'Unknown' : $_SERVER['HTTP_USER_AGENT'],
					'remote_add' => empty($_SERVER['REMOTE_ADDR']) ? 'Unknown' : $_SERVER['REMOTE_ADDR'],
					'user' => empty($user) ? 'No user' : $user['id'] . ' - ' . $user['username']
				);

				$debug = array();
				foreach (self::$_log as $_log) {
					$_log['log'] = substr($_log['log'], 0, 100);
					unset($_log['data'], $_log['start'], $_log['end'], $_log['type']);
					$debug[] = $_log;
				}

				$additional['debug'] = json_encode($debug);

				self::syslog($log, self::SYSLOG_PAGE, compact('additional'));
			}
		}
	}

	/**
	 *
	 */
	public static function d($value) {
		echo '<pre>' . print_r($value, true) . '</pre>';
	}

	/**
	 *
	 */
	public static function onJson($data) {
		if (self::$_config['display']) {
			self::_calculateCounts();

			$data['debug'] = array(
				'counts' => self::$_counts,
				'logs' => self::$_log,
			);
		}
		return $data;
	}

	/**
	 *
	 */
	protected static function display($force = false) {
		if (!self::$_config['display']) {
			return false;
		}

		if (self::$_displayed && !$force) {
			return false;
		}

		if (empty(self::$_request)) {
			$mode = 'text';
		} elseif (self::$_request->is('json')) {
			$mode = 'json';
		} elseif (self::$_request->is('ajax')) {
			$mode = 'ajax';
		} elseif (self::$_request->is('xml')) {
			$mode = 'empty';
		} else {
			$mode = 'html';
		}

		// Variables for template
		$includedFiles = get_included_files();
		$counts = self::$_counts;
		$logs = self::$_log;
		$size = File::sizeHumanized(memory_get_usage(true));
		$displaySession = self::$_config['displaySession'];
		$displayFileStack = self::$_config['displayFileStack'];

		switch ($mode) {
			case 'ajax':
				$dataText = json_encode(compact('counts', 'logs'));
				?>
				<div style="display:none;" data-debug-rel="data-debug">
					<?php echo $dataText; ?>
				</div>
				<?php
			break;

			case 'html':
				include( dirname(__FILE__) . '/' . 'html_render.php');
			break;

			case 'json':
			case 'text':
			case 'empty':
			default:
			break;
		}

		return self::$_displayed = true;
	}
}

?>