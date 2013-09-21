<pre>
<?php
class Config {
	public static $base_url = '/todo/back/php/';
}

class Request {
	public static $method;
	public static $segments;
	public static $body;

	public static function parse() {
		$server = $_SERVER;
		self::$method = $server['REQUEST_METHOD'];
		$raw_segments = preg_replace('/^'.preg_quote(Config::$base_url, '/').'/', '', $server['REQUEST_URI']);
		self::$segments = explode('/', $raw_segments);
		self::$body = file_get_contents('php://input');
	}
}

class Helper {
	public static function autoload($class) {
		$filename = 'class/'.$class.'.php';
		if (is_file($filename)) {
			require $filename;
		}
	}

	public static function call_action() {
		$segments = Request::$segments;
		if (empty($segments) || empty($segments[0])) {
			$class = 'Route_Index';
		} else{
			$class = 'Route_'.ucfirst($segments[0]);
		}
		if (!class_exists($class)) {
			header('HTTP/1.1 404 Not Found');
			return;
		}
		$object = new $class;
		
		if (empty($segments[1])) {
			$action = 'index';
		} else {
			$action = $segments[1];
		}
		$method_name = strtolower(Request::$method).'_'.$action;
		$args = array_slice($segments, 2);

		$object->{$method_name}($args);
	}
}

spl_autoload_register('Helper::autoload');
Request::parse();
Helper::call_action();
