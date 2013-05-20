<?php

include_once './DB_Connect.php';

class DB_Functions {

    public static $instance;
    private $db;

    static public function getInstance() {
        return (self::$instance == null ? self::$instance = new DB_Functions() : self::$instance);
    }

    function __construct() {
        // connecting to database
        $this->db = new DB_Connect();
        $this->db->connect();
    }

    function __destruct() {
        $this->db->close();
    }

    /**
     * Storing new user
     * returns user details
     */
    public function storeUser($email, $gcm_regid) {
        // insert user into database
        $result = mysql_query("INSERT INTO gcm_users(email, gcm_regid, created_at) VALUES('$email', '$gcm_regid', NOW())");
        // check for successful store
        if ($result) {
            // get user details
            $id = mysql_insert_id(); // last inserted id
            $result = mysql_query("SELECT * FROM gcm_users WHERE id = $id") or die(mysql_error());
            // return user details
            if (mysql_num_rows($result) > 0) {
                return mysql_fetch_array($result);
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function deleteUser($gcm_regid)
    {
     $result = mysql_query("DELETE FROM `gcm_users` WHERE gcm_regid = '$gcm_regid'");
         // check for successful store
     if ($result)
        return (true);
    die(mysql_error());
    return (false);
}

    /**
     * Get user by email and password
     */
    public function getUserByEmail($email) {
        $result = mysql_query("SELECT * FROM gcm_users WHERE email = '$email' LIMIT 1");
        return $result;
    }

    /**
     * Getting all users
     */
    public function getAllUsers() {
        $result = mysql_query("select * FROM gcm_users");
        return $result;
    }

    /**
     * Check user is existed or not
     */
    public function isUserExist($email) {
        $result = mysql_query("SELECT email from gcm_users WHERE email = '$email'");
        $no_of_rows = mysql_num_rows($result);
        if ($no_of_rows > 0) {
            // user existed
            return true;
        } else {
            // user not existed
            return false;
        }
    }

}

?>