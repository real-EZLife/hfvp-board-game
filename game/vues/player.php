<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>theGame</title>
</head>

<body>

    <div class="hero">
        <div class="player--name">
            Nom de Joueur:
            <? $player->getPlayerName() ?>
        </div>
        <ul class="hero--stats">
            <li>Nombre de cartes en main: 
                <? $hero->getHandLength() ?>
            </li>
            <li>Nombre de cartes en deck: 
                <? $hero->getDeckLength() ?>
            </li>
            <li>Mana:
                <? $hero->getCurrentMana() ?> / <? $hero->getTotalMana() ?>
            </li>
            <li>Vos cartes en main: 
                <? if($hero->getDeckLength() > 0) : ?>
                    <ul class="hero--cardlist">
                        <? foreach($hero->getHeroHand() as $card) : ?>
                            <li class="hero--card">
                                <? $card->cardName ?>
                            </li>
                        <? endforeach ?>
                    </ul>
                <? endif ?>
            </li>
        </ul>
    </div>

</body>

</html>