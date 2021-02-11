<?php
  $request = \Config\Services::request();
  $session   = session();
  $segment_1 = $request->uri->setSilent()->getSegment(2);
  $segment_2 = $request->uri->setSilent()->getSegment(3);
  $segment_4 = $request->uri->setSilent()->getSegment(3);
?>
<nav class="sidebar sidebar-bunker">
    <div class="sidebar-header">
        <a href="<?php echo base_url('dashboard') ?>" class="logo"><img src="<?php echo base_url(!empty($settings->logo)?$settings->logo:"assets/images/icons/logo.png"); ?>" alt=""></a>
    </div><!--/.sidebar header-->
    <div class="profile-element d-flex align-items-center flex-shrink-0">
        <?php $image = $session->get('image'); ?>
        <div class="avatar online">
          <img src="<?php echo base_url(!empty($image)?$image:"assets/images/icons/user.png") ?>" class="img-fluid rounded-circle" alt="">
        </div>
        <div class="profile-text">
          <h6 class="m-0"><?php echo $session->get('fullname') ?></h6>
          <span><?php echo display('admin'); ?></a></span>
        </div>
    </div><!--/.profile element-->
    <div class="sidebar-body">
        <nav class="sidebar-nav">
            <ul class="metismenu">
                 <li class="treeview <?php echo (($segment_1 == "dashboard") ? "mm-active" : null) ?>">
                    <a class="" href="<?php echo base_url('dashboard'); ?>">
                      <i class="fas fa-home fa-4x"></i>
                      <span><?php echo display('dashboard') ?></span>
                    </a>
                </li>
                <li class="treeview <?php echo (($segment_1 == "finance") ? "mm-active" : null) ?>">
                    <a class="has-arrow material-ripple" href="#">
                        <i class="fas fa-money-check"></i>
                        <span><?php echo display('finance') ?></span>
                    </a>
                    <ul class="nav-second-level">
                        <li class="<?php echo ((@$segment_2 == "pending-withdraw") ? "mm-active" : null) ?>"><a href="<?php echo base_url("admin/finance/pending-withdraw") ?>"> <?php echo display('pending_withdraw') ?> </a></li>
                        <li class="<?php echo ((@$segment_2 == "withdraw-list") ? "mm-active" : null) ?>"><a href="<?php echo base_url("admin/finance/withdraw-list") ?>"> <?php echo display('withdraw_list') ?> </a></li>
                        <li class="<?php echo ((@$segment_2 == "pending-deposit") ? "mm-active" : null) ?>"><a href="<?php echo base_url("admin/finance/pending-deposit") ?>"> <?php echo display('pending_deposit') ?> </a></li>
                        <li class="<?php echo ((@$segment_2 == "deposit-list") ? "mm-active" : null) ?>"><a href="<?php echo base_url("admin/finance/deposit-list") ?>"> <?php echo display('deposit_list') ?> </a></li>
                        <li class="<?php echo ((@$segment_2 == "add-credit") ? "mm-active" : null) ?>"><a href="<?php echo base_url("admin/finance/add-credit") ?>"> <?php echo display('credit') ?> </a></li>
                        <li class="<?php echo ((@$segment_2 == "credit-list") ? "mm-active" : null) ?>"><a href="<?php echo base_url("admin/finance/credit-list") ?>"> <?php echo display('credit_list') ?> </a></li>
                    </ul>
                </li>
                
                <li class="treeview <?php echo (($segment_1 == "trade") ? "mm-active" : null) ?>">
                      <a class="has-arrow material-ripple" href="#">
                        <img class="pal15" height="25" width="25" src="<?php echo base_url('assets/images/icons/icon.png'); ?>"> <span><?php echo display('trade') ?></span>
                      </a> 
                      <ul class="nav-second-level">
                          <li class="<?php echo ((@$segment_2 == "open-order") ? "mm-active" : null) ?>"><a href="<?php echo base_url("admin/trade/open-order") ?>"> <?php echo display('open-order');?> </a></li>
                          <li class="<?php echo ((@$segment_2 == "trade-history") ? "mm-active" : null) ?>"><a href="<?php echo base_url("admin/trade/trade-history") ?>"> <?php echo display('trade-history');?> </a></li>
                      </ul>
                </li>

                <li class="treeview <?php echo (($segment_1 == "exchanger") ? "mm-active" : null) ?>">
                    <a class="has-arrow material-ripple" href="#">
                      <i class="hvr-buzz-out fas fa-exchange-alt"></i></i> <span><?php echo display('exchanger');?></span>
                    </a> 
                    <ul class="nav-second-level">
                       <li class="<?php echo (($segment_2 == "cryptocoin") ? "mm-active" : null) ?>"><a href="<?php echo base_url("admin/exchanger/cryptocoin") ?>"> <?php echo display('cryptocurrency') ?> </a></li>
                       <li class="<?php echo (($segment_2 == "market") ? "mm-active" : null) ?>"><a href="<?php echo base_url("admin/exchanger/market") ?>"> <?php echo display('market') ?> </a></li>
                       <li class="<?php echo (($segment_2 == "coin-pair") ? "mm-active" : null) ?>"><a href="<?php echo base_url("admin/exchanger/coin-pair") ?>"> <?php echo display('coin_pair') ?> </a></li>
                    </ul>
                </li>

                <li class="treeview <?php echo (($segment_1 == "user") ? "mm-active" : null) ?>">
                    <a class="has-arrow material-ripple" href="#">
                        <i class="fa fa-users"></i> <span><?php echo display('users') ?></span>
                    </a> 
                    <ul class="nav-second-level">
                        <li  class="<?php echo (($segment_2 == "add-user") ? "mm-active" : null) ?>"><a href="<?php echo base_url("admin/user/add-user") ?>"> <?php echo display('create_user');?> </a></li>
                        <li  class="<?php echo (($segment_2 == "user-list") ? "mm-active" : null) ?>"><a href="<?php echo base_url("admin/user/user-list") ?>"> <?php echo display('user_list') ?> </a></li>
                        <li  class="<?php echo (($segment_2 == "verify-user") ? "mm-active" : null) ?>"><a href="<?php echo base_url("admin/user/verify-user") ?>"> <?php echo display('verify-user');?> </a></li>
                        <li  class="<?php echo (($segment_2 == "subscriber-list") ? "mm-active" : null) ?>"><a href="<?php echo base_url("admin/user/subscriber-list") ?>"> <?php echo display('subscriber');?> </a></li>
                    </ul>
                </li>

                <li class="treeview <?php echo (($segment_1 == "setting" || $segment_1 == "language" || $segment_1 == "security" || $segment_4 == "fees-settings" || $segment_1 == "payment-gateway") || $segment_2 == "affiliation" || $segment_1 == "external-api-setup" ? "mm-active" : null) ?>">
                    <a class="has-arrow material-ripple" href="#">
                        <i class="fa fa ti-settings"></i> <span><?php echo display('setting') ?></span>
                    </a>
                    <ul class="nav-second-level">
                        <li class="<?php echo (($segment_2 == "app-setting") ? "mm-active" : null) ?>"><a href="<?php echo base_url("admin/setting/app-setting") ?>"> <?php echo display('app_setting') ?> </a></li> 
                        <li class="<?php echo (($segment_2 == "security") ? "mm-active" : null) ?>"><a href="<?php echo base_url("admin/setting/security") ?>"> <?php echo display('security');?></a></li>
                        <li class="<?php echo (($segment_2 == "fees-setting") ? "mm-active" : null) ?>"><a href="<?php echo base_url("admin/setting/fees-setting") ?>"> <?php echo display('fees_setting') ?> </a></li>
                        <li class="<?php echo (($segment_2 == "transaction-setup") ? "mm-active" : null) ?>"><a href="<?php echo base_url("admin/setting/transaction-setup") ?>"> <?php echo display('transaction-setup');?> </a></li>

                        <li class="<?php echo (($segment_2 == "email-gateway") ? "mm-active" : null) ?>"><a href="<?php echo base_url("admin/setting/email-gateway") ?>"> <?php echo display('email_gateway') ?> </a></li> 
                        <li class="<?php echo (($segment_2 == "sms-gateway") ? "mm-active" : null) ?>"><a href="<?php echo base_url("admin/setting/sms-gateway") ?>"> <?php echo display('sms_gateway');?> </a></li> 

                        <li class="<?php echo (($segment_2 == "email-sms-template") ? "mm-active" : null) ?>"><a href="<?php echo base_url("admin/setting/email-sms-template") ?>"> <?php echo display('email_sms_template') ?> </a></li> 

                        <li class="<?php echo (($segment_2 == "email-sms-settings") ? "mm-active" : null) ?>"><a href="<?php echo base_url("admin/setting/email-sms-settings") ?>"> <?php echo display('email_and_sms_setting');?> </a></li> 

                        <li class="<?php echo (($segment_2 == "language") ? "mm-active" : null) ?>"><a href="<?php echo base_url("admin/setting/language") ?>"> <?php echo display('language_setting') ?> </a></li> 
                        <li class="<?php echo (($segment_2 == "payment-gateway") ? "mm-active" : null) ?>"><a href="<?php echo base_url("admin/setting/payment-gateway") ?>"><?php echo display('payment_gateway') ?></a></li>
                        <li class="<?php echo (($segment_2 == "affiliation") ? "mm-active" : null) ?>"><a href="<?php echo base_url("admin/setting/affiliation") ?>"><?php echo display('affiliation-setup');?></a></li>
                        <li class="<?php echo (($segment_2 == "external-api-setup") ? "mm-active" : null) ?>"><a href="<?php echo base_url("admin/setting/external-api-list") ?>"> <?php echo display('external-api');?> </a></li>
                    </ul>
                </li>

                <li class="treeview <?php echo (($segment_1 == "admin") ? "mm-active" : null) ?>">
                    <a class="has-arrow material-ripple" href="#">
                      <i class="hvr-buzz-out fas fa-user-tie"></i><span><?php echo display('admin') ?></span>
                    </a> 
                    <ul class="nav-second-level">
                        <li class="<?php echo (($segment_1 == "add-admin") ? "mm-active" : null) ?>"><a href="<?php echo base_url("admin/add-admin") ?>"> <?php echo display('create_admin');?></a></li>
                        <li class="<?php echo (($segment_1 == "admin-list") ? "mm-active" : null) ?>"><a href="<?php echo base_url("admin/admin-list") ?>"> <?php echo display('admin_list') ?> </a></li>
                    </ul>
                </li>
                  
                <li class="treeview <?php echo (($segment_1 == "cms") ? "mm-active" : null) ?>">
                    <a class="has-arrow material-ripple" href="#">
                        <i class="hvr-buzz-out far fa-comment-alt"></i> <span><?php echo display('cms');?></span>
                    </a> 
                    <ul class="nav-second-level">
                        <li class="<?php echo (($segment_2 == "themes") ? "mm-active" : null) ?>"><a href="<?php echo base_url("admin/cms/themes-setting") ?>"><?php echo display('themes-setting');?></a></li>
                        <li class="<?php echo (($segment_2 == "page-content-list") ? "mm-active" : null) ?>"><a href="<?php echo base_url("admin/cms/page-content-list") ?>"><?php echo display('content') ?></a></li>
                        <li class="<?php echo (($segment_2 == "faq-list") ? "mm-active" : null) ?>"><a href="<?php echo base_url("admin/cms/faq-list") ?>"><?php echo display('faq') ?></a></li>
                        <li class="<?php echo (($segment_2 == "notice-list") ? "mm-active" : null) ?>"><a href="<?php echo base_url("admin/cms/notice-list") ?>"><?php echo display('notice');?></a></li>
                        <li class="<?php echo (($segment_2 == "news-list") ? "mm-active" : null) ?>"><a href="<?php echo base_url("admin/cms/news-list") ?>"><?php echo display('news') ?></a></li>
                        <li class="<?php echo (($segment_2 == "category-list") ? "mm-active" : null) ?>"><a href="<?php echo base_url("admin/cms/category-list") ?>"><?php echo display('category') ?></a></li>
                        <li class="<?php echo (($segment_2 == "slider-list") ? "mm-active" : null) ?>"><a href="<?php echo base_url("admin/cms/slider-list") ?>"><?php echo display('slider') ?></a></li>
                        <li class="<?php echo (($segment_2 == "social-link-list") ? "mm-active" : null) ?>"><a href="<?php echo base_url("admin/cms/social-link-list") ?>"><?php echo display('social_link') ?></a></li>
                        <li class="<?php echo (($segment_2 == "advertisement-list") ? "mm-active" : null) ?>"><a href="<?php echo base_url("admin/cms/advertisement-list") ?>"><?php echo display('advertisement') ?></a></li>
                        <li class="<?php echo (($segment_2 == "web-language-list") ? "mm-active" : null) ?>"><a href="<?php echo base_url("admin/cms/web-language-list") ?>"><?php echo display('language_setting') ?></a></li>
                    </ul> 
                </li>
                <li class="treeview <?php echo (($segment_1 == "addon") ? "mm-active" : null) ?>">
                    <a class="has-arrow material-ripple" href="#">
                      <i class="fas fa-share-alt-square"></i> <span><?php echo display('add-ons');?></span>
                    </a> 
                    <ul class="nav-second-level">
                      <li class="<?php echo (($segment_1 == "addon" && $segment_2 == "") ? "mm-active" : null) ?>"><a href="<?php echo base_url("admin/addon") ?>"><?php echo display('module');?></a></li>
                      <li class="<?php echo (($segment_2 == "theme") ? "mm-active" : null) ?>"><a href="<?php echo base_url("admin/addon/theme") ?>"><?php echo display('themes');?></a></li>
                    </ul> 
                </li>
                <li class="<?php echo (($segment_2 == "autoupdate") ? "mm-active" : null) ?>">
                  <a href="<?php echo base_url('admin/autoupdate/autoupdate') ?>"><i class="fa fa-magic"></i><span><?php echo display('update');?></span></a>
                </li>
                <li>
                  <a target="_blank" href="https://forum.bdtask.com/"><i class="fa fa-question-circle"></i><span><?php echo display('support');?></span></a>
                </li>
            </ul>
        </nav>
    </div><!-- sidebar-body -->
</nav>