<?php

// page controller 

require_once('conf/request.php');

$req = new SRequest();

var_dump($req->getAll());
    