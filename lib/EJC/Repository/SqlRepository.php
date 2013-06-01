<?php

namespace EJC\Repository;

/**
 * Methoden fuer die SQL-Verarbeitung
 * 
 * @author Christian Hansen <chrstian.hansen@stud.fh-luebeck.de>
 * @package wp-crm
 */
class SqlRepository {

    /**
     * Die SQL-Tabelle fuer das Repository
     *
     * @var string
     */
    protected $table;
    
    /**
     * Die Mysqli-Datenbankverbindung
     *
     * @var \mysqli
     */
	protected $mysqli;    

    /**
	 * Konstruktor / Verbindung zur DB aufbauen und Character Set setzen
     * 
	 * @return void
	 */
	public function __construct() {
        include __AppRoot__ . '/lib/config.php';
		$this->mysqli = new \mysqli($config['db_host'], $config['db_user'], $config['db_password'], $config['db_name']);
		$this->mysqli->query("SET NAMES 'utf8';");
	}
    
    /**
     * Desktruktor / Werfe einen Ausnahmefehler, wenn ein Datenfehler auftritt
     * 
     * @throws \Exception
     * @return void
     */
    public function __destruct() {
        if (!empty($this->mysqli->error)) {
            throw new \EJC\Exception\RepositoryException('mysql error occured: "' . $this->mysqli->error . '"', 1366213519);
        }
    }

    /**
     * Bereite String vor, um in die Datenbank zu schreiben
     * 
     * @param string $dirtyString
     * @return string
     */
    public function prepareString($dirtyString) {
        return $this->mysqli->escape_string(trim($dirtyString));
    }    
    
    /**
     * Praepariere eine Array um die Daten in die Datenbank zu schreiben
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
	 * Baue eine SELECT Query
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
	} // public function buildSelectQuery($select, $table, $where = NULL, $groupBy = NULL, $orderBy = NULL, $limit = NULL)
    
    /**
	 * Baue ein UPDATE query
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
	} // public function buildUpdateQuery($table, $propertiesValues, $where)
    
    /**
	 * Baue eine INSERT query
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
     * Gib das erste Object der Ergebnisse einer Query zurueck
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
    } // public function getFirstResult($query)
    
    /**
     * Gib alle Ergebnis-Objekte in einem Array zurueck
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
        var_dump($query);
		return $results;        
    } // public function getResultArray($query)
    
	/**
	 * Finde ein Objekt ueber die ID
     * 
	 * @param int $id
     * @return object
	 */
	public function findById($id) {
		$query = $this->buildSelectQuery("*", $this->table," id = '" . intval($id) . "'");
		return $this->getFirstResult($query);
	}  
    
	/**
	 * Finde alle Objekte zu einer Parent_id
     * 
	 * @param int $parent_id
     * @return array
	 */
	public function findByParent_id($parent_id) {
		$query = $this->buildSelectQuery("*", $this->table, " parent_id = '" . intval($parent_id) . "'");
		return $this->getResultArray($query);
	} 
    
    /**
     * Finde alle Objekte zu der ID eines Grosselternobject 
     * 
     * @param int $grandParent_id
     * @return array 
     */
    public function findByGrandParent_id($grandParent_id) {
        $query = $this->buildSelectQuery("*", $this->table, " parent_id  IN (" 
                . $this->buildSelectQuery("id", $this->getParentRepository()->getTable(), " parent_id = " . $grandParent_id) . ")");
        $this->getResultArray($query);
    }
    
    /**
     * Finde alle Objekte zu der ID eines UrGrosselternobject 
     * 
     * @param int $greatGrandParent_id
     * @return array 
     */
    public function findByGreatGrandParent_id($greatGrandParent_id) {
        $query = $this->buildSelectQuery("*", $this->table, " parent_id  IN (" 
                . $this->buildSelectQuery("id", $this->getParentRepository()->getTable(), " parent_id  IN (" 
                . $this->buildSelectQuery("id", $this->getParentRepository()->getParentRepository()->getTable(), " parent_id = " . $greatGrandParent_id) . ")"));
        $this->getResultArray($query);
    }
    
	/**
	 * Finde alle Objekte zu einer Parent_id und dem Status
     * 
	 * @param int $parent_id
	 * @param string $status
     * @return array
	 */
	public function findByParent_idAndStatus($parent_id, $status) {
		$query = $this->buildSelectQuery("*", $this->table, " parent_id = '" . intval($parent_id) . "' AND status = '" . $status . "'");
		return $this->getResultArray($query);
	}   
    
    /**
     * Finde alle Objekte zu der ID eines Grosselternobject 
     * 
     * @param int $grandParent_id
     * @return array 
     */
    public function findByGrandParent_idAndStatus($grandParent_id, $status) {
        $query = $this->buildSelectQuery("*", $this->table, " parent_id  IN (" 
                . $this->buildSelectQuery("id", $this->getParentRepository()->getTable(), " parent_id = " . $grandParent_id) . ") AND status = '" . $status . "'");
        return $this->getResultArray($query);
    }    
    
    /**
     * Finde alle Objekte zu der ID eines UrGrosselternobject und dem Status
     * 
     * @param int $greatGrandParent_id
     * @param string $status
     * @return array 
     */
    public function findByGreatGrandParent_idAndStatus($greatGrandParent_id, $status) {
        $query = $this->buildSelectQuery("*", $this->table, " parent_id  IN (" 
                . $this->buildSelectQuery("id", $this->getParentRepository()->getTable(), " parent_id  IN (" 
                . $this->buildSelectQuery("id", $this->getParentRepository()->getParentRepository()->getTable(), " parent_id = " . $greatGrandParent_id) . ")) AND status = '" . $status . "'"));
        return $this->getResultArray($query);
    }    
    
	/**
	 * Finde ein Objekt zu einer Eigenschaft
     * 
	 * @param string $property
	 * @param string $value
     * @return object
	 */
	public function findOneByProperty($property, $value) {
		$query = $this->buildSelectQuery("*", $this->table, $property . " = '" . $this->prepareString($value) . "'", NULL, NULL, "0,1");
		return $this->getFirstResult($query);
	}   
    
	/**
	 * Finde alle Objekte zu einer Eigenschaft
     * 
	 * @param string $property
	 * @param string $value
     * @return array
	 */
	public function findByProperty($property, $value) {
		$query = $this->buildSelectQuery("*", $this->table, $property . " = '" . $this->prepareString($value) . "'");
		return $this->getResultArray($query);
	}    

	/**
	 * Finde alle Objekte in einem Repository
	 * 
	 * @return array results
	 */
	public function findAll() {
		$query = $this->buildSelectQuery("*", $this->table, "deleted = 0");
        return $this->getResultArray($query);
    }
    
    /**
     * Loesche ein Objekt aus dem Repository
     * setze deleted = 1
     * 
     * @param int $id
     * @return void
     */
    public function delete($id) {
        $query = $this->buildUpdateQuery($this->table, array('deleted' => 1), "id = " . intval($id));
        $this->mysqli->query($query);
    }
    
    /**
     * Fuege ein neues Objekt in die Datenbank
     * 
     * @param array $propertiesValues
     * @return int SQL insert id
     */
    public function insert($propertiesValues) {
        $query = $this->buildInsertQuery($this->table, $propertiesValues);
        $this->mysqli->query($query);
        return $this->mysqli->insert_id;
    }
    
    /**
     * Aktualisiere eine Objekt ueber die id des Objekts
     * 
     * @param int $id
     * @param array $propertiesValues
     * @return void
     */
    public function updateOneById($id, $propertiesValues) {
        $query = $this->buildUpdateQuery($this->table, $propertiesValues, "id = " . intval($id));
        $this->mysqli->query($query);
    }

}
?>
