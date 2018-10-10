<?php
    require_once(ROOT_PATH . '/classModels/Cards/Spell.php');

    class CreaDmg extends Spell {
        public function __construct( String $cardName = 'defaultTitle', String $cardImg = './defaultImg.jpeg', 
                        String $cardDesc = 'defaultDesc', Int $cardManaCost = 0, 
                        Int $cardEffectValue = 0) {
            parent::__construct($cardName, $cardImg, $cardDesc, $cardManaCost);
            $this->setEffect('creaDmg');
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
        public function setEffectValue(Int $effectValue) {

                $this->effectValue = $effectValue;

                return $this;
        }
    }