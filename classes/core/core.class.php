<?php 
    abstract class Core {
        //possible utilisation trait pour getobjectinfo
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
         * @return array
        */
        public function getObjectInfo() : array {
            return get_object_vars($this);
        }
    }