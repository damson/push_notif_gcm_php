<?php 

include_once 'User.php';

/**
* 
*/
class UserManager
{

    function __construct() {
        # code...
    }

    static public function getAll() {
        return (DB_Functions::getInstance()->getAllUsers());
    }

    static public function isExist($email) {
        return (DB_Functions::getInstance()->getAllUsers());
    }

    static public function getByEmail($email) {
        $user = DB_Functions::getInstance()->getUserByEmail($email);
        $user = mysql_fetch_assoc($user);

        return (new User(
            $user['gcm_regid'],
            $user['email'],
            $user['id'],
            $user['created_at']));
    }
}

?>