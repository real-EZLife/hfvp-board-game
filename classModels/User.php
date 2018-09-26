<?php
/**
 * / ! \ A TESTER
 */
class User
{
    /* ----------------------------------------------------
                        ATTRIBUTS
    ---------------------------------------------------- */
    /**
     * Identifiant de l'utilisateur
     *
     * @var integer
     */
    private $_id;
    /**
     * Nom d'utilisateur
     *
     * @var string
     */
    private $_login;
    /**
     * Mot de passe de l'utilisateur
     *
     * @var string
     */
    private $_pwd;
    /**
     * Nom de l'utilisateur
     *
     * @var string
     */
    private $_lastname;
    /**
     * Prénom de l'utilisateur
     *
     * @var string
     */
    private $_firstname;
    /**
     * Rôle de l'utilisateur
     *
     * @var integer
     */
    private $_role;

    /**
     * Date d'inscription de l'utilisateur
     *
     * @var date
     */
    private $_signup;

    /* ----------------------------------------------------
                        CONSTRUCTEUR
    ---------------------------------------------------- */

    /**
     * Constructeur
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->hydrate($data);
    }

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
            $methodName = 'set_' . $key;
            if (method_exists($this, $methodName)) {
                $this->$methodName($value);
            }
        }
    }

    /* ----------------------------------------------------
                        GETTERS
    ---------------------------------------------------- */
    /**
     * Get identifiant de l'utilisateur
     *
     * @return  integer
     */
    public function get_id()
    {
        return $this->_id;
    }

    /**
     * Get nom d'utilisateur
     *
     * @return  string
     */
    public function get_login()
    {
        return $this->_login;
    }

    /**
     * Get mot de passe de l'utilisateur
     *
     * @return  string
     */
    public function get_pwd()
    {
        return $this->_pwd;
    }

    /**
     * Get nom de l'utilisateur
     *
     * @return  string
     */
    public function get_lastname()
    {
        return $this->_lastname;
    }

    /**
     * Get prénom de l'utilisateur
     *
     * @return  string
     */
    public function get_firstname()
    {
        return $this->_firstname;
    }

    /**
     * Get rôle de l'utilisateur
     *
     * @return  integer
     */
    public function get_role()
    {
        return $this->_role;
    }

    /* ----------------------------------------------------
                        SETTERS
    ---------------------------------------------------- */

    /**
     * Set identifiant de l'utilisateur
     *
     * @param  integer  $_id  Identifiant de l'utilisateur
     *
     * @return  self
     */
    public function set_id($_id)
    {
        $this->_id = $_id;

        return $this;
    }

    /**
     * Set nom d'utilisateur
     *
     * @param  string  $_login  Nom d'utilisateur
     *
     * @return  self
     */
    public function set_login(string $_login)
    {
        $this->_login = $_login;

        return $this;
    }

    /**
     * Set mot de passe de l'utilisateur
     *
     * @param  string  $_pwd  Mot de passe de l'utilisateur
     *
     * @return  self
     */
    public function set_pwd(string $_pwd)
    {
        $this->_pwd = $_pwd;

        return $this;
    }

    /**
     * Set nom de l'utilisateur
     *
     * @param  string  $_lastname  Nom de l'utilisateur
     *
     * @return  self
     */
    public function set_lastname(string $_lastname)
    {
        $this->_lastname = $_lastname;

        return $this;
    }

    /**
     * Set prénom de l'utilisateur
     *
     * @param  string  $_firstname  Prénom de l'utilisateur
     *
     * @return  self
     */
    public function set_firstname(string $_firstname)
    {
        $this->_firstname = $_firstname;

        return $this;
    }

    /**
     * Set rôle de l'utilisateur
     *
     * @param  integer  $_role  Rôle de l'utilisateur
     *
     * @return  self
     */
    public function set_role($_role)
    {
        if (ctype_digit($_role)) {
            $this->_role = $_role;
        }

        return $this;
    }

    /**
     * Set date inscription de l'utilisateur
     *
     * @param  date  $_signup  de l'utilisateur
     *
     * @return  self
     */
    public function set_signup(string $_signup)
    {
        $this->_signup = $_signup;

        return $this;
    }

}