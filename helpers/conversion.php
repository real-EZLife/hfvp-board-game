<?php
    function stringToNumber(String $s) : int {

        if(is_numeric($s)) {
            
            return intval($s);
            
        }else {

            var_dump('error: "' . $s . '" isn\'t a valid numeric value');
            return 0;

        }
    }