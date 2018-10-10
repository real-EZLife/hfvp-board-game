<?php
    class Hero {
        public function __construct() {

        }
        private $currentHp;
        private $maxHp;
        private $currentMana;
        private $totalMana;
        private $faction;
        private $deck;
        private $hand;

        /**
         * Get the value of currentHp
         */ 
        public function getCurrentHp() : int {
                return $this->currentHp;
        }

        /**
         * Set the value of currentHp
         *
         * @return  self
         */ 
        public function setCurrentHp(Int $currentHp) : self {
                $this->currentHp = $currentHp;

                return $this;
        }

        /**
         * Get the value of maxHp
         */ 
        public function getMaxHp() : int {
                return $this->maxHp;
        }

        /**
         * Set the value of maxHp
         *
         * @return  self
         */ 
        public function setMaxHp(Int $maxHp) : self {
                $this->maxHp = $maxHp;

                return $this;
        }

        /**
         * Get the value of currentMana
         */ 
        public function getCurrentMana() : int {
                return $this->currentMana;
        }

        /**
         * Set the value of currentMana
         *
         * @return  self
         */ 
        public function setCurrentMana(Int $currentMana) : self {
                $this->currentMana = $currentMana;

                return $this;
        }

        /**
         * Get the value of totalMana
         */ 
        public function getTotalMana() : int {
                return $this->totalMana;
        }

        /**
         * Set the value of totalMana
         *
         * @return  self
         */ 
        public function setTotalMana(Int $totalMana) : self{
                $this->totalMana = $totalMana;

                return $this;
        }

        /**
         * Get the value of faction
         */ 
        public function getFaction() : string {
                return $this->faction;
        }

        /**
         * Set the value of faction
         *
         * @return  self
         */ 
        public function setFaction(string $faction) : self{
                $this->faction = $faction;

                return $this;
        }

        /**
         * Get the value of hand
         */ 
        public function getHand() : hand {
                return $this->hand;
        }

        /**
         * Set the value of hand
         *
         * @return  self
         */ 
        public function setHand(Hand $hand) : self {
                $this->hand = $hand;

                return $this;
        }
    }