<?php
    abstract class CoreModel {
        
        const className = '';
        const db_prefix = '';

        /**
         * PDO Object
         *
         * @var PDO
        */
        protected $db;
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
         * Get PDO Object
         *
         * @return  PDO
        */ 
        protected function getDb() {
            return $this->db;
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
         * Set pDO Object
         *
         * @param  PDO  $db  PDO Object
         *
         * @return  self
         */ 
        private function setDb(PDO $db) {
            $this->db = $db;

            return $this;
        }
        /**
         * query database using INSERT INTO keywords creating a new record
         *
         * @param array $values
         * @return mixed
        */
        public function create(array $values) {
            try {
                if(!empty($values)) {
                    $query = 'INSERT INTO `' . static::className . '` ';
                    $fields = '(';
                    $vals = '(';
                    foreach($values as $key => $value) {
                        if($key != 'id' && !is_numeric($key)) {
                            $fields .= '`' . static::db_prefix . $key . '`, ';
                            $vals .= '"' . $value . '", ';
                        }
                    }
                    $fields = substr($fields, 0, -2) . ')';
                    $vals = substr($vals, 0, -2) . ')';

                    $query .= $fields . ' VALUES '. $vals . ';';
                    if(($req = $this->getDb()->query($query)) != false) {
                        return $this->getDb()->lastInsertId();
                    }else {
                        return false;
                    }
                }
                return false;
            }catch(PDOException $e) {
                return $e->getMessage();
            }
        }
        /**
         * query database using SELECT keyword 
         *
         * @param mixed $id can be null, int or string
         * @return mixed
        */
        public function read($id = null) {
            try {
                if($id === null) {
                    if(($req = $this->getDb()->query('SELECT * FROM ' . static::className . ';' )) != false) {
                        if(($res = $req->fetchAll(PDO::FETCH_ASSOC)) != null)
                            if(count($res) == 1) {
                                return $res[0];
                            }else {
                                return $res;
                            }
                        else 
                            return false;
                    }
                    return false;
                }else {
                    if(ctype_digit($id)) {
                        if(($req = $this->getDb()->prepare('SELECT * FROM ' . static::className . ' WHERE `' . static::db_prefix . '_id`=?;' )) != false) {
                            if($req->bindValue(1, $id, PDO::PARAM_INT)) {
                                if($req->execute()) {
                                    if(($res = $req->fetch(PDO::FETCH_ASSOC)) != null )
                                        return $res;
                                    else
                                        return false;
                                }
                            }
                        }
                        return false;
                    }else {
                        if(($req = $this->getDb()->prepare('SELECT * FROM ' . static::className . ' WHERE `' . static::db_prefix . '_name`=?;' )) != false) {
                            if($req->bindValue(1, $id, PDO::PARAM_STR)) {
                                if($req->execute()) {
                                    if(($res = $req->fetch(PDO::FETCH_ASSOC)) != null )
                                        return $res;
                                    else
                                        return false;
                                }
                            }
                        }
                        return false;
                    }
                }
            }catch(PDOException $e) {
                return $e->getMessage();
            }
        }
        /**
         * query database using UPDATE keywords updating a record
         *
         * @param array $values
         * @return bool
        */
        public function update(array $values) {
            try {
                if(!empty($values) && isset($values['id'])) {
                    $query = 'UPDATE `' . static::className . '` SET ';
                    $fields = '';
                    foreach($values as $key => $value) {
                        if($key != 'id' && !is_numeric($key)) {
                            $fields .= "`" . static::db_prefix . "$key`='$value', ";
                        }
                    }
                    $fields = substr($fields, 0, -2) . '';

                    $query .= $fields . ' WHERE `'. static::db_prefix . 'id`=' . $values['id'] . ';';
                    if(($req = $this->getDb()->query($query)) != false) {
                        return true;
                    }else {
                        return false;
                    }
                }
                return false;
            }catch(PDOException $e) {
                return $e->getMessage();
            }
        }
        /**
         * query database using DELETE keywords deleting a record with the $id
         *
         * @param int $id id of the record to delete
         * @return mixed
        */
        public function delete(int $id) {
            try {
                if(is_numeric($id)) {
                    $query = 'DELETE FROM `' . static::className . '` WHERE `' . static::db_prefix . 'id`=' . $id . ';';
                    if(($req = $this->getDb()->query($query)) != false) {
                        return true;
                    }else {
                        return false;
                    }
                }
                return false;
            }catch(PDOException $e) {
                return $e->getMessage();
            }
        }
        /**
         * build sql queries
         *
         * @param string $queryString
         * @param array $values
         * @return mixed
         */
        public function query(string $queryString, $values = []) {
            try {
                if(!empty($queryString) && !is_null($queryString) && !strpos(strtoupper($queryString), 'DROP') && !strpos(strtoupper($queryString), 'TRUNCATE')) {
                    $keyword = strtoupper(substr($queryString, 0, 6));
                    if(empty($values)) {
                        switch($keyword) {
                            case 'SELECT':
                                if(($req = $this->getDb()->query($queryString)) !== false ) {
                                    if(($res = $req->fetchAll(PDO::FETCH_ASSOC)) != null) {
                                        if(count($res) == 1) {
                                            return $res[0];
                                        }else {
                                            return $res;
                                        }
                                    }
                                }
                                return false;
                            case 'INSERT':
                                if(($req = $this->getDb()->query($queryString)) !== false ) {
                                    return $this->getDb()->lastInsertId();
                                }
                                return false;
                            case 'UPDATE':
                                if(($req = $this->getDb()->query($queryString)) !== false ) {
                                    return $this->getDb()->lastInsertId();
                                }
                                break;
                            default: 
                                return false;
                        }
                    }else {
                        switch($keyword) {
                            case 'SELECT':
                                $selected = '';
                                $query = '';
                                foreach($values as $key => $value) {
                                    var_dump($key);
                                    if(!is_numeric($key)) {
                                        $selected .= " `" . static::db_prefix . "$key`, ";
                                    }else {
                                        $selected .= " `" . static::db_prefix . "$value`, ";
                                    }
                                }
                                $selected = substr($selected, 0, -2);
                                $query = $keyword . $selected . ' FROM ' . static::className . ';';
                                var_dump($query);
                                if(($req = $this->getDb()->query($query)) !== false ) {
                                    if(($res = $req->fetchAll(PDO::FETCH_ASSOC)) != null ) {
                                        if(count($res) == 1) {
                                            return $res[0];
                                        }
                                        else {
                                            return $res;
                                        }
                                    }
                                    else 
                                        return false;
                                }
                                return false;
                            case 'INSERT':
                                $fields = '(';
                                $inserts = '(';
                                $query = '';
                                foreach($values as $key => $value) {
                                    if($key != 'id' && !is_numeric($key)) {
                                        $fields .= "`" . static::db_prefix . "$key`, ";
                                        $inserts .= "`" . "$value`, ";
                                    }
                                }
                                $fields = substr($fields, 0, -2) . ')';
                                $inserts = substr($inserts, 0, -2) . ')';
                                $query = $keyword . ' INTO `' . static::className ."` $fields". ' VALUES ' . $inserts . ';';
                                if(($req = $this->getDb()->query($query)) !== false ) {
                                    return $this->getDb()->lastInsertId();
                                } else {
                                    return false;
                                }
                                break;
                            case 'UPDATE':
                                if($values['id']) {
                                    $fields = '';
                                    $query = '';
                                    foreach($values as $key => $value) {
                                        if($key != 'id' && !is_numeric($key)) {
                                            $fields .= "`" . static::db_prefix . "$key`='$value', ";
                                        }
                                    }
                                    $fields = substr($fields, 0, -2);
                                    $query = $keyword . ' `' . static::className ."` SET $fields". ' WHERE `' . static::db_prefix . 'id`=' . $values['id'] . ';';
                                    if(($req = $this->getDb()->query($query)) !== false ) {
                                        return true;
                                    }else {
                                        return false;
                                    }
                                }
                                break;
                            case 'DELETE':
                                if($values['id']) {
                                    $query = $keyword . ' FROM `' . static::className ."` ". 'WHERE `' . static::db_prefix . 'id`=' . $values['id'] . ';';
                                    if(($req = $this->getDb()->query($query)) !== false ) {
                                        return true;
                                    }else {
                                        return false;
                                    }
                                }
                                break;
                            default: 
                                return false;
                        }
                    }
                }
                return false;
            }catch(PDOException $e) {
                return $e->getMessage();
            }
        }
        public function __construct( PDO $db ) {
            $this->setDb($db);
        }
        
    }