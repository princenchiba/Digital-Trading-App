    <div class="container contactPage-content">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-12 col-lg-7">
                <div class="contect-des">
                    <div class="contact-header">
                        <h2><span class="headline"><?php echo display('contact_with_us');?></span></h2>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-md-6 col-lg-6">
                            <div class="media contact-service">
                                <i class="fas fa-map-marker-alt fa-3x"></i>&nbsp;
                                <div class="media-body">
                                    <h4 class="mt-0"><?php echo display('address');?></h4>
                                    <div><?php echo esc(@$settings->description); ?></div>
                                </div>
                            </div>
                            <div class="media contact-service">
                                <i class="far fa-clock fa-3x"></i>&nbsp;
                                <div class="media-body">
                                    <h4><?php echo display('working_hours');?></h4>
                                    <div>
                                        <?php echo htmlspecialchars_decode(@$settings->office_time); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6">
                            <div class="media contact-service">
                                <i class="far fa-envelope fa-3x"></i>&nbsp;
                                <div class="media-body">
                                    <h4><?php echo display('email_address');?></h4>
                                    <div><?php echo esc($settings->email);?></div>
                                </div>
                            </div>
                            <div class="media contact-service">
                                <i class="fas fa-phone fa-3x"></i>&nbsp;
                                <div class="media-body">
                                    <h4><?php echo display('phone_number');?></h4>
                                    <div><?php echo htmlspecialchars_decode(@$settings->phone); ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-5">
                <div class="map-content">
                    <div id="map"></div>
                </div>
                <!-- /.End of map content -->
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="contact-form form-design">
                    <?php echo form_open('home/contactMsg','id="contactForm"  class="contact_form" name="contactForm"'); ?>
                    <h3>Let's Talk!</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><?php echo display('firstname'); ?> <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter your First Name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><?php echo display('lastname'); ?></label>
                                <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter Your Last Name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><?php echo display('email'); ?> <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="email" name="email" placeholder="Enter Your Email" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><?php echo display('phone'); ?> <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone Number">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label><?php echo display('comments'); ?> <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="comment" name="comment" placeholder="Your Comment" rows="5" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-kingfisher-daisy"><?php echo display('submit') ?></button>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>

<!-- /.End of contact content -->