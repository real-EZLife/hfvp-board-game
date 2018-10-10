<?php
    class Hero {
        public function __construct() {

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
        private $Lp;
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
        public function getMaxLp() {
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
    }