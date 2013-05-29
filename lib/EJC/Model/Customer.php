<?php

namespace EJC\Model;

/**
 * Model fuer den Customer
 *
 * @author Christian Hansen <christian.hansen@stud.fh-luebeck.de>
 * @package wp-crm
 */
class Customer extends AbstractModel { 

    /**
     * Die Strasse
     * 
     * @var string 
     */
    protected $street;
    
    /**
     * Die Postleitzahl
     * 
     * @var string 
     */
    protected $zip;
    
    /**
     * Der Ort
     * 
     * @var string
     */
    protected $city;
    
    /**
     * Die Telefonnummer
     * 
     * @var string
     */
    protected $phone;
    
    /**
     * Die Faxnumer
     * 
     * @var string
     */
    protected $fax;
    
    /**
     * Die Email-Adresse
     *
     * @var string
     */
    protected $email;
    
    /**
     * Hole die Strasse
     * 
     * @return string
     */
    public function getStreet() {
        return $this->street;
    }

    /**
     * Setze die Strasse
     * 
     * @param string $street
     * @return void
     */
    public function setStreet($street) {
        $this->street = trim($street);
    }

    /**
     * Hole die Postleitzahl
     * 
     * @return string
     */
    public function getZip() {
        return $this->zip;
    }

    /**
     * Setze die Postleitzahl
     * 
     * @param string $zip
     * @return void
     */
    public function setZip($zip) {
        $this->zip = trim($zip);
    }

    /**
     * Hole den Ort
     * 
     * @return string
     */
    public function getCity() {
        return $this->city;
    }

    /**
     * Setze den Ort
     * 
     * @param string $city
     * @return void
     */
    public function setCity($city) {
        $this->city = trim($city);
    }

    /**
     * Setze die Telefonnummer
     * 
     * @return string
     */
    public function getPhone() {
        return $this->phone;
    }

    /**
     * Setze die Telefonnummer
     * 
     * @param string $phone
     * @return string
     */
    public function setPhone($phone) {
        $this->phone = trim($phone);
    }

    /**
     * Hole die Faxnummer
     * 
     * @return string
     */
    public function getFax() {
        return $this->fax;
    }

    /**
     * setze die Faxnummer
     * 
     * @param string $fax
     * @return void
     */
    public function setFax($fax) {
        $this->fax = trim($fax);
    }

    /**
     * Hole die Email-Adresse
     * 
     * @return string
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * Setze die Email-Adresse
     * 
     * @param string $email
     * @return void
     */
    public function setEmail($email) {
        $this->email = filter_var(trim($email), FILTER_VALIDATE_EMAIL);
    }


}

?>
