<?php
session_start();

require_once('../conf/defines.php');
require_once(ROOT_PATH . 'conf\db_conf.php');
require_once(ROOT_PATH . 'functions\autoloads.php');


if(!$_SESSION['hfvp']['user']) {
    header('Location: /login');
}
$user = $_SESSION['hfvp']['user'];


$controller = new GameController;
if(isset($_GET['c']) && !empty($_GET['c'])) {
    $controllerName = ucfirst($_GET['c']) . 'Controller';
    if(class_exists($controllerName)) {
        $controller = new $controllerName();
    }else {
        header('HTTP/1.1 404 Not Found');
    }
}
$controller->setModel($epic_db);
if(isset($_GET['a']) && !empty($_GET['a'])) {
    $actionName = strtolower($_GET['a']) . 'Action';
    if(method_exists($controller, $actionName)) {
        $controller->$actionName($_POST);
    }else {
        header('HTTP/1.1 404 Not Found');
    }
}else {
    $controller->defaultAction();
}