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
    
    
    
    
    // while(1) {
        //     $theGame->startGameTurn();
        //         $theGame->playerAStartTurn();
        //         $theGame->playerAEndTurn();
        //         $theGame->playerBStartTurn();
        //         $theGame->playerBEndTurn();
        //     writeDBFile( $gameSavePath, $theGame->exportLobby() );
        
        //     if($theGame->getGameTurns() >= 10) break;
        // }
        // var_dump($theGame);
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
                    writeDBFile( $gameSavePath, array_merge(readDBFile($gameSavePath), [$theGame->exportLobby()]));
                }else {
                    writeDBFile( $gameSavePath, [$theGame->exportLobby()] );
                }
            }
        }
        if(isset($_SESSION['hfvp']['game'], $_SESSION['hfvp']['game']['id'])) {
            require(ROOT_PATH . 'game/restoreDatas.php');
            $gameID = $_SESSION['hfvp']['game']['id'];


            if(readDBFile($gameSavePath)[$gameID] === null) {
             
                session_destroy();
                header('Location: http://localhost/www/HFVSP/');
                
            }

            $storedGameLobby = readDBFile($gameSavePath)[$gameID];

            
            
            $theGame = restoreLobby($storedGameLobby, $user1, $user2);
            var_dump($theGame->getGameTurns());
            // if($theGame->getGameTurns() === 0) {

            // }
            
            // startGameTurn($theGame);

            if( isset($_POST) && $theGame->getWhosTurn() === 1 ) {
                
                var_dump($_POST);

                if( isset($_POST['start_turn1']) ) {
                    echo 'P1 starts';
                    $theGame->playerAStartTurn();
                }
                if( isset($_POST['end_turn1']) ) {
                    echo 'P1 ends';
                    $theGame->playerAEndTurn();
                }
                
                // var_dump($theGame->getWhosTurn());
                
                
            }else {

                
                if( isset($_POST['start_turn2']) ) {
                    echo 'P2 starts';
                    $theGame->playerBStartTurn();
                }
                if( isset($_POST['end_turn2']) ) {
                    echo 'P2 ends';
                    $theGame->playerBEndTurn();
                } 
            }
            // var_dump(readDBFile($gameSavePath)[$gameID]);
            // readDBFile($gameSavePath)[$gameID] = phpToJson($theGame->exportLobby());

            var_dump($_POST);
            updateDBFile($gameID, $gameSavePath, $theGame->exportLobby());
        }
    }
        // if(isset($_POST, $_POST['endturn']))
    // }
    
?>