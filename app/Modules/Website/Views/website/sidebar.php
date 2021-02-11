<aside class="col-sm-4 p_l_40">
<?php if ($recentnews) { ?>

    <div class="widget">
        <h4 class="widget_title"><?php echo display('recent_post'); ?></h4>

        <?php  
        $request = \Config\Services::request();
        foreach ($recentnews as $news_key => $news_value) {
            $article_id         =   $news_value->article_id;
            $cat_id             =   $news_value->cat_id;
            $slug               =   esc($news_value->slug);
            $news_headline      =   isset($lang) && $lang =="french"?$news_value->headline_fr:$news_value->headline_en;
            $news_article1      =   isset($lang) && $lang =="french"?$news_value->article1_fr:$news_value->article1_en;
            $news_article_image =   $news_value->article_image;
            $publish_date       =   $news_value->publish_date;

            $cat_slug = $db->table('web_category')->select("slug, cat_name_en, cat_name_fr")->where('cat_id', $cat_id)->get()->getRow();
            $cat_name = isset($lang) && $lang =="french"?$cat_slug->cat_name_fr:$cat_slug->cat_name_en;
        ?>
            <div class="post post_list post_list_sm">
                <div class="post_img">
                    <a href="<?php echo base_url($request->uri->setSilent()->getSegment(1).'/'.esc($cat_slug->slug)."/$slug"); ?>"><img src="<?php echo base_url($news_article_image); ?>" alt="<?php echo strip_tags($news_headline); ?>"></a>
                </div>
                <div class="post_body">
                    <h4 class="post_heading"><a href="<?php echo base_url($request->uri->setSilent()->getSegment(1).'/'.$cat_slug->slug."/$slug"); ?>"><?php echo strip_tags(esc($news_headline)); ?></a></h4>
                    <div class="post_meta">
                        <span class="post_date"><i class="fa fa-calendar-o"></i><time datetime="<?php echo $publish_date ?>">
                            <?php
                                $date = date_create(esc($publish_date));
                                echo date_format($date,"jS, F Y");
                            ?>                                            
                        </time></span>
                    </div>
                </div>
            </div><!-- End of post list -->
        <?php } ?>
    </div><!--   /.End of recent post -->

<?php } ?>

<?php if ($social_link) { ?>
    <div class="widget">
        <h4 class="widget_title"><?php echo display('my_social_link'); ?></h4>
        <div class="social_icon">
            <?php foreach ($social_link as $key => $value) { ?>
                <a href="<?php echo htmlspecialchars_decode($value->link); ?>" class="<?php echo esc($value->icon); ?>"><i class="fab fa-<?php echo esc($value->icon); ?>"></i></a>
            <?php } ?>
        </div>
    </div><!-- /.End of social link -->
<?php } ?>
<?php

    foreach ($advertisement as $add_key => $add_value) { 

            $ad_position   = $add_value->serial_position;
            $ad_link       = $add_value->url;
            $ad_script     = $add_value->script;
            $ad_image      = $add_value->image;
            $ad_name       = $add_value->name;                            
?>

<?php if (@$ad_position == 1) { ?>
    <div class="widget">
        <div class="widget_banner">
            <?php if ($ad_script=="") { ?>
                <a target="_blank" href="<?php echo $ad_link ?> "><img src="<?php echo base_url(esc($ad_image)) ?>" class="img-fluid" alt="<?php echo strip_tags(esc($ad_name)) ?>"></a>
            <?php } else { echo htmlspecialchars_decode($ad_script); } ?>
        </div>
    </div><!-- /.End of banner -->
<?php } } ?>

<?php if ($newscat) { ?>
    <div class="widget">
        <h4 class="widget_title"><?php echo display('category'); ?></h4>
        <ul class="widget_category">
            <?php
            foreach ($newscat as $key => $value) {
                $newscatname_list  = isset($lang) && $lang =="french"?$value->cat_name_fr:$value->cat_name_en;
                $newscatslug  = $value->slug;
                ?>
                <li><a href="<?php echo base_url("news/$newscatslug") ?>"><span>#</span><?php echo esc($newscatname_list); ?></a></li>
            <?php } ?>
        </ul>
    </div><!-- /.End of category -->
<?php } ?>


<?php
    foreach ($advertisement as $add_key => $add_value) { 
        $ad_position   = $add_value->serial_position;
        $ad_link       = $add_value->url;
        $ad_script     = $add_value->script;
        $ad_image      = $add_value->image;
        $ad_name       = $add_value->name;                            
?>

    <?php if (@$ad_position == 2) { ?>
        <div class="widget">
            <div class="widget_banner">
                <?php if ($ad_script=="") { ?>
                    <a target="_blank" href="<?php echo htmlspecialchars_decode($ad_link) ?> "><img src="<?php echo base_url(esc($ad_image)) ?>" class="img-responsive center-block" alt="<?php echo strip_tags(esc($ad_name)) ?>"></a>
                <?php } else { echo htmlspecialchars_decode($ad_script); } ?>
            </div>
        </div><!-- /.End of banner -->
    <?php } } ?>

</aside>