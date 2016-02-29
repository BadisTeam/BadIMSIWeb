<?php
    session_start();
    // We check if the session we want to destroy is from Master (we don't want our observers to kill the session right? ;P)
    if($_SESSION['accessRights'] == 1) {
        file_get_contents('http://'.$REST_HOST.':'.$REST_PORT.'/master/session/destroy');
    }
    $_SESSION = array();
    session_destroy();
    header('Location: index.php');
 ?>
