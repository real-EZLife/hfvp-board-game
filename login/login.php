<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
</head>
<body>
    <form action="#" method="post" >
        <input type="text" name="login" placeholder="Pseudo" aria-label="Pseudo"<?php if (isset($_GET['login'])) echo ' value="' . $_GET['login'] . '"'; ?>><br><br>
        <input type="password" name="pwd" placeholder="Mot de passe" aria-label="Mot de passe"><br><br>
        <input type="submit" value="Se connecter">
    </form>
</body>
</html>