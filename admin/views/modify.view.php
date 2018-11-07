<?php $card = $cardModel->read($id = $_GET['id']); ?>
<!-- list the card and update form afetr -->
 <h2>Modifier la carte :</h2>
<!-- list here -->
<section class="big-card-contener-update">
<div class="card-view">
<?php echo '<img class="back-pic" src=".././assets/images/card-background/'.$card->get_faction().'/'.$card->get_type().'/'.$card->get_img().'" alt="" class="fallback">' ?>
    <div class="card-inner">
        <!-- <div class="card-layer background-layer"> -->
            <!-- picture contener -->
            <!-- <div class="card-layer image-layer"> -->
        <!-- </div> -->
        <!-- stats contener -->
        <div class="card-layer icons-layer">
            <!-- mana -->
            <div class="card-icon card-cost">
                <span class="icon"></span>
                <span class="value"><?php echo $card->get_mana() ?></span>
            </div>
            <!-- attack --> 
            <div class="card-icon card-atk">
                <span class="icon"></span>
                <span class="value"><?php echo $card->get_atk() ?></span>
            </div>
            <!-- health -->
            <div class="card-icon card-hp">
                <span class="icon"></span>
                <span class="value"><?php echo $card->get_pv() ?></span>
            </div>
        </div>
        <!-- type, name and descrption contener -->
        <div class="card-layer text-layer">
            <!-- type with switch to convert name in french (to do : auto translation) -->
            <div class="card-type">
            <?php   switch ($card->get_cardtype()) {
                        case 'creature':
                            echo 'Créature';
                            break;
                        case 'spell':
                            echo 'Sort';
                            break;
                        case 'shield':
                            echo 'Bouclier';
                            break;
                        case 'special':
                            echo 'Spéciale';
                            break;
                    } ?>
            </div>
            <!-- show name -->
                <div class="card-title">
                    <?php echo $card->get_name() ?>
                </div>
            <!--show description -->
                <div class="card-desc">
                    <?php echo $card->get_desc() ?>
                </div>
            <!-- show faction -->
                <div class="card-faction">
                    <?php   switch ($card->get_faction()) {
                                case 1:
                                    echo 'Heroic Fantasy';
                                    break;
                                case 2:
                                    echo 'Politique';
                                    break;
                            }           ?>
                </div>
            </div>
            <!-- effet spécial si présent -->
            <div class="card-layer foreground-layer">
                <div class="card-fx"></div>
            </div>
        </div>
    </div>
<!-- Update form here -->
<form action="?a=update&id=<?php echo $card->get_id(); ?>" class="grid-4 has-gutter" method="POST">
    <label for="name">Nom de la carte :</label>
        <input class="input-update" type="text" name="name" title="Nom" placeholder="Nom de la carte" value="<?php echo $card->get_name() ?>">
    <label for="mana">Points de mana :</label>
        <input class="input-update" type="text" name="mana" title="Mana" placeholder="Points de mana (Nb)" value="<?php echo $card->get_mana() ?>">
    <label for="pv">Points de vie :</label>
        <input class="input-update" type="text" name="pv" title="Pv" placeholder="Points de vie (Nb)" value="<?php echo $card->get_atk() ?>">
    <label for="atk">Points d'attaque :</label>
        <input class="input-update" type="text" name="atk" title="Atk" placeholder="Points d'attaque (Nb)" value="<?php echo $card->get_pv() ?>">
    <label for="desc">Description :</label>
        <input class="desc-update" type="text" name="desc" title="Description" placeholder="Description" value="<?php echo $card->get_desc() ?>">
    <label for="type">Type :</label>
        <select class="list-update" name="type" title="Type">
            <option value="1" <?php if($card->get_type() == 1) { echo 'selected="selected"'; } ?> >Créature</option>
            <option value="2" <?php if($card->get_type() == 2) { echo 'selected="selected"'; } ?> >Sort</option>
            <option value="3" <?php if($card->get_type() == 3) { echo 'selected="selected"'; } ?> >Bouclier</option>
            <option value="4" <?php if($card->get_type() == 4) { echo 'selected="selected"'; } ?> >Spéciale</option>
        </select>
    <label for="fx">Effets :</label>
        <select class="list-update" name="fx" title="fx">
            <option value="none">Aucun</option>
            <option value="fire">Feu</option>
            <option value="water">Eau</option>
            <option value="air">Air</option>
            <option value="earth">Terre</option>
        </select>
    <label for="special">Carte spéciale :</label>
        <ul class="is-unstyled">
            <li>
                <input type="radio" class="radio" name="special" value="1" id="r1">
                <label for="r1">OUI</label>
                <input type="radio" class="radio" name="special" value="0" checked="checked" id="r2">
                <label for="r2">NON</label>
            </li>
        </ul>
    <!-- <label for="img">Image :</label>
        <input type="file" id="img" name="img" title="Image"/> -->
    <label for="faction">Faction :</label>
        <select class="list-update" name="faction" title="faction">
            <option value="1" <?php if($card->get_faction() == 1) { echo 'selected="selected"'; } ?> >Heroic Fantasy</option>
            <option value="2" <?php if($card->get_faction() == 2) { echo 'selected="selected"'; } ?> >Politiques</option>
        </select>
    <br>
    <button class="btn--primary" onclick="if(window.confirm('Voulez-vous vraiment modifier ?')) {return true;} else {return false;}">Modifier</button>
</form>
</div>
</section>