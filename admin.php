<?php
session_start();

require_once('dataBase.php');

if( isset( $_GET['deconnect'] ) ) {
    unset( $_SESSION['admin']['user'] );
    header('Location:index.php?_err=logout');
    exit;
}

if( isset( $_POST['login'], $_POST['pwd'] ) ) {
    
    if( !empty( $_POST['login'] ) && !empty( $_POST['pwd'] ) ) {
       
        foreach( $users as $user ) {
            if( $_POST['login']==$user['login'] && $_POST['pwd']==$user['pwd'] ) {
                $_SESSION['admin']['user'] = $user;
            }
        }
        if( !isset( $_SESSION['admin']['user'] ) ) {
            header('Location:index.php?_err=notfound');
            exit;
        }

    } else {
        header('Location:index.php?_err=empty');
        exit;
    }

}

if( !isset( $_SESSION['admin']['user'] ) ) {
    header('Location:index.php?_err=capability');
    exit;
}/*  else {
    echo "Bonjour " . $_SESSION['admin']['user']['nom'] . ' ' . $_SESSION['admin']['user']['pnom'];
    if( $_SESSION['admin']['user']['role']=="superadmin" ) {
        echo "<br>Je peux tout faire, je suis un dieu dans cette application";
    } elseif( $_SESSION['admin']['user']['role']=="admin" ) {
        echo "<br>Je peux faire beaucoup de chose ... mais pas tout";
    } elseif( $_SESSION['admin']['user']['role']=="invite" ) {
        echo "<br>Je ne peux quasi rien faire ... ah si : modifier mon profil";
    } */
    echo '<a href="?deconnect">Déconnexion</a>';
//}