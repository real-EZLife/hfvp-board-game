<?php
    //Configuration de l'acces BDD

    class dbConf {
        private $dbUrl = '127.0.0.1';
        private $dbName = 'objectif3w_epicassembly';
        private $dbUser = 'epic_assembly';
        private $dbPwd = '-EK,[YK4IQc*';
        private $dbCharset = 'utf8mb4';
        public function getDB() {
            try {
                $epic_db = new PDO('mysql:host=' . $this->dbUrl . ';dbname=' . $this->dbName . ';charset=' . $this->dbCharset, $this->dbUser, $this->dbPwd);
                return $epic_db;
            }catch(PDOException $e) {
                var_dump($e->getMessage());
            }
        }
    }

    $db = new dbConf();
    $epic_db = $db->getDB();

