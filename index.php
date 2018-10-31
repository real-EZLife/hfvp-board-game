<?php
error_reporting(E_ALL & ~E_NOTICE); // Sets which PHP errors are reported (http://php.net/manual/fr/function.error-reporting.php)
session_start();
try {
    
    
    /**
     * --------------------------------------------------
     * AUTOROUTING
     * --------------------------------------------------
     **/
    
    
} catch(Exception $e) {
    
}
?>
<?php if(isset($_SESSION['hfvp']['user'], $_SESSION['hfvp']['user']['pseudo'])) : ?>
    <a href="./login?a=logout">Se déconnecter</a>
<?php else : ?>
    <a href="./login">Se connecter</a>
    <a href="./login?a=register">Créer un compte</a>
<?php endif ?>
