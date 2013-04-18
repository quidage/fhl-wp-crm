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

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }
    
    public function getLast_login() {
        return $this->last_login;
    }

    public function setLast_login($last_login) {
        $this->last_login = $last_login;
    }


    
}

?>
