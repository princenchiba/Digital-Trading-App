<?php
    $cat_title1  = isset($lang) && $lang =="french"?$cat_info->cat_title1_fr:$cat_info->cat_title1_en;
    $cat_title2  = isset($lang) && $lang =="french"?$cat_info->cat_title2_fr:$cat_info->cat_title2_en;

    $news_headline      =   isset($lang) && $lang =="french"?$news->headline_fr:$news->headline_en;
    $news_article1      =   isset($lang) && $lang =="french"?$news->article1_fr:$news->article1_en;
    $news_article_image =   $news->article_image;
    $publish_date       =   $news->publish_date;

?>
<div class="breadcrumb-content">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url('news') ?>"><?php echo display('news'); ?></a></li>
                <li class="breadcrumb-item active"><?php echo display('news_details'); ?></li>
            </ol>
        </nav>
    </div>
</div>
<!-- /.End of breadcrumb -->
<div class="blog_details_wrapper">
    <div class="container">
        <div class="row">
            <main class="col-md-8">
                <div class="post_details">
                    <header class="details-header">
                        <h2><?php echo esc($news_headline); ?></h2>
                        <div class="element-block">
                            <div class="post_meta">
                                <span class="post_date"><i class="far fa-clock"></i><time datetime="<?php echo $publish_date ?>"><?php 
                                $date=date_create($publish_date);
                                echo date_format($date,"jS, F Y"); 
                                ?></time></span>                                        
                            </div>
                        </div>
                    </header>
                    <figure>
                        <img class="img-fluid" src="<?php echo base_url($news_article_image); ?>" alt="<?php echo strip_tags($news_headline); ?>" class="aligncenter img-fluid">
                    </figure>
                    <?php echo htmlspecialchars_decode($news_article1); ?>
                </div>
                <!-- /.End of post details -->
                <?php
                foreach ($advertisement as $add_key => $add_value) { 
                    $ad_position   = $add_value->serial_position;
                    $ad_link       = $add_value->url;
                    $ad_script     = $add_value->script;
                    $ad_image      = $add_value->image;
                    $ad_name       = $add_value->name;
                    ?>

                    <?php if (@$ad_position == 4) { ?>
                        <div class="widget_banner">
                            <?php if ($ad_script=="") { ?>
                                <a target="_blank" href="<?php echo htmlspecialchars_decode($ad_link) ?> "><img src="<?php echo base_url($ad_image) ?>" class="img-fluid" alt="<?php echo strip_tags(esc($ad_name)) ?>"></a>
                            <?php } else { echo $ad_script; } ?>
                        </div><!-- /.End of banner -->
                    <?php } } ?>
                </main>
                <?php echo (!empty($content)?$content:null) ?>
            </div>
        </div>
    </div>