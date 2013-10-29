<?php namespace Todo;

use Illuminate\Support\Facades\Facade;

class TodoFacade extends Facade {

	/**
	 * Get the registered name of the component.
	 *
	 * @return string
	 */
	protected static function getFacadeAccessor() { return 'todo'; }

}