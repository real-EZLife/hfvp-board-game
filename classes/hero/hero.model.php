<?php
/**
 * CRUD
 */
class HeroModel {
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
     * [CREATE] a hero
     */
    public function create($name, $mana, $lp, $faction, $img) {
      try {
        if(($req = $this->db->prepare('INSERT INTO `hero`(`hero_name`, `hero_mana`, `hero_lp`, `fac_id`, `hero_img`) 
                                       VALUES (:name, :mana, :lp, :faction, :img);'))!==false) {                                          
          $img = $_FILES['img']['name'];
          if($req->bindValue('name', $name) && $req->bindValue('mana', $mana) && $req->bindValue('lp', $lp) && $req->bindValue('faction', $faction) && $req->bindValue('img', $img));
            $req->closeCursor();  
            return $req->execute();
            }
          return false;
        } catch(PDOException $e) {
            throw new Exception($e->getMessage(), $e->getCode(), $e);
      }
    }

    /**
     * [READ] a faction
     */
    public function read(int $id) {
      try {
        if(($this->req = $this->db->prepare('SELECT `hero_id`, `hero_name`, `hero_mana`, `hero_lp`, `fac_id` AS `hero_faction`, `hero_img`
                                            FROM `hero` WHERE `hero_id`=?
                                            '))!==false) {
        if($this->req->bindValue(1, $id, PDO::PARAM_INT)) {
          if($this->req->execute()) {
            $datas = $this->req->fetch(PDO::FETCH_ASSOC);
            return new Hero($datas);
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
          if(($this->req = $this->db->query('SELECT `hero_id`, `hero_name`, `hero_mana`, `hero_lp`, `fac_id` AS `hero_faction`, `hero_img` FROM `hero`'))!==false) {
            $heroes = array();
            while(($datas = $this->req->fetch(PDO::FETCH_ASSOC))!==false) {
              $heroes[] = new Hero($datas);
            }
            $this->req->closeCursor();
            return $heroes;
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