<?php
class DeckModel extends CoreModel {

    const className = 'deck';

    const db_prefix = 'deck';


    public function readByPlayer(string $pseudo, int $deck_id = null) {
        if($deck_id == null)
            return $this->query('SELECT * FROM `deck` LEFT JOIN `compose` ON `deck`.`deck_id`=`compose`.`deck_id` WHERE `compose`.`user_pseudo`="'. $pseudo .'";');
        else
            return $this->query('SELECT * FROM `deck` LEFT JOIN `compose` ON `deck`.`deck_id`=`compose`.`deck_id` WHERE `compose`.`user_pseudo`="'. $pseudo .'" AND `compose`.`deck_id`='. $deck_id .';');
    }

    public function create(array $values) {

        $deck = ['name' => $values['name']];
        if(($id = parent::create($deck)) != false ) {
            $this->query('INSERT INTO `compose` (`deck_id`, `user_pseudo`) VALUES (' . $id . ', "' . $_SESSION['hfvp']['user']['pseudo'] .'");');
            return $id; 
        }else
            return false;
    }

    public function delete($id) {
        if(($req = $this->getDb()->query('DELETE FROM `compose` WHERE `compose`.`deck_id`=' . $id .';')) !== false) {
            if($this->getDb()->query('DELETE FROM `deck` WHERE `deck`.`deck_id`=' . $id .';') !== false)
                return true;
            else
                return false;
        }
    }

}