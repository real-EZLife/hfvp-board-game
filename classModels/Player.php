<?php
    /**
     * class Player
     * @param object User $user
     * @param object Deck $deck
     * @param object Hand $hand
     * 
     * @return Player
    */
    class Player {
        public function __construct( User $user, Deck $deck, Hand $hand ) {
            //Attribue un objet deck, crée préalablement, à la nouvelle instance de Player
            $this->deck = $deck;
            //Attribue un objet main, crée préalablement, à la nouvelle instance de Player
            $this->hand = $hand;
            //Le nom de la nouvelle instance de Player découle de l'utilisateur
            $this->playername = $user->getDisplayedUserName();
            //initialise le pool de point de vie du joueur
            $this->hp = self::BASEHP;
        }
        const BASEHP = 20;
        const MAXIMUMMANA = 10;
        /**
         * @var string
        */
        private $playername = '';
        /**
         * @var int
        */
        private $hp;
        /**
         * @var int
        */
        private $totalMana = 0;
        /**
         * @var int
        */
        private $currentMana = 0;
        /**
         * @var int
        */
        private $turns = 0;
        /**
         * @var bool
        */
        private $isAlive = true;
        /**
         * @var bool
        */
        private $isPlayerTurn = false;
        /**
         * @var string
        */
        private $faction = 'not defined';
        /**
         * @var Hand
        */
        private $hand;
        /**
         * @var Deck
        */
        private $deck;
        //Player Setters
        /**
         * setCurrentMana 
         * 
         * @param int
         * @return self
        */
        public function setCurrentMana( Int $value ) : self {
            $this->currentMana = $value;
            return $this;
        }
        /**
         * setTotalMana
         * 
         * @param int
         * @return self
        */
        public function setTotalMana( Int $value ) : self {
            $this->totalMana = $value;
            return $this;
        }
        /**
         * setPlayerName
         * 
         * @param string
         * @return self
        */
        public function setPlayerName( String $value ) : self {
            $this->playername = $value;
            return $this;
        }
        /**
         * setHp
         * 
         * @param int
         * @return self
        */
        public function setHp( Int $value ) : self {
            //$hp must always be <= self::BASEHP
            if( $value + $this->hp >= self::BASEHP ) {
                $this->hp = self::BASEHP;
            }else {
                $this->hp = $value;
            }
            return $this;
        }
        /**
         * setTurns
         * 
         * @param int
         * @return self
        */
        public function setTurns( Int $value ) : self {
            $this->turns = $value;
            return $this;
        }
        /**
         * setAliveStatus
         * 
         * @param bool
         * @return self
        */
        public function setAliveStatus( Bool $value ) : self {
            $this->isAlive = $value;
            return $this;
        }
        /**
         * setPlayerTurnStatus
         * 
         * @param bool
         * @return self
        */
        public function setPlayerTurnStatus( Bool $value ) : self {
            $this->isPlayerTurn = $value;
            return $this;
        }
        /**
         * setFaction
         * 
         * @param string
         * @return self
        */
        public function setFaction( String $value ) : self {
            $this->faction = $value;
            return $this;
        }
        /**
         * setPlayerDeck
         * 
         * @param Deck
         * @return self
        */
        public function setPlayerDeck( Deck $value ) : self {
            $this->deck = $value;
            return $this;
        }
        /**
         * setPlayerHand
         * 
         * @param Hand
         * @return self
        */
        public function setPlayerHand( Hand $value ) : self {
            $this->hand = $value;
            return $this;
        }
        //Player Getters
        /**
         * getCurrentMana
         * 
         * return Player->currentMana
         * 
         * @return int
        */
        public function getCurrentMana() : int {
            return $this->currentMana;
        }
        /**
         * getTotalMana
         * 
         * return Player->totalMana
         * 
         * @return int
        */
        public function getTotalMana() : int {
            return $this->totalMana;
        }
        /**
         * getPlayerName
         * 
         * @return string
        */
        public function getPlayerName() : string {
            return $this->playername;
        }
        /**
         * getHp
         * 
         * @return int
        */
        public function getHp() : int {
            return $this->hp;
        }
        /**
         * getTurns
         * 
         * @return int
        */
        public function getTurns() : int {
            return $this->turns;
        }
        /**
         * getAliveStatus
         * 
         * @return bool
        */
        public function getAliveStatus() : bool {
            return $this->isAlive;
        }
        /**
         * getPlayerTurnStatus
         * 
         * @return bool
        */
        public function getPlayerTurnStatus() : bool {
            return $this->isPlayerTurn;
        }
        /**
         * getFaction
         * 
         * @return string
        */
        public function getFaction() : string {
            return $this->faction;
        }
        /**
         * getPlayerDeck
         * 
         * @return array
        */
        public function getPlayerDeck() : array {
            return $this->deck->getDeckList();
        }
        /**
         * getPlayerHandCard
         * 
         * Return the Card object in Player->hand Hand at $pos int
         * 
         * @param int $pos
         * @return Card
        */
        public function getPlayerHandCard( Int $pos ) : Card {
            return $this->hand->getCard( $pos );
        }
        /**
         * getPlayerHand
         * 
         * Return Player->hand as an array of Card objects
         * 
         * @param int $pos
         * @return array of Card
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
         * @return int
        */
        public function getHandLength() : int {
            return $this->hand->getCardCount();
        }
        
        //Every Functions That Concern the Player's Hand

        /**
         * drawCard
         * 
         * Get $n cards from Player->Deck and add them to Player->Hand.
         * 
         * 
         * @param int $n number of cards to draw from Player->deck 
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
         * @param int $pos 
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
         * @return int
        */
        public function getDeckLenght() : int {
            return $this->deck->getCardCount();
        }
        /**
         * takeDamage
         * 
         * Reduce Player->hp value by $n then run Player->checkHpPool();
         * 
         * @param int $n
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
         * @param int $n
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
         * Check Player->totalMana value is lesser than self::MAXIMUMMANA value and update Player->totalmana accordingly
         * 
         * @return void
        */
        public function addOneTotalMana() : void {
            if( $this->totalMana < self::MAXIMUMMANA) {
                $this->totalMana += 1;
            }
        }
        /**
         * exportPlayer
         * 
         * Return a new object containing current Player instance properties
         * 
         * @return object
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
            if( $this->getDeckLenght() > 0 ) {
                //loop through Player->deck and extract each card it holds accordingly
                foreach($this->getPlayerDeck() as $pos => $card) {
                    $deck[$pos] = $card->getCardInfo();
                }
            }

            //Create object properies for all the current Player instance
            /**
             * @var string
             */
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