<?php
    function LoadAll(string $classname) : void {
        $classname = strtolower($classname);
        if ($pos = strpos($classname, 'model')) {
            $classname = substr($classname, 0, $pos);
            if (file_exists(ROOT_PATH . "classes/$classname/$classname.model.php")) {
                require_once(ROOT_PATH . "classes/$classname/$classname.model.php");
            }
        }
        if ($pos = strpos($classname, 'controller')) {
            $classname = substr($classname, 0, $pos);
            if (file_exists(ROOT_PATH . "classes/$classname/$classname.controller.php")) {
                require_once(ROOT_PATH . "classes/$classname/$classname.controller.php");
            }
        }
        if($pos = strpos($classname, 'view')) {
            $classname = substr($classname, 0, $pos);
            if(file_exists(ROOT_PATH . "classes/$classname/$classname.view.php")) {
                require_once(ROOT_PATH . "classes/$classname/$classname.view.php");
            }
        }
        if(file_exists(ROOT_PATH . "classes/$classname/$classname.class.php")) {
            require_once(ROOT_PATH . "classes/$classname/$classname.class.php");
        }
    }

    spl_autoload_register('LoadAll');