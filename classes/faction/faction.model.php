<?php
/**
 * CRUD
 */
class FactionModel {
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
     * [CREATE] a faction
     */
    // public function create($name, $mana, $pv, $atk, $desc, $type, $fx, $special, $img, $faction) {
    //   try {
    //     if(($req = $this->db->prepare('INSERT INTO `faction`(`fac_name`) VALUES (:name);'))!==false) {                                          
    //       if($req->bindValue('name', $name));
    //         $req->closeCursor();  
    //         return $req->execute();
    //         }
    //       return false;
    //     } catch(PDOException $e) {
    //         throw new Exception($e->getMessage(), $e->getCode(), $e);
    //   }
    // }

    /**
     * [READ] a faction
     */
    public function read(int $id) {
      try {
        if(($this->req = $this->db->prepare('SELECT `card_id`, `card_name`, `card_mana`, `card_pv`, `card_atk`, `card_desc`, `card_type`, `card_fx`, `card_special`, `card_img`, `card_fac_id` AS `fact_faction`, `type_id` AS `type_type`, `type_name` AS `type_cardtype`
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
     * [READ] all factions
     * @return void
     */
    public function readAll() {
        try {
          if(($this->req = $this->db->query('SELECT `fac_id`, `fac_name` FROM `faction`'))!==false) {
            $cards = array();
            while(($datas = $this->req->fetch(PDO::FETCH_ASSOC))!==false) {
              $factions[] = new Faction($datas);
            }
            $this->req->closeCursor();
            return $factions;
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
        // public function update($name) {
        //   try {
        //     if(($req = $this->db->prepare('UPDATE `faction` SET `fac_name`=:name'))!==false) {
        //       if($req->bindValue('name', $name));
        //         $req->closeCursor();  
        //         return $req->execute();
        //         }
        //     return false;
        //   } catch(PDOException $e) {
        //     throw new Exception($e->getMessage(), $e->getCode(), $e);
        //   }
        // }

        /**
         * [DELETE] a card (to do : code a confirmation)
         * USES the card id to SELECT the good card
         * @param int $id
         * @return $req
         */
        //     public function delete($id) {
        //       try {
        //         if(($req = $this->db->prepare('DELETE FROM `faction` WHERE `fac_id`=:id'))!==false) {
        //           $req->bindValue('id', $id);
        //           $req->closeCursor();
        //           return $req->execute();
        //         }
        //       return false;
        //     } catch(PDOException $e) {
        //         throw new Exception($e->getMessage(), $e->getCode(), $e);
        //     }
        //   }


}