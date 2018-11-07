<?php
class Hero {
// --------------------
// ATTRIBUTES
// --------------------
/**
 * Hero ID
 * @var int 
 */
protected $_id;
/**
 * Hero name
 * @var string
 */
protected $_name;
/**
 * Mana of the hero
 * @var int
 */
protected $_mana;
/**
 * Life of the hero
 * @var int
 */
protected $_lp;
/**
 * Faction of the hero
 * @var int
 */
protected $_faction;
/**
 * IMG of the hero
 * @var string
 */
protected $_img;

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
/**
 * Get the value of _mana
 */ 
 public function get_mana() {
    return $this->_mana;
}
/**
 * Get the value of _lp
 */ 
public function get_lp() {
    return $this->_lp;
}
/**
 * Get the value of _faction
 */ 
public function get_faction() {
    return $this->_faction;
}
/**
 * Get the value of _img
 */ 
 public function get_img() {
    return $this->_img;
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
/**
 * Set the value of _mana
 * @return  self
 */ 
 public function set_mana(string $_mana) {
    $this->_mana = $_mana;
    return $this;
}
/**
 * Set the value of _lp
 * @return  self
 */ 
public function set_lp(string $_lp) {
    $this->_lp = $_lp;
    return $this;
}
/**
 * Set the value of _faction
 * @return  self
 */ 
public function set_faction(string $_faction) {
    $this->_faction = $_faction;
    return $this;
}
/**
 * Set the value of _img
 * @return  self
 */ 
 public function set_img(string $_img) {
    $this->_img = $_img;
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
    $method = 'set'. substr($key, 4);        
    if (method_exists($this, $method)) {
        $this->$method($value);
        }
    }
}
}