<?php
class Hand
{
    public function __construct()
    {

    }
    /**
     * @var $cardList
     */
    private $cardList = [];


    public function addCards(Int $n, array $deck) : void
    {
        for ($i = 0; $i < $n; $i++) {
            $this->cardList[] = $deck[0];
            array_splice($deck, 0, 1);
        }
    }
    /**
     * remove a card at the position $pos
     *
     * @param Int $pos
     * @return void
    */
    public function removeCard(Int $pos) : void
    {
        array_splice($this->cardList, $pos, $pos + 1);
    }
    /**
     * takes an array of Card child classes and stores it Hand->ccardList
     *
     * @param array $array
     * @return self
     */
    public function setHandFromArray(array $array) : self
    {
        $this->cardList = $array;
        return $this;
    }
    /**
     * return the number length of hand->cardList array
     *
     * @return integer
     */
    public function getCardCount() : int {
        if ($this->cardList !== null) {
            return count($this->cardList);
        } else {
            return 0;
        }
    }
    /**
     * return the card at the position $pos
     *
     * @param int $pos
     * @return Card
     */
    public function getCard(Int $pos) : Card {
        return $this->cardList[$pos];
    }
    /**
     * Get the value of cardList
     *
     * @return  $cardList
     */ 
    public function getCardList() : array {
        return $this->cardList;
    }

    /**
     * Set the value of cardList
     *
     * @param  $cardList  $cardList
     *
     * @return  self
     */ 
    public function setCardList(Array $cardList) : self {
        $this->cardList = $cardList;

        return $this;
    }
}