<?php
    abstract class CoreController {

        private $view = null;
        // private $ = null;

        const className = '';

        public function defaultAction() {

            

        }


        public function render(string $view) {
            $path = ROOT_PATH . DS . 'classes' . DS . className . DS . 'views' . DS . $view . '.php';
            if(file_exists($path)) {
                include(ROOT_PATH . DS . 'classes' . DS . className . DS . 'views' . DS . $view . '.php');
            }else {
                throw new ErrorException('View: '. $view . ' in render function of ' . ucfirst(static::className) . 'Controller hasn\'t been found');
            }
        }
    }