<?php 
    /**
     * class Board contains all informations about the board status
     */
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
        public function getSideACemetery() : array {
            return $this->boardCemeterySideA;
        }
        public function getSideBCemetary() : array {
            return $this->boardCemeterySideB;
        }
        public function getSideACemeteryCount() : int {
            return count($this->boardCemeterySideA);
        }
        public function getSideBCemeteryCount() : int {
            return count($this->boardCemeterySideB);
        }
        //Setters
        public function setSideA( Array $value ) : void {
            $this->boardSideA = $value;
        }
        public function setSideB( Array $value ) : void {
            $this->boardSideB = $value;
        }
        public function setSideACemetery( Array $value ) : void {
            $this->boardCemeterySideA = $value;
        }
        public function setSideBCemetery( Array $value ) : void {
            $this->boardCemeterySideB = $value;
        }
        //Functions linked to players actions

        /**
         * removeCardFromSideA remove Card object from array $boardSideA, e.g. object Creature->hp is <= 0
         * @param int $pos position of the card to remove 
         * 
         * @return void
         */
        public function removeCardFromSideA( Int $pos ) : void {
            if($this->boardSideA[$pos]) {
                $this->$boardCemeterySideA[] = $this->boardSideA[$pos];
                array_splice($this->boardSideA, $pos, $pos + 1);
            }else {
                $err = "Card at position $pos doesn't exist $boardSideA";
            }
        }
        public function removeAllCardsFromSideA() : void {
            if(count($this->boardSideA) > 0) {
                $this->$boardCemeterySideA[] = $this->boardSideA;
                array_splice($this->boardSideA, 0, count($this->boardSideA));
            }
        }
        public function removeCardFromSideB( Int $pos ) : void {
            if($this->boardSideB[$pos]) {
                $this->$boardCemeterySideB[] = $this->boardSideB[$pos];
                array_splice($this->boardSideB, $pos, $pos + 1);
            }else {
                $err = "Card at position $pos doesn't exist in $boardSideB";
            }
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
        public function exportBoard() : object {
            $boardObject = new stdClass();

            $boardObject->boardSideA = $this->getSideA();
            $boardObject->boardSideB = $this->getSideB();
            $boardObject->boardCemeterySideA = $this->getSideACemetery();
            $boardObject->boardCemeterySideB = $this->getSideBCemetary();

            return $boardObject;
        }
    }

    // $board = new Board();
    // $board->setSideA( array( 'Troll', 'Orc', 'Malandrin', 'BonHomme', 'Gobelin' ) );
    // $board->removeCardFromSideA( 4 );
    // $board->addCardToSideA( 2, 'Ogre' );
    // $board->addCardToSideB( 2, 'Ogre' );
    // var_dump($board);

