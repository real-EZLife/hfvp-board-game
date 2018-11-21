<?php
    class CardController extends CoreController {
        const className = 'card';

        public function listAction() {
            $this->setModel();
            $this->cards = $this->getModel()->readAllByFaction(1);
            $this->render('list');
        }
        public function renderCard($card) {

        }
    }