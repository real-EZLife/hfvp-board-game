<?php
session_start();

required_once('classes/user/user.classe.php');
required_once('classes/user/user.controller.php');
required_once('classes/user/user.model.php');

$controller = new UserController;

if (isset($_GET['deconnect'])) {

    $controller->logout();
}

if (!empty($_SESSION['hfvsp']['player'])) {

    $player = unserialize($_SESSION['hfvsp']['player']);
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

    if (empty($_SESSION['hfvsp']['player'])) {
        header('Location:.?_err=403');
        exit;
    }
} */


