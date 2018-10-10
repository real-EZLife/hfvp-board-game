<?php
    // L'utilisateur doit déjà être connecté (ou avoir recu un mail) pour pouvoir changer son mot de passe 
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
    <h1>Changer le mot de passe ou l'adresse mail</h1><br>
        <form method="post">
            <input type="email" name="email" placeholder="Nouvel email" ><br><br>
            <input type="password" name="pwd" placeholder="Nouveau mot de passe">
            <input type="password" name="pwd2" placeholder="Confirmer mot de passe"><br><br>
            <input type="submit" value="Soumettre">
        </form>
        <a href="index.php"><< Retour</a>
    </center>
</body>
</html>