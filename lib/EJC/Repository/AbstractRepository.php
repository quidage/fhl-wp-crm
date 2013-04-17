<?php

namespace EJC\Repository;

/**
 * Repositoryfunctions for all repositories 
 * 
 * @author Christian Hansen <chrstian.hansen@stud.fh-luebeck.de>
 * 
 * @package wp-crm
 */
class AbstractRepository {

	protected $table;
	protected $mysqli;

    /**
	 * Constructor
	 * 
	 * @return void
	 */
	public function __construct() {
		$this->mysqli = new \mysqli('localhost', 'wp-crm', 'aVtUtzruEn2c8EMT', 'wp-crm') or die($this->mysqli->connect_error);
		$this->mysqli->query("SET NAMES 'utf8';");
	}
    
    /**
     * Get the class name of the Model
     * 
     * @return string
     */
    public function getModelClassName() {
        return '\\EJC\\Model\\' . ucwords($this->table);
    }
    
    /**
     * Prepare string for database
     * 
     * @param string $dirtyString
     * @return string
     */
    public function prepareString($dirtyString) {
        return $this->mysqli->real_escape_string(\EJC\Helper\StringHelper::cleanUp($dirtyString));
    }    

    /**
	 * build select query
	 * 
	 * @param string $select
	 * @param string $table
	 * @param string $where
	 * @return string
	 */
	public function buildSelectQuery($select, $table, $where = NULL, $groupBy = NULL, $orderBy = NULL, $limit = NULL) {
		$query = "SELECT " . $select . " FROM " . $table;
		if ($where !== NULL) $query .= " WHERE " . $where; 
		if ($groupBy !== NULL) $query .= " GROUP BY " . $groupBy; 
		if ($orderBy !== NULL) $query .= " ORDER BY " . $orderBy;
		if ($limit !== NULL) $query .= " LIMIT " . $limit;
		return $query;
	}
    
    /**
	 * build update query
	 * 
	 * @param string $table
	 * @param string $where
     * @param array $propertiesValues array($property => $value)
	 * @return string
	 */
	public function buildUpdateQuery($table, $propertiesValues, $where) {
		$query = "UPDATE " . $table . " SET (";
        foreach ($propertiesValues AS $property => $value) {
            $query .= $this->prepareString($property) . " = '" . $this->prepareString($value) . "',";
        }
        $query = substr($query, 0, -1);
        $query .= ") WHERE " . $where;
		return $query;
	}
       
    /**
     * Return first result object of a query result
     * 
     * @param string $query
     * @return object $result
     */
    public function getFirstResult($query) {
        $queryResult = $this->mysqli->query($query);
        if ($queryResult === FALSE) {
            return NULL;
        } else {
            return $queryResult->fetch_object($this->getModelClassName());
        }
    }
    
    /**
     * get array of result-objects
     * 
     * @param type $result
     * @return type
     */
    public function getResultArray($query) {
        $queryResult = $this->mysqli->query($query);
        $results = array();
        if ($queryResult !== FALSE) {
            while ($row = $queryResult->fetch_object($this->getModelClassName())) {
                $results[] = $row;
            }
        }
		return $results;        
    }
	 
	/**
	 * find one object by property
     * 
	 * @param string $property
	 * @param string $value
	 */
	public function findOneByProperty($property, $value) {
		$query = $this->buildSelectQuery("*", $this->table, $property . " = '" . $this->prepareString($value) . "'", NULL, NULL, "0,1");
		return $this->getFirstResult($query);
	}   
    
	/**
	 * find objects by property
     * 
	 * @param string $property
	 * @param string $value
	 */
	public function findByProperty($property, $value) {
		$query = $this->buildSelectQuery("*", $this->table, $property . " = '" . $this->prepareString($value) . "'");
		return $this->getResultArray($query);
	}    

	/**
	 * Returns array of all results
	 * 
	 * @return array results
	 */
	public function findAll() {
		$query = $this->buildSelectQuery("*", $this->table, "deleted = 0");
        return $this->getResultArray($query);
	}

	/**
	 * Returns one result by id
	 * 
	 * @param int $id id
	 * @return array result
	 */
	public function findById($id) {
		$query = $this->buildSelectQuery("*", $this->table, "deleted = 0 AND uid = " . intval($id));
		return $this->getFirstByQuery($query);
	}

	/**
	 * Returns one result by id
	 * 
	 * @param int $id id
	 * @return array result
	 */
	public function findByParentId($id) {
        $query = $this->buildSelectQuery("*", $this->table, "deleted = 0 AND parent_id = " . intval($id));
		return $this->getResultArray($query);
	}

	/**
	 * Insert new record
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
			$columns .= $key . ",";
			$values .= "'" . $value . "'";
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
