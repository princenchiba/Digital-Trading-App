<?php 
    $session = session();
    $db = \Config\Database::connect();
    $query= $db->query("Select title,site_align,logo,favicon from setting");
    $settings   = $query->getRow();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title><?php echo display('login') ?> - <?php echo ((!empty($title)?$title:null)) ?></title>
        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="<?php echo base_url(@$settings->favicon); ?>">
        <!-- Bootstrap --> 
        <link href="<?php echo base_url('assets/plugins/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css"/>
       <!-- 7 stroke css -->
        <link href="<?php echo base_url(); ?>/assets/css/pe-icon-7-stroke.css" rel="stylesheet" type="text/css"/>

        <!-- style css -->
        <link href="<?php echo base_url('/assets/css/login.css'); ?>" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url()?>/assets/dist/css/style.css" rel="stylesheet">
        
    </head>
    <body>
        <!-- Content Wrapper -->
        <div class="login-wrapper"> 
            <div class="container-center">
                <div class="card">
                    <div class="card-header">
                        <div class="view-header">
                            <div class="header-icon">
                                <i class="pe-7s-unlock"></i>
                            </div>
                            <div class="header-title">
                                <h3 style="display: table-cell;"><?php echo display('please_login');?></h3>
                                <small><strong><?php echo esc(@$settings->title) ?></strong></small>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                      
                            <!-- alert message -->
                            <?php if ($session->get('message') != null) {  ?>
                            <div class="alert alert-info alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <?php echo ($this->session->flashdata('message')); ?>
                            </div> 
                            <?php } ?>
                            
                            <?php if ($session->getFlashdata('exception') != null) {  ?>
                            <div class="alert alert-danger alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <?php echo ($session->getFlashdata('exception')); ?>
                            </div>
                            <?php } ?>
                         
                      
                        <?php echo form_open('admin','id="loginForm" novalidate'); ?>
                            <div class="form-group">
                                <label class="control-label" for="email"><?php echo display('email') ?></label>
                                <input type="text" placeholder="<?php echo display('email') ?>" name="email" id="email" class="form-control" value="<?php echo (!empty($user->email)?$user->email:null) ?>"> 
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="password"><?php echo display('password') ?></label>
                                <input type="password"  placeholder="<?php echo display('password') ?>" name="password" id="password" class="form-control" value="<?php echo ((!empty($user->email)?$user->password:null)) ?>"> 
                            </div> 

                            <div class="form-group">
                                <label class="control-label" for="captcha"><?php echo ($captcha_image) ?></label>
                                <input type="captcha"  placeholder="<?php echo display('captcha') ?>" name="captcha" id="captcha" class="form-control"> 
                            </div> 

                            <div> 
                                <button  type="submit" class="btn btn-success"><?php echo display('login') ?></button> 
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.content-wrapper -->
        <!-- jQuery -->
        <script src="<?php echo base_url('/assets/js/jquery.min.js') ?>" type="text/javascript"></script>
        <!-- bootstrap js -->
        <script src="<?php echo base_url('/assets/js/bootstrap.min.js') ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('/assets/js/loginwraper.js') ?>" type="text/javascript"></script>
    </body>
</html>