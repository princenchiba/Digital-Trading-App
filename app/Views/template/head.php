<?php 
    $request  = \Config\Services::request();
    $segment3 = $request->uri->setSilent()->getSegment(3);
?>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="Responsive Bootstrap 4 Admin &amp; Dashboard Template">
<meta name="author" content="Bdtask">
<title><?php echo esc($settings->title) ?> - <?php echo esc((!empty($title)?$title:null)) ?></title>
<!-- Font family css -->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet" type="text/css"/>
<link href="https://fonts.googleapis.com/css?family=Alegreya+Sans:100,100i,300,300i,400,400i,500,500i,700,700i,800,800i,900,900i"/>
<link href="https://fonts.googleapis.com/css?family=Nunito+Sans:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet" type="text/css"/>
<!-- App favicon -->
<link rel="shortcut icon" href="<?php echo base_url(!empty($settings->favicon)?$settings->favicon:"assets/images/icons/favicon.png"); ?>">
<!-- jquery ui css -->
<link href="<?php echo base_url('/assets/css/jquery-ui.min.css') ?>" rel="stylesheet" type="text/css"/>
<!--Global Styles(used by all pages)-->
<link href="<?php echo base_url('/assets/plugins/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
<link href="<?php echo base_url('/assets/plugins/fontawesome/css/all.min.css') ?>" rel="stylesheet">
<link href="<?php echo base_url('/assets/plugins/typicons/src/typicons.min.css') ?>" rel="stylesheet">
<link href="<?php echo base_url('/assets/plugins/themify-icons/themify-icons.min.css') ?>" rel="stylesheet">
<link href="<?php echo base_url(); ?>/assets/css/select2.min.css" rel="stylesheet" type="text/css"/> 
<!--Third party Styles(used by this page)--> 
<?php if($segment3 != ''){?>
	<link href="<?php echo base_url('/assets/plugins/datatables/dataTables.bootstrap4.min.css') ?>" rel="stylesheet">
	<link href="<?php echo base_url('/assets/plugins/datatables/responsive.bootstrap4.min.css') ?>" rel="stylesheet">
	<link href="<?php echo base_url('/assets/plugins/datatables/buttons.bootstrap4.min.css') ?>" rel="stylesheet">
<?php } ?>
<link href="<?php echo base_url('/assets/plugins/bootstrap4-toggle/css/bootstrap4-toggle.min.css') ?>" rel="stylesheet">
<link href="<?php echo base_url('/assets/plugins/semantic/semantic.min.css') ?>" rel="stylesheet">
<!--Third party Styles(used by this page)--> 
<!--Start Your Custom Style Now-->
<?php if (!empty($settings->site_align) && $settings->site_align == "RTL") {  ?>
	<link href="<?php echo base_url('assets/dist/css/style.rtl.css') ?>" rel="stylesheet">
	<link href="<?php echo base_url('/assets/plugins/metisMenu/metisMenu-rtl.css') ?>" rel="stylesheet">
<?php } else { ?>
	<link href="<?php echo base_url('/assets/plugins/metisMenu/metisMenu.css') ?>" rel="stylesheet">
	<link href="<?php echo base_url('/assets/dist/css/style.css') ?>" rel="stylesheet">
<?php } ?>
<link href="<?php echo base_url(); ?>/assets/css/custom.css" rel="stylesheet" type="text/css"/>
<!--Start Your Custom Style Now-->
<script src="<?php echo base_url('/assets/js/jquery.min.js') ?>"></script>
<script type='text/javascript' src="<?php echo base_url('Adapter/javascript') ?>"></script>