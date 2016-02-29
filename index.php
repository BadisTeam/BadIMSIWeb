<?php
// FIRST FILE BABY!!
    session_start();
    if (isset($_SESSION['id']) AND isset($_SESSION['login']) AND isset($_SESSION['accessRights'])) {
        if($_SESSION['accessRights'] == 1) {
            header('Location: master.php');
        }
    }
    // Include the template manager
    include_once('library/TBS/tbs_class.php');
    include_once('includes/functions.php');
    // Instanciate the template manager
    $TBS = new clsTinyButStrong;

    // Load templates
    $TBS->LoadTemplate('template/header.html');
    $TBS->LoadTemplate('template/index.html', '+');
    $TBS->LoadTemplate('template/footer.html', '+');

    // Inititialize base variables
    $template_path = 'template/';
    $title = 'Welcome';
    $breadcrumb = '<li class="active">Login</li>';

    // Main work here
    $TBS->VarRef['err_log'] = 0;
    $login = '';
    $password = '';
    $errorMessage = '';
    if (isset($_POST['btn_ok'])) {
        // Imagine we check the login/password...
        $login = $_POST['login'];
        echo $login;
        $password = $_POST['password'];
        if(($errorMessage === '') && (trim($login) === '')) { $errorMessage = 'Please enter your login.'; }
        if(($errorMessage === '') && ($password === '')) { $errorMessage = 'Please enter your password.'; }
        if($login == "Observer") {
            $sessionPassword = json_decode(@file_get_contents('http://'.$REST_HOST.':'.$REST_PORT.'/master/session/state'), true)['password'];
            if($sessionPassword == $password) {
                $_SESSION['id'] = 42;
                $_SESSION['login'] = "Observer";
                $_SESSION['accessRights'] = 0;
                header('Location: observer.php');
            }
        } else {
            $salted = md5($password);
            $req = $connection->prepare('SELECT id, login, firstName, lastName, accessRights FROM users WHERE login = :login AND password = :password');
            $req->execute(array('login' => $login,
                                 'password' => $salted));
            $result = $req->fetch();

            if(!$result) {
                $TBS->VarRef['err_log'] = 1;
            } else {
                $_SESSION['id'] = $result['id'];
                $_SESSION['login'] = $result['login'];
                $_SESSION['accessRights'] = $result['accessRights'];
                if($result['accessRights'] == 1) {
                    $_SESSION['firstName'] = $result['firstName'];
                    $_SESSION['lastName'] = $result['lastName'];
                    header('Location: master.php');
                }
            }
        }
    }

    $TBS->Show();
    