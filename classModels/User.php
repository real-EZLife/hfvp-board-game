<?php
    class User {
        public function __construct( String $username, String $userDisplayedName, 
                        String $userEmail, String $userPassword, Int $userID, String $userRole = 'guest' ) {
            $this->username = $username;
            $this->userDisplayedName = $userDisplayedName;
            $this->userEmail = $userEmail;
            $this->userPassword = $userPassword;
            $this->userID = $userID;
            $this->userRole = $userRole;

        }
        /**
         * @var string $username
        */
        private $username;
        /**
         * @var string $userDiplayedName
        */
        private $userDisplayedName;
        /**
         * @var string $userEmail
        */
        private $userEmail;
        /**
         * @var string $userPassword
        */
        private $userPassword;
        /**
         * @var int $userID
        */
        private $userID;
        /**
         * @var int $userRole default: guest
        */
        private $userRole;

        //User Getters
        public function __get($property) {
            if (property_exists($this, $property)) {
                return $this->$property;
            }
        }
        /**
         * getUsername
         * 
         * return User->username;
         * 
         * @return string
        */
        public function getUsername() : String {
            return $this->username;
        }
        /**
         * getDisplayedUserName
         * 
         * return User->userDisplayedName;
         * 
         * @return string
        */
        public function getDisplayedUserName() : String {
            return $this->userDisplayedName;
        }
        /**
         * getUserEmail
         * 
         * return User->userEmail;
         * 
         * @return string
        */
        public function getUserEmail() : String {
            return $this->userEmail;
        }
        /**
         * getUserPassword
         * 
         * return User->userPassword;
         * 
         * @return string
        */
        public function getUserPassword() : String {
            return $this->userPassword;
        }
        /**
         * getUserID
         * 
         * return User->userID;
         * 
         * @return int
        */
        public function getUserID() : Int {
            return $this->userID;
        }
        /**
         * getUserRole
         * 
         * return User->userRole;
         * 
         * @return string
        */
        public function getUserRole() : String {
            return $this->userRole;
        }
        //User Setters
        public function __set($property, $value) {
            if (property_exists($this, $property)) {
                $this->$property = $value;
            }
            return $this;
        }
        /**
         * setUsername 
         * 
         * User->username = $value
         * 
         * @param string
         * @return void
        */
        public function setUsername( String $value ) : void {
            $this->username = $value;
        }
        /**
         * setDisplayedUserName 
         * 
         * User->displayedUserName = $value
         * 
         * @param string
         * @return void
        */
        public function setDisplayedUserName( String $value ) : void {
            $this->displayedUserName = $value;
        }
        /**
         * setUserEmail 
         * 
         * User->userEmail = $value
         * 
         * @param string
         * @return void
        */
        public function setUserEmail( String $value ) : void {
            $this->userEmail = $value;
        }
        /**
         * setUserPassword 
         * 
         * User->userPassword = $value
         * 
         * @param int
         * @return void
        */
        public function setUserPassword( String $value ) : void {
            $this->userPassword = $value;            
        }
        /**
         * setUserID 
         * 
         * User->userID = $value
         * 
         * @param int
         * @return void
        */
        public function setUserID( Int $value ) : void {
            $this->userID = $value;
        }
        /**
         * setUserRole 
         * 
         * $this->userRole = $value
         * 
         * @param int
         * @return void
        */
        public function setUserRole( String $value ) : void {
            $this->userRole = $value;
        }
        /**
         * getUserObj 
         * 
         * return an Object $user that contains all info about the User instance (except the pwd)
         * 
         * @return object $user
        */
        public function getUserObj() : Object {

            $user = new stdClass();
            $user->username = $this->getUsername();
            $user->displayedUserName = $this->getDisplayedUserName();
            $user->userEmail = $this->getUserEmail();
            $user->userID = $this->getUserID();
            $user->role = $this->getUserRole();

            // Next line is really bad practice and shouldn't be used in production
            // Used as a testing purpose only
            // $user->userPassword = $this->getUserPassword();
            
            return $user;
        }
    }