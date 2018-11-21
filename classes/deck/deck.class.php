<?php
    /**
     * Deck class is used to create a new Deck instance
     */
    class Deck extends Core {
        public function __construct(array $datas) {
            if(isset($datas['cards'])) $cards = $datas['cards'];
            else $cards = [];

            parent::__construct($datas);

            $this->setDeckListFromArray($cards);

        }
        /**
         * @var Card[]
        */


        /**
         * deck name
         *
         * @var string
        */
        protected $name;

        /**
         * deck id
         *
         * @var int
        */
        protected $id = null;

        private $deckList = [];

        /**
         * pass an array of Card or Card child instances to store
         * 
         * @param Card[]
         * @return self
        */
        public function setDeckListFromArray( array $array ) : self {
            foreach($array as $pos => $card) {
                if(!is_subclass_of($card, 'Card', false) && get_class($card) != 'Card') {
                    array_splice($array, $pos, 1);
                }
            }
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
            return $this->deckList;
        }

        /**
         * Get deck id
         *
         * @return  int
         */ 
        public function getId() {
            return $this->id;
        }

        /**
         * Set deck id
         *
         * @param  int  $id  deck id
         *
         * @return  self
         */ 
        public function setId(int $id) {
            $this->id = $id;

            return $this;
        }

        /**
         * Get deck name
         *
         * @return  string
         */ 
        public function getName() {
            return $this->name;
        }

        /**
         * Set deck name
         *
         * @param  string  $name  deck name
         *
         * @return  self
         */ 
        public function setName(string $name) {
            $this->name = $name;

            return $this;
        }
    }