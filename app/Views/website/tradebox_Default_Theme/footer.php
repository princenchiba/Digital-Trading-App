<footer class="footer">
    <div class="primary-footer">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-scroll back-top" data-section="#top">
                        <i class="fas fa-chevron-up"></i>
                    </div>
                    <?php if ($social_link) { ?>                            
                        <ul class="social-link tt-animate ltr mt-20">
                            <?php foreach ($social_link as $key => $value) { ?>
                                <li><a href="<?php echo htmlspecialchars_decode($value->link); ?>"><i class="fab fa-<?php echo esc($value->icon); ?>"></i></a></li>
                            <?php } ?>
                        </ul>
                    <?php } ?>
                </div>
            </div>
            <hr class="mt-15">
            <div class="row justify-content-between">
                <div class="col-md-4">
                    <div class="footer-logo">
                        <img src="<?php echo base_url(esc($settings->logo_web)) ?>" class="img-fluid" alt="<?php echo esc($settings->title) ?>">
                        <p><?php echo htmlspecialchars_decode($settings->description) ?></p>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="row">
                        <div class="col-6 col-sm-4 col-md-4">
                            <div class="link-widgets">
                                <h5 class="link-title"><?php echo display('useful_links');?></h5>
                                <ul>
                                    <?php
                                        foreach ($category as $cat_key => $cat_value) {
                                            if ($cat_value->menu==2 || $cat_value->menu==3) { 
                                               $cat_name = isset($lang) && $lang =="french"?$cat_value->cat_name_fr:$cat_value->cat_name_en;
                                               $cat_slug = $cat_value->slug;
                                               ?>
                                               <li><a href="<?php echo base_url('otherpage/'.$cat_slug); ?>"><?php echo  esc($cat_name) ?></a></li>
                                               <?php
                                           }                               
                                       }
                                   ?>
                                    <li><a href="<?php echo base_url('contact') ?>">Contact</a></li>
                               </ul>
                           </div>
                       </div>
                       <div class="col-6 col-sm-4 col-md-4">
                        <div class="link-widgets">
                            <h5 class="link-title"><?php echo display('pages');?></h5>
                            <ul>
                                <li><a href="<?php echo base_url('news') ?>"><?php echo display('news') ?></a></li>
                                <li><a href="<?php echo base_url('login'); ?>"><?php echo display('login') ?></a></li>
                                <li><a href="<?php echo base_url('register'); ?>"><?php echo display('register') ?></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-12 col-sm-4 col-md-4">
                        <div class="link-widgets">
                            <?php if ($social_link) { ?>
                                <h5 class="link-title"><?php echo display('footer_menu3') ?></h5>
                                <ul>
                                    <?php   foreach ($social_link as $key => $value) { ?>
                                        <li><a href="<?php echo htmlspecialchars_decode($value->link); ?>"><i class="fab fa-<?php echo esc($value->icon); ?>"></i> <?php echo esc($value->name); ?></a></li>
                                    <?php } ?>
                                </ul>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!-- /.primary-footer -->
<div class="secondary-footer">
    <div class="container">
        <div class="row justify-content-between align-items-center">
            <div class="col-md-10">
                <p class="footer-copyright"><?php echo esc($settings->footer_text); ?></a></p>
            </div>
            <div class="col-md-2">
                <div class="language">
                    <select class="custom-select" id="lang-change" data-width="fit">
                        <option value="english" <?php echo isset($lang) && $lang =="english"?'Selected':''; ?>>English</option>
                        <option value="french" <?php echo isset($lang) && $lang =="french"?'Selected':''; ?>><?php echo esc($web_language->name); ?></option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div><!-- /.secondary-footer -->
</footer><!-- /.End of footer -->
<!-- Optional JavaScript -->
<?php
    $request = \Config\Services::request();
    $home_menu = $request->uri->setSilent()->getSegment(1);
?>
<script src="<?php echo base_url('assets/website/js/vendors.bundle.min.js'); ?>"></script>
<?php if ($request->uri->setSilent()->getSegment(1) == '' || @$request->uri->setSilent()->getSegment(1) == 'coinmarket') { ?>
    <script src="<?php echo base_url("assets/website/js/angular.min.js"); ?>"></script>
    <script src="<?php echo base_url("assets/website/js/socket.io.js"); ?>"></script>
    <script src="<?php echo base_url("assets/website/js/ccc-streamer-utilities.js"); ?>"></script>
    <script src="<?php echo base_url('assets/js/sparkline.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/website/streamer/streammyjs.js?v=1');?>"></script>
<?php } ?>
<!-- sweetalert and toastr -->
<script src="<?php echo base_url('assets/js/sweetalert/sweetalert.min.js')?>"></script>
<script src="<?php echo base_url('assets/website/js/toastr.js')?>"></script>
<!-- Custom js -->
<script src="<?php echo base_url('assets/website/js/script.js') ?>"></script>
<script src="<?php echo base_url('assets/website/js/custom.js') ?>"></script>
<?php if ($request->uri->setSilent()->getSegment(1) == 'contact') { ?>
    <script src="<?php echo base_url('assets/website/js/contact.js?v=2'); ?>"></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=<?php echo $map_api->api_key; ?>" type="text/javascript"></script>
<?php } ?>
<?php 
    if ($request->uri->setSilent()->getSegment(1) == '' OR $request->uri->setSilent()->getSegment(1) == 'profile') {
        if(!empty($session->get('message'))) echo $session->get('message'); 
        if(!empty($session->get('exception'))) echo $session->get('exception'); 
    }
?>
</body>
</html>