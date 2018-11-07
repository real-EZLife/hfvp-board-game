<?php
    /**
     * Card est une classe permettant de créer un modèle de Carte
    */
    abstract class Card extends Core {
        /**
         * Holds the card name
         * @var int
        */
        protected $id;
        /**
         * Holds the card name
         * @var string
        */
        protected $name;
        /**
         * Holds the card image path
         * @var string
        */
        protected $img;
        /**
         * Holds the card description
         * @var string
        */
        protected $desc;
        /**
         * Holds the card mana cost
         * @var int
        */
        protected $mana;
        /**
         * Holds the card type
         * @var string
        */
        protected $fx;
        /**
         * Holds the card type
         * @var string
        */
        protected $type;
        /**
         * Holds the card special type
         * @var string
        */
        protected $special;
        /**
         * 
         * ------------------
         * 
         * SETTTERS
         * 
         * ------------------
         * 
         */
        /**
         * setSpecial
         * 
         * @param mixed pass a string with special keyword or false
         * @return self
        */
        public function setSpecial($value) : self {
            $this->special = $value;
            return $this;
        }
        /**
         * setName
         * 
         * @param int
         * @return self
        */
        public function setName(string $value) : self {
            $this->name = $value;
            return $this;
        }
        /**
         * setImg
         * 
         * @param int
         * @return self
        */
        public function setImg(string $value) : self {
            $this->img = $value;
            return $this;
        }
        /**
         * setDesc
         * 
         * @param int
         * @return self
        */
        public function setDesc(string $value) : self {
            $this->desc = $value;
            return $this;
        }
        /**
         * setMana
         * 
         * @param int
         * @return self
        */
        public function setMana(int $value) : self {
            $this->mana = $value;
            return $this;
        }
        /**
         * setType
         * 
         * @param int
         * @return self
        */
        public function setType(string $value) : self {
            $this->type = $value;
            return $this;
        }

        /**
         * Set $id
         *
         * @param  int  $id  Holds the card name
         *
         * @return  self
         */ 
        public function setId(int $id) {
            $this->id = $id;

            return $this;
        }
        /**
         * 
         * ------------------------
         * 
         * GETTERS
         * 
         * ------------------------
         */
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
         * getMana
         * 
         * @return int
        */
        public function getMana() : int {
            return $this->mana;
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
         * Get $id
         *
         * @return  int
         */ 
        public function getId() {
            return $this->id;
        }

        /**
         * ----------------------------------------
         * METHODS
         * ----------------------------------------
         */
        /**
         * getCardData
         * 
         * return all the User instance properties as an associative array except password
         * 
         * @return array
        */
        public function getCardData() : array {
            return $this->getObjectInfo($this);
        }
    }