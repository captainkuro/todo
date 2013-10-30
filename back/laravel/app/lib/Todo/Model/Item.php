<?php namespace Todo\Model;

use Eloquent;

class Item extends Eloquent {

	protected $table  = 'todos';

	public $timestamps = false;

}