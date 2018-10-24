<?php

/**
 * Manages the data for the user, according to the CRUD model
 * 
 * @license MIT // https://fr.wikipedia.org/wiki/Licence_MIT
 * 
 * @since 1.0.0
 * 
 * @category PHP
 * @package heroic fantaisy vs politic
 * @subpackage user
 * @copyright 2018 EZlife - all rights reserved
 * @author Christophe Roussin<adresse mail pro>
 */

class UserModel {

    public function __construct(PDO $db) {
        $this->setDB($db);
    }

    private $db;

    /**
     * Get db de la connection
     *
     * @return string
     */
    private function getDb() {
        return $this->db;
    }

    /**
     * Set db de la connection
     */
    private function setDb(PDO $db) {
        $this->db = $db;
        return $this;
    }

    /**
     * Creates a user in the database
     *
     * @param string $pseudo
     * @param string $email
     * @param string $name
     * @param string $surname
     * @param string $password
     * 
     * @throws Exception if an error occured
     * 
     * @return bool The last inserted is true or false
     */
    public function create(string $email, string $name, string $surname, string $pseudo, string $password) : bool
    {
        try {
            if (($req = $this->getDb()->prepare('INSERT INTO `user` (`user_pseudo`,`user_email`, `user_name`, `user_surname`,`user_password`) VALUES (?,?,?,?,?)')) !== false) 
            {
                if ($req->bindValue(1, $pseudo, PDO::PARAM_STR) &&
                    $req->bindValue(2, $email, PDO::PARAM_STR) &&
                    $req->bindValue(3, $name, PDO::PARAM_STR) &&
                    $req->bindValue(4, $surname, PDO::PARAM_STR) &&
                    $req->bindValue(5, $password, PDO::PARAM_STR))
                {
                    if ($req->execute()) {
                        $req->closeCursor();
                        return true;
                    }
                }
            }

            return false;
        } catch (PDOException $e) {
            throw new Exception('Can not insert into the database', 12, $e);
        }
    }

    /**
     * Selects one or more user
     *
     * @param integer $pseudo (optional)
     * 
     * @throws Exception if an error occured
     * 
     * @return mixed (array|bool)
     */
    public function read(string $pseudo = null)
    {
        try {
            if (is_null($pseudo)) {
                if (($req = $this->getDb()->query('SELECT * FROM `user` ORDER BY `user_pseudo` ASC')) !== false) {
                    $res = $req->fetchAll(PDO::FETCH_ASSOC);
                    $req->closeCursor();
                    return $res;
                }
            } else {
                if (($req = $this->getDb()->prepare('SELECT * FROM `user` WHERE `user_pseudo`=?')) !== false) {
                    if ($req->bindValue(1, $pseudo)) {
                        if ($req->execute()) {
                            $res = $req->fetchAll(PDO::FETCH_ASSOC);
                            $req->closeCursor();
                            return $res;
                        }
                    }
                }
            }

            return false;
        } catch (PDOException $e) {
            throw new Exception('Can not select in the database', 13, $e);
        }
    }

    /**
     * Updates a user
     *
     * @param string $pseudo
     * @param string $email
     * @param string $name
     * @param string $surname
     * @param string $password (passera par une fonction de cryptage avant)
     * 
     * @throws Exception if an error occured
     * 
     * @return mixed (array|bool)
     */
    public function update(string $pseudo, string $email = '', string $name ='', string $surname = '', string $password = '')
    {
        try {
            if (($req = $this->getDb()->prepare('UPDATE `user` SET `user_email`=?, `user_name`=?, `user_surname`=?, `user_password`=? WHERE `user_pseudo`=?')) !== false) {

                if ($req->bindValue(1, $email) && 
                    $req->bindValue(2, $name) && 
                    $req->bindValue(3, $surname) && 
                    $req->bindValue(4, $password) && 
                    $req->bindValue(5, $pseudo)) 
                {
                    if ($req->execute()) {
                        var_dump($req);
                        // $res = $req->rowCount();
                        $req->closeCursor();
                        return true;
                        
                    }

                }
            }
            return false;
        } catch (PDOException $e) {
            throw new Exception('Can not update in the database', 14, $e);
        }
    }

    /**
     * Delete a user
     * 
     * @param string $pseudo
     * 
     * @throws Exception if an error occured
     * 
     * @return mixed (array|bool)
     */
    public function delete(string $pseudo)
    {
        try {
            if (($req = $this->getDb()->prepare('DELETE FROM `user` WHERE `user_pseudo`=?')) !== false) {
                if ($req->bindValue(1, $pseudo)) {
                    if ($req->execute()) {
                        $res = $req->rowCount();
                        $req->closeCursor();
                        return $res;
                    }
                }
            }

            return false;
        } catch (PDOException $e) {
            throw new Exception('Can not delete in the database', 15, $e);
        }
    }

    /**
     * login the user
     *
     * @param string $login
     * @return mixed (array|bool)
     */
    public function signin(string $login)
    {
        try {
            if (($req = $this->getDb()->prepare('SELECT * FROM `user` WHERE `user_email`=:login OR `user_pseudo`=:login')) !== false) {
                if ($req->bindValue('login', $login)) {
                    if ($req->execute()) {
                        $res = $req->fetch(PDO::FETCH_ASSOC);
                        $req->closeCursor();
                        return $res;
                    }
                }
            }

            return false;
        } catch (PDOException $e) {
            throw new Exception('Can not read the database', 16, $e);
        }
    }

    /**
     * Select all rank in database
     *
     * @param string $pseudo from user
     * 
     * @throws Exception if an error occured
     * 
     * @return mixed (array|bool)
     */
    public function autorisationRank(string $pseudo)
    {
        try {
            if (($req = $this->getDb()->prepare('SELECT `user`.*, `role`.* FROM `user` JOIN `role` ON `user`.`role_id`=`role`.`role_id` WHERE `user_pseudo`=?')) !== false) {
                if ($req->bindValue(1, $pseudo)) {
                    if ($req->execute()) {
                        $res = $req->fetch(PDO::FETCH_ASSOC);
                        $req->closeCursor();
                        return $res;
                    }
                }
            }
            return false;
        } catch (PDOException $e) {
            throw new Exception('Can not read the database', 16, $e);
        }
    }

}

/**
 * TEST DES METHODES
 * mysql -h 127.0.0.1 -u objectif3w_epicassembly -p 
    -EK,[YK4IQc* 
    use objectif3w_epicassembly
 */

// require_once('D:\www\HFVSP-GIT\hfvp-board-game\conf\db_conf.php');
// $test = new UserModel($epic_db);

// $t = $test->autorisationRank('testPseudo'); /* TEST OK */
// $t = $test->read('testPseudo'); /* TEST OK pour montrer un user de la bdd*/
// $t = $test->read(); /* TEST OK pour montrer tous les user de la bdd*/
// $t = $test->signin('testPseudo4'); /* TEST OK */
// $t = $test->create('test.test@test.com','test','TEST','testPseudo','1234'); /* TEST OK */
// $t = $test->delete('testPseudo'); /* TEST OK */
// $t = $test->update('testPseudo', 'chris.rou@sss.dd','chris','rou','1234') ; /* TEST OK */

// var_dump($t);

// var_dump(func_get_args());
