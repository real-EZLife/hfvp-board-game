<h1>Inscription</h1>
<br>
<form action='.?a=signup' method="post">
    <div class="field">
        <label for="name" class="label">Votre Nom</label>
        <input id="name" type="text" name="name" required title="">
    </div><br>
    <div class="field">
        <label for="surname" class="label">Votre Prénom</label>
        <input id="surname" type="text" name="surname" required title="">
    </div><br>
    <div class="field">
        <label for="un" class="label">Votre Pseudo</label>
        <input id="un" type="text" name="pseudo" required title="seulement en lettres minuscule et chiffres">
    </div><br>
    <div class="field">
        <label for="email" class="label">Votre Email</label>
        <input type="email" name="email" required title="email@email.com" >
    </div><br>
    <div class="field">
        <label for="pwd">Votre Mot de passe</label>
        <input id="pwd" type="password" name="password" pattern=".{8,20}" required title="Le mot de passe doit être compris entre 8 et 20 caratères">
    </div><br>
    <div class="field">
        <label for="pwd2" class="label">Confirmer votre Mot de Passe</label>
        <input id="pwd2" type="password" name="password2" pattern=".{8,20}" required>
    </div><br>
    <div class="field">
        <input type="submit" name="register" value="S'inscrire">
    </div><br>
</form>
<a href="index.php"><< Retour</a><br>