<?php
    function loadAll( string $className ) {
        $className = strtolower($className);
        if($pos = strpos($className, 'model')) {

            $className = substr($className, 0, $pos);
            $path = ROOT_PATH . "classes/$className/$className.model.php";
            if(file_exists($path))
                require_once($path);

        }else {
            $path = ROOT_PATH . "classes/$className/$className.class.php";
            if(file_exists($path))
                require_once($path);
        }
    }
    
    spl_autoload_register('loadAll');
    