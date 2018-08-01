<?php
    session_start();

    /** 
     * Loading Dependencies
     * 
    */
    require_once(dirname(__DIR__) . '/conf/defines.php');
    
    require_once(ROOT_PATH . 'game/init.php');
    require_once(ROOT_PATH . 'game/turn.php');

    $formalDeckComp = [
        ['type' => 'creature', 'nb' => 12],
        ['type' => 'spell', 'nb' => 3],
        ['type' => 'shield', 'nb' => 4],
        ['type' => 'special', 'nb' => 1,]
    ];
    require_once(ROOT_PATH . 'classModels/User.php');

    $user1 = new User( 'Obnoxious', 'Zorlimar', 'youri-26@hotmail.fr', 'azertyuiop', 1, 'admin' );
    $user2 = new User( 'RainbowPoney', 'Mistyk309', 'youri-26@hotmail.fr', 'azertyuiop', 1, 'admin' );

    if(!isset($_SESSION['hfvp']['gameTest'])) {
        $_SESSION['hfvp']['gameTest'] = [];
    }
    if(!isset($_SESSION['hfvp']['gameTest']['whosTurn']))  {
        $_SESSION['hfvp']['gameTest']['whosTurn'] = false;
    }

        $player1 = createNewPlayer( $user1, $formalDeckComp );
        $player2 = createNewPlayer( $user2, $formalDeckComp );
        initPlayerVars($player1);
        initPlayerVars($player2);
        $theGame = createNewLobby($player1, $player2);
        $theGame->decideWhoStarts();


    if($theGame->getWhosTurn() === 1) {
        $theGame->playerAStartTurn();
    }else {
        $theGame->playerBStartTurn();
    }
    require_once(ROOT_PATH . '_db/dataBase.php');


    $gameSavePath = ROOT_PATH . '_db/game.json';
    writeDBFile( $gameSavePath );

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>In Game || Epic Assembly</title>
</head>
<body>
    <?php 
        if( isset($_POST['endTurn'])) {
            if($theGame->getWhosTurn() === 1) {
                $theGame->playerAEndTurn();
                $theGame->playerBStartTurn();
            }else {
                $theGame->playerBEndTurn();
                $theGame->playerAStartTurn();
            }
        }


    ?>
    <form action="" method="post">
        <div class="field">
            <input name="endTurn" type="submit" value="Fin du Tour">
        </div>
    </form>
    <?php 
        if( isset($theGame) ) {
            echo " <h2> Player 1: " . $theGame->getPlayerA()->getPlayerName() . " </h2> ";
            foreach($theGame->getPlayerA()->getPlayerHand() as $cards) {
                foreach($cards as $pos => $card) {
                    echo "<ul>";
                    foreach($card->getCardInfo() as $key => $info) {
                        if( $info !== false )
                            echo "<li> $key : $info </li>";
                    }
                    echo "</ul>";
                };
            }
            echo " <h3> Player 1's Board: </h3>";
            foreach($theGame->getBoard()->getSideA() as $pos => $card) {
                echo "<ul>";
                foreach($card->getCardInfo() as $key => $info) {
                    if( $info !== false )
                        echo "<li> $key : $info </li>";
                }
                echo "</ul>";
            }
            echo "<h2> Player 2: " . $theGame->getPlayerB()->getPlayerName() . "</h2>";
            foreach($theGame->getPlayerB()->getPlayerHand() as $cards) {
                foreach($cards as $pos => $card) {
                    echo "<ul>";
                    foreach($card->getCardInfo() as $key => $info) {
                        if( $info !== false )
                            echo "<li> $key : $info </li>";
                    }
                    echo "</ul>";
                };
            }
            echo " <h3> Player 2's Board: </h3>";
            foreach($theGame->getBoard()->getSideB() as $pos => $card) {
                // var_dump($theGame->getBoard()->getSideB());
                echo "<ul>";
                foreach($card->getCardInfo() as $key => $info) {
                    if( $info !== false )
                        echo "<li> $key : $info </li>";
                }
                echo "</ul>";
            }
        } 
    ?>
</body>
</html>