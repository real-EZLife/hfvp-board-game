<?php

function jsonToPhp($jsonObj) {
    return json_decode($jsonObj);
}
function phpToJson($phpObj) {
    return json_encode($phpObj);
}
function writeDBFile( String $file, Array $data ) : void {
    file_put_contents( $file, phpToJson($data), true );
}
function readDBFile( String $file ) {
    return jsonToPhp(file_get_contents( $file ));
}

?>