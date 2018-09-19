<?php
    require_once(ROOT_PATH . '/classModels/Cards/Creature.php');
    /**
     * Shield est une classe hérité de la class Creature
     * @param string $cardSpecial = 'shield'
     * @return Shield
     */
    class Shield extends Creature {
        public function __construct(    String $cardName = 'defaultTitle', String $cardImg = './defaultImg.jpeg', String $cardDesc = 'defaultDesc', 
                            Int $cardManaCost = 0, int $cardAtk = 0, int $cardHp = 0 ) {
            parent::__construct( $cardName, $cardImg, $cardDesc, $cardManaCost, $cardSpecial = 'shield', $cardAtk, $cardHp );
        }
    }