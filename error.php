<?php
    // Include the template manager
    include_once('library/TBS/tbs_class.php');
    // Instanciate the template manager
    $TBS = new clsTinyButStrong;

    // Load templates
    $TBS->LoadTemplate('template/error.html');
    $template_path = 'template/';
    $title = '';
    if($_GET['e'] == 403) {
        $title = '403';
        $errorMessage = "Error 403 : What are you doing here??";

    } elseif($_GET['e'] == 401) {
        $title = '401';
        $errorMessage = "Error 401: You shall not pass!!";
    } else {
        $title = '418';
        $errorMessage = "Error 418: I'm a teapot! 🍵";
    }
    $TBS->Show();
?>
