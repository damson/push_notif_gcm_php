<?php

include_once 'GCM.php';
include_once 'DB_Functions.php';

/**
* Model User for a gcm_user
*/
class User
{
    private $id;
    private $gcm_regid; // GCM Registration ID
    private $email;
    private $created_at;

    private $db;

    function __construct($gcm_regid, $email = "", $id = -1, $created_at = "") {
        $this->id = $id;
        $this->gcm_regid = $gcm_regid;
        $this->email = $email;
        $this->created_at = $created_at;
        $this->db = DB_Functions::getInstance();
    }

    public function notify($msg) {
        return (GCM::send_notification($this->gcm_regid, $msg));
    }

    public function delete() {
        return ($this->db->deleteUser($this->gcm_regid));
    }

    public function isExist() {
        return ($this->db->isUserExist($this->email));
    }

    public function store()
    {
        return ($this->db->storeUser($this->email, $this->gcm_regid));
    }

    public function toString()
    {
        return ("{
            \"id\": $this->id,
            \"gcm_regid\": $this->gcm_regid,
            \"email\": \"$this->email\",
            \"created_at\": \"$this->created_at\"
        }");
    }

    public function __get($name) {
        return ($this->{$name});
    }

    public function __set ($name, $value) {
        $this->{$name} = $value;
    }
}

?>