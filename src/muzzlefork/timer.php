<?php

namespace MuzzleFork;

class Timer
{
	private static $timers = array();

	public static function start($key)
	{
		self::$timers[$key] = array(
			'start' => microtime(true),
			'key' => $key,
			'events' => array(),
			'is_active' => true
			);
		self::$record($key, 'start');
	}

	public static function record($key, $event)
	{
		if (!isset(self::$timers[$key]))
		{
			throw new Exception('Non-existent key specified');
		}
		$time_since_last = 0;
		$now = microtime(true);
		if (count(self::$timers[$key]['events']) > 0)
		{
			$current = self::$timers[$key]['events'][count(self::$timers[$key]['events'])];
			$time_since_last = $now - $current['microtime'];
		}
	}

	public function __construct()
	{
		echo "Started a timer\n";

	}

	public function __destruct()
	{
		echo "Timer got destroyed\n";
	}
}