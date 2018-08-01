<?php
    require_once('CardModels.php');


    class Deck {
        function Deck( Array $deckFormat ) {
            $this->format = $deckFormat;
        }
        private $deckList = [];
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
        public function removeDrawnCards( $n ) : void {
            for( $i = 0; $i < $n; $i++ ) {
                array_splice($this->deckList, 0, 1);
            }
        }
        public function getCardCount() : int {
            return count( $this->deckList );
        }
        public function shuffleDeck() : void {
            shuffle( $this->deckList );
        }
        public function getDeckList() : array {
            $deck = $this->deckList;
            return $deck;
        }
    }



    // $playerDeck = [];
    

    // function fillDeck(Array $deck, Array $deckType) {
        
    //     foreach( $deckType as $value ) {
    //         switch( $value['type'] ) {
    //             case 'creature':
    //             for($i = 0; $i < $value['nb']; $i++) {
    //                 $deck[] = new Creature();
    //             }
    //             break;
    //             case 'spell':
    //             for($i = 0; $i < $value['nb']; $i++) {
    //                 $deck[] = new Spell();
    //             }
    //             break;
    //             case 'shield':
    //             for($i = 0; $i < $value['nb']; $i++) {
    //                 $deck[] = new Shield();
    //             }
    //             break;
    //             case 'special':
    //             for($i = 0; $i < $value['nb']; $i++) {
    //                 $deck[] = new Special();
    //             }
    //             break;
    //         }
    //     }
    //     return $deck;
    // }
    
    // function listDeck(Array $deck) : Array {
    //     $deckCards = [];
    //     foreach($deck as $pos => $card) {
    //         $deckCards[] = $card->getCardInfo();
    //     }
    //     return $deckCards;
    // }
    // $playerDeck = fillDeck($playerDeck, $formalDeckComp);
    // shuffle($playerDeck);
?>