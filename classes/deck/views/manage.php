<h1>Vos Decks</h1>
<?php var_dump($this->decks) ?>
<?php if(isset($this->decks, $this->decks[0]) && count($this->decks) > 0) : ?>
    <ul class=''>
    <?php foreach($this->decks as $pos => $deck) : ?>
        <li>
            <a href=".?c=deck&a=compose&id=<?php echo $deck['deck_id']?>"><?php echo $deck['deck_name'] ?></a>
            <a href=".?c=deck&a=delete&id=<?php echo $deck['deck_id']?>"> Supprimer </a>
        </li>
    <?php endforeach ?>
    </ul>
<?php elseif(isset($this->decks) && count($this->decks) == 4) : ?>
    <ul class=''>
    <?php $deck = $this->decks ?>
    <li>
        <a href=".?c=deck&a=compose&id=<?php echo $deck['deck_id']?>"><?php echo $deck['deck_name'] ?></a>
        <a href=".?c=deck&a=delete&id=<?php echo $deck['deck_id']?>"> Supprimer </a>
    </li>
    </ul>
<?php else : ?>
    <p> Vous n'avez aucun deck </p>
<?php endif ?>
<a href='.?c=deck&a=create'>Créer un nouveau deck</a>

