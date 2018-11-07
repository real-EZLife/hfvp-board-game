<h1>Création d'un deck</h1>
<form action="?c=deck&a=composing" method='post'>
    <label for="name">
        Nom du Deck
        <input type="text" name="name" id="name">
    </label>
    <label for="faction">
        Faction
        <select name="faction">
            <?php if(isset($factions)) : ?>
                <?php foreach($factions as $pos => $fac) : ?>
                    <option value=<?php $fac['id']?>>
                        <?php $fac['name'] ?>
                    </option>
                <?php endforeach ?>
            <?php endif ?>
        </select>
    </label>
    <button type="submit">Créer</button>
</form>