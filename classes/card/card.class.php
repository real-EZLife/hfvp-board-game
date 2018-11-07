<?php
class Card {
// --------------------
// ATTRIBUTES
// --------------------
/**
 * Card ID
 * @var string 
 */
protected $_id;
/**
 * Name's card 
 * @var string
 */
protected $_name;
/**
 * Mana
 * @var int
 */
protected $_mana;
/**
 * Life's card
 * @var int
 */
protected $_pv;
/**
 * Attck's card
 * @var int
 */
protected $_atk;
/**
 * A short description about the card
 * @var string
 */
protected $_desc;
/**
 * Type of the card : Monster, Spell, Shield, Special
 * @var int
 */
protected $_type;
/**
 * Special FX if there's one
 * @var string
 */
protected $_fx;
/**
 * This is a special card ? TRUE or FALSE
 * @var int
 */
protected $_special;
/**
 * Path picture, w/o extension name
 * @var string
 */
protected $_img;
/**
 * Faction
 * @var int
 */
protected $_faction;
/**
 * Undocumented variable
 * @var [type]
 */
protected $_cardtype;
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
 * Get the value of _pv
 */ 
public function get_pv() {
return $this->_pv;
}
/**
 * Get the value of _atk
 */ 
public function get_atk() {
return $this->_atk;
}
/**
 * Get the value of _desc
 */ 
public function get_desc() {
return $this->_desc;
}
/**
 * Get the value of _type
 */ 
public function get_type() {
return $this->_type;
}
/**
 * Get the value of _fx
 */ 
public function get_fx() {
return $this->_fx;
}
/**
 * Get the value of _special
 */ 
public function get_special() {
return $this->_special;
}
/**
 * Get the value of _img
 */ 
public function get_img() {
return $this->_img;
}
/**
 * Get faction
 *
 * @return  string
 */ 
public function get_faction() {
return $this->_faction;
}
/**
 * Get undocumented variable
 * @return  [type]
 */ 
public function get_cardtype() {
return $this->_cardtype;
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
public function set_mana(int $_mana) {
$this->_mana = $_mana;
return $this;
}
/**
 * Set the value of _pv
 * @return  self
 */ 
public function set_pv(int $_pv) {
$this->_pv = $_pv;
return $this;
}
/**
 * Set the value of _atk
 * @return  self
 */ 
public function set_atk(int $_atk) {
$this->_atk = $_atk;
return $this;
}
/**
 * Set the value of _desc
 * @return  self
 */ 
public function set_desc(string $_desc) {
$this->_desc = $_desc;
return $this;
}
/**
 * Set the value of _type
 * @return  self
 */ 
public function set_type(int $_type) {
$this->_type = $_type;
return $this;
}
/**
 * Set the value of _fx
 * @return  self
 */ 
public function set_fx(string $_fx) {
$this->_fx = $_fx;
return $this;
}
/**
 * Set the value of _special
 * @return  self
 */ 
public function set_special(int $_special) {
$this->_special = $_special;
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
/**
 * Set faction
 * @param  string  $_faction  Faction
 * @return  self
 */ 
public function set_faction(int $_faction) {
$this->_faction = $_faction;
return $this;
}
/**
 * 
 */
public function set_cardtype($_cardtype) {
$this->_cardtype = $_cardtype;

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