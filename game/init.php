<?php
    // session_start();

    
    
    // $_SESSION['hfvp']['user'] = new stdClass();
    
    // var_dump($user1->getUserObj());
    
    
    
    
    //


    function createNewPlayer( Object $user, Array $deckType ) : object {
        require_once(ROOT_PATH . 'classModels/Player.php');
        require_once(ROOT_PATH . 'classModels/Hand.php');
        require_once(ROOT_PATH . 'classModels/Deck.php');
        $newHand = new Hand();
        $newDeck = new Deck( $deckType );
        $newPlayer = new Player( $user, $newDeck, $newHand );

        return $newPlayer;
    }
    function createNewLobby( Object $playerInstanceA, Object $playerInstanceB ) : object {
        require_once(ROOT_PATH . 'classModels/Lobby.php');
        require_once(ROOT_PATH . 'classModels/Board.php');
        $newBoard = new Board();
        $newLobby = new Lobby( $newBoard, $playerInstanceA, $playerInstanceB );

        return $newLobby;
    }

    function initPlayerVars( Object $playerInstance ) : void {
        $playerInstance->deckSetup();
    }
?>