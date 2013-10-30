<?php
define('SQLITE_DSN', 'sqlite:'.realpath(__DIR__.'/../../database/todos.db'));

class Config {
	public static $base_url = '/todo/back/php/';
	public static $database_driver = 'pdo';

	public static $pdo;
	public static $pdo_settings = array(
		'dsn' => SQLITE_DSN,
	);

	public static $mongo;
	public static $mongo_settings = array(
		'server' => 'mongodb://localhost/',
		'database' => 'todos',
	);
}

if (Config::$database_driver === 'pdo') {
	Config::$pdo = new PDO(Config::$pdo_settings['dsn']);
} else if (Config::$database_driver === 'mongo') {
	$client = new MongoClient(Config::$mongo_settings['server']);
	Config::$mongo = $client->selectDB(Config::$mongo_settings['database']);
}