<?php
class Card extends Core {

// --------------------
// ATTRIBUTES
// --------------------
/**
 * Card ID
 * @var string 
 */
protected $id;
/**
 * Name's card 
 * @var string
 */
protected $name;
/**
 * Mana
 * @var int
 */
protected $mana;
/**
 * Life's card
 * @var int
 */
protected $pv;
/**
 * Attck's card
 * @var int
 */
protected $atk;
/**
 * A short description about the card
 * @var string
 */
protected $desc;
/**
 * Type of the card : Monster, Spell, Shield, Special
 * @var int
 */
protected $type;
/**
 * Special FX if there's one
 * @var string
 */
protected $fx;
/**
 * This is a special card ? TRUE or FALSE
 * @var int
 */
protected $special;
/**
 * Path picture, w/o extension name
 * @var string
 */
protected $img;
/**
 * Faction
 * @var int
 */
protected $faction;
/**
 * Undocumented variable
 * @var [type]
 */
protected $cardtype;
// --------------------
// GETTERS
// --------------------
/**
 * Get the value of id
 */ 
public function getId() {
return $this->id;
}
/**
 * Get the value of name
 */ 
public function getName() {
return $this->name;
}
/**
 * Get the value of mana
 */ 
public function getMana() {
return $this->mana;
}
/**
 * Get the value of pv
 */ 
public function getPv() {
return $this->pv;
}
/**
 * Get the value of atk
 */ 
public function getAtk() {
return $this->atk;
}
/**
 * Get the value of desc
 */ 
public function getDesc() {
return $this->desc;
}
/**
 * Get the value of type
 */ 
public function getType() {
return $this->type;
}
/**
 * Get the value of fx
 */ 
public function getFx() {
return $this->fx;
}
/**
 * Get the value of special
 */ 
public function getSpecial() {
return $this->special;
}
/**
 * Get the value of img
 */ 
public function getImg() {
return $this->img;
}
/**
 * Get faction
 *
 * @return  string
 */ 
public function getFaction() {
return $this->faction;
}
/**
 * Get undocumented variable
 * @return  [type]
 */ 
public function getCardtype() {
return $this->cardtype;
}

// --------------------
// SETTERS
// --------------------
/**
 * Set the value of id
 * @return  self
 */ 
public function setId(int $id) {
$this->id = $id;
return $this;
}
/**
 * Set the value of name
 * @return  self
 */ 
public function setName(string $name) {
$this->name = $name;
return $this;
}
/**
 * Set the value of mana
 * @return  self
 */ 
public function setMana(int $mana) {
$this->mana = $mana;
return $this;
}
/**
 * Set the value of pv
 * @return  self
 */ 
public function setPv(int $pv) {
$this->pv = $pv;
return $this;
}
/**
 * Set the value of atk
 * @return  self
 */ 
public function setAtk(int $atk) {
$this->atk = $atk;
return $this;
}
/**
 * Set the value of desc
 * @return  self
 */ 
public function setDesc(string $desc) {
$this->desc = $desc;
return $this;
}
/**
 * Set the value of type
 * @return  self
 */ 
public function setType(int $type) {
$this->type = $type;
return $this;
}
/**
 * Set the value of fx
 * @return  self
 */ 
public function setFx(string $fx) {
$this->fx = $fx;
return $this;
}
/**
 * Set the value of special
 * @return  self
 */ 
public function setSpecial(int $special) {
$this->special = $special;
return $this;
}
/**
 * Set the value of img
 * @return  self
 */ 
public function setImg(string $img) {
$this->img = $img;
return $this;
}
/**
 * Set faction
 * @param  string  $faction  Faction
 * @return  self
 */ 
public function setFaction(int $faction) {
$this->faction = $faction;
return $this;
}
/**
 * 
 */
public function setCardtype($cardtype) {
$this->cardtype = $cardtype;

return $this;
}

// --------------------
// METHODS
// -------------------

/**
 * Construction
 * @param array $datas
 */
// public function __construct(array $datas) {
//     $this->hydrate($datas);
// }
/**
 * Hydratation
 * @param array $datas
 * @return void
 */
// public function hydrate(array $datas) {
//     var_dump($datas);
//     foreach ($datas as $key => $value) {
//     $method = 'set'. substr($key, 4);        
//     if (method_exists($this, $method)) {
//         $this->$method($value);
//         }
//     }
// }
}