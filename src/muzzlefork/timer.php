<?php

namespace MuzzleFork;

class Timer
{
	private static $timers = array();
	private $key;
	private $events;
	private $is_active;
	private $total = 0;

	public static function create($key)
	{
		$timer = new self($key);
		self::$timers[$key] = $timer;
		return $timer;
	}

	public static function get($key)
	{
		if (!isset(self::$timers[$key]))
		{
			return self::create($key);
		}
		return self::$timers[$key];
	}

	public function __construct($key)
	{
		$this->key = $key;
		$this->events = array();
		$this->is_active = false;
		$this->total = 0;
		// $this->start();
	}

	public function start()
	{
		if (count($this->events) > 0)
		{
			// throw new \Exception('Timer is already started');
		}

		$this->resume('start');
	}

	public function resume($message = '')
	{
		if ($this->is_active)
		{
			// throw new \Exception('Timer is already active');
		}
		$this->is_active = true;
		$this->record($message);
	}

	public function pause($message = '')
	{
		if (!$this->is_active)
		{
			// throw new Exception('Timer is not active');
		}
		$this->is_active = false;
		$this->record($message);
	}

	public function getTotal()
	{
		return $this->total;
	}

	public function record($message = '')
	{
		$now = microtime(true);
		if (count($this->events) > 0)
		{
			$current = $this->events[count($this->events) - 1];
			$time_since_last = $now - $current['microtime'];
			if ($this->events[count($this->events) - 1]['is_active'])
			{
				$this->total += $time_since_last;
			}
		}
		$this->events[] = array(
			'pretty_time' => date('Y-m-d H:i:s'),
			'microtime' => $now,
			'message' => $message,
			'is_active' => $this->is_active

			);
	}

	public function __destruct()
	{
		if ($this->is_active)
		{
			$this->pause('timer destroyed');
		}
		print_r($this->events);
	}
}