# li3_debug

A port of Symfony2's debug menu to lithium. Thanks to @marcghorayeb for a great starting point.

Here is a screenshot of what it looks like with the **Timer** panel open:

![Timer Panel](http://i.imgur.com/Mzcmg8Kl.jpg)

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
