<h2>Les types<h2>
<?php $types = $typeModel->readAll(); 
if (empty($types)) {
    // If no types in database, show information message
    echo '<div class="alert--warning">Il n\'y a aucune carte dans la base de données.</div>';
}?>
<!-- ***** -->
<?php
if(!empty($types)) {
    foreach( $types as $key=>$type) { ?>
<div class="t-view">
    <span class="t-id" href="#"><?php echo $type->get_id(); ?></span>
    <a class="t-name" href="#"><?php echo $type->get_name(); ?></a>
</div>
<?php } } ?>