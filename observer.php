<?php
    session_start();
    if (!isset($_SESSION['id']) OR !isset($_SESSION['login']) OR !isset($_SESSION['accessRights'])) {
        if($_SESSION['accessRights'] != 0) {
            header('Location: error.php?e=401');
        }
    }

    // Include the template manager
    include_once('library/TBS/tbs_class.php');
    include_once('includes/functions.php');

    $TBS = new clsTinyButStrong;

    $TBS->LoadTemplate('template/observer/header.html');
    $state = isset($_GET['state']) ? $_GET['state'] : '';
    if($state == "sniffing") {
        $TBS->LoadTemplate('template/observer/sniffing.html', '+');
        $title = 'Observer Session - Sniffing';
    } elseif($state == "jamming") {
        $TBS->LoadTemplate('template/observer/jamming.html', '+');
        $title = 'Observer Session - Jamming';
    } elseif($state == "attack") {
        $TBS->LoadTemplate('template/observer/attack.html', '+');
        $title = 'Observer Session - Attack';
    } else {
        $TBS->LoadTemplate('template/observer/location.html', '+');
        $title = 'Observer Session';
    }
    $TBS->LoadTemplate('template/observer/footer.html', '+');
    $template_path = 'template/';
    $server_link = 'http://localhost:8080';
    $TBS->Show();
