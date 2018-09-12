<?php
    /**
     * class Player
     * @param object User $user
     * @param object Deck $deck
     * @param object Hand $hand
     * 
     * @return Lobby
    */
    class Lobby {
        function Lobby ( Board $board, Player $playerA, Player $playerB ) {
            $this->board = $board;
            $this->playerA = $playerA;
            $this->playerB = $playerB;
        }
        
        /**
            * $whosTurn INT 0 if not initialized, 1 if it's playerA turn or 2 if it's playerB turn
            * $elapsedTurns INT
            * $gameStatus STRING
            * $board obj Board
            * $playerA obj Player
            * $playerB obj Player
        */
        private $whosTurn = 0;
        private $elapsedTurns = 0;
        private $gameStatus = '';
        private $board;
        private $playerA;
        private $playerB;

        //Getters
        /**
         * getPlayerA
         * 
         * Lobby->playerA
         * 
         * @return Player
        */
        public function getPlayerA() : Player {
            return $this->playerA;
        }
        /**
         * getPlayerB
         * 
         * Lobby->playerB
         * 
         * @return Player
        */
        public function getPlayerB() : Player {
            return $this->playerB;
        }
        /**
         * getBoard
         * 
         * Lobby->board
         * 
         * @return Board
        */
        public function getBoard() : Board {
            return $this->board;
        }
        /**
         * getWhosTurn
         * 
         * Lobby->whosTurn
         * 
         * @return INT
        */
        public function getWhosTurn() : int {
            return $this->whosTurn;
        }
        /**
         * getTotalMana
         * 
         * Lobby->elapsedTurns;
         * 
         * @return INT
        */
        public function getGameTurns() : int {
            return $this->elapsedTurns;
        }
        /**
         * getGameStatus
         * 
         * Lobby->gameStatus;
         * 
         * @return STRING
        */
        public function getGameStatus() : string {
            return $this->gameStatus;
        }
        //Setters
        /**
         * setPlayerA
         * 
         * Lobby->playerA = $value
         * 
         * @param Player $value
         * @return void
        */
        public function setPlayerA( Player $value ) : void {
            $this->playerA = $value;
        }
        /**
         * setPlayerB
         * 
         * Lobby->playerB = $value
         * 
         * @param Player $value
         * @return void
        */
        public function setPlayerB( Player $value ) : void {
            $this->playerB = $value;
        }
        /**
         * setBoard
         * 
         * Lobby->board = $value
         * 
         * @param Board $value
         * @return void
        */
        public function setBoard( Board $value ) : void {
            $this->board = $value;
        }
        /**
         * setWhosTurn
         * 
         * Lobby->whosTurn = $value
         * 
         * @param INT $value
         * @return void
        */
        public function setWhosTurn( Int $value ) : void {
            $this->whosTurn = $value;
        }
        /**
         * setGameTurns
         * 
         * Lobby->elapsedTurns = $value
         * 
         * @param INT $value
         * @return void
        */
        public function setGameTurns( Int $value ) : void {
            $this->elapsedTurns = $value;
        }
        /**
         * setPlayerA
         * 
         * Lobby->playerA = $value
         * 
         * @param String $value
         * @return void
        */
        public function setGameStatus( String $value ) : void {
            $this->gameStatus = $value;
        }
        //Lobby related functions 
        public function startGameTurn() {
            $this->elapsedTurns += 1;
        }
        function decideWhoStarts() {
            //If rand(0, 1) > 0.5 P1 starts
            if(rand(0, 1) > .5) {
                $this->whosTurn = 1;
            //else P2 starts
            }else {
                $this->whosTurn = 2;
            }
        }
        //Player A related functions
        public function playerAStartTurn() : void {
            startPlayerTurn( $this->playerA );
        }
        public function playerAEndTurn() : void {
            $this->whosTurn = 2;
            endPlayerTurn( $this->playerA );
        }
        public function playerADrawCards( Int $n ) : void {
            if( $this->playerA->getPlayerTurnStatus() === true ) {
                $this->playerA->drawCard($n);
            }
        }
        public function playerAPlayCard( Int $pos ) : void {
            //Check Player A $turnStatus
            if( $this->playerA->getPlayerTurnStatus() === true ) {
                $card = $this->playerA->getPlayerHandCard( $pos );
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
            $this->whosTurn = 1;
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
        public function exportLobby() {
            $lobbyObject = new stdClass();


            $lobbyObject->gameStatus = $this->getGameStatus();
            $lobbyObject->whosTurn = $this->getWhosTurn();
            $lobbyObject->elapsedTurns = $this->getGameTurns();
            $lobbyObject->board = $this->board->exportBoard();
            $lobbyObject->playerA = $this->playerA->exportPlayer();
            $lobbyObject->playerB = $this->playerB->exportPlayer();
            
            // var_dump($this->playerA->getPlayerDeck());

            return $lobbyObject;
        }
    }