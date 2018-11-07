<?php
    /**
     * Creature est une classe hérité de la class Card
     * 
     * @param int $cardAtk
     * @param int $cardHp
     * @return Creature
    */
    class Creature extends Card {
        /**
         * Holds card atk value
         * 
         * @var int
        */
        protected $atk;
        /**
         * Holds card hp value
         * 
         * @var int
        */
        protected $hp;
        /**
         * Holds card talent keyword
         * 
         * @var string
        */
        protected $talent = 'none';
        /**
         * Holds card attack status
         * 
         * @var bool
        */
        protected $canAttack = false;
        /**
         * changeAttackState
         * 
         * Creature->canAttack becomes Creature->!canAttack
         * 
         * @return self
        */
        public function invertAttackState() : self {
            $this->canAttack = !$this->canAttack;
            return $this;
        }
        /**
         * 
         * ------------------
         * 
         * SETTERS
         * 
         * ------------------
         * 
        */
        /**
         * setAtk
         * 
         * @param int
         * @return self
        */
        public function setAtk( int $value) : self {
            $this->atk = $value;
            return $this;
        }
        /**
         * setHp
         * 
         * @param int
         * @return self
        */
        public function setHp( int $value) : self {
            $this->hp = $value;
            return $this;
        }
        /**
         * setCanAttack
         * 
         * @param bool
         * @return self
        */
        public function setCanAttack( bool $value) : self {
            $this->canAttack = $value;
            return $this;
        }        /**
        * Set card talent keyword
        *
        * @param  string  $talent  Holds card talent keyword
        *
        * @return  self
        */ 
       public function setTalent(string $talent) {
            $this->talent = $talent;

            return $this;
       }
        /**
         * 
         * ------------------
         * 
         * GETTERS
         * 
         * ------------------
         * 
        */
        /**
         * getAtk
         * 
         * @return int
        */
        public function getAtk() : int {
            return $this->atk;
        }
        /**
         * getHp
         * 
         * @return int
        */
        public function getHp() : int {
            return $this->hp;
        }
        /**
         * getCanAttack
         * 
         * @return bool
        */
        public function getCanAttack() : bool {
            return $this->canAttack;
        }
        /**
         * Get holds card talent keyword
         *
         * @return  string
         */ 
        public function getTalent() {
            return $this->talent;
        }

    }