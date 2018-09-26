<?php
    //Configuration de l'acces BDD

    $dbConf = new stdClass();
    $dbConf->dbUrl = 'localhost';
    $dbConf->dbName = 'objectif3w_epicassembly';
    $dbConf->dbUser = 'epic_assembly';
    $dbConf->dbPwd = '-EK,[YK4IQc*';
    $dbConf->dbCharset = 'utf8mb4';
    $dbConf->dsn = 'mysql:host=' . $this->dbUrl . 'dbname=' . $this->dbName . 'charset=' . $this->dbCharset;

    $epic_db = new PDO($dbConf->dsn, $dbConf->dbUser, $dbConf->dbPwd);
