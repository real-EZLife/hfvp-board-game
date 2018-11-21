<?php 
    abstract class Core {
        //possible utilisation trait pour getobjectinfo
        public function __construct(array $datas) {
            $this->hydrate($datas);
        }
        public function hydrate(array $data) {
            if(!empty($data)) {
                foreach($data as $key => $value) {
                    $methodName = '';
                    $class_dbprefix = strtolower(get_called_class()) . '_';
                    if( $pos = strpos( $key, $class_dbprefix ) !== false) {
                        $key = str_replace($class_dbprefix, '', $key);
                        $methodName = 'set' . ucfirst($key);
                    }else {
                        $methodName = 'set' . ucfirst($key);
                    }
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
        public function getObjectInfo($obj) : array {
            return get_object_vars($obj);
        }
    }