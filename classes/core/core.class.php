<?php 
    abstract class Core {
        public function __construct(array $datas) {
            $this->hydrate($datas);
        }
        public function hydrate(array $data) {
            if(!empty($data)) {
                foreach($data as $key => $value) {
                    $methodName = 'set' . ucfirst($key);
                    if(method_exists($this, $methodName)) {
                        $this->$methodName($value);
                    }
                }
            }
            return $this;
        }
        
        /**
         * getObjectInfos
         * 
         * return all the object properties as an associative array
         * 
         * @param int
         * @return array
        */
        public function getObjectInfo() : array {
            return get_object_vars($this);
        }
    }