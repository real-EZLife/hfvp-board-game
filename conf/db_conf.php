<?php
    //Configuration de l'acces BDD

    class dbConf {
        private $dbUrl = '127.0.0.1';
        private $dbName = 'objectif3w_epicassembly';
        private $dbUser = 'objectif3w_epicassembly';
        private $dbPwd = '-EK,[YK4IQc*';
        private $dbCharset = 'utf8mb4';
        public function getDB() {
            try {
                $epic_db = new PDO('mysql:host=' . $this->dbUrl . ';dbname=' . $this->dbName . ';charset=' . $this->dbCharset, $this->dbUser, $this->dbPwd, array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
                return $epic_db;
            }catch(PDOException $e) {
                var_dump($e->getMessage());
            }
        }
    }
    
    $db = new dbConf();
    $epic_db = $db->getDB();

    /*  mysql -h 127.0.0.1 -u objectif3w_epicassembly -p 
        -EK,[YK4IQc* 
        use objectif3w_epicassembly
    */