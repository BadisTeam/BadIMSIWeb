<?php
    // Include the template manager
    include_once('library/TBS/tbs_class.php');
    $TBS = new clsTinyButStrong;

    $TBS->LoadTemplate('template/');
    $template_path = 'template/';
    $TBS->Show();

?>
