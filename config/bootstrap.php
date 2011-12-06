<?php

use lithium\action\Dispatcher;
use lithium\analysis\Logger;
use lithium\core\Environment;

// Force development environment
Environment::set('development');

// Force PHP error display
ini_set("display_errors", 1);

$APP_START_TIME = microtime();

Dispatcher::applyFilter('run', function($self, $params, $chain) use ($APP_START_TIME){
	$r = $chain->next($self,$params,$chain);

	$APP_END_TIME = microtime();
	$times = array_map(
		function($a){
			$time = explode(' ', $a);
			return $time[1] + $time[0];
		},
		array($APP_START_TIME, $APP_END_TIME)
	);

	$t = $times[1]-$times[0];

	Logger::debug('*** PAGE EXECUTION TIME:'.$t);

	return $r;
});
?>