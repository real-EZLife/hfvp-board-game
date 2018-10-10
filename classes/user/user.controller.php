<?php

/**
 * the controller for the user
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

class UserController
{
    private $_model;

    public function show()
    {
        include('classes/user/index.php');
    }

    private function connect()
    {
        try {
            $this->_model = new UserModel('mysql', 'localhost', 'streetfighter', 'root', '');
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), 0, $e);
        }
    }

    /**
     * The user wants to disconnect
     *
     * @return void
     */
    public function logout()
    {
        if (isset($_SESSION['hfvsp'])) {
            unset($_SESSION['hfvsp']);
        }
        header('Location:.');
        exit;
    }

    /**
     * The user wants to connect
     *
     * @return void
     */
    public function signin()
    {
        $this->connect();
        if (($data = $this->_model->signin(htmlentities($_POST['login']))) !== false) {
            $player = new Player($data);

            $_SESSION['hfvsp']['player'] = serialize($player);
            header('Location:.?c=home');
            exit;

        } else {
            $message = 'Mauvais identifiant';
            include('classes/user/index.php');
        }
    }

    /**
     * The user wants to create his account
     *
     * @param array $data
     * @return void
     */
    public function signup(array $data)
    {
        $this->connect();

        if (($id = $this->_model->create(htmlentities($data['email']), htmlentities($data['name']), htmlentities($data['surname']), htmlentities($data['pseudo']))) !== false) {
            $player = new User($data);
            $player->setId($id);

            $_SESSION['hfvsp']['player'] = serialize($player);
            header('Location:.?c=game');
            exit;
        } else {
            $message = 'Problème de connexion avec la base de données. Nous vous présentons nos excuses. Veuillez réessayer ultérieurement';
            include('views/player/index.php');
        }
    }
}