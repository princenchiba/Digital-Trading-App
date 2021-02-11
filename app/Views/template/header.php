<?php 
    $request  = \Config\Services::request();
    $session  = session();
    $segment1 = $request->uri->setSilent()->getSegment(1);
    $segment2 = $request->uri->setSilent()->getSegment(2);
   
?>
<nav class="navbar-custom-menu navbar navbar-expand-xl m-0">
    <div class="sidebar-toggle-icon" id="sidebarCollapse">
        sidebar toggle<span></span>
    </div><!--/.sidebar toggle icon-->
    <!-- Collapse -->
    <div class="navbar-icon d-flex">
        <ul class="navbar-nav flex-row align-items-center">
            <?php 

                if($max_version < $current_version && ($settings_info->update_notification == 1)){
                  if(session('isAdmin') == 1){
            ?> 
                <li> <a class="blink_text" href="<?php echo base_url('admin/autoupdate/autoupdate')?>" > <?php echo 'Version '.$current_version.' available'; ?></a>
                </li>
            <?php } } ?>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url(); ?>"><i class="typcn typcn-home-outline"></i></a>
            </li>
            <li class="nav-item dropdown user-menu">
                <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
                    <i class="typcn typcn-user-add-outline"></i>
                </a>
                <div class="dropdown-menu" >
                    <div class="dropdown-header d-sm-none">
                        <a href="" class="header-arrow"><i class="icon ion-md-arrow-back"></i></a>
                    </div>
                    <div class="user-header">
                        <div class="img-user">
                            <?php if(!empty($session->get('image'))){ ?>
                                <img src="<?php echo site_url($session->get('image')) ?>" alt="">
                            <?php } else { ?>
                                <img src="<?php echo site_url('assets/website/img/img-user.png') ?>" alt="">
                            <?php } ?>
                        </div><!-- img-user -->
                        <h6><?php echo $session->get('fullname') ?></h6>
                        <span><?php echo $session->get('email') ?></span>
                    </div><!-- user-header -->
                    <a href="<?php echo base_url('dashboard/profile'); ?>" class="dropdown-item"><i class="typcn typcn-user-outline"></i> <?php echo display('profile') ?></a>
                    <a href="<?php echo base_url('dashboard/edit-profile'); ?>" class="dropdown-item"><i class="typcn typcn-edit"></i> <?php echo display('edit_profile') ?></a>
                    <a href="<?php echo base_url('admin/logout') ?>" class="dropdown-item"><i class="typcn typcn-key-outline"></i> <?php echo display('logout') ?></a>
                </div><!--/.dropdown-menu -->
            </li>
        </ul><!--/.navbar nav-->
        <div class="nav-clock">
            <div class="time">
                <span class="time-hours"></span>
                <span class="time-min"></span>
                <span class="time-sec"></span>
            </div>
        </div><!-- nav-clock -->
    </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <i class="typcn typcn-th-menu-outline"></i>
    </button>
</nav><!--/.navbar-->
<!--Content Header (Page header)-->
<?php if($segment1 != 'dashboard'){?>
    <div class="content-header row align-items-center m-0">
        <nav aria-label="breadcrumb" class="col-sm-4 order-sm-last mb-3 mb-sm-0 p-0 ">
            <ol class="breadcrumb d-inline-flex font-weight-600 fs-13 bg-white mb-0">
                <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard') ?>"><?php echo display('home');?></a></li>
                <li class="breadcrumb-item active"><?php echo display('dashboard'); ?></li>
            </ol>
        </nav>
        <div class="col-sm-8 header-title p-0">
            <div class="media">
                <div class="header-icon text-success"><i class="typcn typcn-spiral"></i></div>
                <div class="media-body">
                    <h1 class="font-weight-bold">
                        <?php  
                            if(!empty($request->uri->setSilent()->getSegment(3))) { 

                                echo display($request->uri->setSilent()->getSegment(2));

                            } else { 

                                echo display($request->uri->setSilent()->getSegment(1));
                            }
                        ?>
                    </h1>
                    <small>
                        <?php
                        
                            if(!empty($request->uri->setSilent()->getSegment(3))) { 

                                echo display($request->uri->setSilent()->getSegment(3));

                            } else { 

                                echo display($request->uri->setSilent()->getSegment(2));
                            }
                         ?>
                    </small>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<!--/.Content Header (Page header)-->