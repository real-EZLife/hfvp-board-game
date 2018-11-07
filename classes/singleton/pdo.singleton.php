<?php
class PDOSingleton {
    const dbUrl = '127.0.0.1';
    const dbName = 'objectif3w_epicassembly';
    const dbUser = 'objectif3w_epicassembly';
    const dbPwd = '-EK,[YK4IQc*';
    const dbCharset = 'utf8mb4';
    
    private $PDOInstance = null;
    private static $instance = null;

    /**
     * Constructeur
     *
     * @param void
     * @return void
     * @see PDO::__construct()
     * @access private
     */
    private function __construct() {
        $this->PDOInstance = new PDO('mysql:dbname='.self::dbName . ';host='.self::dbUrl . ';charset='.self::dbCharset, self::dbUser, self::dbPwd, array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
    }
    
    /**
        * Crée et retourne l'objet SPDO
        *
        * @access public
        * @static
        * @param void
        * @return PDOSingleton $instance
        */
    public static function getInstance() {  
        if(is_null(self::$instance)) {
            self::$instance = new PDOSingleton();
        }
        return self::$instance;
    }
}