<?php
class DeckController extends CoreController {
    const className = 'deck';

    public function createAction() {
        $this->render('create');
    }
    public function creatingAction(array $post) {
        
        if(!isset($post['name']) || empty($post['name'])) {
            header('Location: ?c=deck&a=create&err=required');
        }
        $this->setModel();
        if(($id = $this->getModel()->create($post)) != false) {
            header('Location: ?c=deck&a=compose&id='.$id);
        }else {
            header('HTTP/1.1 500 Internal Server Error');
        }
    }
    public function composeAction() {
        if(isset($_GET['id']) && !empty($_GET['id'])) {
            $this->getModel();
            if(($this->deck = $this->getModel()->readByPlayer($_SESSION['hfvp']['user']['pseudo'], $_GET['id'])) != false) {
                $cm = new CardModel;
                $compo = $this->deck['deck_compo'];
                if(($c = $cm->readAllByString($compo)) != false)
                    $this->deck['cards'] = $c;
                $this->deck = new Deck($this->deck);
                var_dump($this->deck);
                $this->render('compose');
            }else {
                header('HTTP/1.1 404 Not Found');
            }
        }
        else
            header('Location: ?c=deck&a=manage');
    }
    public function composingAction() {

    }
    public function manageAction() {
        $this->setModel();
        $this->decks = $this->getModel()->readByPlayer($_SESSION['hfvp']['user']['pseudo']);
        $this->render('manage');
    }
    public function managingAction() {

    }
    public function deleteAction() {
        if(isset($_GET['id']) && !empty($_GET['id'])) {
            $this->setModel();
            if($this->getModel()->delete($_GET['id'])) {
                header('Location: .?c=deck');
            }else {
                header('HTTP/1.1 500 Internal Server Error');
            }
        }else {
            header('Location: .?c=deck');
        }
    }
    public function defaultAction() {
        $this->manageAction();
    }
}