<?php

/**
 * / ! \ EN COURS D'ELABORATION
 */

/**
 * CRUD User
 */

require('D:\www\HFVSP-GIT\hfvp-board-game\conf\db_conf.php');

class UserModel
{
    private $db;
    private $req;


    public function __construct(PDO $db)
    {
        try {
            $this->db = $db;
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
            if (($this->req = $this->db->prepare(
                'INSERT INTO `user`(`user_pseudo`, `user_password`, `user_name`, `user_surname`, `user_email`) 
                VALUES (:user_pseudo, :user_password, :user_name, :user_surname, :user_email)')) !== false) {
                if ($this->req->bindValue('user_pseudo', $user->get_login())
                    && $this->req->bindValue('user_password', $user->get_pwd())
                    && $this->req->bindValue('user_name', $user->get_name())
                    && $this->req->bindValue('user_surname', $user->get_lastname())
                    && $this->req->bindValue('user_email', $user->get_email())) {
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
            if (($this->req = $this->db->query('SELECT * FROM `user`')) !== false) {
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

    public function read(string $login)
    {
        try {
            if (($this->req = $this->db->prepare('SELECT * FROM `user` WHERE `user_pseudo`=?')) !== false) {
                if ($this->req->bindValue(1, (string) $login, PDO::PARAM_STR)) {
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
            if (($this->req = $this->db->prepare('UPDATE `user` SET `user_email`=:user_email, `user_name`=:user_name, `user_surname`=:user_surname, `role_id`=:role_id WHERE `user_pseudo`=:user_pseudo')) !== false) {
                if ($this->req->bindValue('user_email', $user->get_email())
                    && $this->req->bindValue('user_name', $user->get_lastname())
                    && $this->req->bindValue('user_surname', $user->get_firstname())
                    && $this->req->bindValue('role_id', $user->get_role(), PDO::PARAM_INT)
                    && $this->req->bindValue('user_pseudo', $user->get_id(), PDO::PARAM_INT)) {
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
require_once('user.php');
$usr = new User([
    'login' => 'Tommy34',
    'pwd' => '12345',
    'name' => 'Chris',
    'surname' => 'Rou',
    'email' => 'chrisRou@gmail.com',
]);
$usrm = new UserModel($epic_db);
//`user_pseudo`, `user_password`, `user_name`, `user_surname`, `user_email`) 
var_dump($usrm->read('epicdesign'));

