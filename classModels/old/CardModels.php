<?php
    /**
     * Card est une classe permettant de créer un modèle de Carte
    */
    class Card {
        public function __construct(  String $cardName = 'defaultTitle', String $cardImg = './defaultImg.jpeg', String $cardDesc = 'defaultDesc', Int $cardManaCost = 0, 
                        String $cardType = '', $cardSpecial = false) {
                            
            $this->name = $cardName;
            $this->img = $cardImg;
            $this->desc = $cardDesc;
            $this->manaCost = $cardManaCost;
            $this->type = $cardType;
            $this->special = $cardSpecial;
        }
        /**
         * Holds the card name
         * @var string
        */
        private $name;
        /**
         * Holds the card image path
         * @var string
        */
        private $img;
        /**
         * Holds the card description
         * @var string
        */
        private $desc;
        /**
         * Holds the card mana cost
         * @var int
        */
        private $manaCost;
        /**
         * Holds the card type
         * @var string
        */
        private $type;
        /**
         * Holds the card special type
         * @var string
        */
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
         * @return int
        */
        public function getName() : string {
            return $this->name;
        }
        /**
         * getImg
         * 
         * @return int
        */
        public function getImg() : string {
            return $this->img;
        }
        /**
         * getDesc
         * 
         * @return int
        */
        public function getDesc() : string {
            return $this->desc;
        }
        /**
         * getManaCost
         * 
         * @return int
        */
        public function getManaCost() : int {
            return $this->manaCost;
        }
        /**
         * getType
         * 
         * @return int
        */
        public function getType() : string {
            return $this->type;
        }
        /**
         * getCardInfo
         * 
         * return all the Card properties as an assoc. array
         * 
         * @param int
         * @return array
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
         * @param int
         * @return void
        */
        public function setName(string $value) : void {
            $this->name = $value;
        }
        /**
         * setImg
         * 
         * @param int
         * @return void
        */
        public function setImg(string $value) : void {
            $this->img = $value;
        }
        /**
         * setDesc
         * 
         * @param int
         * @return void
        */
        public function setDesc(string $value) : void {
            $this->desc = $value;
        }
        /**
         * setManaCost
         * 
         * @param int
         * @return void
        */
        public function setManaCost(int $value) : void {
            $this->manaCost = $value;
        }
        /**
         * setType
         * 
         * @param int
         * @return void
        */
        public function setType(string $value) : void {
            $this->type = $value;
        }

    }
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
            $this->atk = $cardAtk;
            $this->hp = $cardHp;
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
         * @return void
        */
        public function changeAttackState() : void {
            $this->canAttack = !$this->canAttack;
        }
        //Setters
        /**
         * setAtk
         * 
         * @param int
         * @return void
        */
        public function setAtk( int $value) : void {
            $this->atk = $value;
        }
        /**
         * setHp
         * 
         * @param int
         * @return void
        */
        public function setHp( int $value) : void {
            $this->hp = $value;
        }
        /**
         * setHp
         * 
         * @param bool
         * @return void
        */
        public function setCanAttack( bool $value) : void {
            $this->canAttack = $value;
        }
        //Getters
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
    /**
     * Shield est une classe hérité de la class Creature
     * @param int $cardSpecial = 'shield'
     * @return Shield
     */
    class Shield extends Creature {
        public function __construct(    String $cardName = 'defaultTitle', String $cardImg = './defaultImg.jpeg', String $cardDesc = 'defaultDesc', 
                            Int $cardManaCost = 0, int $cardAtk = 0, int $cardHp = 0 ) {
            parent::__construct( $cardName, $cardImg, $cardDesc, $cardManaCost, $cardSpecial = 'shield', $cardAtk, $cardHp );
        }
    }
    /**
     * Spell est une classe hérité de la class Card
     * @param int $cardEffect
     * @return Spell
     */
    class Spell extends Card {
        public function __construct( String $cardName = 'defaultTitle', String $cardImg = './defaultImg.jpeg', String $cardDesc = 'defaultDesc', 
                        Int $cardManaCost = 0, String $cardEffect = 'none' ) {
            parent::__construct( $cardName, $cardImg, $cardDesc, $cardManaCost, $cardType = 'spell' );
            $this->effect = $cardEffect;
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
    /**
     * Special est une classe hérité de la class Card
     * @param string $cardEffect
     * @return object
     */
    class Special extends Card {
        public function __construct(   String $cardName = 'defaultTitle', String $cardImg = './defaultImg.jpeg', String $cardDesc = 'defaultDesc', 
                            Int $cardManaCost = 0, Int $cardAtk = 0, Int $cardHp = 0, String $cardEffect = 'none' ) {
            parent::__construct( $cardName, $cardImg, $cardDesc, $cardManaCost, $cardType = 'special'  );
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
         * @param int
         * @return void
        */
        public function setAtk( int $value) : void {
            $this->atk = $value;
        }
        /**
         * setHp
         * 
         * @param int
         * @return void
        */
        public function setHp( int $value) : void {
            $this->hp = $value;
        }
        /**
         * setEffect
         * 
         * @param int
         * @return void
        */
        public function setEffect( String $value ) : void {
            $this->effect = $value;
        }
        //Getters
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