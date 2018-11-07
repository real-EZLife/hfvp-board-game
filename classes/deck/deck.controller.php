<?php
class DeckController extends CoreController {
    const className = 'deck';

    public function createAction() {
        $this->render('create');
    }
    public function creatingAction($post) {
        $this->setModel();
    }
    public function composeAction() {
        $this->render('compose');
    }
    public function composingAction() {

    }
    public function manageAction() {
        $this->render('manage');
    }
    public function managingAction() {

    }
    public function defaultAction() {
        $this->managedecksAction();
    }
}