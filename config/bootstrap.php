<?php

use li3_debug\extensions\storage\Debugger;
use lithium\util\collection\Filters;

Debugger::init();

register_shutdown_function(function() {
    Debugger::terminate();
});

Filters::apply('lithium\action\Dispatcher', '_callable', function($self, $params, $chain) {
    $data           = array();
    $data['start']  = microtime(true);
    $data['memory'] = memory_get_usage(true);
    $data['name']   = $params['request']->params['controller'] . ':' . $params['request']->params['action'] . '->_callable()';
    $controller     = $chain->next($self, $params, $chain);
    $data['end']    = microtime(true);
    $data['memory'] = memory_get_usage(true) - $data['memory'];
    $data['time']   = $data['end'] - $data['start'];
    Debugger::push('events', $data);
    Debugger::inc('events.time', $data['time']);
    if ($controller instanceof \lithium\action\Controller) {
        Debugger::setRequest($params['request']);
        Debugger::bindTo($controller);
    }
    return $controller;
});
