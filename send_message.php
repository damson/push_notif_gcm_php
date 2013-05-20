<?php

if (isset($_POST["regId"]) && isset($_POST["message"])) {
    include_once './User.php';

    $message = $_POST["message"];
    $user = new User($_POST["regId"]);

    echo '<br />NOTIFY: '.$user->notify($message);
}
?>
