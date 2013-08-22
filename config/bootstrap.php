<?php

use lithium\core\Environment;

if (!Environment::is('production')) {
    \li3_debug\extensions\storage\Debugger::init();
}
