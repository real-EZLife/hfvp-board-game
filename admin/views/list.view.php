<h2>Les cartes</h2>
<?php $cards = $cardModel->readAll();
if (empty($cards)) {
    // If no cards in database, show information message
    echo '<div class="alert--warning">Il n\'y a aucune carte dans la base de données.</div>';
} ?>
<div class="big-card-contener">
<?php
if(!empty($cards)) {
    foreach( $cards as $key=>$card) { ?>
<!-- <section class="wrapper"> -->
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
        <!-- contener of "delete" and "modify" links -->
        <div class="link-cont">
            <!-- delete link -->
            <a  onclick="if(window.confirm('Voulez-vous vraiment supprimer ?')) {return true;} else {return false;}" href="?v=vlist&a=delete&id=<?php echo $card->get_id(); ?>&name=<?php echo $card->get_name(); ?>" method="GET">Supprimer</a>
            <!-- update link -->
            <a href="?v=update&id=<?php echo $card->get_id(); ?>" method="GET">Modifier</a>
        </div>
    </div>
<!-- </section> -->
<?php } } ?>
</div>
