<?php
    abstract class Card {
        // card_id	card_name	card_mana	card_pv	card_atk	card_desc	card_type	card_fx	card_special	card_img	fac_id
        public function __construct(array $array = []) {
                if(!empty($array)) {
                        $this->hydrate($array);
                }
        }
        /**
         * card id
         *
         * @var int
        */
        protected $id;
        /**
         * card name
         *
         * @var string
        */
        protected $name;
        /**
         * card description
         *
         * @var string
        */
        protected $desc;
        /**
         * card artwork url
         *
         * @var string
        */
        protected $imgurl;
        /**
         * card mana cost
         *
         * @var int
        */
        protected $cost;
        /**
         * card special type keyword
         *
         * @var string
        */
        protected $talent;
        /**
         * hydrate object filling User instance props
         *
         * @param array $data
         * @return self
        */
        public function hydrate(array $data) : self {
                foreach( $data as $key => $value) {
                                $methodName = 'set' . ucfirst($key);
                                if(method_exists($this, $methodName)) {
                                        $this->$methodName($value);
                                }
                }
                return $this;
        }

        /**
         * Get card id
         *
         * @return  int
         */ 
        public function getId() :int {
                return $this->id;
        }

        /**
         * Set card id
         *
         * @param  int  $id  card id
         *
         * @return  self
         */ 
        public function setId(int $id) : self {
                var_dump($id);
                $this->id = $id;

                return $this;
        }

        /**
         * Get card name
         *
         * @return  string
         */ 
        public function getName() : string{
                return $this->name;
        }

        /**
         * Set card name
         *
         * @param  string  $name  card name
         *
         * @return  self
         */ 
        public function setName(string $name) : self{
                $this->name = $name;

                return $this;
        }

        /**
         * Get card description
         *
         * @return  string
         */ 
        public function getDesc() : string {
                return $this->desc;
        }

        /**
         * Set card description
         *
         * @param  string  $desc  card description
         *
         * @return  self
         */ 
        public function setDesc(string $desc) : self {
                $this->desc = $desc;

                return $this;
        }

        /**
         * Get card artwork url
         *
         * @return  string
         */ 
        public function getImgurl() : string {
                return $this->imgurl;
        }

        /**
         * Set card artwork url
         *
         * @param  string  $imgurl  card artwork url
         *
         * @return  self
         */ 
        public function setImgurl(string $imgurl) : self {
                $this->imgurl = $imgurl;

                return $this;
        }

        /**
         * Get card mana cost
         *
         * @return  int
         */ 
        public function getCost() : int {
                return $this->cost;
        }

        /**
         * Set card mana cost
         *
         * @param  int  $cost  card mana cost
         *
         * @return  self
         */ 
        public function setCost(int $cost) : self {
                $this->cost = $cost;

                return $this;
        }

        /**
         * Get card special type keyword
         *
         * @return  string
         */ 
        public function getTalent() : string {
                return $this->talent;
        }

        /**
         * Set card special type keyword
         *
         * @param  string  $talent  card special type keyword
         *
         * @return  self
         */ 
        public function setTalent(string $talent) : self {
                $this->talent = $talent;

                return $this;
        }
    }