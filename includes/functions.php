<?php
    // Load configuration as an array. Use the actual location of your configuration file
    $config = parse_ini_file('config.ini');

    // Try and connect to the database
    $connection = mysqli_connect('localhost',$config['username'],$config['password'],$config['dbname']);
    try {
        $connection = new PDO('mysql:host=localhost;dbname='.$config['dbname'].';charset=utf8', $config['username'], $config['password']);
    } catch(Exception $e) {
        die('Erreur : '.$e->getMessage());
    }
    // If connection was not successful, handle the error
    if($connection === false) {
        // Handle error - notify administrator, log to a file, show an error screen, etc.
    }

    $REST_HOST = '172.17.10.24';
    $REST_PORT = 8080;

 ?>
