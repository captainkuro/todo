<?php
class Request {
	public static $method;
	public static $segments;
	public static $uri;
	public static $body;

	public static function parse() {
		$server = $_SERVER;
		self::$method = $server['REQUEST_METHOD'];
		$raw_segments = preg_replace('/^'.preg_quote(Config::$base_url, '/').'/', '', $server['REQUEST_URI']);
		self::$uri = $raw_segments;
		self::$segments = explode('/', $raw_segments);
		self::$body = file_get_contents('php://input');
	}
}
