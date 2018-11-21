<h1>Modifier le deck: <?php $this->deck->getName() ?></h1>
<?php if(isset($this->deck) && count($this->deck->getDeckList()) > 0) : ?>
    <ul class=''>
    <?php foreach($this->deck->getDeckList() as $pos => $card) : ?>
        <li>
            <?php echo $card->getName() ?>
        </li>
    <?php endforeach ?>
    </ul>
    <a href='.?c=deck&a=delete&id='<?php echo $this->deck->getId() ?>>Supprimer ce deck</a>
<?php else : ?>
    <p> Votre deck ne contient pas de cartes </p>
<?php endif ?>
<a href='.?c=deck&a=create'>Créer un nouveau deck</a>

