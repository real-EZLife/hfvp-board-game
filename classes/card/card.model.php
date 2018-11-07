<?php
/**
 * CRUD
 */
class CardModel {
// ------------
// ATTRIBUTES
// ------------
    /**
     * Undocumented variable
     * @var string
     */
    private $db;
    /**
     * Undocumented variable
     * @var string
     */
    private $req;
// ------------
// METHODS
// ------------
  /**
   * Constructor
   */
  public function __construct() {
      try {
      $this->db = new PDO('mysql:host=localhost;dbname=epic_assembly;charset=utf8mb4', 'root', '', array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
      } catch(PDOException $e) {
      throw new Exception($e->getMessage(), $e->getCode(), $e);
      }
  }
    /**
     * [CREATE] a card
     */
    public function create($name, $mana, $pv, $atk, $desc, $type, $fx, $special, $img, $faction) {
      try {
        if(($req = $this->db->prepare('INSERT INTO `card`(`card_name`, `card_mana`, `card_pv`, `card_atk`, `card_desc`, `card_type`, `card_fx`, `card_special`, `card_img`, `fac_id`) 
                                       VALUES (:name, :mana, :pv, :atk, :desc, :type, :fx, :special, :img, :faction);'))!==false) {                                          
          $img = $_FILES['img']['name'];
          if($req->bindValue('name', $name) && $req->bindValue('mana', $mana) && $req->bindValue('pv', $pv) && $req->bindValue('atk', $atk) && $req->bindValue('desc', $desc) && $req->bindValue('type', $type) && $req->bindValue('fx', $fx) && $req->bindValue('special', $special) && $req->bindValue('img', $img) && $req->bindValue('faction', $faction));
            $req->closeCursor();  
            return $req->execute();
            }
          return false;
        } catch(PDOException $e) {
            throw new Exception($e->getMessage(), $e->getCode(), $e);
      }
    }

    /**
     * [READ] a card
     */
    public function read(int $id) {
      try {
        if(($this->req = $this->db->prepare('SELECT `card_id`, `card_name`, `card_mana`, `card_pv`, `card_atk`, `card_desc`, `card_type`, `card_fx`, `card_special`, `card_img`, `fac_id` AS `fact_faction`, `type_id` AS `type_type`, `type_name` AS `type_cardtype`
                                            FROM `card`
                                            JOIN `type` ON `card_type`=`type_id`
                                            WHERE `card_id`=?
                                            '))!==false) {
        if($this->req->bindValue(1, $id, PDO::PARAM_INT)) {
          if($this->req->execute()) {
            $datas = $this->req->fetch(PDO::FETCH_ASSOC);
            return new Card($datas);
          }
          $req->closeCursor();
        }
      }
          return false;
      } catch(PDOException $e) {
          throw new Exception($e->getMessage(), $e->getCode(), $e);
      }
    }

    /**
     * [READ] all cards with a JOIN to the 'type' TABLE
     * @return void
     */
    public function readAll() {
        try {
          if(($this->req = $this->db->query('SELECT `card_id`, `card_name`, `card_mana`, `card_pv`, `card_atk`, `card_desc`, `card_type`, `card_fx`, `card_special`, `card_img`, `fac_id` AS `fact_faction`, `type_id` AS `type_type`, `type_name` AS `type_cardtype`
                                              FROM `card`
                                              JOIN `type` ON `card_type`=`type_id`'))!==false) {
            $cards = array();
            while(($datas = $this->req->fetch(PDO::FETCH_ASSOC))!==false) {
              $cards[] = new Card($datas);
            }
            $this->req->closeCursor();
            return $cards;
          }
            return false;
        } catch(PDOException $e) {
          throw new Exception($e->getMessage(), $e->getCode(), $e);
        }
      }

        /**
         * [UPDATE] card content
         * USES the card id to SELECT the good card
         * @return void
         */
        public function update($name, $mana, $pv, $atk, $desc, $type, $fx, $special, $faction, $id) {
          try {
            if(($req = $this->db->prepare('UPDATE `card` SET `card_name`=:name, `card_mana`=:mana, `card_pv`=:pv, `card_atk`=:atk, `card_desc`=:desc, `card_type`=:type, `card_fx`=:fx, `card_special`=:special, `fac_id`=:faction WHERE `card_id`=:id'))!==false) {
              // $img = $_FILES['img']['name'];
              if($req->bindValue('name', $name) && $req->bindValue('mana', $mana) && $req->bindValue('pv', $pv) && $req->bindValue('atk', $atk) && $req->bindValue('desc', $desc) && $req->bindValue('type', $type) && $req->bindValue('fx', $fx) && $req->bindValue('special', $special) && $req->bindValue('faction', $faction) && $req->bindValue('id', $id, PDO::PARAM_INT));
                $req->closeCursor();  
                return $req->execute();
                }
            return false;
          } catch(PDOException $e) {
            throw new Exception($e->getMessage(), $e->getCode(), $e);
          }
        }

        /**
         * [DELETE] a card (to do : code a confirmation)
         * USES the card id to SELECT the good card
         * @param int $id
         * @return $req
         */
        public function delete($id) {
          try {
            if(($req = $this->db->prepare('DELETE FROM `card` WHERE `card_id`=:id'))!==false) {
              $req->bindValue('id', $id);
              $req->closeCursor();
              return $req->execute();
            }
          return false;
        } catch(PDOException $e) {
            throw new Exception($e->getMessage(), $e->getCode(), $e);
        }
      }


}