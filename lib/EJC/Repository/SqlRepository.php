<?php

namespace EJC\Repository;

/**
 * Repositoryfunctions for all repositories 
 * 
 * @author Christian Hansen <chrstian.hansen@stud.fh-luebeck.de>
 * 
 * @package wp-crm
 */
class SqlRepository {

	protected $table;
	protected $mysqli;

    /**
	 * constructor
	 * 
     * connect to database, set character set
     * 
	 * @return void
	 */
	public function __construct() {
		$this->mysqli = new \mysqli('localhost', 'wp-crm', 'aVtUtzruEn2c8EMT', 'wp-crm');
		$this->mysqli->query("SET NAMES 'utf8';");
	}
    
    /**
     * destructor
     * 
     * throw exception if database errors occur
     * 
     * @throws \Exception
     */
    public function __destruct() {
        if (!empty($this->mysqli->error_list)) {
            throw new \Exception('mysql-errors occured: "' . $this->mysqli->error . '"', 1366213519);
        }
    }

    /**
     * Prepare string for database
     * 
     * @param string $dirtyString
     * @return string
     */
    public function prepareString($dirtyString) {
        return $this->mysqli->escape_string(\EJC\Helper\StringHelper::cleanUp($dirtyString));
    }    
    
    /**
     * @todo write list of properties and for writing in database
     * 
     * @param array $keysValues
     * @return return array
     */
    public function preparePropertiesForInsert($keysValues) {
        $keyString = (implode(',', array_keys($keysValues)));
        $valueString = "'" . (implode("','",$keysValues)) . "'";
        return array($keyString, $valueString);
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
		$query = "UPDATE " . $table . " SET ";
        foreach ($propertiesValues AS $property => $value) {
            $query .= $this->prepareString($property) . " = '" . $this->prepareString($value) . "',";
        }
        $query = substr($query, 0, -1);
        $query .= " WHERE " . $where;
		return $query;
	}
    
    /**
	 * build insert query
	 * 
	 * @param string $table
	 * @param string $where
     * @param array $propertiesValues array($property => $value)
	 * @return string
	 */
	public function buildInsertQuery($table, $propertiesValues) {
        list ($properties, $values) = $this->preparePropertiesForInsert($propertiesValues);
		$query = "INSERT INTO " . $table  . " (" . $properties . ") VALUES (" . $values . ")";
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
	public function findById($id) {
		$query = $this->buildSelectQuery("*", $this->table," id = '" . intval($id) . "'");
		return $this->getFirstResult($query);
	}  
    
	/**
	 * find one object by property
     * 
	 * @param string $property
	 * @param string $value
	 */
	public function findByParent_id($parent_id) {
		$query = $this->buildSelectQuery("*", $this->table, " parent_id= '" . intval($parent_id) . "'");
		return $this->getFirstResult($query);
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
     * set deleted = 1
     * 
     * @param int $id
     * @return void
     */
    public function delete($id) {
        $query = $this->buildUpdateQuery($this->table, array('deleted' => 1), "id = " . intval($id));
        $this->mysqli->query($query);
    }
    
    /**
     * Insert in database
     * 
     * @param array $propertiesValues
     */
    public function insert($propertiesValues) {
        $query = $this->buildInsertQuery($this->table, $propertiesValues);
        $this->mysqli->query($query);
        return $this->mysqli->insert_id;
    }

}
?>
