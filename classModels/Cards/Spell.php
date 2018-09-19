<?php
    require_once(ROOT_PATH . '/classModels/Cards/Card.php');
    /**
     * Spell est une classe hérité de la class Card
     * @param int $cardEffect
     * @return Spell
     */
    class Spell extends Card {
        public function __construct( String $cardName = 'defaultTitle', String $cardImg = './defaultImg.jpeg', String $cardDesc = 'defaultDesc', 
                        Int $cardManaCost = 0, String $cardEffect = 'none' ) {
            parent::__construct( $cardName, $cardImg, $cardDesc, $cardManaCost, $cardType = 'spell' );
            $this->setEffect($cardEffect);
        }
        /**
         * Holds Spell effect keyword
         * 
         * @var string
         */
        private $effect;
        //Setters
        /**
         * setEffect
         * 
         * set the Spell effect from a keyword
         * 
         * @param int $value 
         * @return self
        */
        public function setEffect( String $value ) : self {
            $this->effect = $value;
            return $this;
        }
        //Getters
        /**
         * getEffect
         * 
         * get the effect keyword of a Spell card 
         * 
         * @param string $value 
         * @return void
        */
        public function getEffect() : string {
            return $this->effect;
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
            $card = array_merge($card, array('effect' => $this->getEffect() ));
            return $card;
        }
    }