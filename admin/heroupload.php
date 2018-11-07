<?php
require_once('classes/hero/hero.class.php');
require_once('classes/hero/hero.model.php');
include('./views/header.php'); ?>

<body>
<div style="width: 80%" class="center">
<?php
// if(!empty($_FILES)) {
//     var_dump($_FILES); }

//     if(!empty($_GET)) {
//         var_dump($_GET); }

//         if(!empty($_POST)) {
//             var_dump($_POST); }
// Copy file in directory
$heroModel = new HeroModel;

if(!empty($_POST['name'])) {
    $res = $heroModel->create($_POST['name'], $_POST['mana'], $_POST['lp'], $_POST['faction'], $_FILES['img']);
    if($res) $res = 'Le héros "' . $_POST['name'] . '" a bien été ajouté !';
}
$repertoireDestination = dirname(__FILE__)."/assets/pic/" . $_POST['faction'] . "/hero/";
$nomDestination = $_FILES['img']['name']; //"fichier_du_".date("YmdHis").".txt";

if (is_uploaded_file($_FILES["img"]["tmp_name"])) {
    if (rename($_FILES["img"]["tmp_name"],
                   $repertoireDestination.$nomDestination)) {
        echo "Le fichier temporaire ".$_FILES["img"]["tmp_name"].
                " a été déplacé vers ".$repertoireDestination.$nomDestination; 
                ?><!-- Alert message when an action has done (delete okay, and modify to do) -->
                <div class="alert--success"><?php if(isset($res)) { echo $res; } ?></div>
                <?php

    } else {
        echo "Le déplacement du fichier temporaire a échoué".
                " vérifiez l'existence du répertoire ".$repertoireDestination;
    }          
} else {
    echo "Le fichier n'a pas été uploadé (trop gros ?)";
}
?>
<?php include('./views/navbar.php'); ?>

<?php include('./views/hero.view.php'); ?>
</div>
</main>
</body>
</html>