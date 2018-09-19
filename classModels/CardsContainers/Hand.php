<?php
    class Hand {
        public function __construct() {
           
        }
        private $cardsList = [];

        public function addCards( Int $n, Array $deck ) : void {
            for( $i = 0; $i < $n; $i++ ) {
                $this->cardsList[] = $deck[0];
                array_splice($deck, 0, 1);
            }
        }
        public function removeCard( Int $pos ) : void {
            array_splice($this->cardsList, $pos, $pos + 1);
        }
        public function setHandFromArray( Array $array ) : self {
            $this->cardsList = $array;
            return $this;
        }
        public function getCardCount() : int {
            if( $this->cardsList !== null ) {
                return count( $this->cardsList );
            }else {
                return 0;
            }
        }
        public function getCard( Int $pos ) : object {
            return $this->cardsList[$pos];
        }
        /**
         * 
         */
        public function getCardsList() : array {
            return $this->cardsList;
        }
    }