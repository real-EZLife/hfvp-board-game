<?php
    class Creature extends Card {
        public function __construct(array $array = []) {
                parent::__construct($array);
        }
        /**
         * card atk value
         *
         * @var int
        */
        protected $atk;
        /**
         * card hp value
         *
         * @var int
        */
        protected $hp;

        /**
         * Get card atk value
         *
         * @return  int
         */ 
        public function getAtk() : int {
                return $this->atk;
        }

        /**
         * Set card atk value
         *
         * @param  int  $atk  card atk value
         *
         * @return  self
         */ 
        public function setAtk(int $atk) : self {
                $this->atk = $atk;

                return $this;
        }

        /**
         * Get card hp value
         *
         * @return  int
         */ 
        public function getHp() : int {
                return $this->hp;
        }

        /**
         * Set card hp value
         *
         * @param  int  $hp  card hp value
         *
         * @return  self
         */ 
        public function setHp(int $hp) : self {
                $this->hp = $hp;

                return $this;
        }
        
    }