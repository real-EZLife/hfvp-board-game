<?php
    /**
     * Card est une classe permettant de créer un modèle de Carte
     * @param string $cardDesc
     * @param string $cardName
     * @param string $cardDesc
     * @param string $cardImg
     * @param int $cardManaCost
     * @param string $cardType
     * @param boolean $cardSpecial
     * @return object
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
        private $name;
        private $img;
        private $desc;
        private $manaCost;
        private $type;
        private $special;
        /**
         * getSpecial() 
         * 
         * @return mixed false if !set or string if set
         */
        public function getSpecial() {
            return $this->special;
        }
        public function setSpecial(string $value) : void {
            $this->special = $value;
        }
        public function getName() : string {
            return $this->name;
        }
        public function getImg() : string {
            return $this->img;
        }
        public function getDesc() : string {
            return $this->desc;
        }
        public function getManaCost() : int {
            return $this->manaCost;
        }
        public function getType() : string {
            return $this->type;
        }
        public function setName(string $value) : void {
            $this->name = $value;
        }
        public function setImg(string $value) : void {
            $this->img = $value;
        }
        public function setDesc(string $value) : void {
            $this->desc = $value;
        }
        public function setManaCost(int $value) : void {
            $this->manaCost = $value;
        }
        public function setType(string $value) : void {
            $this->type = $value;
        }
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

    }
    /**
     * Creature est une classe hérité de la class Card
     * @param int $cardAtk
     * @param int $cardHp
     * @return object
     */
    class Creature extends Card {
        function Creature(  String $cardName = 'defaultTitle', String $cardImg = './defaultImg.jpeg', String $cardDesc = 'defaultDesc', 
                            Int $cardManaCost = 0, $cardSpecial = false, Int $cardAtk = 0, Int $cardHp = 0  ) {

            parent::Card( $cardName, $cardImg, $cardDesc, $cardManaCost, $cardType = 'creature', $cardSpecial );
            $this->atk = $cardAtk;
            $this->hp = $cardHp;
        }
        private $atk;
        private $hp;
        private $canAttack = false;
        public function changeAttackState() {
            $this->canAttack = !$this->canAttack;
        }
        //Setters
        public function setAtk( int $value) : void {
            $this->atk = $value;
        }
        public function setHp( int $value) : void {
            $this->hp = $value;
        }
        //Getters
        public function getAtk() : int {
            return $this->atk;
        }
        public function getHp() : int {
            return $this->hp;
        }
        public function getCardInfo() : array {
            $card = parent::getCardInfo();
            $card = array_merge($card, array('atk' => $this->getAtk(), 'hp' => $this->getHp() ));
            return $card;
        }
    }
    /**
     * Shield est une classe hérité de la class Creature
     * @param string $cardSpecial
     * @return object
     */
    class Shield extends Creature {
        function Shield(    String $cardName = 'defaultTitle', String $cardImg = './defaultImg.jpeg', String $cardDesc = 'defaultDesc', 
                            Int $cardManaCost = 0, int $cardAtk = 0, int $cardHp = 0 ) {
            parent::Creature( $cardName, $cardImg, $cardDesc, $cardManaCost, $cardSpecial = 'shield', $cardAtk, $cardHp );
        }
    }
    /**
     * Spell est une classe hérité de la class Card
     * @param string $cardEffect
     * @return object
     */
    class Spell extends Card {
        function Spell( String $cardName = 'defaultTitle', String $cardImg = './defaultImg.jpeg', String $cardDesc = 'defaultDesc', 
                        Int $cardManaCost = 0, String $cardEffect = 'none' ) {
            parent::Card( $cardName, $cardImg, $cardDesc, $cardManaCost, $cardType = 'spell' );
            $this->effect = $cardEffect;
        }
        private $effect;
        //Setters
        public function setEffect( String $value ) : void {
            $this->effect = $value;
        }
        //Getters
        public function getEffect() : string {
            return $this->effect;
        }
        public function getCardInfo() : array {
            $card = parent::getCardInfo();
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
        public function changeAttackState() {
            $this->canAttack = !$this->canAttack;
        }
        //Setters
        public function setAtk( int $value) : void {
            $this->atk = $value;
        }
        public function setHp( int $value) : void {
            $this->hp = $value;
        }
        public function setEffect( String $value ) : void {
            $this->effect = $value;
        }
        //Getters
        public function getAtk() : int {
            return $this->atk;
        }
        public function getHp() : int {
            return $this->hp;
        }
        public function getEffect() : string {
            return $this->effect;
        }
        public function getCardInfo() : array {
            $card = parent::getCardInfo();
            $card = array_merge($card, array('atk' => $this->getAtk(), 'hp' => $this->getHp(), 'effect' => $this->getEffect() ));
            return $card;
        }
    }