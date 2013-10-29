<?php namespace Todo;

use Config;
use App;
use Illuminate\Support\ServiceProvider;
use Todo\Driver\Mongo as MongoDriver;
use Todo\Driver\PDO as PDODriver;

class TodoServiceProvider extends ServiceProvider {

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		if (Config::get('database.default') == 'mongo') 
		{
			$todo = new MongoDriver();
		}
		else
		{
			$todo = new PDODriver();
		}
		App::instance('todo', $todo);
	}


	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('todo');
	}

}