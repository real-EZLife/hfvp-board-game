<?php
    class Board {
        public function __construct(Type $var = null) {
            # code...
        }
        /**
         * player a board
         *
         * @var array
        */
        private $sidea = [];
        /**
         * player b board
         *
         * @var array
        */
        private $sideb = [];
        /**
         * player b cemetery
         *
         * @var array
        */
        private $cemeterya = [];
        /**
         * player a cemetery
         *
         * @var array
        */
        private $cemeteryb = [];
        /**
         * hydrate object filling User instance props
         *
         * @param array $data
         * @return self
         */
        public function hydrate(array $data) : self {
                foreach( $data as $key => $value) {
                                $methodName = 'set' . ucfirst($key);
                                if(method_exists($this->$methodName)) {
                                        $this->$methodName($value);
                                }
                }
                return $this;
        }
    }