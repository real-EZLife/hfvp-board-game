<?php
    /**
     * Card est une classe permettant de créer un modèle de Carte
     * @param STRING $cardDesc
     * @param STRING $cardName
     * @param STRING $cardDesc
     * @param STRING $cardImg
     * @param INT $cardManaCost
     * @param STRING $cardType
     * @param MIXED $cardSpecial, false if not set string otherwise
     * @return Card
     */
    class Card {
        function Card(  String $cardName = 'defaultTitle', String $cardImg = './defaultImg.jpeg', String $cardDesc = 'defaultDesc', Int $cardManaCost = 0, 
                        String $cardType = '', $cardSpecial = false) {
                            
            $this->name = $cardName;
            $this->img = $cardImg;
            $this->desc = $cardDesc;
            $this->manaCost = $cardManaCost;
            $this->type = $cardType;
            $this->special = $cardSpecial;
        }
        /**
            * $cardName STRING
            * $cardDesc STRING
            * $cardImg STRING
            * $cardManaCost INT
            * $cardType STRING
            * $cardSpecial MIXED, false if not set string otherwise
        */
        private $name;
        private $img;
        private $desc;
        private $manaCost;
        private $type;
        private $special;
        /**
         * getSpecial
         * 
         * @return mixed false, if not set string otherwise
         */
        public function getSpecial() {
            return $this->special;
        }
        /**
         * getName
         * 
         * @return STRING
         */
        public function getName() : string {
            return $this->name;
        }
        /**
         * getImg
         * 
         * @return STRING
         */
        public function getImg() : string {
            return $this->img;
        }
        /**
         * getDesc
         * 
         * @return STRING
         */
        public function getDesc() : string {
            return $this->desc;
        }
        /**
         * getManaCost
         * 
         * @return INT
         */
        public function getManaCost() : int {
            return $this->manaCost;
        }
        /**
         * getType
         * 
         * @return STRING
         */
        public function getType() : string {
            return $this->type;
        }
        /**
         * getCardInfo
         * 
         * return all the Card properties as an assoc. array
         * 
         * @param STRING
         * @return ARRAY
        */
        public function getCardInfo() : array {
            $card = [
                'name' => $this->getName(),
                'img' => $this->getImg(),
                'desc' => $this->getDesc(),
                'manaCost' => $this->getManaCost(),
                'type' => $this->getType(),
                'special' => $this->getSpecial()
            ];
            return $card;
        }
        /**
         * setSpecial
         * 
         * @param mixed pass a string with special keyword or false
         * @return void
         */
        public function setSpecial($value) : void {
            $this->special = $value;
        }
        /**
         * setName
         * 
         * @param STRING
         * @return void
         */
        public function setName(string $value) : void {
            $this->name = $value;
        }
        /**
         * setImg
         * 
         * @param STRING
         * @return void
         */
        public function setImg(string $value) : void {
            $this->img = $value;
        }
        /**
         * setDesc
         * 
         * @param STRING
         * @return void
         */
        public function setDesc(string $value) : void {
            $this->desc = $value;
        }
        /**
         * setManaCost
         * 
         * @param INT
         * @return void
        */
        public function setManaCost(int $value) : void {
            $this->manaCost = $value;
        }
        /**
         * setType
         * 
         * @param STRING
         * @return void
        */
        public function setType(string $value) : void {
            $this->type = $value;
        }

    }
    /**
     * Creature est une classe hérité de la class Card
     * 
     * @param INT $cardAtk
     * @param INT $cardHp
     * @return Creature
     */
    class Creature extends Card {
        function Creature(  String $cardName = 'defaultTitle', String $cardImg = './defaultImg.jpeg', String $cardDesc = 'defaultDesc', 
                            Int $cardManaCost = 0, $cardSpecial = false, Int $cardAtk = 0, Int $cardHp = 0  ) {

            parent::Card( $cardName, $cardImg, $cardDesc, $cardManaCost, $cardType = 'creature', $cardSpecial );
            $this->atk = $cardAtk;
            $this->hp = $cardHp;
        }
        /**
            * $atk INT
            * $hp INT
            * $canAttack BOOL
         */
        private $atk;
        private $hp;
        private $canAttack = false;
        /**
         * changeAttackState
         * 
         * Creature->canAttack becomes Creature->!canAttack
         * 
         * @return void
        */
        public function changeAttackState() : void {
            $this->canAttack = !$this->canAttack;
        }
        //Setters
        /**
         * setAtk
         * 
         * @param INT
         * @return void
        */
        public function setAtk( int $value) : void {
            $this->atk = $value;
        }
        /**
         * setHp
         * 
         * @param INT
         * @return void
        */
        public function setHp( int $value) : void {
            $this->hp = $value;
        }
        /**
         * setHp
         * 
         * @param BOOL
         * @return void
        */
        public function setCanAttack( bool $value) : void {
            $this->canAttack = $value;
        }
        //Getters
        /**
         * getAtk
         * 
         * @return INT
        */
        public function getAtk() : int {
            return $this->atk;
        }
        /**
         * getHp
         * 
         * @return INT
        */
        public function getHp() : int {
            return $this->hp;
        }
        /**
         * getCanAttack
         * 
         * @return BOOL
        */
        public function getCanAttack() : bool {
            return $this->canAttack;
        }
        /**
         * getCardInfo
         * 
         * return all the Creature properties as an assoc. array
         * 
         * @param STRING
         * @return ARRAY
        */
        public function getCardInfo() : array {
            //extends Card->getCardInfo() function adding atk and hp identifier to the array
            $card = parent::getCardInfo();
            $card = array_merge($card, array('atk' => $this->getAtk(), 'hp' => $this->getHp() ));
            return $card;
        }
    }
    /**
     * Shield est une classe hérité de la class Creature
     * @param STRING $cardSpecial = 'shield'
     * @return Shield
     */
    class Shield extends Creature {
        function Shield(    String $cardName = 'defaultTitle', String $cardImg = './defaultImg.jpeg', String $cardDesc = 'defaultDesc', 
                            Int $cardManaCost = 0, int $cardAtk = 0, int $cardHp = 0 ) {
            parent::Creature( $cardName, $cardImg, $cardDesc, $cardManaCost, $cardSpecial = 'shield', $cardAtk, $cardHp );
        }
    }
    /**
     * Spell est une classe hérité de la class Card
     * @param STRING $cardEffect
     * @return Spell
     */
    class Spell extends Card {
        function Spell( String $cardName = 'defaultTitle', String $cardImg = './defaultImg.jpeg', String $cardDesc = 'defaultDesc', 
                        Int $cardManaCost = 0, String $cardEffect = 'none' ) {
            parent::Card( $cardName, $cardImg, $cardDesc, $cardManaCost, $cardType = 'spell' );
            $this->effect = $cardEffect;
        }
        private $effect;
        //Setters
        /**
         * setEffect
         * 
         * set the Spell effect from a keyword
         * 
         * @param STRING $value 
         * @return void
        */
        public function setEffect( String $value ) : void {
            $this->effect = $value;
        }
        //Getters
        /**
         * getEffect
         * 
         * get the effect keyword of a Spell card 
         * 
         * @param STRING $value 
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
         * @return ARRAY
        */
        public function getCardInfo() : array {
            $card = parent::getCardInfo();
            //extends Card->getCardInfo() function adding effect identifier to the array
            $card = array_merge($card, array('effect' => $this->getEffect() ));
            return $card;
        }
    }
    /**
     * Special est une classe hérité de la class Card
     * @param string $cardEffect
     * @return object
     */
    class Special extends Card {
        function Special(   String $cardName = 'defaultTitle', String $cardImg = './defaultImg.jpeg', String $cardDesc = 'defaultDesc', 
                            Int $cardManaCost = 0, Int $cardAtk = 0, Int $cardHp = 0, String $cardEffect = 'none' ) {
            parent::Card( $cardName, $cardImg, $cardDesc, $cardManaCost, $cardType = 'special'  );
            $this->effect = $cardEffect;
            $this->atk = $cardAtk;
            $this->hp = $cardHp;
        }
        private $effect;
        private $atk;
        private $hp;
        private $canAttack = false;
        /**
         * changeAttackState
         * 
         * if the card type is special and creature
         * Creature->canAttack becomes Creature->!canAttack
         * 
         * @return void
        */
        public function changeAttackState() {
            $this->canAttack = !$this->canAttack;
        }
        //Setters
        /**
         * setAtk
         * 
         * @param INT
         * @return void
        */
        public function setAtk( int $value) : void {
            $this->atk = $value;
        }
        /**
         * setHp
         * 
         * @param INT
         * @return void
        */
        public function setHp( int $value) : void {
            $this->hp = $value;
        }
        /**
         * setEffect
         * 
         * @param STRING
         * @return void
        */
        public function setEffect( String $value ) : void {
            $this->effect = $value;
        }
        //Getters
        /**
         * getAtk
         * 
         * @return INT
        */
        public function getAtk() : int {
            return $this->atk;
        }
        /**
         * getHp
         * 
         * @return INT
        */
        public function getHp() : int {
            return $this->hp;
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
         * @return ARRAY
        */
        public function getCardInfo() : array {
            $card = parent::getCardInfo();
            $card = array_merge($card, array('atk' => $this->getAtk(), 'hp' => $this->getHp(), 'effect' => $this->getEffect() ));
            return $card;
        }
    }