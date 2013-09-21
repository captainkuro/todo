<?php

function my_autoload($class) {
	$filename = 'class/'.$class.'.php';
	if (is_file($filename)) {
		require $filename;
	}
}
spl_autoload_register('my_autoload');
Request::parse();

require 'application.php';
Route::run(Request::$method, Request::$uri);