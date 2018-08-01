<?php
    

    class Lobby {
        function Lobby ( Board $board, Player $playerA, Player $playerB ) {
            $this->board = $board;
            $this->playerA = $playerA;
            $this->playerB = $playerB;
            $this->players = [ $playerA, $playerB ];
        }
        private $whosTurn;
        private $board;
        private $playerA;
        private $playerB;
        private $players = [];

        //Getters
        public function getPlayerA() : Player {
            return $this->playerA;
        }
        public function getPlayerB() : Player {
            return $this->playerB;
        }
        public function getBoard() : Board {
            return $this->board;
        }
        public function getWhosTurn() : int {
            return $this->whosTurn;
        }
        //Lobby related functions 
        function decideWhoStarts() {
            if(rand(0, 1) > .5) {
                $this->whosTurn = 1;
                $_SESSION['hfvp']['gameTest']['whosTurn'] = $this->whosTurn;
            }else {
                $this->whosTurn = 2;
                $_SESSION['hfvp']['gameTest']['whosTurn'] = $this->whosTurn;
            }
        }
        //Player A related functions
        public function playerAStartTurn() : void {
            $this->whosTurn = 1;
            $_SESSION['hfvp']['gameTest']['whosTurn'] = $this->whosTurn;
            startPlayerTurn( $this->playerA );
        }
        public function playerAEndTurn() : void {
            $_SESSION['hfvp']['gameTest']['whosTurn'] = $this->whosTurn;
            $this->whosTurn = 2;
            endPlayerTurn( $this->playerA );
        }
        public function playerADrawCards( Int $n ) : void {
            if( $this->playerA->getPlayerTurnStatus() === true ) {
                $this->playerA->drawCard($n);
            }
        }
        public function playerAPlayCard( Int $pos ) : void {
            if( $this->playerA->getPlayerTurnStatus() === true ) {
                $card = $this->playerA->getPlayerHandCard( $pos );
                // var_dump($card);
                if( $card->getManaCost() <= $this->playerA->getCurrentMana() ) {
                    $pos = $this->board->getSideACount();
                    $this->board->addCardToSideA( $card, $pos );
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
                // var_dump($card);
                if( $card->getManaCost() <= $this->playerB->getCurrentMana() ) {
                    $pos = $this->board->getSideACount();
                    $this->board->addCardToSideB( $card, $pos );
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
    }