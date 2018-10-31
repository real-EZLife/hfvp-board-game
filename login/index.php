<?php
session_start();

require_once(dirname(__DIR__) . '/conf/defines.php');
require_once(ROOT_PATH . '/functions/autoloads.php');
require_once(ROOT_PATH . 'conf/db_conf.php');


$controller = new UserController;
$controller->setModel($epic_db);
if(isset($_GET['a']) && !empty($_GET['a'])) {
    $actionName =  strtolower($_GET['a']) . 'Action';
    if(method_exists($controller, $actionName)) {
        $controller->$actionName($_POST);
    }else {
        header('HTTP/1.1 404 Not Found');
    }
}else {
    $controller->defaultAction();
}

