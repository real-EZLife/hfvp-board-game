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
 * @author Christophe Roussin<adresse mail pro>
 */

class UserController extends CoreController {

    const className = 'user';

    public function defaultAction() {
        $this->loginAction();
    }

    public function loginAction() {
        if(!isset($_SESSION['hfvp']['user'], $_SESSION['hfvp']['user']['pseudo'])) {
            $this->render('login');
        }else {
            header('Location: ../');
        }

    }
    public function registerAction() {
        if(!isset($_SESSION['hfvp']['user'], $_SESSION['hfvp']['user']['pseudo'])) {
            $this->render('register');
        }else {
            header('Location: ../');
        }

    }
    public function signupAction(array $post) {
        if(empty($post)) {
            header('Location: .');
        }
        if(!empty($post)) {
            if(isset($post['pseudo'], $post['email'], $post['name'], $post['surname'], $post['password'])) {
                if(!empty($post['pseudo']) && !empty($post['email']) && !empty($post['name']) && !empty($post['surname']) && !empty($post['password'])) {
                    $ctrl = true;
                    $nameregexp = "/^[A-Za-z -]{1,50}$/";
                    if(ctype_alnum($post['pseudo'])) {
                        if(filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
                            if(preg_match($nameregexp, $post['name']) == 1) {
                                if(preg_match($nameregexp, $post['surname']) == 1) {

                                    $post['password'] = User::passwordHash($post['password']);

                                    if($this->getModel()->read($post['pseudo']) == false) {
                                        if(($req = $this->getModel()->create( $post['email'], $post['name'], $post['surname'], strtolower($post['pseudo']), $post['password']) != false )) {
                                            header('Location: .?msg=login');
                                        }
                                    }else {
                                        header('Location: .?a=register&err=taken');
                                    }
                                }else {
                                    $ctrl = false;
                                    $err = 'surname';
                                }
                            }else {
                                $ctrl = false;
                                $err = 'name';
                            }
                        }else {
                            $ctrl = false;
                            $err = 'email';
                        }
                    }else {
                        $ctrl = false;
                        $err = 'pseudo';
                    }
                    if(!$ctrl) {
                        header('Location: .?a=register&err=invalid&fields='.$err);
                    }
                }else {
                    header('Location: .?a=register&err=required');
                }
            }else {
                header('Location: .?a=register&err=required');
            }
        }
    }
    public function signinAction(array $post) {
        if(empty($post)) {
            header('Location: .');
        }
        if(isset($post['pseudo']) && !empty($post['pseudo']) ) {
            if(isset($post['password']) && !empty($post['password']) ) {
                if(($data = $this->getModel()->read(htmlentities(strtolower($post['pseudo'])))) != false) {
                    if(User::passwordVerify($post['password'], $data['user_password'])) {
                        $user = new User($data);
                        $user->setPassword('erased');
                        $_SESSION['hfvp']['user'] = $user->getUserInfo();
                        if($user->getPower() >= 20) {
                            header('Location: ../?login=ok');
                        }else {
                            header('Location: ../admin?login=ok');
                        }
                    }else {
                        header('Location: .?err=auth');
                    }
                }else {
                    header('Location: .?err=auth');
                }
            }else {
                header('Location: .?err=required');
            }
        }else {
            header('Location: .?err=required');
        }
    }
    /**
     * The user wants to disconnect
     *
     * @return void
     */
    public function logoutAction() {
        if (isset($_SESSION['hfvp']['user'])) {
            unset($_SESSION['hfvp']['user']);
        }
        header('Location: ../');
        exit;
    }
}