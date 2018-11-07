<?php
    class HeroModel {
        public function __construct(PDO $db) {
            $this->setDB($db);
        }
        /**
         * credentials and db config 
         *
         * @var PDO
        */
        private $db;

        /**
         * Get credentials and db config 
         *
         * @return  PDO
         */ 
        private function getDb() {
            return $this->db;
        }

        /**
         * Set credentials and db config 
         *
         * @param  PDO  $db
         *
         * @return  self
         */ 
        private function setDb(PDO $db) {
            $this->db = $db;

            return $this;
        }


        public function read(int $id = null) {
            try {

                if($id == null) {
                    if(($req = $this->getDb()->query('SELECT *, `faction`.`fac_name` AS `hero_faction`
                                                        FROM `hero`
                                                        LEFT JOIN `faction` ON `hero`.`fac_id`=`faction`.`fac_id`')
                                                    ) != false) 
                    {
                        if(($res = $req->fetchAll(PDO::FETCH_ASSOC)) != null) {
                            foreach($res as $pos => $hero) {
                                return new Hero($hero);
                            }
                        }
                    }
                    return false;
                }elseif(is_numeric($id)) {
                    if(($req = $this->getDb()->prepare('SELECT * FROM `hero` WHERE `hero_id`=?')) != false) {
                        if($req->bindValue(1, (int) $id, PDO::PARAM_INT) != false) {
                            if(($res = $req->fetch(PDO::FETCH_ASSOC)) != null) {
                                return new Hero($hero);
                            }
                        }
                    }
                    return false;
                }
                return false;

            }catch(PDOException $e) {
                return $e->getMessage();
            }
        }
        public function createHero(Hero $hero) {
            try {
                if($req = $this->getDb()->prepare('INSERT INTO `hero` (`fac_id`, `hero_id`, `hero_lp`, `hero_mana`, `hero_name`)
                                                    VALUES (`:fac`, NULL, `:lp`, `:mana`, `:name`)')) 
                {
                    if($req->bindValue('fac', (int) $hero->getFaction(), PDO::PARAM_INT) &&
                        $req->bindValue('lp', (int) $hero->getMaxlp(), PDO::PARAM_INT) &&
                        $req->bindValue('mana', (int) Hero::MAX_MANA, PDO::PARAM_INT) &&
                        $req->bindValue('name', (string) $hero->getName(), PDO::PARAM_STR))
                    {
                        if($req->execute()) {
                            return $this->getDb()->lastInsertId();
                        }
                    }
                }
                return false;
                var_dump($hero->getHero());     

            }catch(PDOException $e) {
                return $e->getMessage();
            }
        }
        public function createTempHero(Lobby $lobby, Hero $hero) {
            try {
                if($req = $this->getDb()->prepare('INSERT INTO `temp_hero` (`gam_id`, `hero_id`, `temp_hero_id`, `temp_hero_lp`, `temp_hero_mana`, `user_pseudo`)
                                                    VALUES (`:game`, `:id`, NULL, `:tmplp`, `:tmpmana`, `:user`)')) 
                {
                    if($req->bindValue('game', (int) $lobby->getId(), PDO::PARAM_INT) &&
                        $req->bindValue('id', (int) $hero->getId(), PDO::PARAM_INT) &&
                        $req->bindValue('tmplp', (int) $hero->getLp(), PDO::PARAM_INT) &&
                        $req->bindValue('tmpmana', (int) $hero->getMana(), PDO::PARAM_INT) &&
                        $req->bindValue('user', (string) $lobby->getName(), PDO::PARAM_STR))
                    {
                        if($req->execute()) {
                            return $this->getDb()->lastInsertId();
                        }
                    }
                }
                return false;
                var_dump($hero->getHero());     

            }catch(PDOException $e) {
                return $e->getMessage();
            }
        }
    }
    require_once('D:\www\hfvp-board-game\classes\hero\hero.class.php');
    require_once('D:\www\hfvp-board-game\conf\db_conf.php');
    $hm = new HeroModel($epic_db);
    var_dump($hm->read());