<?php
    /**
     * class Player
     * @param object User $user
     * @param object Deck $deck
     * @param object Hand $hand
     * 
     * @return Player
    */
    class Player extends Core {
        // public function __construct( User $user, Deck $deck, Hand $hand ) {
        //     //Attribue un objet deck, crée préalablement, à la nouvelle instance de Player
        //     $this->deck = $deck;
        //     //Attribue un objet main, crée préalablement, à la nouvelle instance de Player
        //     $this->hand = $hand;
        //     //Le nom de la nouvelle instance de Player découle de l'utilisateur
        //     $this->name = $user->getDisplayedUserName();
        //     $this->id = $user->getId();
        //     //initialise le pool de point de vie du joueur
        //     $this->hp = self::BASEHP;
        // }
        const BASEHP = 20;
        const MAXIMUMMANA = 10;
        /**
         * Player Id
         * 
         * @var 
        */
        private $id = '';
        /**
         * Player name
         * 
         * @var string
        */
        private $name = '';
        /**
         * @var int
        */
        private $turns = 0;
        /**
         * 
         * @var bool
        */
        private $isPlayerTurn = false;
        /**
         * Currently Played Hero
         *
         * @var Hero
        */
        private $hero;
        /**
         * Current Player's Hand object
         * 
         * @var Hand
        */
        private $hand;
        /**
         * Current Player's Deck object
         * 
         * @var Deck
        */
        private $deck;
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
         * exportPlayer
         * 
         * Return a new object containing current Player instance properties
         * 
         * @return object
        */
        

        /**
         * Get currently Played Hero
         *
         * @return  Hero
         */ 
        public function getHero() {
            return $this->hero;
        }

        /**
         * Set currently Played Hero
         *
         * @param  Hero  $hero  Currently Played Hero
         *
         * @return  self
         */ 
        public function setHero(Hero $hero) {
            $this->hero = $hero;

            return $this;
        }
        public function getPlayer() : array {

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
            $player = get_object_vars($this);
            $player['hero'] = getHero()->getHero();
            $player['hand'] = $hand;
            $player['deck'] = $deck;

            

            return $player;
        }


    }