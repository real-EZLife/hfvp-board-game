<?php
session_start();

require_once(dirname(__DIR__) . '/conf/defines.php');
require_once(ROOT_PATH . '/functions/autoloads.php');

require_once(ROOT_PATH . 'conf/db_conf.php');
// require_once(ROOT_PATH . 'classes/user/user.classe.php');
// require_once(ROOT_PATH . 'classes/user/user.controller.php');
// require_once(ROOT_PATH . 'classes/user/user.model.php');


$controller = new UserController;

if (isset($_GET['deconnect'])) {

    $controller->logout();
}

if (!empty($_SESSION['hfvsp']['user'])) {

    $player = unserialize($_SESSION['hfvsp']['user']);
}

if (isset($_POST['signin']) || isset($_POST['signup'])) {

    if (isset($_POST['signin']) && !empty($_POST['login'])) {
        $controller->signin();
    }

    if (isset($_POST['signup']) && !empty($_POST['email']) && !empty($_POST['pseudo'])) {
        $controller->signup();
    }

} else {
    $controller->show();
}

/* if(empty($_GET['c']))
{
    }

} else {

    if (empty($_SESSION['hfvsp']['user'])) {
        header('Location:.?_err=403');
        exit;
    }
} */


