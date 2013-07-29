muzzlefork/timers
=================

Basic composer package for PHP allowing you to time actions.

Installation:
```composer require "muzzlefork/timer 0.1.*"```

Usage:

```php
$t = MuzzleFork\Timer::get('x'); // Timers are inactive when started
$t->resume('Starting API call');
// do some heavy work
$t->pause('API command completed');
// go and do something else
$t->resume('Starting new API call');
$t->pause('Some other message');
	
echo $t->getTotal();
```

Of note:

* When you create a timer, it is inactive, so you should ->start() or ->resume() it.
* You can pass a message to ->resume($msg) and ->pause($msg) which can be handy when getting the full list out.