<?php
    class Hand {
        function Hand() {
        }
        private $cardsList = [];

        public function addCards( Int $n, Array $deck ) : void {
            // var_dump($deck);
            for( $i = 0; $i < $n; $i++ ) {
                $this->cardsList[] = $deck[0];
                array_splice($deck, 0, 1);
                
            }
            // var_dump($this->cardsList);
        }
        public function removeCard( Int $pos ) : void {
            array_splice($this->cardsList, $pos, $pos + 1);
        }
        public function setHandFromArray( Array $array ) : void {
            $this->cardsList = $array;
        }
        public function getCardCount() : int {
            if( $this->cardsList !== null ) {
                return count( $this->cardsList );
            }else {
                return 0;
            }
        }
        public function getCard( Int $pos ) : Object {
            $card = $this->cardsList[$pos];
            return $card;
        }
        public function getCardsList() : array {
            $hand = $this->cardsList;
            return $hand;
        }
    }
    // require_once('Deck.php');

    // $playerHand = [];

    // var_dump($playerHand);
    
    // var_dump($playerDeck);

    // function initialDraw(Array &$hand, Array &$deck) :void {
    //     $hand[] = $deck[0];
    //     $hand[] = $deck[1];
    //     $hand[] = $deck[2];
    //     array_splice($deck, 0, 3);
    // }
    

    // function drawCard(Array &$hand, Array &$deck) : void {
    //     $hand[] = $deck[0];
    //     array_splice($deck, 0, 1);
    // }

    
    // initialDraw($playerHand, $playerDeck);

    // var_dump($playerHand);
    
    // var_dump($playerDeck);