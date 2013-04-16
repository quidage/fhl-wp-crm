<?php

namespace EJC\Controller;

/**
 * Description of UserController
 *
 * @author Christian Hansen <christian.hansen@stud.fh-luebeck.de>
 */
class UserController extends AbstractController {
    
    /**
     * 
     */
    public function __construct() {
        parent::__construct();
    }
    
    /**
     * Action for the index page
     * 
     * @return void
     */
    public function startAction() {
        echo 'Startseite';
    }
    
    
}

?>
