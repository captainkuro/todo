<?php

Route::register('GET', '', function () {
	echo 'Hello World!';
});
Route::register('GET', 'index(\/?|\/.*)', function () {
	echo 'Hello World!';
});