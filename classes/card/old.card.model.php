<?php 
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

                    return $datas;
                    
                }elseif(ctype_digit($id)) {
                    
                    return $datas;
                    
                }else {
                    
                    return $datas;

                }

            }
            return false;

        }        

    }

    $cm = new CardModel($epic_db);

    var_dump($cm->read());