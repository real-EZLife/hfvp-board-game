<?php
    class Hero {
        public function __construct(array $caracts, Deck $deck = null, Hand $hand = null) {
                $this->hydrate($caracts);
                if(!is_null($deck) && get_class($deck) == 'Deck') {
                        $this->setDeck($deck);
                }
                if(!is_null($hand) && get_class($hand) == 'Hand') {
                        $this->setHand($hand);
                }
        }
        private function hydrate(array $array) {
                if(!is_null($array)) {
                        foreach($array as $key => $value) {
                        $methodName = 'set';
                        $key = str_replace('hero_', '', $key);
                        $key = str_replace('_fk', '', $key);
                        $key = ucfirst($key);
                        $methodName = $methodName . $key;
                        if(method_exists($this, $methodName))
                                $this->$methodName($value);
                        }
                        return $this;
                }
                return false;
        }
        private $id;
        /**
         * hero current life pool
         *
         * @var int
        */
        private $lp;
        /**
         * hero name
         *
         * @var string
        */
        private $name;
        /**
         * hero maximum life pool
         *
         * @var int 
        */
        private $maxlp;
        /**
         * hero current available mana
         *
         * @var int
        */
        private $mana;
        /**
         * hero total mana at turn start
         *
         * @var int
        */
        private $totalmana;
        /**
         * hero current faction
         * 
         * @var string
        */
        private $faction;
        /**
         * hero current deck
         * 
         * @var Deck
        */
        private $deck;
        /**
         * hero current hand
         * 
         * @var Hand
        */
        private $hand;

        /**
         * Get the value of id
         */ 
        public function getId() {
                return $this->id;
        }

        /**
         * Get hero current life pool
         *
         * @return  int
         */ 
        public function getLp() {
                return $this->lp;
        }

        /**
         * Get hero name
         *
         * @return  string
         */ 
        public function getName() {
                return $this->name;
        }

        /**
         * Get hero maximum life pool
         *
         * @return  int
         */ 
        public function getMaxlp() {
                return $this->maxLp;
        }

        /**
         * Get hero total mana at turn start
         *
         * @return  int
         */ 
        public function getTotalmana() {
                return $this->totalMana;
        }

        /**
         * Get hero current faction
         *
         * @return  string
         */ 
        public function getFaction() {
                return $this->faction;
        }

        /**
         * Get hero current deck
         *
         * @return  Deck
         */ 
        public function getDeck() {
                return $this->deck;
        }

        /**
         * Get hero current hand
         *
         * @return  Hand
         */ 
        public function getHand() {
                return $this->hand;
        }

        /**
         * Set the value of id
         *
         * @return  self
         */ 
        public function setId($id) {
                $this->id = $id;

                return $this;
        }

        /**
         * Set hero current life pool
         *
         * @param  int  $lp  hero current life pool
         *
         * @return  self
         */ 
        public function setLp(int $lp) {
                $this->lp = $lp;

                return $this;
        }

        /**
         * Set hero name
         *
         * @param  string  $name  hero name
         *
         * @return  self
         */ 
        public function setName(string $name) {
                $this->name = $name;

                return $this;
        }

        /**
         * Set hero maximum life pool
         *
         * @param  int  $maxlp  hero maximum life pool
         *
         * @return  self
         */ 
        public function setMaxlp(int $maxlp) {
                $this->maxlp = $maxlp;

                return $this;
        }

        /**
         * Set hero current available mana
         *
         * @param  int  $mana  hero current available mana
         *
         * @return  self
         */ 
        public function setMana(int $mana) {
                $this->mana = $mana;

                return $this;
        }

        /**
         * Set hero total mana at turn start
         *
         * @param  int  $totalmana  hero total mana at turn start
         *
         * @return  self
         */ 
        public function setTotalmana(int $totalmana) {
                $this->totalmana = $totalmana;

                return $this;
        }

        /**
         * Set hero current faction
         *
         * @param  string  $faction  hero current faction
         *
         * @return  self
         */ 
        public function setFaction(string $faction) {
                $this->faction = $faction;

                return $this;
        }

        /**
         * Set hero current deck
         *
         * @param  Deck  $deck  hero current deck
         *
         * @return  self
         */ 
        public function setDeck(Deck $deck) {
                $this->deck = $deck;

                return $this;
        }

        /**
         * Set hero current hand
         *
         * @param  Hand  $hand  hero current hand
         *
         * @return  self
         */ 
        public function setHand(Hand $hand) {
                $this->hand = $hand;

                return $this;
        }
    }

    $h = new Hero([]);

    var_dump($h);