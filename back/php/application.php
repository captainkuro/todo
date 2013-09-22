<?php

Route::register('GET', 'todos\/?', function () {
	$todos = Todos::instance();
	echo json_encode($todos->all());
});

Route::register('POST', 'todos\/?', function () {
	$todos = Todos::instance();
	$input = json_decode(Request::$body);
	$result = $todos->insert($input);
	echo json_encode($result);
});

Route::register('PUT', 'todos\/([^\/]+)\/?', function ($id) {
	$todos = Todos::instance();
	$input = json_decode(Request::$body);
	$result = $todos->update($id, $input);
	echo json_encode($result);
});

Route::register('DELETE', 'todos\/([^\/]+)\/?', function ($id) {
	$todos = Todos::instance();
	$result = $todos->delete($id);
	echo json_encode($result);
});

Route::register('GET', 'index(\/?|\/.*)', function ($a) {
	echo 'Hello World!';
	echo $a;
});

Route::register('GET', '', function () {
	echo 'Hello World!';
});
