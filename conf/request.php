<?php
    class SRequest {
        /**
         * client request $_GET
         *
         * @var array
        */
        private $get;
        /**
         * client request $_POST
         *
         * @var array
        */
        private $post;
        
        /**
         * 
         * ------------------
         * 
         * GETTERS
         * 
         * ------------------
         * 
        */
        /**
         * Get client request $_GET
         *
         * @return  array
         */ 
        public function getGet() {
            return $this->get;
        }
        /**
         * Get client request $_POST
         *
         * @return  array
         */ 
        public function getPost() {
            return $this->post;
        }
        /**
         * get all object props
         *
         * @return array
        */
        public function getAll() : array {
            return get_object_vars($this);
        }
        /**
         * 
         * ------------------
         * 
         * SETTERS
         * 
         * ------------------
         * 
        */
        /**
         * Set client request $_GET
         *
         * @param  array  $get  client request $_GET
         *
         * @return  self
         */ 
        public function setGet(array $get) {
            $this->get = $get;

            return $this;
        }
        /**
         * Set client request $_POST
         *
         * @param  array  $post  client request $_POST
         *
         * @return  self
        */ 
        public function setPost(array $post) {
            $this->post = $post;

            return $this;
        }

        /**
         * 
         * ------------------
         * 
         * Constructeur
         * 
         * ------------------
         * 
        */
        public function __construct() {

            $this->setGet($_GET);
            $this->setPost($_POST);

        }

    }