<?php
namespace DNS;

/* 
 * Base class for all DNS objects
 * @author     Maurice Meyer <developer@maurice-meyer.de>
 */
class DNSObject {

    /* 
     * Uniqe ID of the object
     * @var id
     */
    private $id;

    /*
     * Getter for the ID
     * @return id
     */
    public function getId() {
        return $this->$id;
    }
}
?>