<?php
class DeckController extends CoreController {
    const className = 'deck';

    public function createAction() {
        $this->render('create');
    }
    public function creatingAction(array $post) {
        
        if(empty($post['name'])) {
            header('Location: .?c=deck&a=create&err=required');
        }
        $this->setModel();
        $this->getModel()->create($post);

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