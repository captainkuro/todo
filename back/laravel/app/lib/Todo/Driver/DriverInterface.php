<?php namespace Todo\Driver;

interface DriverInterface {
	
	/**
	 * @return array of stdClass {id, complete, text}
	 */
	public function all();

	/**
	 * @param  ParameterBag $bag {text}
	 * @return stdClass $obj {id, complete, text}
	 */
	public function insert($bag);

	/**
	 * @param  string $id  
	 * @param  ParameterBag $bag {complete, text}
	 * @return stdClass $obj {id, complete, text}
	 */
	public function update($id, $bag);

	/**
	 * @param  string $id 
	 * @return bool
	 */
	public function delete($id);
}