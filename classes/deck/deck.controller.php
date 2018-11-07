<?php
class DeckController extends CoreController {
    const className = 'deck';

    public function composeAction() {
        $this->render('createdeck');
    }
    public function composingAction() {
    }
    public function managedecksAction() {
        
    }
    public function defaultAction() {
        $this->render('managedecks');
    }
}