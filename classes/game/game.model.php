<?php
    
    require_once('C:\_xampp\htdocs\www\hfvp-board-game\conf\db_conf.php');
    require_once('C:\_xampp\htdocs\www\hfvp-board-game\classes\core\core.model.php');
    require_once('game.class.php');
    class GameModel extends CoreModel {

        const className = 'game';
        const db_prefix = 'gam';

        // public function create() {

        // }
        // public function read() {

        // }
        // public function update() {

        // }
        // public function delete() {

        // }
        // public function __construct() {

        // }
    }


    /* 
    -----------------------------------------
    Tests
    ----------------------------------------- 
    */
    
    // $gm = new GameModel($epic_db);
    // var_dump($gm->create(['id'=>0, 'whosturn'=>0, 'elapsedturns'=>10]));