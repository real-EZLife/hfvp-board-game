<?php
class DeckModel extends CoreModel {

    const className = 'deck';

    const db_prefix = 'deck';

    public function create(array $values) {

        $deck= ['name' => $values['name']];

        if(($id = parent::create($deck)) != false )
            var_dump($this->query('INSERT INTO `compose` (`deck_id`, `user_pseudo`) VALUES (' . $id . ', ' . $_SESSION['user']['pseudo'] .');'));
        else
            return false;
    }

}