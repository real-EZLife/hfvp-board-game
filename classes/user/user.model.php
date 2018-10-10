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
 * @author Christophe Roussin<adrsse mail pro>
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
     * @return integer The last inserted ID
     */
    public function create(string $email, string $name, string $surname, string $pseudo, string $password) : int
    {
        try {
            if (($req = $this->getDB()->prepare('INSERT INTO `user` (`user_pseudo`,`user_email`, `user_name`, `user_surname`,`user_password`, ) VALUES (?,?,?,?,?)')) !== false) {
                if ($req->bindValue(1, $pseudo) && $req->bindValue(2, $email) && $req->bindValue(3, $name) && $req->bindValue(4, $surname) && $req->bindValue(5, $password)) {
                    if ($req->execute()) {
                        $res = $this->_pdo->lastInsertId();
                        $req->closeCursor();
                        return $res;
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
     * @return array The data of one or more player
     */
    public function read(int $pseudo = null) : array
    {
        try {
            if (is_null($pseudo)) {
                if (($req = $this->getDB()->query('SELECT * FROM `user` ORDER BY `user_pseudo` ASC')) !== false) {
                    $res = $req->fetchAll(PDO::FETCH_ASSOC);
                    $req->closeCursor();
                    return $res;
                }
            } else {
                if (($req = $this->getDB()->prepare('SELECT * FROM `user` WHERE `user_pseudo`=?')) !== false) {
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
     * @return integer The number of rows affected
     */
    public function update(string $email, string $name, string $surname, string $password, string $pseudo) : int
    {
        try {
            if (($req = $this->getDB()->prepare('UPDATE `user` SET `user_email`=?, `user_name`=?, `user_surname`=?, `user_password`=? WHERE `user_pseudo`=?')) !== false) {
                if ($req->bindValue(1, $email) && $req->bindValue(2, $name) && $req->bindValue(3, $surname) && $req->bindValue(4, $password) && $req->bindValue(5, $pseudo)) {
                    if ($req->execute()) {
                        $res = $req->rowCount();
                        $req->closeCursor();
                        return $res;
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
     * @return integer The number of rows affected
     */
    public function delete(string $pseudo) : int
    {
        try {
            if (($req = $this->getDB()->prepare('DELETE FROM `user` WHERE `user_pseudo`=?')) !== false) {
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
     * @return void
     */
    public function signin(string $login)
    {
        try {
            if (($req = $this->getDB()->prepare('SELECT * FROM `user` WHERE `user_email`=:login OR `user_pseudo`=:login')) !== false) {
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

}