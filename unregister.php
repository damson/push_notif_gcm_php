<?php

/**
 * Unregistering a user device
 * Delete from reg id in users table
 */
if (isset($_POST["regId"])) {
    include_once './User.php';

    $user = new User($_POST["regId"]);
    $res = $user->delete();

    if ($res)
        echo 'success';
    echo 'fail';
} else {
    // user details missing
}
?>