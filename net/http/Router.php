<?php

namespace li3_debug\net\http;

use li3_debug\analysis\Debugger;

/**
 *
 */
class Router extends \lithium\net\http\Router {

	/**
	 * Override to log time spent processing the incoming request.
	 */
	public static function process($request) {
		$id = Debugger::log('Router::process', Debugger::TYPE_LITHIUM);
		$result = parent::process($request);
		Debugger::end($id);
		return $result;
	}
}

?>