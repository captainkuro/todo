<?php

class Todos {

	/**
	 * @var Todos_Driver
	 */
	protected $driver;

	protected static $instance = null;

	public static function instance() {
		if (self::$instance === null) {
			self::$instance = new self();
			$driver_class = 'Todos_Driver_'.ucfirst(Config::$database_driver);
			self::$instance->driver = new $driver_class;
		}
		return self::$instance;
	}

	public function __call($method, $args) {
		return call_user_func_array(array($this->driver, $method), $args);
	}
}