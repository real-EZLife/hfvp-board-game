<?php

    require_once('Deck.php');

    $playerHand = [];

    var_dump($playerHand);
    
    var_dump($playerDeck);

    function initialDraw(Array &$hand, Array &$deck) :void {
        $hand[] = $deck[0];
        $hand[] = $deck[1];
        $hand[] = $deck[2];
        array_splice($deck, 0, 3);
    }
    

    function drawCard(Array &$hand, Array &$deck) : void {
        $hand[] = $deck[0];
        array_splice($deck, 0, 1);
    }

    
    initialDraw($playerHand, $playerDeck);

    var_dump($playerHand);
    
    var_dump($playerDeck);
?>