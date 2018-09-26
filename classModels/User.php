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
     * Identifiant d'utilisateur
     *
     * @var string
     */
    private $_pseudo;
    /**
     * Mot de passe de l'utilisateur
     *
     * @var string
     */
    private $_password;
    /**
     * Nom de l'utilisateur
     *
     * @var string
     */
    private $_surname;
    /**
     * Prénom de l'utilisateur
     *
     * @var string
     */
    private $_name;
    /**
     * Email de l'utilisateur
     *
     * @var string
     */
    private $_email;
    /**
     * Rôle de l'utilisateur
     *
     * @var integer
     */
    private $_role = 3;
    /**
     * Date d'inscription de l'utilisateur
     *
     * @var string
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
            $key = str_replace('user_', '', $key);
            $key = str_replace('_id', '', $key);
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
     * Get identifiant d'utilisateur
     *
     * @return  string
     */
    public function get_pseudo()
    {
        return $this->_pseudo;
    }
    /**
     * Get mot de passe de l'utilisateur
     *
     * @return  string
     */
    public function get_password()
    {
        return $this->_password;
    }
    /**
     * Get nom de l'utilisateur
     *
     * @return  string
     */
    public function get_surname()
    {
        return $this->_surname;
    }
    /**
     * Get prénom de l'utilisateur
     *
     * @return  string
     */
    public function get_name()
    {
        return $this->_name;
    }
    /**
     * Get email de l'utilisateur
     *
     * @return  string
     */
    public function get_email()
    {
        return $this->_email;
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
    /**
     * Get date inscription de l'utilisateur
     *
     * @return  string
     */
    public function get_signup()
    {
        return $this->_signup;
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
    public function set_pseudo(string $_pseudo)
    {
        $this->_pseudo = $_pseudo;

        return $this;
    }
    /**
     * Set mot de passe de l'utilisateur
     *
     * @param  string  $_password  Mot de passe de l'utilisateur
     *
     * @return  self
     */
    public function set_password(string $_password)
    {
        $this->_password = $_password;

        return $this;
    }
    /**
     * Set nom de l'utilisateur
     *
     * @param  string  $_surname  Nom de l'utilisateur
     *
     * @return  self
     */
    public function set_surname(string $_surname)
    {
        $this->_surname = $_surname;

        return $this;
    }
    /**
     * Set prénom de l'utilisateur
     *
     * @param  string  $_name  Prénom de l'utilisateur
     *
     * @return  self
     */
    public function set_name(string $_name)
    {
        $this->_name = $_name;

        return $this;
    }
    /**
     * Set email de l'utilisateur
     *
     * @param  string  $_email  email de l'utilisateur
     *
     * @return  self
     */
    public function set_email(string $_email)
    {
        $this->_email = $_email;

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
     * Set date d'inscription de l'utilisateur
     *
     * @param  string  $_signup  Date d'inscription de l'utilisateur
     *
     * @return  self
     */ 
    public function set_signup(string $_signup)
    {
        $this->_signup = $_signup;

        return $this;
    }
}