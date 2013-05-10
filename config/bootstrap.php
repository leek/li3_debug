<?php

use lithium\core\Environment;
use li3_debug\extensions\storage\Debugger;

if (!Environment::is('production')) {
    Debugger::init();
}
