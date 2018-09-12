<?php 

    function logMess( String $message ) {

        print_r($message);

    }

    function startGameTurn( Lobby $game ) {

        //
        $game->startGameTurn();
        //
        switch($game->getWhosTurn()) {
            //la propriété WhosTurn peut prendre deux valeurs (1 ou 2)
            case 1: 
                //  
                logMess( 'Au Tour du Joueur 1: ' . $game->getPlayerA()->getPlayerName() );
                break;

            case 2:
                //
                logMess( 'Au Tour du Joueur 2: ' . $game->getPlayerB()->getPlayerName() );
                break;
            
            default: 
                
                break;
        }
    }
    function endGameTurn( Lobby $game ) {
        

    }

    function startPlayerTurn( Player $player ) {
        if( $player->getPlayerTurnStatus() === false ) {
            $player->setTurns( $player->getTurns() + 1 );
            if( $player->getTurns() === 1 ) {
                $player->initialDraw();
            }else {
                $player->drawCard(1);
            }
            $player->addOneTotalMana();
            $player->setCurrentMana( $player->getTotalMana() );
            $player->setPlayerTurnStatus( true );
        }else {
        }
    }

    function endPlayerTurn( Player $player ) {
        if( $player->getPlayerTurnStatus() === true ) {
            $player->setPlayerTurnStatus( false );
        }else {
            $err = 'Not ' . $player->getPlayerName() . ' turn.';
        }
    }