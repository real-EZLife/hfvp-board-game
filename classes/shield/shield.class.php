<?php
    /**
     * Shield est une classe hérité de la class Creature
     * @param string $cardSpecial = 'shield'
     * @return Shield
     */
    class Shield extends Creature {
        public function __construct(array $data) {
            parent::__construct($data);
            $this->setTalent('shield');
        }
    }