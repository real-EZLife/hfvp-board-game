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
        //Check that $player->turnStatus is indeed false
        if( $player->getPlayerTurnStatus() === false ) {
            //Add 1 to $player->turns
            $player->setTurns( $player->getTurns() + 1 );
            //Check $player->turns value
            if( $player->getTurns() === 1 ) {
                //On his first turn $player draw his initial amount of card from $player->deck
                $player->initialDraw();
            }else {
                //$player starts his turn by drawing 1 card from $player->deck
                $player->drawCard(1);
            }
            $player->addOneTotalMana();
            //Copy $player->totalMana value in $player->currentMana
            $player->setCurrentMana( $player->getTotalMana() );
            //finally set $player->turnStatus = true so he can start his turn
            $player->setPlayerTurnStatus( true );
        }else {
            $err = $player->getPlayerName() . ' turn has already started.';
            print_r($err);
        }
    }

    function endPlayerTurn( Player $player ) {
        //Check that $player->turnStatus is indeed true
        if( $player->getPlayerTurnStatus() === true ) {
            //set $player->turnStatus to false ending his turn
            $player->setPlayerTurnStatus( false );
        }else {
            $err = 'Not ' . $player->getPlayerName() . ' turn.';
            print_r($err);
        }
    }