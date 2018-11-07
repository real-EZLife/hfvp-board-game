
<?php foreach($card->getCardInfo() as $prop => $value) : ?>
    <li><?php echo "$prop : $value" ?></li>
<?php endforeach ?>

<article class="card--container">
    <div class="card--inner">
        <div class="layer layer--background">
        </div>
        <div class="layer layer--text">
            <div class="card--title"></div>
            <div class="card--desc"></div>
        </div>
        <div class="layer layer--stats">
        </div>
        <div class="layer layer--image">
        </div>
    </div>
</article>