<?php
    class User {
        public function __construct() {

        }
        /**
         * User id
         *
         * @var int
        */
        private $id;
        /**
         * User username
         *
         * @var string
        */
        private $username;
        /**
         * User password
         *
         * @var string
        */
        private $password;
        /**
         * User in game name
         *
         * @var string
        */
        private $ingamename;
        /**
         * User in registration email
         *
         * @var string
        */
        private $email;
        /**
         * User role
         *
         * @var int
        */
        private $role;

        /**
         * Get user id
         *
         * @return  int
         */ 
        public function getId()
        {
                return $this->id;
        }

        /**
         * Set user id
         *
         * @param  int  $id  User id
         *
         * @return  self
         */ 
        public function setId(int $id)
        {
                $this->id = $id;

                return $this;
        }

        /**
         * Get user username
         *
         * @return  string
         */ 
        public function getUsername() : string {
                return $this->username;
        }

        /**
         * Set user username
         *
         * @param  string  $username  User username
         *
         * @return  self
         */ 
        public function setUsername(string $username) {
                $this->username = $username;

                return $this;
        }

        /**
         * Get user password
         *
         * @return  string
         */ 
        public function getPassword() : string {
                return $this->password;
        }

        /**
         * Set user password
         *
         * @param  string  $password  User password
         *
         * @return  self
         */ 
        public function setPassword(string $password) {
                $this->password = $password;

                return $this;
        }

        /**
         * Get user in game name
         *
         * @return  string
         */ 
        public function getIngamename() : string {
                return $this->ingamename;
        }

        /**
         * Set user in game name
         *
         * @param  string  $ingamename  User in game name
         *
         * @return  self
         */ 
        public function setIngamename(string $ingamename) {
                $this->ingamename = $ingamename;

                return $this;
        }

        /**
         * Get user role
         *
         * @return  string
         */ 
        public function getRole() {
                return $this->role;
        }

        /**
         * Set user role
         *
         * @param  string  $role  User role
         *
         * @return  self
         */ 
        public function setRole(string $role) {
                $this->role = $role;

                return $this;
        }

        /**
         * Get user in registration email
         *
         * @return  string
         */ 
        public function getEmail() : string {
                return $this->email;
        }

        /**
         * Set user in registration email
         *
         * @param  string  $email  User in registration email
         *
         * @return  self
         */ 
        public function setEmail(string $email) {
                $this->email = $email;

                return $this;
        }
        /**
         * hydrate object filling User instance props
         *
         * @param array $data
         * @return self
         */
        public function hydrate(array $data) : self {
                foreach( $data as $key => $value) {
                                $methodName = 'set' . ucfirst($key);
                                if(method_exists($this->$methodName)) {
                                        $this->$methodName($value);
                                }
                }
                return $this;
        }
    }