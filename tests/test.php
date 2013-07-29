<?php

include(dirname(__FILE__).'/../vendor/autoload.php');

$t = new MuzzleFork\Timer('asd');
$t->resume('Commencing API call');
sleep(2);
$t->pause('Finished API call');

echo "Total time spent doing API calls: " . $t->getTotal() . "\n";
// $t->start();