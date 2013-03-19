<?php

/**
 * 
 * @package wp-crm
 */
class AbstractRepository {

	/**
	 * @var string
	 */
	protected $table;

	/**
	 *
	 */
	protected $db;

	/**
	 * Constructors
	 * 
	 * @return void
	 */
	public function __construct() {
		$this->db = mysql_connect('localhost', 'wp-crm', 'aVtUtzruEn2c8EMT') or die(mysql_error());
		mysql_select_db('wp-crm', $this->db) or die(mysql_error());
		mysql_query("SET NAMES 'utf8';") or die(mysql_error());
	}

	/**
	 * Returns array of all results
	 * 
	 * @return array results
	 */
	public function findAll() {
		$results = array();
		$query = "SELECT * FROM " . $this->table . " WHERE deleted = 0";
		$res = mysql_query($query) or die(mysql_error());
		if ($res !== false) {
			while ($row = mysql_fetch_assoc($res)) {
				$results[] = $row;
			}
		}
		return $results;
	}

	/**
	 * Returns one result by id
	 * 
	 * @param int $id id
	 * @return array result
	 */
	public function findById($id) {
		$query = "SELECT * FROM " . $this->table . " WHERE deleted = 0 AND id = " . $id;
		$res = mysql_query($query) or die(mysql_error());
		if ($res !== false) {
			return mysql_fetch_assoc($res);
		} else {
			return false;
		}
	}

	/**
	 * Returns one result by id
	 * 
	 * @param int $id id
	 * @return array result
	 */
	public function findByParentId($id) {
		$query = "SELECT * FROM " . $this->table . " WHERE deleted = 0 AND parent_id = " . intval($id);
		$res = mysql_query($query) or die(mysql_error());
		if ($res !== false) {
			while ($row = mysql_fetch_assoc($res)) {
				$results[] = $row;
			}
			return $results;
		} else {
			return false;
		}
	}

	/**
	 * Insert new 
	 * 
	 * @param array $record
	 * @param int $parent_id
	 * @return int insert id
	 */
	public function add($record, $parent_id = NULL) {
		$columns = '';
		$values = '';

		if ($parent_id !== NULL) {
			$columns .= "parent_id,tstamp,";
			$values .= "'$parent_id'," . time() . ",";
		}

		foreach ($record as $key => $value) {
			
		}

		$query = "INSERT INTO " . $this->table . " (" . $columns . ") VALUES (" . $values . ")";
		if (mysql_query($query)) {
			return mysql_insert_id();
		} else {
			return false;
		}
	}

}

?>
