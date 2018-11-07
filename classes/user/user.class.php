<?php

/**
 * Manages the data for the user
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
class User extends Core {
    /* ----------------------------------------------------
                        ATTRIBUTS
    ---------------------------------------------------- */

    /**
     * Identifiant d'utilisateur
     * @var string
     */
    private $pseudo;
    /**
     * Mot de passe de l'utilisateur
     * @var string
     */
    private $password;
    /**
     * Nom de l'utilisateur
     * @var string
     */
    private $surname;
    /**
     * Prénom de l'utilisateur
     * @var string
     */
    private $name;
    /**
     * Email de l'utilisateur
     * @var string
     */
    private $email;
    /**
     * Rôle de l'utilisateur
     * @var integer
     */
    private $role = 3;
    /**
     * Libelle du role de l'utilisateur
     * @var string
     */
    private $rolename;
    /**
     * Date d'inscription de l'utilisateur
     * @var string
     */
    private $signup;
    /**
     * Pouvoir de l'utilisateur
     * @var string
     */
    private $power;

    /* ----------------------------------------------------
                        CONSTANTS
    ---------------------------------------------------- */

    const PARAM_CRYPT = PASSWORD_BCRYPT;

     /* ----------------------------------------------------
                        CONSTRUCTEUR
    ---------------------------------------------------- */

    /**
     * Constructeur
     * @param array $data
     */
    // public function __construct(array $data) {
    //     $this->hydrate($data);
    // }

     /* ----------------------------------------------------
                        HYDRATATION
    ---------------------------------------------------- */

    /**
     * Hydratation
     *
     * @param array $data
     * @return void
     */
    public function hydrate(array $data)
    {
        foreach ($data as $key => $value) {
            $key = str_replace('user_', '', $key);
            $methodName = 'set' . $key;
            if (method_exists($this, ucfirst($methodName))) {
                $this->$methodName($value);
            }
        }
    }

    /* ----------------------------------------------------
                        GETTERS
    ---------------------------------------------------- */

    /**
     * Get identifiant d'utilisateur
     *
     * @return  string
     */
    public function getPseudo()
    {
        return $this->pseudo;
    }
    /**
     * Get mot de passe de l'utilisateur
     *
     * @return  string
     */
    public function getPassword()
    {
        return $this->password;
    }
    /**
     * Get nom de l'utilisateur
     *
     * @return  string
     */
    public function getSurname()
    {
        return $this->surname;
    }
    /**
     * Get prénom de l'utilisateur
     *
     * @return  string
     */
    public function getName()
    {
        return $this->name;
    }
    /**
     * Get email de l'utilisateur
     *
     * @return  string
     */
    public function getEmail()
    {
        return $this->email;
    }
    /**
     * Get rôle de l'utilisateur
     *
     * @return  integer
     */
    public function getRole()
    {
        return $this->role;
    }
    /**
     * Get date inscription de l'utilisateur
     *
     * @return  string
     */
    public function getSignup()
    {
        return $this->signup;
    }

    /**
     * Get pouvoir de l'utilisateur
     *
     * @return  string
     */ 
    public function getPower() {
        return $this->power;
    }

    /**
     * Get libelle du role de l'utilisateur
     *
     * @return  string
     */ 
    public function getRolename() {
        return $this->rolename;
    }
    /* ----------------------------------------------------
                        SETTERS
    ---------------------------------------------------- */

    /**
     * Set identifiant d'utilisateur
     *
     * @param  string  $_pseudo  Nom d'utilisateur
     *
     * @return  self
     */
    public function setPseudo(string $pseudo)
    {
        $this->pseudo = $pseudo;

        return $this;
    }
    /**
     * Set mot de passe de l'utilisateur
     *
     * @param  string  $_password  Mot de passe de l'utilisateur
     *
     * @return  self
     */
    public function setPassword(string $password)
    {
        $this->password = $password;

        return $this;
    }
    /**
     * Set nom de l'utilisateur
     *
     * @param  string  $_surname  Nom de l'utilisateur
     *
     * @return  self
     */
    public function setSurname(string $surname)
    {
        $this->surname = $surname;

        return $this;
    }
    /**
     * Set prénom de l'utilisateur
     *
     * @param  string  $_name  Prénom de l'utilisateur
     *
     * @return  self
     */
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }
    /**
     * Set email de l'utilisateur
     *
     * @param  string  $_email  email de l'utilisateur
     *
     * @return  self
     */
    public function setEmail(string $email)
    {
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            $this->email = strtolower($email);
        }

        return $this;
    }
    /**
     * Set rôle de l'utilisateur
     *
     * @param  integer  $_role  Rôle de l'utilisateur
     *
     * @return  self
     */
    public function setRole(int $role) {
        if (ctype_digit($role)) {
            $this->role = $role;
        }

        return $this;
    }
    /**
     * Set date d'inscription de l'utilisateur
     *
     * @param  string  $_signup  Date d'inscription de l'utilisateur
     *
     * @return  self
     */ 
    public function setSignup(string $signup)
    {
        $this->signup = $signup;

        return $this;
    }

    /**
     * Set pouvoir de l'utilisateur
     *
     * @param  string  $power  Pouvoir de l'utilisateur
     *
     * @return  self
     */ 
    public function setPower(string $power) {
        $this->power = $power;

        return $this;
    }

    /**
     * Set libelle du role de l'utilisateur
     *
     * @param  string  $rolename  Libelle du role de l'utilisateur
     *
     * @return  self
     */ 
    public function setRolename(string $rolename) {
        $this->rolename = $rolename;

        return $this;
    }
     /* ----------------------------------------------------
                        STATIC METHODS
    ---------------------------------------------------- */

    /**
     * betterCost - Determine the better cost for hashing passwords
     *
     * @param [type] $crypt
     * @param float $timeTarget
     * @return
     */
    public static function betterCost( $crypt = self::PARAM_CRYPT, $timeTarget = 0.05 ) {
       $cost = 8;
       
       do {
           $cost++;
           $start = microtime(TRUE);
           password_hash('test', $crypt, array('cost'=>$cost));
           $end = microtime(true);
       } while( ($end - $start)<=$timeTarget);

       return $cost;
    }

    /**
     * passwordHash - Generates a hashed password
     * @param string $password
     * @param array $hashOptions [optional]
     * @return
     */
    public static function passwordHash( $password, $hashOptions = array('cost'=>8, 'crypt'=>self::PARAM_CRYPT) ) {
        $options = array('cost'=>$hashOptions['cost']);
        return password_hash($password, $hashOptions['crypt'], $options);
    }

    /**
     * passwordVerify - Checkes a hashed password
     *
     * @param string $entered
     * @param string $stored
     * @return
     */
    public static function passwordVerify($entered, $stored) {
        return password_verify($entered, $stored);
    }
    /**
     * getUserInfo
     * 
     * return all the User instance properties as an associative array except password
     * 
     * @return array
    */
    public function getUserInfo() : array {
        $vars = get_object_vars($this);
        if(isset($vars['password']))
            unset($vars['password']);
        return $vars;            
    }


}