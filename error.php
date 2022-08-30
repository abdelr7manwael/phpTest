<?php
session_start();

// solution is using isset() on session to check if it's exist or not before assign its value  
$lang = isset($_POST['lang']) ? $_POST['lang'] : isset($_SESSION['lang']) ? $_SESSION['lang']:'';
if(isset($_POST['inp_lang'])){ $_SESSION['lang'] = $lang;}
if(!isset($lang)|| empty($lang)){
    echo substr($_SERVER['HTTP_ACCEPT_LANGUAGE'],0,2);
    $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'],0,2);
}

?>