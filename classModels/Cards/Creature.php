<?php
    require_once(ROOT_PATH . '/classModels/Cards/Card.php');
    /**
     * Creature est une classe hérité de la class Card
     * 
     * @param int $cardAtk
     * @param int $cardHp
     * @return Creature
    */
    class Creature extends Card {
        public function __construct(  String $cardName = 'defaultTitle', String $cardImg = './defaultImg.jpeg', String $cardDesc = 'defaultDesc', 
                            Int $cardManaCost = 0, $cardSpecial = false, Int $cardAtk = 0, Int $cardHp = 0  ) {

            parent::__construct( $cardName, $cardImg, $cardDesc, $cardManaCost, $cardType = 'creature', $cardSpecial );
            $this->setAtk($cardAtk);
            $this->setHp($cardHp);
            $this->setCanAttack(false);
        }
        /**
         * Holds card atk value
         * 
         * @var int
        */
        private $atk;
        /**
         * Holds card hp value
         * 
         * @var int
        */
        private $hp;
        /**
         * Holds card attack status
         * 
         * @var bool
        */
        private $canAttack = false;
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
         * getCardInfo
         * 
         * return all the Creature properties as an assoc. array
         * 
         * @param int
         * @return array
        */
        public function getCardInfo() : array {
            //extends Card->getCardInfo() function adding atk and hp identifiers to the array
            $card = parent::getCardInfo();
            $card = array_merge($card, array('atk' => $this->getAtk(), 'hp' => $this->getHp() ));
            return $card;
        }
    }