<?php
    require_once('CardModels.php');


    $playerDeck = [];
    
    $formalDeckComp = [
        ['type' => 'creature', 'nb' => 12],
        ['type' => 'spell', 'nb' => 3],
        ['type' => 'shield', 'nb' => 4],
        ['type' => 'special', 'nb' => 1,]
    ];
    function fillDeck(Array $deck, Array $deckType) {
        
        foreach( $deckType as $value ) {
            switch( $value['type'] ) {
                case 'creature':
                for($i = 0; $i < $value['nb']; $i++) {
                    $deck[] = new Creature();
                }
                break;
                case 'spell':
                for($i = 0; $i < $value['nb']; $i++) {
                    $deck[] = new Spell();
                }
                break;
                case 'shield':
                for($i = 0; $i < $value['nb']; $i++) {
                    $deck[] = new Shield();
                }
                break;
                case 'special':
                for($i = 0; $i < $value['nb']; $i++) {
                    $deck[] = new Special();
                }
                break;
            }
        }
        return $deck;
    }
    
    function listDeck(Array $deck) : Array {
        $deckCards = [];
        foreach($deck as $pos => $card) {
            $deckCards[] = $card->getCardInfo();
        }
        return $deckCards;
    }
    $playerDeck = fillDeck($playerDeck, $formalDeckComp);
    shuffle($playerDeck);
?>