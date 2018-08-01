<?php 

    function startPlayerTurn( Object $player ) {
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

    function endPlayerTurn( Object $player ) {
        if( $player->getPlayerTurnStatus() === true ) {
            $player->setPlayerTurnStatus( false );
        }else {
            $err = 'Not' + $player->getName();
        }
    }






?>