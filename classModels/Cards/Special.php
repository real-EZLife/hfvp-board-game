<?php
    require_once(ROOT_PATH . '/classModels/Cards/Card.php');
    /**
     * Special est une classe hérité de la class Card
     * @param string $cardEffect
     * @return object
     */
    class Special extends Card {
        public function __construct(   String $cardName = 'defaultTitle', String $cardImg = './defaultImg.jpeg', String $cardDesc = 'defaultDesc', 
                            Int $cardManaCost = 0, Int $cardAtk = 0, Int $cardHp = 0, String $cardEffect = 'none' ) {
            parent::__construct( $cardName, $cardImg, $cardDesc, $cardManaCost, $cardType = 'special'  );
            $this->setEffect($cardEffect);
            $this->setAtk($cardAtk);
            $this->setHp($cardHp);
            $this->setCanAttack(false);
        }
        private $effect;
        private $atk;
        private $hp;
        private $canAttack;
        /**
         * changeAttackState
         * 
         * if the card type is special and creature
         * Creature->canAttack becomes Creature->!canAttack
         * 
         * @return Special
        */
        public function invertAttackState() : Special {
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
         * setEffect
         * 
         * @param int
         * @return self
        */
        public function setEffect( String $value ) : self {
            $this->effect = $value;
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
         * getEffect
         * 
         * @return mixed string if an effect is set, false otherwise
        */
        public function getEffect() {
            return $this->effect;
        }
        /**
         * getCardInfo
         * 
         * return all the Special card properties as an assoc. array
         * 
         * @return array
        */
        public function getCardInfo() : array {
            $card = parent::getCardInfo();
            $card = array_merge($card, array('atk' => $this->getAtk(), 'hp' => $this->getHp(), 'effect' => $this->getEffect() ));
            return $card;
        }
    }