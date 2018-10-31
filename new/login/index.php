<?php
    session_start();

// unset($_SESSION['hfvp']['user']);
if( !isset($_SESSION['hfvp']) ) {
    $_SESSION['hfvp'] = [];
}
if( !isset($_SESSION['hfvp']['user']) ) {
    $_SESSION['hfvp']['user'] = new stdClass();
}
if( isset($_SESSION['hfvp']['user'], $_SESSION['hfvp']['user']->userID, $_SESSION['hfvp']['user']->username, $_SESSION['hfvp']['user']->displayedName, $_SESSION['hfvp']['user']->role) ) {
    
    // header('Location: player.php');
} 

var_dump($_SESSION['hfvp']);

if( isset($_POST, $_POST['login'] ) ) {

    var_dump($_POST);

    if( isset($_POST['login'], $_POST['pwd'] ) && !empty($_POST['login']) && !empty($_POST['pwd']) ) {
        // Check for alphanumeric character(s) from username
        if(  ctype_alnum($_POST['login']) ) {
            // Check for alphanumeric character(s) from displayedname
            if( strlen($_POST['pwd']) >= 8  && strlen($_POST['pwd']) <= 20 ) {



                $users = readDBFile( $DBPath );
                $userFound = false;
                var_dump($users);
                $hashed_password = password_hash($_POST["pwd"], PASSWORD_DEFAULT);
                // $hashed_password = $_POST["pwd"];

                foreach($users as $key => $user) {
                    var_dump($user->username);
                    
                    var_dump($user->userPassword);
                    if( $user->username  === $_POST['login'] ) {
                        if( $user->userPassword === $hashed_password ) {
                            $userFound = true;
                            $loggedUser = $user;

                            break;
                        }else $err = 'identifiants invalides';

                    }else $err = 'identifiants invalides';
                }
                if( $userFound ) { 
                    $_SESSION['hfvp']['user']->username = $loggedUser->username;
                    $_SESSION['hfvp']['user']->displayedName = $loggedUser->displayedUserName;
                    $_SESSION['hfvp']['user']->userID = $loggedUser->userID;
                    $_SESSION['hfvp']['user']->role = $loggedUser->role;
                }
            }else $err = '';

        }else $err = '';

    }else $err = '';
    
}else $err = '';

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../assets/css/reset.css">
    <link rel="stylesheet" href="../assets/css/set_game.css">
    <title>Login | Epic Assembly</title>
</head>

<body>
        <h1>Epic Assembly</h1>
        <br>
        <form method="post">
            <input type="text" name="login" placeholder="Identifiant" aria-label="Identifiant" <?php if
                (isset($_GET['login'])) echo ' value="' . $_GET['login'] . '"' ; ?>><br><br>
            <input type="password" name="pwd" placeholder="Mot de passe" aria-label="Mot de passe"><br><br>
            <input type="submit" value="Se connecter">
        </form>
        <a href="register.php">Pas encore inscrit ?</a>
        <a href="forgotPwd.php">Mot de passe oublié ?</a>
        <a href=".?deconnect">Se déconnecter</a>
</body>

</html>