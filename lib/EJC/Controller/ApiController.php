<?php

namespace EJC\Controller;

/**
 * Controller fuer Api-Funktionen
 *
 * @author Christian Hansen <christian.hansen@stud.fh-luebeck.de>
 * @package wp-crm
 */
class ApiController extends AbstractController {

    /**
     * Gib XML-Baum aller Daten des Users zurueck
     * 
     * @return void
     */
    public function getAction() {
        // Setze MIME-Type fuer Output auf XML
        header('Content-type: application/xml');
        
        $customers = $this->customerRepository->findByParent_id($this->getCurrentUser()->getId());
        $this->view->assign('customers', $customers);
        $this->view->setLayout('ajax');
        $this->view->render();
    }

}

?>