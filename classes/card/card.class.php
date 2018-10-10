<?php
    /**
     * Card est une classe permettant de créer un modèle de Carte
    */
    class Card {
        public function __construct(  String $cardName = 'defaultTitle', String $cardImg = './defaultImg.jpeg', String $cardDesc = 'defaultDesc', Int $cardManaCost = 0, 
                        String $cardType = '', $cardSpecial = false) {
                            
            $this->setName($cardName);
            $this->setImg($cardImg);
            $this->setDesc($cardDesc);
            $this->setManaCost($cardManaCost);
            $this->setType($cardType);
            $this->setSpecial($cardSpecial);
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
    }