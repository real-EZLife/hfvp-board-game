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
        
        // header('Location:player.php');
    } 
    var_dump($_SESSION['hfvp']);
    if( isset($_POST, $_POST['login'] ) ) {
        var_dump($_POST);
        if( isset($_POST['username'], $_POST['pwd'] ) && !empty($_POST['username']) && !empty($_POST['pwd']) ) {
            // Check for alphanumeric character(s) from username
            if(  ctype_alnum($_POST['username']) ) {
                // Check for alphanumeric character(s) from displayedname
                if( strlen($_POST['pwd']) >= 8  && strlen($_POST['pwd']) <= 20 ) {



                    require_once('_db/dataBase.php');
                    $DBPath = "C:\_xampp\htdocs\www\HFVSP\_db\database.json";

                    $users = readDBFile( $DBPath );
                    $userFound = false;
                    var_dump($users);
                    $hashed_password = password_hash($_POST["pwd"],PASSWORD_DEFAULT);
                    // $hashed_password = $_POST["pwd"];

                    foreach($users as $key => $user) {
                        var_dump($user->username);
                        
                        var_dump($user->userPassword);
                        if( $user->username  === $_POST['username'] ) {
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



<form action="#" method="post" >

    <div class="field">
        <label for="un" class="label">Identifiant ou Email</label>
        <input name="username" type="text">
    </div>
    <div class="field">
        <label for="pwd" class="label">Mot de Passe</label>
        <input name="pwd" type="password">
    </div>
    <div class="field">
        <label for="submit" class="label"></label>
        <input id="submit" type="submit" name="login" value="Connexion">
    </div>


</form>