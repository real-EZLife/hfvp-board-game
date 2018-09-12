<?php
    // session_start();

    
    
    // $_SESSION['hfvp']['user'] = new stdClass();
    
    // var_dump($user1->getUserObj());
    
    /**
     * createNewPlayer allows to create a new Player instance
     * @param object User $user
     * @param array $deckType deck prototype with cards type as [type => String, nb => Int] 
     * 
     * @return object Player $newPlayer 
     */
    function createNewPlayer( User $user, Array $deckType ) : object {
        require_once(ROOT_PATH . 'classModels/Player.php');
        require_once(ROOT_PATH . 'classModels/Hand.php');
        require_once(ROOT_PATH . 'classModels/Deck.php');
        $newHand = new Hand();
        $newDeck = new Deck( $deckType );
        $newPlayer = new Player( $user, $newDeck, $newHand );

        return $newPlayer;
    }
    /**
     * createNewLobby allows to create a new Lobby instance (game instance)
     * @param object Player $playerInstanceA the first player instance to generate a game
     * @param object Player $playerInstanceB the other player instance to generate a game
     * 
     * @return object Lobby $newLobby
     */
    function createNewLobby( Object $playerInstanceA, Object $playerInstanceB ) : object {
        require_once(ROOT_PATH . 'classModels/Lobby.php');
        require_once(ROOT_PATH . 'classModels/Board.php');
        //generate a Board object to generate the game instance
        $newBoard = new Board();
        $newLobby = new Lobby( $newBoard, $playerInstanceA, $playerInstanceB );

        return $newLobby;
    }

    /**
     * initPlayerVars allows to init a Player->deck and populate it with the corresponding Cards Objects
     * @param object Player $playerInstance
     * 
     * @return void
     */
    function initPlayerVars( Object $playerInstance ) : void {
        $playerInstance->deckSetup();
    }