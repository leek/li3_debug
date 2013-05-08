# li3_debug

A port of [Symfony2](http://symfony.com)'s debug menu to [Lithium](http://lithify.me). Thanks to [@marcghorayeb](https://github.com/marcghorayeb) for a great starting point.

Here is a screenshot of what it looks like with the **Timer** panel open:

[![Timer Panel](http://i.imgur.com/Mzcmg8Kl.jpg)](http://i.imgur.com/Mzcmg8Kl.jpg)

## Installation

Load `li3_debug` by updating `config/bootstrap/libraries.php`:

```php
<?php

// ... snip ...

use lithium\core\Environment;

if (!Environment::is('production')) {
    Libraries::add('li3_debug');
}
```

## ToDo

* Use [li3_profiler](https://github.com/joebeeson/li3_profiler) for Timer panel
* Look for enhancements that could be <del>stolen</del> borrowed from [li3_perf](https://github.com/tmaiaroto/li3_perf)
