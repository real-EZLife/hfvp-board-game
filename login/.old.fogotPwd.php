<?php

    // 1 - Se connecter à la base de donnée pour vérifier l'adresse mail

    // 2 - creer un mot de passe -> le placer dans la colonne password de l'utilisateur 

    // 3 - Envoyer un mail avec un lien le dirigeant sur editPwd.php

    // 4 - insérer dans la base de donnée le nouveau mot de passe 



?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../assets/css/reset.css">
    <link rel="stylesheet" href="../assets/css/set_game.css">
    <title>Cards Manager</title>
</head>
<body>
    <center>
    <h1>Mot de passe oublié</h1>
    <p>Merci de rentrer votre adresse mail... <br>Vous recevrez un mot de passe temporaire et un lien pour changer celui-ci.</p>
    <br>
        <form method="post">
            <input type="email" name="email" placeholder="Email" >
            <input type="submit" value="Envoyer">
        </form>
        <a href="index.php"><< Retour</a>
    </center>
</body>
</html>