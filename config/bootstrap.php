<?php

use lithium\action\Dispatcher;
use lithium\analysis\Logger;
use lithium\core\Environment;

global $APP_START_TIME, $SQL;

$APP_START_TIME = microtime(true);
$SQL = array();

// Configure the Logger class to use the File adapter by default
Logger::config(array(
	'default' => array('adapter' => 'File')
));

// Force development environment
Environment::set('development');

// Force PHP error display
ini_set("display_errors", 1);

register_shutdown_function('li3_debug_exit');

function li3_debug_exit() {
	global $SQL, $APP_START_TIME;
	?>
	<hr/>
	<div>
		<h4>Temps d'exécution</h4>
		<p><?= round(microtime(true) - $APP_START_TIME, 4) ?> secondes.</p>

		<h4>Requêtes SQL</h4>
		<ul>
			<?php foreach ($SQL as $query) : ?>
				<li><?= $query ?></li>
			<?php endforeach; ?>
		</ul>

		<h4>Session</h4>
		<pre><?= print_r($_SESSION) ?></pre>
	</div>
	<?php
}

function addSqlLine($query) {
	global $SQL;
	$SQL[] = $query;
}

// Thanks to li3_profiler for this bit of code
// SQL query logging
use \lithium\util\collection\Filters;
use \lithium\data\Connections;

// Attach to the `Connections` adapters after dispatch.
Filters::apply('\lithium\action\Dispatcher', '_callable', function($self, $params, $chain) {
	/**
	 * Loop over all defined `Connections` adapters and tack in our
	 * filter on the `_execute` method.
	 */
	foreach (Connections::get() as $connection) {
		$connection = Connections::get($connection);
		$connection->applyFilter('_execute', function($self, $params, $chain) {
			addSqlLine($params['sql']);
			return $chain->next($self, $params, $chain);
		});
	}

	// Return the controller.
	return $chain->next($self, $params, $chain);
});

?>