<?php  $session = session(); ?>

<?php if ($session->get('message') != null) {  ?>
<div class="alert alert-success alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
   <?php echo $session->get('message'); ?>
</div>
<?php } ?>

<?php if ($session->get('exception') != null) {  ?>
<div class="alert alert-danger alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
     <?php echo $session->get('exception'); ?>
</div>
<?php } ?>

<?php if ($session->get('error') != null) {  ?>
<div class="alert alert-danger alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <?php echo $session->get('error'); ?>
</div>
<?php } ?>

