<?php
    require_once(ROOT_PATH . '/classModels/Cards/Spell.php');

    class heroDmg extends Spell {
        public function __construct( String $cardName = 'defaultTitle', String $cardImg = './defaultImg.jpeg', 
                        String $cardDesc = 'defaultDesc', Int $cardManaCost = 0, 
                        Int $cardEffectValue = 0) {
            parent::__construct($cardName, $cardImg, $cardDesc, $cardManaCost);
            $this->setEffect('heroDmg');
            $this->setEffectValue($cardEffectValue); 
        }
        private $effectValue;
        

        /**
         * Get the value of effectValue
         */ 
        public function getEffectValue() : int {

                return $this->effectValue;
        }

        /**
         * Set the value of effectValue
         *
         * @return self
         */ 
        public function setEffectValue(Int $effectValue) : self {

                $this->effectValue = $effectValue;

                return $this;
        }
        /**
         * getCardInfo
         * 
         * return all the Spell properties as an assoc. array
         * 
         * @return array
        */
        public function getCardInfo() : array {
            $card = parent::getCardInfo();
            //extends Card->getCardInfo() function adding effect identifier to the array
            $card = array_merge($card, array('effectValue' => $this->getEffectValue()));
            return $card;
        }
    }