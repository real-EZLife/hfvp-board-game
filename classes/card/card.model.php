<?php 
    require_once('C:\_xampp\htdocs\www\hfvp-board-game\conf\db_conf.php');
    require_once('C:\_xampp\htdocs\www\hfvp-board-game\classes\core\core.model.php');
    class CardModel extends CoreModel {
        
        const className = 'card';
        const db_prefix = 'card';

        private function createCard(array $values) {

            if(isset($values['type'])) {

                switch(strtolower($values['type'])) :
                    case 'creature':

                        break;
                    case 'spell':

                        break;
                    case 'creature':

                        break;
                endswitch;

            }

        }

        public function read($id = null) {

            $datas = parent::read($id);
            if(!empty($datas)) {
                
                if($id == null) {

                    

                }elseif(ctype_digit($id)) {

                }else {

                }

            }

        }        

    }

    $cm = new CardModel($epic_db);