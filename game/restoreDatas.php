<?php
    require_once(ROOT_PATH . 'classModels/Player.php');
    require_once(ROOT_PATH . 'classModels/Hand.php');
    require_once(ROOT_PATH . 'classModels/Deck.php');
    require_once(ROOT_PATH . 'classModels/Board.php');
    require_once(ROOT_PATH . 'classModels/Lobby.php');

    function restoreCardList( String $type, Array $cardList ) {
        
        $type = strtolower($type);
        
        $restoredCardList = [];

        foreach($cardList as $pos => $card) {
            switch( $card->type ) {
                case 'creature':
                $restoredCardList[] = new Creature($card->name, $card->img, $card->desc, $card->manaCost, $card->atk, $card->hp);
                break;
                case 'spell':
                $restoredCardList[] = new Spell($card->name, $card->img, $card->desc, $card->manaCost, $card->effect);
                break;
                case 'shield':
                $restoredCardList[] = new Shield($card->name, $card->img, $card->desc, $card->manaCost, $card->atk, $card->hp);
                break;
                case 'special':
                $restoredCardList[] = new Special($card->name, $card->img, $card->desc, $card->manaCost, $card->atk, $card->hp, $card->effect);
                break;
            }
        }
        switch( $type ) {
            case 'deck':
                
                $deck = new Deck();
                $deck->setDeckListFromArray($restoredCardList);
                
                return $deck;

                break;
            case 'hand':

                $hand = new Hand();
                $hand->setHandFromArray($restoredCardList);
                
                return $hand;

                break;
            case 'board':

                $board = $restoredCardList;

                return $board;

                break;
            default: 

                print_r( 'invalid cardList param $type passed' );
                break;
        }
    }
    function restoreBoard( Object $board ) : Board {
        
        $restoredBoard = new Board();

        $restoredBoard->setSideA(restoreCardList('board', $board->boardSideA));
        $restoredBoard->setSideB(restoreCardList('board', $board->boardSideB));
        $restoredBoard->setSideACemetery(restoreCardList('board', $board->boardCemeterySideA));
        $restoredBoard->setSideBCemetery(restoreCardList('board', $board->boardCemeterySideB));

        return $restoredBoard;
    }
    function restorePlayer ( Object $user, Object $player ) : Player {
        
        $restoredHand = restoreCardList('hand', $player->hand);
        $restoredDeck = restoreCardList('deck', $player->deck);

        
        $restoredPlayer = new Player($user, $restoredDeck, $restoredHand);
        $restoredPlayer->setHp($player->hp);
        $restoredPlayer->setTotalMana($player->totalMana);
        $restoredPlayer->setCurrentMana($player->currentMana);
        $restoredPlayer->setTurns($player->turns);
        $restoredPlayer->setAliveStatus($player->isAlive);
        $restoredPlayer->setPlayerTurnStatus($player->isPlayerTurn);
        $restoredPlayer->setFaction($player->faction);

        return $restoredPlayer;
    }
    
    function restoreLobby( Object $storedLobby, User $user1, User $user2 ) : Lobby {

        $storedBoard = $storedLobby->board;
        $storedPlayer1 = $storedLobby->playerA;
        $storedPlayer2 = $storedLobby->playerB;

        $board = restoreBoard($storedBoard);
        $playerA = restorePlayer($user1, $storedPlayer1);
        $playerB = restorePlayer($user2, $storedPlayer2);

        $restoredLobby = new Lobby( $board, $playerA, $playerB );
        $restoredLobby->setGameStatus($storedLobby->gameStatus);
        $restoredLobby->setWhosTurn($storedLobby->whosTurn);
        $restoredLobby->setGameTurns($storedLobby->elapsedTurns);

        return $restoredLobby;
    }