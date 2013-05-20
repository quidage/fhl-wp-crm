<?php

namespace EJC\Model;

/**
 * Das User-Model
 *
 * @author Christian Hansen <christian.hansen@stud.fh-luebeck.de>
 */
class User extends AbstractModel {
    
    /**
     * Passwort
     * 
     * @var string
     */
    protected $password;
    
    /**
     * Letzter Login
     * 
     * @var DateTime
     */
    protected $last_login;
    
    /**
     * Vorname
     *
     * @var string
     */
    protected $first_name;
    
    /**
     * Nachname
     *
     * @var string
     */
    protected $last_name;
    
    /**
     * Admin-Status
     * 
     * @var boolean
     */
    protected $admin;
    
    /**
     * Sorge dafuer, dass die Eigenschaften die richtigen Datentypen bekommen
     * @return void
     */
    public function __construct() {
        parent::__construct();
        $this->last_login = new \DateTime($this->last_login);
        $this->admin = filter_var($this->admin, FILTER_VALIDATE_BOOLEAN);
    }

    /**
     * Hole das Passwort
     * 
     * @return string
     */
    public function getPassword() {
        return $this->password;
    }

    /**
     * Setze das Passwort verschluesselt als MD5-Hash
     * 
     * @param string $password
     */
    public function setPassword($password) {
        $this->password = md5($password);
    }
    
    /**
     * Hole den lezten Login
     * 
     * @return type
     */
    public function getLast_login() {
        return $this->last_login;
    }

    /**
     * Setze den letzten Login
     * 
     * @param DateTime $last_login
     */
    public function setLast_login($last_login) {
        $this->last_login = $last_login;
    }
    
    /**
     * Hole den Vornamen
     * 
     * @return string
     */
    public function getFirst_name() {
        return $this->first_name;
    }

    /**
     * Setze den Vornamen
     * 
     * @param string $first_name
     */
    public function setFirst_name($first_name) {
        $this->first_name = trim($first_name);
    }

    /**
     * Hole den Nachnamen
     * 
     * @return string
     */
    public function getLast_name() {
        return $this->last_name;
    }

    /**
     * Setze den Nachnamen
     * 
     * @param string $last_name
     */
    public function setLast_name($last_name) {
        $this->last_name = trim($last_name);
    }

    /**
     * Hole den Admin-Status
     * 
     * @return boolean
     */
    public function getAdmin() {
        return filter_var($this->admin, FILTER_VALIDATE_BOOLEAN);
    }
    
    /**
     * Ob der User Admin ist
     * 
     * @return boolen
     */
    public function isAdmin() {
        return $this->getAdmin();
    }

    /**
     * Setze den User Admin
     * 
     * @param boolean $admin
     * @return void
     */
    public function setAdmin($admin) {
        $this->admin = filter_var($admin, FILTER_VALIDATE_BOOLEAN);
    }
    
}

?>
