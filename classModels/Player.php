<?php
    define('BASEHP', 20);

    class Player {
        function Player( User $user, $deck, $hand ) {
            $this->deck = $deck;
            $this->hand = $hand;
            $this->playername = $user->getDisplayedUserName();
            $this->hp = BASEHP;
        }
        private $playername = '';
        private $hp;
        private $totalMana = 0;
        private $currentMana = 0;
        private $turns = 0;
        private $isAlive = true;
        private $isPlayerTurn = false;
        private $faction;
        private $hand;
        private $deck;
        //Player Setters
        public function setCurrentMana( Int $value ) : void {
            $this->currentMana = $value;
        }
        public function setTotalMana( Int $value ) : void {
            $this->totalMana = $value;
        }
        public function setPlayerName( String $value ) : string {
            $this->playername = $value;
        }
        public function setHp( Int $value ) : void {
            $this->hp = $value;
        }
        public function setTurns( Int $value ) : void {
            $this->turns = $value;
        }
        public function setAliveStatus( Bool $value ) : void {
            $this->isAlive = $value;
        }
        public function setPlayerTurnStatus( Bool $value ) : void {
            $this->isPlayerTurn = $value;
        }
        public function setFaction( String $value ) : void {
            $this->faction = $value;
        }
        //Player Getters
        public function getCurrentMana() : int {
            return $this->currentMana;
        }
        public function getTotalMana() : int {
            return $this->totalMana;
        }
        public function getPlayerName() : string {
            return $this->playername;
        }
        public function getHp() : int {
            return $this->hp;
        }
        public function getTurns() : int {
            return $this->turns;
        }
        public function getAliveStatus() : bool {
            return $this->isAlive;
        }
        public function getPlayerTurnStatus() : bool {
            return $this->isPlayerTurn;
        }
        public function getFaction() : string {
            return $this->faction;
        }
        public function getPlayerDeck() : array {
            return $this->deck->getDeckList();
        }
        public function getPlayerHandCard( Int $pos )  {
            return $this->hand->getCard( $pos );
        }
        public function getPlayerHand() : array {
            return $this->hand->getCardsList();
        }
        //Every Functions That Concern the Player's Hand
        public function drawCard( $n ) : void {
            if( $this->deck->getCardCount() > 0 ) {
                if ( $this->deck->getCardCount() >= $n ) {
                    $this->hand->addCards( $n, $this->deck->getDeckList() );
                    $this->deck->removeDrawnCards( $n );
                } else {
                    $this->hand->addCards( $this->deck->getCardCount(), $this->deck->getDeckList() );
                    $this->deck->removeDrawnCards( $this->deck->getCardCount() );
                }
            } else {
                $this->isAlive = false;
            }
        }
        public function initialDraw() : void {
            $this->drawCard( 3, $this->deck );
        }
        public function removeHandCard( Int $pos ) : void {
            $this->hand->removeCard( $pos );
        }
        //Every Function That Concern the Player's Deck
        public function deckSetup() : void {
            $this->deck->setDeckList();
            $this->deck->shuffleDeck();
        }
        public function takeDamage( Int $n ) : void {
            $this->hp -= $n;
            $this->checkHpPool();
        }
        public function checkHpPool() : void {
            if( $this->hp < 0 ) {
                $this->isAlive = false;
            }
        }
        public function addOneTotalMana() : void {
            if( $this->totalMana < 10 ) {
                $this->totalMana += 1;
            }
        }
    }
?>