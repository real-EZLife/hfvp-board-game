<?php 
    class Board {
        function Board() {

        }
        private $boardSideA = [];
        private $boardSideB = [];
        private $boardCemeterySideA = [];
        private $boardCemeterySideB = [];
        
        //Getters
        public function getSideA() : array {
            return $this->boardSideA;
        }
        public function getSideB() : array {
            return $this->boardSideB;
        }
        public function getSideACount() : int {
            return count($this->boardSideA);
        }
        public function getSideBCount() : int {
            return count($this->boardSideB);
        }
        //Setters
        public function setSideA( Array $value ) : void {
            $this->boardSideA = $value;
        }
        public function setSideB( Array $value ) : void {
            $this->boardSideB = $value;
        }
        //Functions linked to players actions
        public function removeCardFromSideA( Int $pos ) : void {
            $this->$boardCemeterySideA[] = $this->boardSideA[$pos];
            array_splice($this->boardSideA, $pos, $pos + 1);
        }
        public function removeAllCardsFromSideA() : void {
            $this->$boardCemeterySideA[] = $this->boardSideA;
            array_splice($this->boardSideA, 0, count($this->boardSideA));
        }
        public function removeCardFromSideB( Int $pos ) : void {
            $this->$boardCemeterySideB[] = $this->boardSideB[$pos];
            array_splice($this->boardSideB, $pos, $pos + 1);
        }
        public function removeAllCardsFromSideB() : void {
            $this->$boardCemeterySideB[] = $this->boardSideB;
            array_splice($this->boardSideB, 0, count($this->boardSideB));
        }
        public function addCardToSideA( Object $card, Int $pos ) : void {
            array_splice($this->boardSideA, $pos, 0, [$card]);
        }
        public function addCardToSideB( Object $card, Int $pos ) : void {
            array_splice($this->boardSideB, $pos, 0, [$card]);
        }
    }

    // $board = new Board();
    // $board->setSideA( array( 'Troll', 'Orc', 'Malandrin', 'BonHomme', 'Gobelin' ) );
    // $board->removeCardFromSideA( 4 );
    // $board->addCardToSideA( 2, 'Ogre' );
    // $board->addCardToSideB( 2, 'Ogre' );
    // var_dump($board);

