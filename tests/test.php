<?php

include(dirname(__FILE__).'/../vendor/autoload.php');

$t = new MuzzleFork\Timer('asd');
$t->resume('Commencing API call');
sleep(1);
$t->pause('Finished API call');

echo "Total time spent doing API calls: " . $t->getTotal() . "\n";

$t = MuzzleFork\Timer::get('x');
$t->resume();
$t->pause();
echo $t->getTotal();

$allTimers = MuzzleFork\Timer::getAllTimers();
print_r($allTimers);
// $t->start();