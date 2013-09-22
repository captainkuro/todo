<?php

class Route {
	public static $map = array();

	public static function register($method, $url, $call) {
		self::$map[$method][$url] = $call;
	}

	public static function run($method, $uri) {
		$map = self::$map[$method];
		if ($map) foreach ($map as $pattern => $call) {
			if (preg_match('/^'.$pattern.'\??/', $uri, $m)) {
				array_shift($m);
				return call_user_func_array($call, $m);
			}
		}
		header('HTTP/1.1 404 Not Found');
		echo '404 Not Found';
	}
}