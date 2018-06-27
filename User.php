<?php
    class User {
        function User( String $username = '', String $displayedUserName, String $userEmail, Int $userID ) {
            $this->username = $username;
            $this->displayedUserName = $displayedUserName;
            $this->userEmail = $userEmail;
            $this->userID = $userID;

        }
        private $username;
        private $displayedUserName;
        private $userEmail;
        private $userID;


        public function getUsername() : String {
            return $this->username;
        }
        public function getDisplayedUserName() : String {
            return $this->displayedUserName;
        }
        public function getUserEmail() : String {
            return $this->userEmail;
        }
        public function getUserID() : String {
            return $this->userID;
        }
    }



?>