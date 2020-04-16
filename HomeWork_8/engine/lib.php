<?php

function getContent()
{
    $page = 'index';
    if (!empty($_GET['p'])) {
        $page = $_GET['p'];
    }

    $fileName = getFileName($page);

    if (!file_exists($fileName)) {
        $fileName = getFileName('index');
    }

    include $fileName;

    $action = 'index';
    if (!empty($_GET['a'])) {
        $action = $_GET['a'];
    }

    if (!function_exists($action . 'Action')) {
        $action = 'index';
    }

    $actionName = $action . 'Action';
    return $actionName();
}

function getFileName($file)
{
    return __DIR__ . "/pages/" . $file . '.php';
}

function getConnect()
{
    static $link;

    if (empty($link)) {
        $link = mysqli_connect('127.0.0.1', 'root', '', 'shop');
    }

    return $link;
}


function getId()
{
    if (!empty($_GET['id'])) {
        return (int)$_GET['id'];
    }

    return 0;
}

function redirect($path = '', $msg = '')
{
    if (!empty($msg)) {
        $_SESSION[MSG] = $msg;
    }

    if (empty($path)) {
        $path = $_SERVER['HTTP_REFERER'];
    }

    header('Location: ' . $path);
}

function getMsg() {
    $msg='';
    if($_SESSION[MSG]) {
        $msg = $_SESSION[MSG];
        unset($_SESSION[MSG]); 
    }
    return $msg;
}

function countBasket () {
    if (empty($_SESSION['goods'])) {
        return 0;
    }
    return count(($_SESSION['goods']));
}

function clearStr($str) {
    return mysqli_real_escape_string(getConnect(), strip_tags((trim($str))));
}

function isAdmin(){
    return !empty($_SESSION['auth']);
}


//unset($_SESSION['goods'][12]);