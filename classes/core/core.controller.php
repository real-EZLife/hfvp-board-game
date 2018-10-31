<?php
    abstract class CoreController {
        public function __construct() {
        }
        /**
         * Model Linked to the Controller
         *
         * @var Object mixed
        */
        protected $_model;
        protected $view = null;
        // private $ = null;

        const className = '';

        public function defaultAction() {

            $this->render('default');

        }


        public function render(string $view) {
            $path = ROOT_PATH . DS . 'classes' . DS . static::className . DS . 'views' . DS . $view . '.php';
            if(file_exists($path)) {
                include(ROOT_PATH . DS . 'classes' . DS . static::className . DS . 'views' . DS . $view . '.php');
            }else {
                throw new ErrorException('View: '. $view . ' in render function of ' . ucfirst(static::className) . 'Controller hasn\'t been found');
            }
        }
        

        /**
         * Get mixed
         *
         * @return  Object
         */ 
        public function getModel() {
            return $this->_model;
        }

        /**
         * Set mixed
         *
         * @param  Object  $_model  mixed
         *
         * @return  self
         */ 
        public function setModel($db) {

            $path = ROOT_PATH . DS . 'classes' . DS . static::className . DS . static::className . '.model.php';
            if(file_exists($path)) {
                $model = static::className . 'Model';
                $this->_model = new $model($db);
            }
            return $this;
        }
    }