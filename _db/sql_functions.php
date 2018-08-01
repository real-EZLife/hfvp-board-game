<?php
    include_once(dirname(__DIR__) . '/conf/defines.php');
    


    function onQueryError($query) {
        echo "Echec lors de la requête : (" . $query->errno . ") " . $query->error . PHP_EOL;
    }

    function makeSqlQuery( String $keyword, String $query, bool $force = false ) {

        require(ROOT_PATH . 'conf/db_conf.php');

        
        strtoupper($keyword);
        $mysqli = new mysqli($dbConf->dbUrl, $dbConf->dbUser, $dbConf->dbPwd, $dbConf->dbName);
        

        $requestOk = false;
        switch( $keyword ) {
            case 'DELETE':
                if($force) {
                    $requestOk = true;
                }
                break;
            default: 
                $requestOk = true;
                break;
        }
        
        if ($mysqli->connect_errno) {
            printf("Échec de la connexion : %s" . PHP_EOL, $mysqli->connect_error);
            exit();
        }
        if($requestOk) {
            $query = "$keyword $query";
            if(!$query = $mysqli->query($query)) {
                onQueryError($mysqli);
            }else {
                if($res = $query) {
                    echo 'Succes';
                    return $res;
                }
            }
        }else {
            print_r('the request wasn\'t send' . PHP_EOL);
        }
    }
    function makeSelectQuery( String $query ) {

        require(ROOT_PATH . 'conf/db_conf.php');


        $mysqli = new mysqli($dbConf->dbUrl, $dbConf->dbUser, $dbConf->dbPwd, $dbConf->dbName);

        if ($mysqli->connect_errno) {
            printf("Échec de la connexion : %s" . PHP_EOL, $mysqli->connect_error);
            exit();
        }

        if(!$query = $mysqli->query("SELECT $query")) {
            onQueryError($mysqli);
        }else {
            if($res = $query) {
                echo 'Succes';
                return $res;
            }
        }
    }
    function makeDeleteQuery( String $query, Bool $force = false ) {

        require(ROOT_PATH . 'conf/db_conf.php');


        $mysqli = new mysqli($dbConf->dbUrl, $dbConf->dbUser, $dbConf->dbPwd, $dbConf->dbName);

        if ($mysqli->connect_errno) {
            printf("Échec de la connexion : %s" . PHP_EOL, $mysqli->connect_error);
            exit();
        }
        if($force) {
            if(!$query = $mysqli->query("DELETE $query")) {
                onQueryError($mysqli);
            }else {
                echo 'Success';
            }
        }else {
            print_r('$force param set to false so nothing appened'.PHP_EOL);
        }
    }
    function makeInsertQuery( String $table, Array $colNames, Array $values ) {

        require(ROOT_PATH . 'conf/db_conf.php');


        $mysqli = new mysqli($dbConf->dbUrl, $dbConf->dbUser, $dbConf->dbPwd, $dbConf->dbName);

        if ($mysqli->connect_errno) {
            printf("Échec de la connexion : %s" . PHP_EOL, $mysqli->connect_error);
            exit();
        }

        $queryRows = '(';
        $queryValues = '(';
        $finalQuery = '';
        if( count($colNames) === count($values)) {
            for($i = 0; $i < count($colNames); $i++) {
                if( $i !== count($colNames) - 1) {
                    $queryValues .= $values[$i] . ', ';
                    $queryRows .=  $colNames[$i] . ', ';
                }else {
                    $queryValues .= $values[$i] . ')';
                    $queryRows .= $colNames[$i] . ')';
                }
            }
        }
        $finalQuery = "INSERT INTO $table $queryRows VALUES $queryValues";
        if(!$mysqli->query($finalQuery)) {
            onQueryError($mysqli);
        }
    }
    function createDatabase( String $database ) {

        require(ROOT_PATH . 'conf/db_conf.php');

        $mysqli = new mysqli($dbConf->dbUrl, $dbConf->dbUser, $dbConf->dbPwd, $dbConf->dbName);

        if ($mysqli->connect_errno) {
            printf("Échec de la connexion : %s" . PHP_EOL, $mysqli->connect_error);
            exit();
        }

        if(!$mysqli->query("CREATE DATABASE $database")) {
            onQueryError($mysqli);
        }else {
            echo 'Success';
        }
    }
    function createTable( String $db = '', String $table, $cols ) {
        
        require(ROOT_PATH . 'conf/db_conf.php');

        if($db === '') {
            $db = $dbConf->dbName;
        }

        $mysqli = new mysqli($dbConf->dbUrl, $dbConf->dbUser, $dbConf->dbPwd, $db);
        
        if ($mysqli->connect_errno) {
            printf("Échec de la connexion : %s" . PHP_EOL, $mysqli->connect_error);
            exit();
        }

        $sqlReq = '';

        if(is_array($cols)) {
            foreach( $cols as $key => $value ) {
                $sqlReq .= $value . ', ';
            }
            $sqlReq = substr($sqlReq, 0, strlen($sqlReq) - 2);
        }elseif(is_string($cols)) {
            $sqlReq = $cols;
        }else {
            echo "invalid sql request given";
        }

        if(!$mysqli->query("CREATE TABLE $table ($sqlReq)")) {
            onQueryError($mysqli);
        }else {
            echo 'Success';
        }
    }

//    print_r(makeInsertQuery('user_database', ['username', 'useremail'], ['blabla', 'machin']));

//    makeDeleteQuery('* FROM user_database');
//    createDatabase( 'truc' );
// $tableModel = [
//     'id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY',
//     'firstname VARCHAR(30) NOT NULL',
//     'lastname VARCHAR(30) NOT NULL',
//     'email VARCHAR(50)',
//     'reg_date TIMESTAMP'
// ];
// var_dump(createTable( '', 'test', $tableModel));