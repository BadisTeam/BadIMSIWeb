<?php
    // Include the template manager
    include_once('library/TBS/tbs_class.php');
    $TBS = new clsTinyButStrong;

    $TBS->LoadTemplate('template/header.html');
    $TBS->LoadTemplate('template/about-us.html', '+');
    $TBS->LoadTemplate('template/footer.html', '+');
    $template_path = 'template/';
    $title = 'About Us';
    $breadcrumb = '<li class="active">About Us</li>';
    $TBS->Show();

?>
