<?php

class Todos_Driver_Pdo implements Todos_Driver {

	protected $pdo;

	public function __construct() {
		$this->pdo = Config::$pdo;
	}
	
	public function all() {
		$sql = 'SELECT * FROM todos ORDER BY id ASC';
		$result = array();
		foreach ($this->pdo->query($sql, PDO::FETCH_OBJ) as $row) {
			$result[] = $row;
		}
		return $result;
	}

	protected function get($id) {
		$sql = 'SELECT * FROM todos WHERE id = ?';
		$stmt = $this->pdo->prepare($sql);
		$stmt->execute(array($id));
		return $stmt->fetch(PDO::FETCH_OBJ);
	}

	public function insert($obj) {
		$sql = 'INSERT INTO todos (`complete`, `text`) VALUES (0, ?)';
		$stmt = $this->pdo->prepare($sql);
		$stmt->execute(array($obj->text));
		$id = $this->pdo->lastInsertId();
		return $this->get($id);
	}

	public function update($id, $obj) {
		$sql = 'UPDATE todos SET complete = ? WHERE id = ?';
		$stmt = $this->pdo->prepare($sql);
		$stmt->execute(array($obj->complete, $id));

		return $this->get($id);
	}

	public function delete($id) {
		$sql = 'DELETE FROM todos WHERE id = ?';
		$stmt = $this->pdo->prepare($sql);
		$stmt->execute(array($id));

		return new stdClass;
	}
}