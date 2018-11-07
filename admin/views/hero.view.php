<h2>Les héros<h2>
<?php $heroes = $heroModel->readAll();
// If no factions in database, show information message
if (empty($heroes)) {
    echo '<div class="alert--warning">Il n\'y a aucun héros dans la base de données.</div>';
}
?>
<section class="big-hero-contener">
<?php
if(!empty($heroes)) {
    foreach( $heroes as $key=>$hero) { ?>
<div class="card-view">
<?php echo '<img class="hero-img" src=".././assets/images/card-background/'.$hero->get_faction().'/hero/'.$hero->get_img().'" alt="" class="fallback">' ?>
    <div class="hero-inner">
        <div class="hero-layer icons-layer">
            <!-- Mana -->
            <div class="hero-icon hero-mana">
                <span class="icon"></span>
                <span class="value"><?php echo $hero->get_mana(); ?></span> 
            </div>
            <!-- Life -->
            <div class="hero-icon hero-life">
                <span class="icon"></span>
                <span class="value"><?php echo $hero->get_lp(); ?></span> 
            </div>
        </div>
        <div class="hero-text">
            <div class="title">
                <a class="fac-name" href="#"><?php echo $hero->get_name(); ?></a>
            </div>
            <div class="hero-faction">
                            <?php   switch ($hero->get_faction()) {
                                        case 1:
                                            echo 'Heroic Fantasy';
                                            break;
                                        case 2:
                                            echo 'Politique';
                                            break;
                                    } ?>
            </div>
        </div>
    </div>
</div>
<?php } } ?>
</section>
<!-- Form hero here -->
<section class="form-hero">
    <form enctype="multipart/form-data" action="heroupload.php" class="grid-4 has-gutter" method="POST">
        <label for="name">Nom du héros :*</label>
            <input type="text" name="name" title="Nom" placeholder="Nom du héros" required>
        <label for="mana">Points de mana :*</label>
            <input type="text" name="mana" title="Mana" placeholder="Points de mana" required>
        <label for="lp">Points de vie :*</label>
            <input type="text" name="lp" title="Pv" placeholder="Points de vie" required>
        <label for="faction">Faction</label>
            <select name="faction" title="faction">
                <option value="1">Heroic Fantasy</option>
                <option value="2">Politiques</option>
            </select>
        <label for="img">Image :*</label>
            <input type="file" name="img" title="img" required>
        <br>
        <button class="btn--primary">Créer</button>
    </form>
</section>