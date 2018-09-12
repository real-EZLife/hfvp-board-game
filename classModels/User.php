<?php

    /**
     * class User 
     * @param string $username
     * @param string $userDisplayedName
     * @param string $userEmail
     * @param string $userPassword
     * @param string $userID
     * @param string $userRole default 'invite
     * 
     * 
     * @return object User
     */
    class User {
        function User(  String $username, String $userDisplayedName, 
                        String $userEmail, String $userPassword, Int $userID, String $userRole = 'guest' ) {
            $this->username = $username;
            $this->userDisplayedName = $userDisplayedName;
            $this->userEmail = $userEmail;
            $this->userPassword = $userPassword;
            $this->userID = $userID;
            $this->userRole = $userRole;

        }
        /**
         * $username STRING
         * $userDisplayedName STRING
         * $userEmail STRING
         * $userPassword STRING
         * $userID STRING
         * $userRole STRING
        */
        private $username;
        private $userDisplayedName;
        private $userEmail;
        private $userPassword;
        private $userID;
        private $userRole;

        //User Getters
        /**
         * getUsername
         * 
         * return User->username;
         * 
         * @return STRING
        */
        public function getUsername() : String {
            return $this->username;
        }
        /**
         * getDisplayedUserName
         * 
         * return User->userDisplayedName;
         * 
         * @return STRING
        */
        public function getDisplayedUserName() : String {
            return $this->userDisplayedName;
        }
        /**
         * getUserEmail
         * 
         * return User->userEmail;
         * 
         * @return STRING
        */
        public function getUserEmail() : String {
            return $this->userEmail;
        }
        /**
         * getUserPassword
         * 
         * return User->userPassword;
         * 
         * @return STRING
        */
        public function getUserPassword() : String {
            return $this->userPassword;
        }
        /**
         * getUserID
         * 
         * return User->userID;
         * 
         * @return INT
        */
        public function getUserID() : INT {
            return $this->userID;
        }
        /**
         * getUserRole
         * 
         * return User->userRole;
         * 
         * @return STRING
        */
        public function getUserRole() : String {
            return $this->userRole;
        }
        //User Setters
        /**
         * setUsername 
         * 
         * User->username = $value
         * 
         * @param STRING
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
         * @param STRING
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
         * @param STRING
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
         * @param INT
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
         * @param INT
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
         * @param INT
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
        public function getUserObj() : object {

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