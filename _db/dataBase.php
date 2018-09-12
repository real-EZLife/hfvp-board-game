<?php

function jsonToPhp($jsonObj) {
    return json_decode($jsonObj);
}
function phpToJson($phpObj) {
    return json_encode($phpObj);
}
function writeDBFile( String $file, $data ) : void {
    file_put_contents( $file, phpToJson($data), true );
}
function readDBFile( String $file ) {
    return jsonToPhp(file_get_contents( $file ));
}
function updateDBFile( Int $recordID, String $file, Object $data ) {

    
    $dbData = readDBFile( $file );
    $updatedData = $data;

    $dbData[$recordID] = $updatedData;


    writeDBFile( $file, $dbData );
    
    //  

    // var_dump($updatedData);

}