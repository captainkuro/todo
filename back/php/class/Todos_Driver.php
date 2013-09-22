<?php

interface Todos_Driver {
	
	/**
	 * @return array of stdClass {id, complete, text}
	 */
	public function all();

	/**
	 * @param  stdClass $obj {text}
	 * @return stdClass $obj {id, complete, text}
	 */
	public function insert($obj);

	/**
	 * @param  string $id  
	 * @param  stdClass $obj {complete}
	 * @return stdClass $obj {id, complete, text}
	 */
	public function update($id, $obj);

	/**
	 * @param  string $id 
	 * @return bool
	 */
	public function delete($id);
}