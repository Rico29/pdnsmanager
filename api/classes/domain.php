<?php

/*
 * Class for single Domains
 * @author Maurice Meyer <developer@maurice-meyer.de>
 */
class Domain extends DNSObject {
   
    /*
     * Name of the domain
     * @var name
     */
    private $name;

    /*
     * Type of the domain
     * @var type
     */
    private $type;

    /*
     * Number of records the domain has
     * @var numRecords
     */
    private $numRecords;

    /*
     * Last notified serial of the domain
     * @var lastNotifiedSerial;
     */
     private $lastNotifiedSerial;

    /*
     * Getter for the name of the domain
     * @return name
     */
    public function getName() {
        return $this->$name;
    }

    /* 
     * Getter for the type of the domain
     * @return type
     */
    public function getType() {
        return $this->$type;
    }

    /*
    public function getNumRecords() {
        return $this->$numRecords;
    }

    
}

?>