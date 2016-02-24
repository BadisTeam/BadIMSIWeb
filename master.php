<?php
    session_start();
    if (!isset($_SESSION['id']) OR !isset($_SESSION['login']) OR !isset($_SESSION['accessRights'])) {
        if($_SESSION['accessRights'] != 1) {
            header('Location: error.php?e=401');
        }
    }

    // Include the template manager
    include_once('library/TBS/tbs_class.php');
    include_once('includes/functions.php');

    $TBS = new clsTinyButStrong;

    $TBS->LoadTemplate('template/master/header.html');
    if(isset($_GET['resume'])) {
        $state = json_decode(@file_get_contents('http://'.$REST_HOST.':'.$REST_PORT.'/master/session/state'), true)['state'];
        switch($state) {
            case 1:
                $state = "location";
                break;
            case 2:
                $state = "sniffing";
                break;
            case 3:
                $state = "jamming";
                break;
            case 4:
                $state = "attack";
                break;
            default:
                $state = "";
        }
    } else {
        $state = isset($_GET['state']) ? $_GET['state'] : '';
    }
    if($state == "location") {
        $TBS->LoadTemplate('template/master/location.html', '+');
        $title = 'Master Session - Location';
    } elseif($state == "sniffing") {
        $TBS->LoadTemplate('template/master/sniffing.html', '+');
        $title = 'Master Session - Sniffing';
    } elseif($state == "jamming") {
        $TBS->LoadTemplate('template/master/jamming.html', '+');
        $title = 'Master Session - Jamming';
    } elseif($state == "attack") {
        $TBS->LoadTemplate('template/master/attack.html', '+');
        $title = 'Master Session - Attack';
    } else {
        $TBS->LoadTemplate('template/master/index.html', '+');
        $title = 'Master Session';
    }
    $TBS->LoadTemplate('template/master/footer.html', '+');

    $template_path = 'template/';
    $title = 'Master Session';
    $server_link = 'http://localhost:8080';
    $username = $_SESSION['login'];
    $fullName = $_SESSION['firstName']. ' ' .$_SESSION['lastName'];

    // If we create a new password
    if(isset($_POST['create'])) {
        $url = @file_get_contents('http://'.$REST_HOST.':'.$REST_PORT.'/master/session/start/'.$_POST['newpassword']);
    }

    // Fetch the last session data
    $sessionData = json_decode(@file_get_contents('http://'.$REST_HOST.':'.$REST_PORT.'/master/session/state'), true);
    $currentPassword = $sessionData['password'];
    $JSConfirm = 'onsubmit="return confirm(\'A session may be currently in progress.\n Do you wish to create a new one?\');"';



    // Check if a session in currently in use AND it was used since less that 30 minutes (1800 secs)
    if($sessionData['state'] > -1 AND (time() - $sessionData['timestamp']) < 1800) {
        $JSConfirm = 'onsubmit="return confirm(\'A session may be currently in progress.\n Do you wish to create a new one?\');"';
        $goButtonState = 'btn-primary';
    } else {
        $JSConfirm = 'onsubmit=""';
        $goButtonState = 'btn-success';
    }

    $TBS->Show();

?>
