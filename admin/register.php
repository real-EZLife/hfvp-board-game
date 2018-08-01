<?php
session_start();

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

                    // Vérifie que le mot de passe soit compris entre  8 et 20 (inclus) caractères (avant hashage)
                    if (strlen($_POST['pwd']) >= 8 && strlen($_POST['pwd']) <= 20) {
                        // Vérification mot de passe identique
                        if( $_POST['pwd'] === $_POST['pwdTest'] ) {

                            
                            require_once('_db/dataBase.php');
                            require_once('classModels/User.php');
                                
                            $DBPath = "C:\_xampp\htdocs\www\HFVSP\_db\database.json";
                            $users = readDBFile( $DBPath );

                            // hashage du mot de passe -> string password_hash ( string $password , int $algo [, array $options ] ) http://php.net/manual/fr/function.password-hash.php
                            // Retourne le mot de passe haché, ou FALSE si une erreur survient.
                            $hashed_password = password_hash($_POST["pwd"],PASSWORD_DEFAULT);
                            $newUser = new User( $_POST['username'], $_POST['displayedname'], $_POST['email'], $hashed_password, count($users));



                            $registerOk = false;

                            if( count((array)$users) > 0 ) {
                                foreach($users as $key => $user) {
                                    var_dump($user);
                                    if( $user->username !== $newUser->getUsername() ) {
                                        if( $user->userEmail !== $newUser->getUserEmail() ) {
                                            if ( $user->displayedUserName !== $newUser->getDisplayedUserName() ) {
                                                $registerOk = true;
                                            }else {
                                                $err = 'Nom de Joueur déjà pris';
                                                $registerOk = false;
                                                break;
                                            }
        
                                        }else {
                                            $err = 'Email déjà utilisé';
                                            $registerOk = false;
                                            break;
                                        }
        
                                    }else {
                                        $err = 'Identifiant déjà utilisé';
                                        $registerOk = false;
                                        break;
                                    }
                                }
                            } else if( $newUser ) {
                                writeDBFile( $DBPath, [$newUser->getUserObj()] );
                                var_dump($users);
                            }

                            if( $registerOk ) {
                                if( $newUser ) writeDBFile($DBPath, array_merge($users, array($newUser->getUserObj())) );
                                var_dump($users);
                            }
                            
                        } else $err = 'Les Mots de Passe ne correspondent pas.';

                    } else $err = 'Le mot de passe doit être compris entre 8 et 20 caratères';

                }else $err = 'Email invalide';

            }else $err = 'Nom de Joueur invalide';

        }else $err = 'Identifiant invalide';

    }else $err = 'Veuillez remplire TOUS les champs';
}

if(isset($err)) echo $err

?>

<center>
<h1>Inscription</h1>
<br>
    <form action="#" method="post">
        <div class="field">
            <label for="un" class="label">Votre Identifiant</label>
            <input id="un" type="text" name="username" required title="seulement en lettres minuscule et chiffres">
        </div>
        <div class="field">
            <label for="dn" class="label">Votre Nom de Joueur</label>
            <input id="dn" type="text" name="displayedname" required title="seulement en lettres minuscule et chiffres">
        </div>
        <div class="field">
            <label for="email" class="label">Votre Email</label>
            <input type="email" name="email" required title="email@email.com" >
        </div>
        <div class="field">
            <label for="pwd">Votre Mot de passe</label>
            <input id="pwd" type="password" name="pwd" pattern=".{8,20}" required title="Le mot de passe doit être compris entre 8 et 20 caratères">
        </div>
        <div class="field">
            <label for="pwd2" class="label">Confirmer votre Mot de Passe</label>
            <input id="pwd2" type="password" name="pwdTest">
        </div>
        <div class="field">
            <input type="submit" name="register" value="S'inscrire">
        </div>
    </form>
    <a href="index.php"><< Déjà inscrit ?</a>
</center>