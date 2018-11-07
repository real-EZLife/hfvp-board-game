<h2>Les factions<h2>
<?php $factions = $factionModel->readAll();
if (empty($factions)) {
    // If no factions in database, show information message
    echo '<div class="alert--warning">Il n\'y a aucune carte dans la base de données.</div>';
} ?>
<!-- ***** -->
<?php
if(!empty($factions)) {
    foreach( $factions as $key=>$faction) { ?>
<div class="f-view">
    <span class="f-id" href="#"><?php echo $faction->get_id(); ?></span>
    <a class="f-name" href="#"><?php echo $faction->get_name(); ?></a>
</div>
<?php } } ?>