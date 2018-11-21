<?php
//session_start();
require_once(dirname(__DIR__) . '/conf/defines.php');
require_once(ROOT_PATH . '/functions/autoloads.php');
require_once(ROOT_PATH . 'conf/db_conf.php');
// Card classes
// require_once('.././classes/card/card.class.php');
// require_once('.././classes/card/card.model.php');
// // Faction classes
// require_once('.././classes/faction/faction.class.php');
// require_once('.././classes/faction/faction.model.php');
// // Type classes
// require_once('.././classes/type/type.class.php');
// require_once('.././classes/type/type.model.php');
// // Hero classes
// require_once('.././classes/hero/hero.class.php');
// require_once('.././classes/hero/hero.model.php');
$cardModel = new CardModel;
$factionModel = new FactionModel;
$typeModel = new TypeModel;
$heroModel = new HeroModel;
if(isset($_GET['a'])) {
    if($_GET['a'] == 'create') {
        $res = $cardModel->create($_POST);
        if($res) $res = 'La carte "' . $_POST['name'] . '" a bien été ajoutée !';
    } elseif($_GET['a'] == 'delete') {
        // include('confirm.php')
        $res = $cardModel->delete($_GET['id']);
        if($res) $res = 'La carte "' . $_GET['name'] . '" a bien été supprimée !';
    } elseif($_GET['a'] == 'update') {
        $res = $cardModel->update($_POST);
        if($res) $res = 'La carte "' . $_POST['name'] . '" a bien été modifiée !';
    } 
}
$cards = $cardModel->readAll();
// !DOCTYPE here
include('./views/header.php'); ?>
<!-- Alert message when an action has done (delete okay, and modiidy to do) -->
<div class="alert--success"><?php if(isset($res)) { echo $res; } ?></div>
<?php
// If we get a view ('v'), show it, if we get an action ('a'), show it. Both possible
if((isset($_GET['v'])) || (isset($_GET['a']))) {
    if(in_array('vcreate', $_GET)) { 
        include('./views/create.view.php'); 
    } elseif ((!empty($cards)) && (in_array('vlist', $_GET))) { 
        include('./views/list.view.php');
    } elseif(in_array('vfaction', $_GET)) {
        include('./views/faction.view.php');
    } elseif(in_array('vtype', $_GET)) {
        include('./views/type.view.php');
    } elseif(in_array('vhero', $_GET)) {
        include('./views/hero.view.php');
    } elseif(in_array('update', $_GET)) {
        include('./views/modify.view.php');
    } 
}
?>
</main>
<?php include('./views/footer.php'); ?>
</body>
</html>
<?php 
// Juste a little var_dump, in case of ! ;)
// if(!empty($cards)) {
// var_dump($cards); }
?>