<?php
session_start();
// session_destroy();
// require_once('_db/dataBase.php');





// if ( isset($_POST['login'], $_POST['email'], $_POST['pwd'], $_POST['pwdTest']) ) {

//     if( !empty( $_POST['login'] ) && !empty($_POST['email'])  && !empty( $_POST['pwd'] ) && !empty($_POST['pwdTest']) ) {

//         if ( ($_POST['pwd'] != $_POST['pwdTest']) ) {

//             echo 'Le mot de passe ne correspond pas !';
//         }
//     }
// }
/* echo '<pre>';
    var_dump( $_POST);
echo '</pre>'; */
  //  var_dump( $_SESSION);
// $_SESSION['registering'] = array(
    
//     array(
//         'login' =>  $_POST['login'],
//         'email' =>  $_POST['email'],
//         'pwd'   =>  $_POST['pwd'],
//         'role'  =>  'invite'
//     )
// );

// echo '<pre>';
//     var_dump( $_SESSION);
// echo '</pre>';


// foreach( $_SESSION['registering'] as $key => $val ) {

//     foreach( $val as $key2 => $val2 ) {
//     echo $key2 . " " . $val2;
//     }
// }

/* $users = array(
    
    array(
        'login'=>'test',
        'email' => 'email@email.com',
        'pwd'=>'0000',
        'role'=>'invite'
    )
); */



// Determine if a variable 'register' is set and is not NULL
if( isset($_POST, $_POST['register']) ) {
    // Determine if all variable are set and are not NULL
    if( isset($_POST['username'], $_POST['displayedname'], $_POST['email'], $_POST['pwd']) && !empty($_POST['username']) && !empty($_POST['displayedname']) && !empty($_POST['email']) && !empty($_POST['pwd'])) {
        // Check for alphanumeric character(s) from username
        if(  ctype_alnum($_POST['username']) ) {
            // Check for alphanumeric character(s) from displayedname
            if( ctype_alnum($_POST['displayedname']) ) {
                // Remove all illegal characters from an email address 
                $sanitized_userEmail = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
                // Check if the variable $email is a valid email address
                if ( filter_var($sanitized_userEmail, FILTER_VALIDATE_EMAIL) ) {
                    
                    //meilleur test à trouver
                    if( $_POST['pwd'] === $_POST['pwdTest'] ) {
                        
                        $newUser = new stdClass();
                        $newUser->username = $_POST['username'];
                        $newUser->displayedname = $_POST['displayedname'];
                        $newUser->email = $_POST['email'];
                        $newUser->pwd = $_POST['pwd'];
                        $newUser->role = 'invite';
                        
                        require_once('_db/dataBase.php');
                            
                        $DBPath = "C:\_xampp\htdocs\www\HFVSP\_db\database.json";
                        $users = readDBFile( $DBPath );
                        $registerOk = false;
                        foreach($users as $key => $user) {
                            if( $user->username !== $newUser->username ) {
                                if( $user->email !== $newUser->email ) {
                                    if ( $user->displayedName !== $newUser->displayedname ) {
                                        $registerOk = true;
                                    }else {
                                        $err = 'Nom de Joueur déjà pris';
                                    }

                                }else {
                                    $err = 'Email déjà utilisé';
                                }

                            }else {
                                $err = 'Identifiant déjà utilisé';
                            }
                        }
                        if( $registerOk ) {
                            $users[] = $newUser;
                            writeDBFile($DBPath, $users);
                            // var_dump(readDBFile( $DBPath ));
                        }
                        
                    } else {
                        $err = 'Les Mots de Passe ne correspondent pas.';
                    }

                }else {
                    $err = 'Email invalide';
                }

            }else {
                $err = 'Nom de Joueur invalide';
            }

        }else {
            $err = 'Identifiant invalide';
        }

    }else {
        $err = 'Veuillez remplire TOUS les champs';
    }
}

if(isset($err)) echo $err

?>

<center>
<h1>Inscription</h1>
<br>
    <form action="#" method="post">
        <div class="field">
            <label for="un" class="label">Votre Identifiant</label>
            <input id="un" type="text" name="username" placeholder="only numbers and lowercase characters">
        </div>
        <div class="field">
            <label for="dn" class="label">Votre Nom de Joueur</label>
            <input id="dn" type="text" name="displayedname" placeholder="only numbers and lowercase characters">
        </div>
        <div class="field">
            <label for="email" class="label">Votre Email</label>
            <input type="email" name="email" placeholder="email@email.com" >
        </div>
        <div class="field">
            <label for="pwd">Votre Mot de passe</label>
            <input id="pwd" type="password" name="pwd" placeholder="">
        </div>
        <div class="field">
            <label for="pwd2" class="label">Confirmer votre Mot de Passe</label>
            <input id="pwd2" type="password" name="pwdTest" placeholder="">
        </div>
        <div class="field">
            <input type="submit" name="register" value="S'inscrire">
        </div>
    </form>
    <a href="index.php"><< Déjà inscrit ?</a>
</center>