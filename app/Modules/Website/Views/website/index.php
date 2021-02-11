<div class="header-slider header-slider-preloader" id="header-slider">
    <div id="banner_bg_effect" class="banner_effect"></div>
    <div class="animation-slide owl-carousel owl-theme" id="animation-slide">

    <?php 
    $i=0; 
    foreach ($slider as $key => $value) {
        $slide_h1 =  isset($lang) && $lang =="french"?$value->slider_h1_fr:$value->slider_h1_en;
        $slide_h2 =  isset($lang) && $lang =="french"?$value->slider_h2_fr:$value->slider_h2_en;
        $slide_h3 =  isset($lang) && $lang =="french"?$value->slider_h3_fr:$value->slider_h3_en;
        $custom_url = $value->custom_url;
    ?>
    <?php if ($i==0) { ?>
        <!-- Slide 1-->
        <div class="item slide-one" style="background-image: url(<?php echo base_url($value->slider_img); ?>)">
            <div class="slide-table">
                <div class="slide-tablecell">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="slide-text text-center">
                                    <h2><?php echo htmlspecialchars_decode($slide_h1); ?></h2>
                                    <p><?php echo htmlspecialchars_decode($slide_h2); ?></p>
                                    <div class="slide-buttons">
                                        <a href="<?php echo htmlspecialchars_decode($custom_url); ?>" class="slide-btn btn-kingfisher-daisy"><?php echo htmlspecialchars_decode($slide_h3); ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php } elseif ($i==1) { ?>
        <!-- Slide 2-->
        <div class="item slide-two" style="background-image: url(<?php echo base_url($value->slider_img); ?>)">
            <div class="slide-table">
                <div class="slide-tablecell">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="slide-text">
                                    <h2><?php echo htmlspecialchars_decode($slide_h1); ?></h2>
                                    <p><?php echo htmlspecialchars_decode($slide_h2); ?></p>
                                    <div class="slide-buttons">
                                        <a href="<?php echo htmlspecialchars_decode($custom_url); ?>" class="slide-btn btn-kingfisher-daisy"><?php echo htmlspecialchars_decode($slide_h3); ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php } else{ ?>
        <!-- Slide 3-->
        <div class="item slide-three" style="background-image: url(<?php echo base_url(esc($value->slider_img)); ?>)">
            <div class="slide-table">
                <div class="slide-tablecell">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="slide-text text-right">
                                    <h2><?php echo htmlspecialchars_decode($slide_h1); ?></h2>
                                    <p><?php echo htmlspecialchars_decode($slide_h2); ?></p>
                                    <div class="slide-buttons">
                                        <a href="#<?php echo htmlspecialchars_decode($custom_url); ?>" class="slide-btn btn-kingfisher-daisy"><?php echo htmlspecialchars_decode($slide_h3); ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    <?php }  $i++; } ?>



    </div>
    <!-- /.End of slider -->
    <!-- Preloader -->
    <div class="slider_preloader">
        <div class="slider_preloader_status">&nbsp;</div>
    </div>
</div>

<!-- /.End of tricker -->
<div class="price-spike">
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
<?php
    foreach ($article as $key => $value) {

$headline_home = isset($lang) && $lang =="french"?$value->headline_fr:$value->headline_en;
$article_home = isset($lang) && $lang =="french"?$value->article1_fr:$value->article1_en;
}
?>
                <div class="section_title">
                    <h3><?php echo htmlspecialchars_decode(@$headline_home) ?></h3>
                    <p><?php echo htmlspecialchars_decode(@$article_home) ?></p>
                </div>
            </div>
        </div>
        <div class="row">

            <?php foreach ($coin as $key => $value) { ?>
            <div class="col-sm-6 col-md-4 col-lg-3">
                <div class="imagine-card">
                    <div class="imagine-card-head">
                        <div class="imagine-card-logo">
                            <img src="<?php echo site_url(esc($value->image)); ?>" alt="<?php echo esc($value->full_name); ?>">
                        </div>
                        <div>
                            <div class="imagine-card-name"><?php echo esc($value->symbol); ?></div>
                            <div class="imagine-card-date"><?php echo esc($value->full_name); ?></div>
                        </div>
                    </div>
                    <div class="imagine-card-bottom">
                        <div class="imagine-card-chart">
                            <span class="bdtasksparkline value_graph" id="GRAPH_<?php echo esc($value->symbol); ?>"></span>
                        </div>
                        <div>
                            <div class="imagine-card-change">
                                <span class="Percent" id="CHANGE24HOURPCT_<?php echo esc($value->symbol); ?>"></span>
                                <div class="imagine-card-points">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>
<!--  ./End of price spike -->

<!-- /.End of live exchange -->
<div class="newslatter">
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="newslatter-text">
                    <h3><?php echo display('email_newslatter'); ?></h3>
                    <p><?php echo display('subscribe_to_our_newsletter'); ?></p>
                </div>
                <?php echo form_open('subscribe','id="subscribeForm"  class="newsletter-form" name="subscribeForm" '); ?>
                <div class="input-group newslatter-form">
                    <input type="email" name="subscribe_email"class="form-control" placeholder="example@mail.com" required>
                    <div class="input-group-append">
                        <button class="btn btn-kingfisher-daisy" type="submit"><?php echo display('submit') ?></button>
                    </div>
                </div>
                <?php echo form_close() ?>
            </div>
        </div>
    </div>
</div>
<!-- /.End of newslatter -->