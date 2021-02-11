<div class="blog_wrapper">
<div class="container">
    <div class="row">
        <main class="col-sm-8">
            <?php
                foreach ($advertisement as $add_key => $add_value) { 
                    $ad_position   = $add_value->serial_position;
                    $ad_link       = $add_value->url;
                    $ad_script     = $add_value->script;
                    $ad_image      = $add_value->image;
                    $ad_name      = $add_value->name;
           ?>

                <?php if (@$ad_position==3) { ?>
                    <div class="widget_banner">
                        <?php if ($ad_script=="") { ?>
                            <a target="_blank" href="<?php echo $ad_link ?> "><img src="<?php echo base_url($ad_image) ?>" class="img-fluid" alt="<?php echo strip_tags($ad_name) ?>"></a>
                        <?php } else { echo esc($ad_script); } ?>
                    </div><!-- /.End of banner -->
                <?php } } ?>



                <?php  
                    foreach ($news as $news_key => $news_value) {
                        $article_id         =   $news_value->article_id;
                        $cat_id             =   $news_value->cat_id;
                        $slug               =   $news_value->slug;
                        $news_headline      =   isset($lang) && $lang =="french"?$news_value->headline_fr:$news_value->headline_en;
                        $news_article1      =   isset($lang) && $lang =="french"?$news_value->article1_fr:$news_value->article1_en;
                        $news_article_image =   $news_value->article_image;
                        $publish_date       =   $news_value->publish_date;

                        $cat_slug = $db->table('web_category')->select("slug, cat_name_en, cat_name_fr")->where('cat_id', $cat_id)->get()->getRow();
                        $cat_name      =   isset($lang) && $lang =="french"?$cat_slug->cat_name_fr:$cat_slug->cat_name_en;
                ?>

                    <div class="post post_list post_list_lg">
                        <div class="post_img">
                            <a href="<?php echo base_url('news/'.$cat_slug->slug."/$slug"); ?>"><img src="<?php echo base_url($news_article_image); ?>" alt="<?php echo strip_tags($news_headline); ?>"></a>
                        </div>
                        <div class="post_body">
                            <h3 class="post_heading"><a href="<?php echo base_url('news/'.$cat_slug->slug."/$slug"); ?>"><?php echo strip_tags(esc($news_headline)); ?></a></h3>
                            <p><?php echo substr(strip_tags(htmlspecialchars_decode($news_article1)), 0, 110); ?></p>
                            <div class="d-flex align-items-center">
                                <div class="avatar-img">
                                    <img src="<?php echo base_url($news_article_image); ?>" class="" alt="">
                                </div>
                                <div class="meta-info">
                                    <span class="date"><?php
                                    $date = date_create(esc($publish_date));
                                    echo date_format($date,"jS, F Y");
                                    ?></span>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.End of post list -->
                    <?php } ?>
                <?php echo htmlspecialchars_decode($pager); ?>
                <!-- /.End of more post button -->
            </main>
            <?php echo (!empty($content)?$content:null) ?>
        </div>
    </div>
</div>