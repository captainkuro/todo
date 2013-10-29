<?php namespace Todo\Driver;

use MongoClient;
use MongoId;
use Config;
use stdClass;

class Mongo implements DriverInterface {

	protected $collection;

	public function __construct() {
		$client = new MongoClient(Config::get('database.connections.mongo.server'));
		$mongo = $client->selectDB(Config::get('database.connections.mongo.database'));
		$this->collection = $mongo->selectCollection('todos');
	}
	
	public function all() {
		$cursor = $this->collection->find()->sort(array('_id' => 1));
		$result = array();
		foreach ($cursor as $doc) {
			$result[] = $this->doc_to_obj($doc);
		}
		return $result;
	}

	protected function get($id) {
		$mid = new MongoId($id);
		return $this->collection->findOne(array('_id' => $mid));
	}

	public function insert($obj) {
		$insert = array(
			'complete' => false,
			'text' => $obj->text,
		);
		$this->collection->insert($insert);
		return $this->doc_to_obj($insert);
	}

	public function update($id, $obj) {
		$doc = $this->get($id);
		$doc['complete'] = (bool) $obj->complete;
		$doc['text'] = $obj->text;
		$this->collection->save($doc);
		return $this->doc_to_obj($doc);
	}

	public function delete($id) {
		$mid = new MongoId($id);
		$this->collection->remove(array('_id' => $mid));
		return new stdClass;
	}

	protected function doc_to_obj($doc) {
		$obj = new stdClass();
		$obj->id = (string)$doc['_id'];
		$obj->complete = $doc['complete'];
		$obj->text = $doc['text'];
		return $obj;
	}
}