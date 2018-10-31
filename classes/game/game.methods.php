<?php

        //Lobby related functions 
        /**
         * startGameTurn
         * 
         * 
         * Work in progress to track the number of turns in a game
         * Lobby->elapsedturns += 1;
         * 
         * @return void
        */
        public function startGameTurn() {
            $this->elapsedturns += 1;
        }
        function decideWhoStarts() {
            //If rand(0, 1) > 0.5 P1 starts
            if(rand(0, 1) > .5) {
                $this->whosturn = 1;
            //else P2 starts
            }else {
                $this->whosturn = 2;
            }
        }
        //Player A related functions
        public function playerAStartTurn() : void {
            //see startPlayerTurn in ./turn.php
            startPlayerTurn( $this->playerA );
        }
        public function playerAEndTurn() : void {
            $this->whosturn = 2;
            //see endPlayerTurn in ./turn.php
            endPlayerTurn( $this->playerA );
        }
        public function playerADrawCards( Int $n ) : void {
            
            //Check Player A $turnStatus
            if( $this->playerA->getPlayerTurnStatus() === true ) {
                //
                $this->playerA->drawCard($n);
            }

        }
        public function playerAPlayCard( Int $pos ) : void {
            //Check Player A $turnStatus
            if( $this->playerA->getPlayerTurnStatus() === true ) {
                $card = $this->playerA->getPlayerHandCard( $pos );
                if( $card->getManaCost() <= $this->playerA->getCurrentMana() ) {
                    $boardPos = $this->board->getSideACount();
                    $this->board->addCardToSideA( $card, $boardPos );
                    $this->playerA->removeHandCard( $pos );
                }
            }
        }
        public function playerACardAttack( Object $player ) {
            if( $this->playerA->getPlayerTurnStatus() === true ) {

            }
            
        }
        //Player B related functions
        public function playerBStartTurn() : void {
            startPlayerTurn( $this->playerB );
        }
        public function playerBEndTurn() : void {
            $this->whosturn = 1;
            endPlayerTurn( $this->playerB );
        }
        public function playerBDrawCards( Int $n ) : void {
            if( $this->playerA->getPlayerTurnStatus() === true ) {
                $this->playerB->drawCard($n);
            }
        }
        public function playerBPlayCard( Int $pos ) : void {
            if( $this->playerB->getPlayerTurnStatus() === true ) {
                $card = $this->playerB->getPlayerHandCard( $pos );
                //Check the current mana available
                if( $card->getManaCost() <= $this->playerB->getCurrentMana() ) {
                    $boardPos = $this->board->getSideACount();
                    $this->board->addCardToSideB( $card, $boardPos );
                    $this->playerB->removeHandCard( $pos );
                }
            }
        }
        public function playerBCardAttack( Object $player ) {
            if( $this->playerB->getPlayerTurnStatus() === true ) {
            
            }
        }
        public function playerWin( Object $player ) {
            
        }
        public function playerLose( Object $player ) {
            
        }
        public function export() : object {
            
            $lobbyObject = new stdClass();

            $lobbyObject->gameStatus = $this->getGameStatus();
            $lobbyObject->whosturn = $this->getWhosturn();
            $lobbyObject->elapsedturns = $this->getGameTurns();
            $lobbyObject->board = $this->board->exportBoard();
            $lobbyObject->playerA = $this->playerA->exportPlayer();
            $lobbyObject->playerB = $this->playerB->exportPlayer();
            
            return $lobbyObject;
        }
