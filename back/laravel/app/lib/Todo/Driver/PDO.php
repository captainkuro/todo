<?php namespace Todo\Driver;

use Todo\Model\Item;
use stdClass;

class PDO implements DriverInterface {

	private function itemToObj(Item $item) 
	{
		$obj = new stdClass();
		$obj->id = $item->id;
		$obj->complete = $item->complete;
		$obj->text = $item->text;
		return $obj;
	}
	
	public function all() 
	{
		$items = Item::orderBy('id', 'asc')->get();
		$result = array();
		foreach ($items as $item)
		{
			$result[] = $this->itemToObj($item);
		}
		return $result;
	}

	public function insert($bag) 
	{
		$item = new Item();
		$item->complete = 0;
		$item->text = $bag->get('text');
		$item->save();
		return $this->itemToObj($item);
	}

	public function update($id, $bag) 
	{
		$item = Item::find($id);
		$item->complete = $bag->get('complete');
		$item->text = $bag->get('text');
		$item->save();
		return $this->itemToObj($item);
	}

	public function delete($id) 
	{
		$item = Item::find($id);
		$item->delete();
		return new stdClass;
	}
}