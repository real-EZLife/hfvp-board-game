<?php
class Faction {
// --------------------
// ATTRIBUTES
// --------------------
/**
 * Faction ID
 * @var string 
 */
protected $_id;
/**
 * Faction name
 * @var string
 */
protected $_name;

// --------------------
// GETTERS
// --------------------
/**
 * Get the value of _id
 */ 
public function get_id() {
return $this->_id;
}
/**
 * Get the value of _name
 */ 
public function get_name() {
return $this->_name;
}

// --------------------
// SETTERS
// --------------------
/**
 * Set the value of _id
 * @return  self
 */ 
public function set_id(int $_id) {
$this->_id = $_id;
return $this;
}
/**
 * Set the value of _name
 * @return  self
 */ 
public function set_name(string $_name) {
$this->_name = $_name;
return $this;
}

// --------------------
// METHODS
// -------------------

/**
 * Construction
 * @param array $datas
 */
public function __construct(array $datas) {
    $this->hydrate($datas);
}
/**
 * Hydratation
 * @param array $datas
 * @return void
 */
protected function hydrate(array $datas) {
    foreach ($datas as $key => $value) {
    $method = 'set'. substr($key, 3);        
    if (method_exists($this, $method)) {
        $this->$method($value);
        }
    }
}
}