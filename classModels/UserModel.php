<?php

/**
 * / ! \ EN COURS D'ELABORATION
 */

/**
 * CRUD User
 */
class UserModel
{
    private $db;
    private $req;


    public function __construct()
    {
        try {
            $this->db = new PDO('mysql:host=localhot;dbname=espace_administration;charset=utf8mb4', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        } catch (PDOException $e) {
            throw new Exception($e->getMessage(), $e->getCode(), $e);
        }
    }

    public function __destruct()
    {
        if (!empty($this->req)) {
            $this->req->closeCursor();
        }
    }


    /**
     * Creates a user
     *
     * @param User $user
     * @return mixed
     */
    public function create(User $user)
    {
        try {
            if (($this->req = $this->db->prepare('INSERT INTO `user`(`login`, `pwd`, `lastname`, `firstname`, `role`) VALUES (:login, :pwd, :lastname, :firstname, :role)')) !== false) {
                if ($this->req->bindValue('login', $user->get_login())
                    && $this->req->bindValue('pwd', $user->get_pwd())
                    && $this->req->bindValue('lastname', $user->get_lastname())
                    && $this->req->bindValue('firstname', $user->get_firstname())
                    && $this->req->bindValue('role', $user->get_role(), PDO::PARAM_INT)) {
                    if ($this->req->execute()) {
                        $id = $this->db->lastInsertId();
                        return $id;
                    }
                }
            }

            return false;
        } catch (PDOException $e) {
        }
    }

    public function readAll()
    {
        try {
            if (($this->req = $this->db->query('SELECT `id`, `login`, `lastname`, `firstname`, `role` FROM `user`')) !== false) {
                while (($datas = $this->req->fetch(PDO::FETCH_ASSOC)) !== false) {
                    $users[] = new User($datas);
                }
                return $users;
            }

            return false;
        } catch (PDOException $e) {
            throw new Exception($e->getMessage(), $e->getCode(), $e);
        }
    }

    public function read(int $id)
    {
        try {
            if (($this->req = $this->db->prepare('SELECT `id`, `login`, `lastname`, `firstname`, `role` FROM `user` WHERE `id`=?')) !== false) {
                if ($this->req->bindValue(1, $id, PDO::PARAM_INT)) {
                    if ($this->req->execute()) {
                        $datas = $this->req->fetch(PDO::FETCH_ASSOC);
                        return new User($datas);
                    }
                }
            }

            return false;
        } catch (PDOException $e) {
            throw new Exception($e->getMessage(), $e->getCode(), $e);
        }
    }

    public function update(User $user)
    {
        try {
            if (($this->req = $this->db->prepare('UPDATE `user` SET `login`=:login, `lastname`=:lastname, `firstname`=:firstname, `role`=:role WHERE `id`=:id')) !== false) {
                if ($this->req->bindValue('login', $user->get_login())
                    && $this->req->bindValue('lastname', $user->get_lastname())
                    && $this->req->bindValue('firstname', $user->get_firstname())
                    && $this->req->bindValue('role', $user->get_role(), PDO::PARAM_INT)
                    && $this->req->bindValue('id', $user->get_id(), PDO::PARAM_INT)) {
                    if ($this->req->execute()) {
                        $nbRow = $this->req->rowCount();
                        return $nbRow;
                    }
                }
            }

            return false;
        } catch (PDOException $e) {
            throw new Exception($e->getMessage(), $e->getCode(), $e);
        }
    }

    public function delete(int $id)
    {
        try {
            if (($this->req = $this->db->prepare('DELETE FROM `user` WHERE `id`=:id')) !== false) {
                if ($this->req->bindValue('id', $id, PDO::PARAM_INT)) {
                    if ($this->req->execute()) {
                        $nbRow = $this->req->rowCount();
                        return $nbRow;
                    }
                }
            }

            return false;
        } catch (PDOException $e) {
            throw new Exception($e->getMessage(), $e->getCode(), $e);
        }
    }
}