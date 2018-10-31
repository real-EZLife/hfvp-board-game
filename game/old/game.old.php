<?php

    /** 
     * Loading Dependencies
     */
    // session_destroy();
    require_once(ROOT_PATH . 'game/init.php');
    require_once(ROOT_PATH . 'game/turn.php');
    // require_once(ROOT_PATH . 'game/players/actions.php');
    require_once(ROOT_PATH . '_db/dataBase.php');
    $gameSavePath = ROOT_PATH . '_db/game.json';
    $formalDeckComp = [
        ['type' => 'creature', 'nb' => 12],
        ['type' => 'spell', 'nb' => 3],
        ['type' => 'shield', 'nb' => 4],
        ['type' => 'special', 'nb' => 1,]
    ];
    require_once(ROOT_PATH . 'classModels/User.php');

    $user1 = new User( 'Obnoxious', 'Zorlimar', 'youri-26@hotmail.fr', 'azertyuiop', 1, 'admin' );
    $user2 = new User( 'RainbowPoney', 'Mistyk309', 'youri-26@hotmail.fr', 'azertyuiop', 1, 'admin' );
    
    
    $theGame;

    if(isset($_POST)) {
        if(isset($_POST, $_POST['newGame']) ) {
            // var_dump(count(readDBFile($gameSavePath)));
            if(!isset($_SESSION['hfvp']['game'], $_SESSION['hfvp']['game']['id'])) {
                $_SESSION['hfvp']['game'] = [];
                if( readDBFile($gameSavePath) !== null && count(readDBFile($gameSavePath)) ) {
                    $_SESSION['hfvp']['game']['id'] = count(readDBFile($gameSavePath)) ;
                }else {
                    $_SESSION['hfvp']['game']['id'] = 0;
                }
                $player1 = createNewPlayer( $user1, $formalDeckComp );
                $player2 = createNewPlayer( $user2, $formalDeckComp );
                $theGame = createNewLobby($player1, $player2); 
                

                if($theGame->getGameTurns() === 0) {

                    initPlayerVars($theGame->getPlayerA());
                    initPlayerVars($theGame->getPlayerB());
                    $theGame->decideWhoStarts();

                }
                if( readDBFile($gameSavePath) !== null && count(readDBFile($gameSavePath)) > 0) {
                    var_dump(count(readDBFile($gameSavePath)));
                    writeDBFile( $gameSavePath, array_merge(readDBFile($gameSavePath), [$theGame->export()]));
                }else {
                    writeDBFile( $gameSavePath, [$theGame->export()] );
                }
            }
        }
        if(isset($_SESSION['hfvp']['game'], $_SESSION['hfvp']['game']['id'])) {
            require(ROOT_PATH . 'game/restoreDatas.php');
            $gameID = $_SESSION['hfvp']['game']['id'];


            if(readDBFile($gameSavePath)[$gameID] === null) {
             
                session_destroy();
                header('Location: ./');
                
            }

            $storedGameLobby = readDBFile($gameSavePath)[$gameID];

            
            
            $theGame = restoreLobby($storedGameLobby, $user1, $user2);
            var_dump($theGame->getGameTurns());

            if( isset($_POST) && $theGame->getWhosTurn() === 1 ) {
                

                if( isset($_POST['start_turn1']) ) {
                    echo 'P1 starts';
                    $theGame->playerAStartTurn();
                }
                if( isset($_POST['end_turn1']) ) {
                    echo 'P1 ends';
                    $theGame->playerAEndTurn();
                }
                if( isset($_POST['play_card']) ) {
                    if(isset($_POST['selected_card']) && is_numeric($_POST['selected_card'])) {
                        
                        echo 'P1 play card';
                        $theGame->playerAPlayCard( stringToNumber($_POST['selected_card']) );

                    }
                }
                
                
            }else {

                
                if( isset($_POST['start_turn2']) ) {
                    echo 'P2 starts';
                    $theGame->playerBStartTurn();
                }
                if( isset($_POST['end_turn2']) ) {
                    echo 'P2 ends';
                    $theGame->playerBEndTurn();
                }
                if( isset($_POST['play_card']) ) {
                    if(isset($_POST['selected_card']) && is_numeric($_POST['selected_card'])) {
                        
                        echo 'P2 play card';
                        $theGame->playerBPlayCard( stringToNumber($_POST['selected_card']) );

                    }
                }
            }

            var_dump($_POST);
            var_dump($theGame->getBoard());
            updateDBFile($gameID, $gameSavePath, $theGame->export());
        }
    }
?>