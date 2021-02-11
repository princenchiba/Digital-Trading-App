<?php

	$cat_title1  = isset($lang) && $lang =="french"?$cat_info->cat_title1_fr:$cat_info->cat_title1_en;
	$cat_title2  = isset($lang) && $lang =="french"?$cat_info->cat_title2_fr:$cat_info->cat_title2_en;
?>
<div class="page_header cryp_wrapper" data-parallax-bg-image="<?php echo base_url($cat_info->cat_image); ?>" data-parallax-direction="">
	<div id="banner_bg_effect" class="banner_effect"></div>
	<div class="header-content">
		<div class="container">
			<div class="row">
				<div class="col-md-8 offset-md-2">
					<div class="haeder-text">
						<h1><?php echo htmlspecialchars_decode($cat_title1); ?></h1>
						<p><?php echo htmlspecialchars_decode($cat_title2); ?></p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!--  /.End of page header -->
<?php
	if ($article) {

		foreach ($article as $key => $value) {
			$headline     =   isset($lang) && $lang =="french"?$value->headline_fr:$value->headline_en;
			$article1     =   isset($lang) && $lang =="french"?$value->article1_fr:$value->article1_en;
			$article2     =   isset($lang) && $lang =="french"?$value->article2_fr:$value->article2_en;
			$article_image=   $value->article_image;

		}
?>

	<div class="about_content">
		<div class="container">
			<div class="row about-text justify-content">
				<div class="col-md-12">
					<h3 class="mb-4"><?php echo htmlspecialchars_decode($headline); ?></h3>
					<img class="img-fluid" src="<?php echo site_url($article_image); ?>" alt="<?php echo strip_tags($headline); ?>">
					<p class="about_text">
					<?php echo htmlspecialchars_decode($article1); ?>
					<?php echo htmlspecialchars_decode($article2); ?></p>
				</div>
			</div>
		</div>
	</div>
	<!-- /.End of about content -->
	<?php } ?> 