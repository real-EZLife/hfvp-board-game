<?php
    require_once('User.php');
    require_once('Deck.php');
    
    define('BASEHP', 20);
    class Player {
        function Player( User $user, Array $deck ) {
            $this->deck = $deck;
            $this->playername = $user->getDisplayedUserName();
            $this->hp = BASEHP;
        }
        private $playername = '';
        private $hp;
        private $totalMana = 0;
        private $currentMana = 0;
        private $isAlive = true;
        private $hand = [];
        private $deck;

        
        public function initialDraw() : void {
            $this->hand[] = $this->deck[0];
            $this->hand[] = $this->deck[1];
            $this->hand[] = $this->deck[2];
            array_splice($this->deck, 0, 3);
        }
        public function drawCard() : void {
            if( count($this->deck) > 0 ) {
                $this->hand[] = $this->deck[0];
                array_splice($this->deck, 0, 1);
            } else {

            }
        }
        public function takeDamage( Int $n ) : void {
            $this->hp -= $n;
            $this->checkAliveStatus();
        }
        public function checkAliveStatus() {
            if( $this->hp < 0 ) {
                $this->isAlive = false;
            }
        }
        public function addOneMana() : void {
            if( $this->totalMana < 10 ) {
                $this->totalMana += 1;
            }
        }
        public function getPlayerDeck() : String {
            return listDeck($this->deck);
        }
        public function getPlayerHand() : Array {
            $handCards = [];
            foreach($this->hand as $pos => $card) {
                $handCards[] = $card->getCardInfo();
            }
            return $handCards;
        }
        function arrayJsonify( Array $array ) {
            return json_encode($array);
        }
    }

    $user1 = new User('youpayou', 'Zorlimar', 'youri-26@hotmail.fr', 0 );

    $player1 = new Player( $user1, $playerDeck );

    $player1->initialDraw();

    // echo $player1-> ();

    var_dump($player1->getPlayerHand());
    echo json_encode($player1->getPlayerHand());
?>