<?php
    
    require_once('D:\www\hfvp-board-game\new\conf/db_conf.php');

    class CardModel {
        public function __construct(PDO $db) {
            $this->db = $db;
        }

        private $db;

        private function createCard(array $data) {
            switch($data['card_type']) {
                case 1: 
                    if($data['card_special'] !== 'none') {
                        ucfirst($data['card_special']);
                        return new $data['card_special']();
                    }
                    else{
                        return new Creature();
                    }
                    break;
                case 2:
                    return new Spell();
                    break;
                case 3:
                    return new Special(); 
            }
        }

        public function create( Card $c ) {

        }
        public function readAll() {
           
            try {
                if($req = $this->db->query('SELECT * from `card`')) {
                    if($req->execute()) {
                        if($res = $req->fetchAll(PDO::FETCH_ASSOC)) {
                            return $res;
                        }
                    }
                }
            }catch(PDOException $e) {
                $e->getMessage();
            }

        }
        public function read(int $id) {
           
            try {
                if($req = $this->db->prepare('SELECT * from `card` WHERE ``=:card_id')) {
                    if($req->bindValues('card_id', (int) $id, PDO::PARAM_INT)) {
                        if($req->execute()) {
                            if($res = $req->fetch(PDO::FETCH_ASSOC)) {
                                return $res;
                            }
                        }
                    }
                }
            }catch(PDOException $e) {
                $e->getMessage();
            }

        }
        public function update( User $user ) {
            


        }
        public function delete( User $user ) {
            


        }
    }
    $cardm = new CardModel($epic_db);
    var_dump($cardm->readAll());