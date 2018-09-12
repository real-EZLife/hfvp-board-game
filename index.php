<?php

    session_start();

    require_once(dirname(__DIR__) . '/HFVSP/conf/defines.php');

    require('game/game.php');

    // var_dump($theGame);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>theGame</title>
</head>
<body>

        <?php if(!isset($_SESSION['hfvp']['game']['id'])) : ?>
                    <form action='' method='post'>
                        <input type='submit' name='newGame' value='start game'>
                    </form>
        <?php else : ?>
            <?php if(isset($theGame) && $theGame->getWhosTurn() !== 0) : ?>
                <?php if($theGame->getWhosTurn() === 1) : ?>
                    <li>Vous: <?php echo $theGame->getPlayerA()->getPlayerName() ?></li>
                    <li>Votre Main: <?php echo $theGame->getPlayerA()->getHandLength() ?></li>
                    <li>Votre Deck: <?php echo $theGame->getPlayerA()->getDeckLenght() ?></li>
                    <li>Votre Mana: <?php echo $theGame->getPlayerA()->getCurrentMana() ?> / <?php echo $theGame->getPlayerA()->getTotalMana() ?></li>
                    <?php if( count($theGame->getPlayerA()->getPlayerHand()) > 0 ) : ?>
                        <li>Vos Cartes:
                            <ol>
                                <?php foreach($theGame->getPlayerA()->getPlayerHand() as $pos => $card) : ?>
                                    <li>
                                        <ul>    
                                            <?php foreach($card->getCardInfo() as $prop => $value) : ?>
                                                <li><?php echo "$prop : $value" ?></li>
                                            <?php endforeach ?>
                                        </ul>
                                    </li>
                                <?php endforeach ?>
                            </ol>
                        </li>
                    <?php endif ?>
                    <?php if(!$theGame->getPlayerA()->getPlayerTurnStatus()) : ?>
                            <form action='' method='post'>
                                <input type='submit' name='start_turn1' value='Début du tour'>
                            </form>
                    <?php else : ?>
                            <form action='' method='post'>
                                <select name='selected_card'></select>
                                <input type='submit' name='play_card' value='Jouer Carte'>
                            </form>    
                            <form action='' method='post'>
                                <input type='submit' name='end_turn1' value='Fin du tour'>
                            </form>
                    <?php endif ?>
                    
                <?php else : ?>
                    <li>Vous: <?php echo $theGame->getPlayerB()->getPlayerName() ?></li>
                    <li>Votre Main: <?php echo $theGame->getPlayerB()->getHandLength() ?></li>
                    <li>Votre Deck: <?php echo $theGame->getPlayerB()->getDeckLenght() ?></li>
                    <li>Votre Mana: <?php echo $theGame->getPlayerB()->getCurrentMana() ?> / <?php echo $theGame->getPlayerB()->getTotalMana() ?></li>
                    <?php if( count($theGame->getPlayerB()->getPlayerHand()) > 0 ) : ?>
                        <li>Vos Cartes:
                            <ol>
                                <?php foreach($theGame->getPlayerB()->getPlayerHand() as $pos => $card) : ?>
                                    <li>
                                        <ul>    
                                            <?php foreach($card->getCardInfo() as $prop => $value) : ?>
                                                <li><?php echo "$prop : $value" ?></li>
                                            <?php endforeach ?>
                                        </ul>
                                    </li>
                                <?php endforeach ?>
                            </ol>
                        </li>
                    <?php endif ?>
                    <?php if(!$theGame->getPlayerB()->getPlayerTurnStatus()) : ?>
                            <form action='' method='post'>
                                <input type='submit' name='start_turn2' value='Début du tour'>
                            </form>
                    <?php else : ?>
                            <form action='' method='post'>
                                <select name='selected_card'></select>
                                <input type='submit' name='play_card' value='Jouer Carte'>
                            </form>    
                            <form action='' method='post'>
                                <input type='submit' name='end_turn2' value='Fin du tour'>
                            </form>
                    <?php endif ?>
                <?php endif ?>
            <?php endif ?>
        <?php endif ?>
</body>
</html>