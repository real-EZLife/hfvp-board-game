<?php
    class User {
        function User(  String $username, String $userDisplayedName, 
                        String $userEmail, String $userPassword, Int $userID, String $userRole = 'invite' ) {
            $this->username = $username;
            $this->userDisplayedName = $userDisplayedName;
            $this->userEmail = $userEmail;
            $this->userPassword = $userPassword;
            $this->userID = $userID;
            $this->userRole = $userRole;

        }
        private $username;
        private $userDisplayedName;
        private $userEmail;
        private $userPassword;
        private $userID;
        private $userRole;


        public function getUsername() : String {
            return $this->username;
        }
        public function getDisplayedUserName() : String {
            return $this->userDisplayedName;
        }
        public function getUserEmail() : String {
            return $this->userEmail;
        }
        public function getUserPassword() : String {
            return $this->userPassword;
        }
        public function getUserID() : String {
            return $this->userID;
        }
        public function getUserRole() : String {
            return $this->userRole;
        }
        public function setUsername( String $value ) : void {
            $this->username = $value;
        }
        public function setDisplayedUserName( String $value ) : void {
            $this->displayedUserName = $value;
        }
        public function setUserEmail( String $value ) : void {
            $this->userEmail = $value;
        }
        public function setUserPassword( String $value ) : void {
            $this->userPassword = $value;            
        }
        public function setUserID( String $value ) : void {
            $this->userID = $value;
        }
        public function setUserRole( String $value ) : void {
            $this->userRole = $value;
        }
        public function getUserObj() {
            $user = new stdClass();
            $user->username = $this->getUsername();
            $user->displayedUserName = $this->getDisplayedUserName();
            $user->userEmail = $this->getUserEmail();
            $user->userPassword = $this->getUserPassword();
            $user->userID = $this->getUserID();
            $user->role = $this->getUserRole();
            
            
            return $user;
        }
    }



?>