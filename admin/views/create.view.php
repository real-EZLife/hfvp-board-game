<h2>Créer une carte :</h2>
<span><i>Les champs marqués d'un * sont obligatoires</i></span>
<br>
<form enctype="multipart/form-data" action="fileupload.php" class="grid-4 has-gutter" method="POST">
    <label for="name">Nom de la carte :*</label>
        <input type="text" name="name" title="Nom" placeholder="Nom de la carte" required>
    <label for="mana">Points de mana :*</label>
        <input type="text" name="mana" title="Mana" placeholder="Points de mana (Nb)" required>
    <label for="pv">Points de vie :*</label>
        <input type="text" name="pv" title="Pv" placeholder="Points de vie (Nb)" required>
    <label for="atk">Points d'attaque :*</label>
        <input type="text" name="atk" title="Atk" placeholder="Points d'attaque (Nb)" required>
    <label for="desc">Description :*</label>
        <input type="text" name="desc" title="Description" placeholder="Description" required>
    <label for="type">Type :*</label>
        <select name="type" title="Type">
            <option value="1">Créature</option>
            <option value="2">Sort</option>
            <option value="3">Bouclier</option>
            <option value="4">Spéciale</option>
        </select>
    <label for="fx">Effets :*</label>
        <select name="fx" title="fx">
            <option value="none">Aucun</option>
            <option value="fire">Feu</option>
            <option value="water">Eau</option>
            <option value="air">Air</option>
            <option value="earth">Terre</option>
        </select>
    <label for="special">Carte spéciale :*</label>
        <ul class="is-unstyled">
            <li>
                <input type="radio" class="radio" name="special" value="1" id="r1">
                <label for="r1">OUI</label>
                <input type="radio" class="radio" name="special" value="0" checked="checked" id="r2">
                <label for="r2">NON</label>
            </li>
        </ul>
    <label for="img">Image :*</label>
        <input type="file" id="img" name="img" title="Image">
    <label for="faction">Faction :</label>
        <select name="faction" title="faction">
            <option value="1">Heroic Fantasy</option>
            <option value="2">Politiques</option>
        </select>
    <br>
    <button class="btn--primary">Créer</button>
</form>