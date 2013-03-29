<?php

use li3_debug\analysis\Debugger;

$config = Libraries::get('li3_debug');
Debugger::init(empty($config) ? array() : $config);

?>