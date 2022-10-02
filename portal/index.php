<?php
    session_start();
    error_reporting(E_ALL & ~E_NOTICE);
    date_default_timezone_set("Africa/Lagos");
    
    $url = $_GET['url'];
    $url = rtrim($url, '/');
    $url = explode('/', $url);
    if ($url[0] == ""){
        include('login.php');
    } 

    //end of client portal info

    if(file_exists('views/' . $url[0] . '.php')){
        $page = 'views/' . $url[0] . '.php';
        include('main.php');
    }
    elseif(!file_exists('views/' . $url[0] . '.php') && $url[0] != "") {
        include("404.php");
    }

?>
    