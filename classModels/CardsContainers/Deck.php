<?php
    require_once(ROOT_PATH . 'classModels/Cards/Creature.php');
    require_once(ROOT_PATH . 'classModels/Cards/Creature/Shield.php');
    require_once(ROOT_PATH . 'classModels/Cards/Spell.php');
    require_once(ROOT_PATH . 'classModels/Cards/Special.php');

    /**
     * Deck class is used to create a new Deck instance
     */
    class Deck {
        public function __construct( Array $deckFormat = [] ) {
            $this->format = $deckFormat;
        }
        /**
         * @var Card[]
        */
        private $deckList = [];
        /**
         * @var array
         */
        private $format = [];

        public function setDeckList() : void {
            foreach( $this->format as $card ) {
                switch( $card['type'] ) {
                    case 'creature':
                    for($i = 0; $i < $card['nb']; $i++) {
                        $this->deckList[] = new Creature();
                    }
                    break;
                    case 'spell':
                    for($i = 0; $i < $card['nb']; $i++) {
                        $this->deckList[] = new Spell();
                    }
                    break;
                    case 'shield':
                    for($i = 0; $i < $card['nb']; $i++) {
                        $this->deckList[] = new Shield();
                    }
                    break;
                    case 'special':
                    for($i = 0; $i < $card['nb']; $i++) {
                        $this->deckList[] = new Special();
                    }
                    break;
                }
            }
        }
        /**
         * pass an array of Card instances to store
         * 
         * @param Card[]
         * @return self
        */
        public function setDeckListFromArray( Array $array ) : self {
            $this->deckList = $array;
            return $this;
        }
        /**
         * remove a card from the deck instance
         * 
         * @param int
        */
        public function removeDrawnCards( int $n ) : void {
            for( $i = 0; $i < $n; $i++ ) {
                array_splice($this->deckList, 0, 1);
            }
        }
        /**
         * return the number of cards in deck
         * 
         * @return int
        */
        public function getCardCount() : int {
            return count( $this->deckList );
        }
        /**
         * randomize the order of $Deck->deckList contained elements
         * 
         * @return void
         */
        public function shuffleDeck() : void {
            shuffle( $this->deckList );
        }
        /**
         * return the instance $Deck->deckList
         * 
         * @return array
        */
        public function getDeckList() : array {
            $deck = $this->deckList;
            return $deck;
        }
    }