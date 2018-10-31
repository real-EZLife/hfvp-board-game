<?php
    /**
     * @return Game
    */
    require_once('C:\_xampp\htdocs\www\hfvp-board-game\classes\core\core.class.php');
    class Game extends Core {
        /**
         * Game id
         *
         * @var int
        */
        protected $id;
        /**
         * Enum: 0, 1, 2, 100
         * 0 when not started
         * 1 on P1 turn
         * 2 on P2 turn
         * 100 when over
         * 
         * @var int
        */
        protected $whosturn = 0; //enum: 0, 1, 2
        /**
         * @var int
        */
        protected $elapsedturns = 0;
        /**
         * @var string
        */
        protected $gameStatus = '';
        /**
         * @var Board
        */
        protected $board;
        /**
         * @var Player
        */
        protected $playerA;
        /**
         * @var Player
        */
        protected $playerB;
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
         * Get game id
         *
         * @return  int
         */ 
        public function getId() : int {
            return $this->id;
        }
        /**
         * getPlayerA
         * 
         * Lobby->playerA
         * 
         * @return Player
        */
        public function getPlayerA() : Player {
            return $this->playerA;
        }
        /**
         * getPlayerB
         * 
         * Lobby->playerB
         * 
         * @return Player
        */
        public function getPlayerB() : Player {
            return $this->playerB;
        }
        /**
         * getBoard
         * 
         * Lobby->board
         * 
         * @return Board
        */
        public function getBoard() : Board {
            return $this->board;
        }
        /**
         * getWhosturn
         * 
         * Lobby->whosturn
         * 
         * @return int
        */
        public function getWhosturn() : int {
            return $this->whosturn;
        }
        /**
         * getTotalMana
         * 
         * Lobby->elapsedturns;
         * 
         * @return int
        */
        public function getGameTurns() : int {
            return $this->elapsedturns;
        }
        /**
         * getGameStatus
         * 
         * Lobby->gameStatus;
         * 
         * @return string
        */
        public function getGameStatus() : string {
            return $this->gameStatus;
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
         * setPlayerA
         * 
         * Lobby->playerA = $value
         * 
         * @param Player $value
         * @return void
        */
        public function setPlayerA( Player $value ) : void {
            $this->playerA = $value;
        }
        /**
         * setPlayerB
         * 
         * Lobby->playerB = $value
         * 
         * @param Player $value
         * @return void
        */
        public function setPlayerB( Player $value ) : void {
            $this->playerB = $value;
        }
        /**
         * setBoard
         * 
         * Lobby->board = $value
         * 
         * @param Board $value
         * @return void
        */
        public function setBoard( Board $value ) : void {
            $this->board = $value;
        }
        /**
         * setWhosturn
         * 
         * Lobby->whosturn = $value
         * 
         * @param int $value
         * @return void
        */
        public function setWhosturn( Int $value ) : void {
            $this->whosturn = $value;
        }
        /**
         * setGameTurns
         * 
         * Lobby->elapsedturns = $value
         * 
         * @param int $value
         * @return void
        */
        public function setGameTurns( Int $value ) : void {
            $this->elapsedturns = $value;
        }
        /**
         * setPlayerA
         * 
         * Lobby->playerA = $value
         * 
         * @param string $value
         * @return void
        */
        public function setGameStatus( String $value ) : void {
            $this->gameStatus = $value;
        }
        /**
         * Set game id
         *
         * @param  int  $id  Game id
         *
         * @return  self
         */ 
        public function setId(int $id) : self {
            $this->id = $id;

            return $this;
        }
    }