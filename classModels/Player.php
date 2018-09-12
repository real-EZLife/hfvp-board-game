<?php
    //PDV Maximum toujours à 20
    define('BASEHP', 20);
    define('MAXIMUMMANA', 10);

    /**
     * class Player
     * @param object User $user
     * @param object Deck $deck
     * @param object Hand $hand
     * 
     * @return Player
    */
    class Player {
        function Player( User $user, $deck, $hand ) {
            //Attribue un objet deck, crée préalablement, à la nouvelle instance de Player
            $this->deck = $deck;
            //Attribue un objet main, crée préalablement, à la nouvelle instance de Player
            $this->hand = $hand;
            //Le nom de la nouvelle instance de Player découle de l'utilisateur
            $this->playername = $user->getDisplayedUserName();
            //initialise le pool de point de vie du joueur
            $this->hp = BASEHP;
        }
        /**
         * $playername INT 
         * $hp INT
         * $totalMana INT
         * $currentMana INT
         * $turns INT
         * $isAlive BOOL
         * $isPlayerTurn BOOL 
         * $faction STRING
         * $hand obj Hand
         * $deck obj Deck
        */
        private $playername = '';
        private $hp;
        private $totalMana = 0;
        private $currentMana = 0;
        private $turns = 0;
        private $isAlive = true;
        private $isPlayerTurn = false;
        private $faction = 'not defined';
        private $hand;
        private $deck;
        //Player Setters
        /**
         * setCurrentMana 
         * 
         * @param INT
         * @return void
        */
        public function setCurrentMana( Int $value ) : void {
            $this->currentMana = $value;
        }
        /**
         * setTotalMana
         * 
         * @param INT
         * @return void
        */
        public function setTotalMana( Int $value ) : void {
            $this->totalMana = $value;
        }
        /**
         * setPlayerName
         * 
         * @param STRING
         * @return void
        */
        public function setPlayerName( String $value ) : void {
            $this->playername = $value;
        }
        /**
         * setHp
         * 
         * @param INT
         * @return void
        */
        public function setHp( Int $value ) : void {
            //$hp must always be <= BASEHP
            if( $value + $this->hp >= BASEHP ) {
                $this->hp = BASEHP;
            }else {
                $this->hp = $value;
            }
        }
        /**
         * setTurns
         * 
         * @param INT
         * @return void
        */
        public function setTurns( Int $value ) : void {
            $this->turns = $value;
        }
        /**
         * setAliveStatus
         * 
         * @param BOOL
         * @return void
        */
        public function setAliveStatus( Bool $value ) : void {
            $this->isAlive = $value;
        }
        /**
         * setPlayerTurnStatus
         * 
         * @param BOOL
         * @return void
        */
        public function setPlayerTurnStatus( Bool $value ) : void {
            $this->isPlayerTurn = $value;
        }
        /**
         * setFaction
         * 
         * @param STRING
         * @return void
        */
        public function setFaction( String $value ) : void {
            $this->faction = $value;
        }
        /**
         * setPlayerDeck
         * 
         * @param Deck
         * @return void
        */
        public function setPlayerDeck( Deck $value ) : void {
            $this->deck = $value;
        }
        /**
         * setPlayerHand
         * 
         * @param Hand
         * @return void
        */
        public function setPlayerHand( Hand $value ) : void {
            $this->hand = $value;
        }
        //Player Getters
        /**
         * getCurrentMana
         * 
         * @return INT
        */
        public function getCurrentMana() : int {
            return $this->currentMana;
        }
        /**
         * getTotalMana
         * 
         * @return INT
        */
        public function getTotalMana() : int {
            return $this->totalMana;
        }
        /**
         * getPlayerName
         * 
         * @return STRING
        */
        public function getPlayerName() : string {
            return $this->playername;
        }
        /**
         * getHp
         * 
         * @return INT
        */
        public function getHp() : int {
            return $this->hp;
        }
        /**
         * getTurns
         * 
         * @return INT
        */
        public function getTurns() : int {
            return $this->turns;
        }
        /**
         * getAliveStatus
         * 
         * @return BOOL
        */
        public function getAliveStatus() : bool {
            return $this->isAlive;
        }
        /**
         * getPlayerTurnStatus
         * 
         * @return BOOL
        */
        public function getPlayerTurnStatus() : bool {
            return $this->isPlayerTurn;
        }
        /**
         * getFaction
         * 
         * @return STRING
        */
        public function getFaction() : string {
            return $this->faction;
        }
        /**
         * getPlayerDeck
         * 
         * @return ARRAY
        */
        public function getPlayerDeck() : array {
            return $this->deck->getDeckList();
        }
        /**
         * getPlayerHandCard
         * 
         * Return the Card object in Player->hand Hand at $pos INT
         * 
         * @param INT $pos
         * @return Card
        */
        public function getPlayerHandCard( Int $pos ) : Card {
            return $this->hand->getCard( $pos );
        }
        /**
         * getPlayerHand
         * 
         * Return Player->hand as an Array of Card objects
         * 
         * @param INT $pos
         * @return Array of Card
        */
        public function getPlayerHand() : array {
            return $this->hand->getCardsList();
        }
        /**
         * getHandLength
         * 
         * Return the number of Cards in Player->hand
         * 
         * @param void
         * @return INT
        */
        public function getHandLength() : int {
            return $this->hand->getCardCount();
        }
        
        //Every Functions That Concern the Player's Hand
        /**
         * drawCard
         * 
         * Get $n cards from Player->Deck and append them to Player->Hand.
         * 
         * 
         * @param INT $n number of cards to draw from Player->deck 
         * @return void
        */
        public function drawCard( $n ) : void {
            //Check that $n is greater than 0
            if( $n > 0 ) {
                //Check that Player->deck has cards
                if( $this->deck->getCardCount() > 0 ) {
                    //Check that the number of cards left in the deck 
                    //is superior or equal to the amount $n we want to draw
                    if ( $this->deck->getCardCount() >= $n ) {
                        //Add $n cards to Player->hand
                        $this->hand->addCards( $n, $this->deck->getDeckList() );
                        //Remove $n cards from the top of the Player->deck
                        $this->deck->removeDrawnCards( $n );
                    } else {
                        //Add all cards left from Player->deck to Player->hand
                        $this->hand->addCards( $this->deck->getCardCount(), $this->deck->getDeckList() );
                        //Remove remaining cards 
                        $this->deck->removeDrawnCards( $this->deck->getCardCount() );
                    }
                } else {
                    //Player is out of cards, Player->isAlive = false
                    $this->isAlive = false;
                }
            } else {
                //Warn that $n is <= 0
                print_r('Warning ' . $n . ' isn\'t a valid number card to draw');
            }
        }
        /**
         * initialDraw
         * 
         * Get 3 cards from Player->Deck and append them to Player->Hand. 
         * Cards will compose player initial hand.
         * 
         * @return void
        */
        //InitialDraw is used to initialise Player->hand
        public function initialDraw() : void {
            //Draw 3 cards from Player->deck to Player->deck
            $this->drawCard( 3, $this->deck );
        }
        /**
         * removeHandCard
         * 
         * Remove one card from the Player->hand at position $pos
         * 
         * @param INT $pos 
         * @return void
        */
        public function removeHandCard( Int $pos ) : void {
            $this->hand->removeCard( $pos );
        }

        //Every Function That Concern the Player's Deck
        /**
         * deckSetup
         * 
         * Initialize the Player->deck and shuffles Card objects inside it
         * 
         * @return void
        */
        public function deckSetup() : void {
            $this->deck->setDeckList();
            $this->deck->shuffleDeck();
        }
        /**
         * getDeckLenght
         * 
         * Return the current number of Cards in Player->deck
         * 
         * @return INT
        */
        public function getDeckLenght() : int {
            return $this->deck->getCardCount();
        }
        /**
         * takeDamage
         * 
         * Reduce Player->hp value by $n then run Player->checkHpPool();
         * 
         * @param INT $n
         * @return void
        */
        public function takeDamage( Int $n ) : void {
            $this->hp -= $n;
            $this->checkHpPool();
        }
        /**
         * CheckHpPool
         * 
         * Compare Player->hp to 0 and modify Player->isAlive value accordingly
         * 
         * @param INT $n
         * @return void
        */
        public function checkHpPool() : void {
            if( $this->hp <= 0 ) {
                $this->isAlive = false;
            }
        }
        /**
         * addOneTotalMana
         * 
         * Check Player->totalMana value is lesser than MAXIMUMMANA value and update Player->totalmana accordingly
         * 
         * @return void
        */
        public function addOneTotalMana() : void {
            if( $this->totalMana < MAXIMUMMANA) {
                $this->totalMana += 1;
            }
        }
        /**
         * exportPlayer
         * 
         * Return a new object containing current Player instance properties
         * 
         * @return OBJECT
        */
        public function exportPlayer() : object {
            //create a new php object which will contain Player instance properties
            $playerObject = new stdClass();

            //initialize two array, hand and deck, which will contain Player->hand and Player->deck respectively
            $hand = []; $deck = [];

            //check that Player->hand isn't empty
            if( $this->getHandLength() > 0 ) {
                //loop through Player->hand and extract each card it holds accordingly
                foreach($this->getPlayerHand() as $pos => $card) {
                    $hand[$pos] = $card->getCardInfo();
                }
            }
            //check that Player->deck isn't empty
            if( count($this->getDeckLenght()) > 0 ) {
                //loop through Player->deck and extract each card it holds accordingly
                foreach($this->getPlayerDeck() as $pos => $card) {
                    $deck[$pos] = $card->getCardInfo();
                }
            }

            //Create object properies for all the current Player instance
            $playerObject->playername = $this->getPlayerName();
            $playerObject->hp = $this->getHp();
            $playerObject->totalMana = $this->getTotalMana();
            $playerObject->currentMana = $this->getCurrentMana();
            $playerObject->isAlive = $this->getAliveStatus();
            $playerObject->isPlayerTurn = $this->getPlayerTurnStatus();
            $playerObject->turns = $this->getTurns();
            $playerObject->faction = $this->getFaction();
            $playerObject->hand = $hand;
            $playerObject->deck = $deck;

            

            return $playerObject;
        }


    }