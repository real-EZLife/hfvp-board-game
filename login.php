<?php
    session_start();

    if( !isset($_SESSION['hfvp']) ) {
        $_SESSION['hfvp'] = [];
    }



?>



<form action="#" method="post" >

    <div class="field">
        <label for="un" class="label">Identifiant ou Email</label>
        <input type="text">
    </div>
    <div class="field">
        <label for="pwd" class="label">Mot de Passe</label>
        <input type="password">
    </div>
    <div class="field">
        <label for="submit" class="label"></label>
        <input id="submit" type="submit" name="login" value="Connexion">
    </div>


</form>