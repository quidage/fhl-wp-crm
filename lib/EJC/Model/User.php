<?php

namespace EJC\Model;

/**
 * Description of User
 *
 * @author christian
 */
class User extends AbstractModel {
    
    protected $password;
    protected $last_login;
    protected $first_name;
    protected $last_name;

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = md5($password);
    }
    
    public function getLast_login() {
        return $this->last_login;
    }

    public function setLast_login($last_login) {
        $this->last_login = $last_login;
    }
    
    public function getFirst_name() {
        return $this->first_name;
    }

    public function setFirst_name($first_name) {
        $this->first_name = $first_name;
    }

    public function getLast_name() {
        return $this->last_name;
    }

    public function setLast_name($last_name) {
        $this->last_name = $last_name;
    }


    
}

?>
