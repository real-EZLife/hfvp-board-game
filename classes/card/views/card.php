<div class="card-view">
    <?php echo '<img class="back-pic" src=".././assets/images/card-background/'.$card->getFaction().'/'.$card->getType().'/'.$card->getImg().'" alt="" class="fallback">' ?>
    <div class="card-inner">
        <div class="card-layer background-layer">
        <!-- picture contener -->
        <!-- <div class="card-layer image-layer"> -->
        <!-- </div> -->
        <!-- stats contener -->
        <div class="card-layer icons-layer">
            <!-- mana -->
            <div class="card-icon card-cost">
                <span class="icon"></span>
                <span class="value">
                    <?php echo $card->getMana() ?></span>
            </div>
            <!-- attack -->
            <div class="card-icon card-atk">
                <span class="icon"></span>
                <span class="value">
                    <?php echo $card->getAtk() ?></span>
            </div>
            <!-- health -->
            <div class="card-icon card-hp">
                <span class="icon"></span>
                <span class="value">
                    <?php echo $card->getPv() ?></span>
            </div>
        </div>
        <!-- type, name and descrption contener -->
        <div class="card-layer text-layer">
            <!-- type with switch to convert name in french (to do : auto translation) -->
            <div class="card-type">
                <?php   switch ($card->getCardtype()) {
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
                <?php echo $card->getName() ?>
            </div>
            <!--show description -->
            <div class="card-desc">
                <?php echo $card->getDesc() ?>
            </div>
            <!-- show faction -->
            <div class="card-faction">
                <?php   switch ($card->getFaction()) {
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