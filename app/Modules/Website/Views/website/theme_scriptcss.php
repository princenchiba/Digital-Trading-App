<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<style type="text/css">
<?php
    $menu_bg_color      ='#03a9f4';
    $menu_font_color    ='#ffffff';
	$footer_bg_color 	='#0099de';
	$footer_font_color 	='#ffffff';
	$btn_bg_color 		='#03a9f4';
	$btn_font_color 	='#ffffff';
	$theme_color 		='#03a9f4';
	$newslatter_font 	='#ffffff';
	$newslatter_bg 		='#FAF7FF';
	$newslatter_img 	=base_url('assets/website/img/newslatter-bg.jpg');

	if ($theme) {
		$theme_data = json_decode($theme->settings, true);
        $menu_bg_color      = $theme_data['menu_bg_color']!=""?$theme_data['menu_bg_color']:$menu_bg_color;
        $menu_font_color    = $theme_data['menu_font_color']!=""?$theme_data['menu_font_color']:$menu_font_color;
		$footer_bg_color 	= $theme_data['footer_bg_color']!=""?$theme_data['footer_bg_color']:$footer_bg_color;
		$footer_font_color 	= $theme_data['footer_font_color']!=""?$theme_data['footer_font_color']:$footer_font_color;
		$btn_bg_color 		= $theme_data['btn_bg_color']!=""?$theme_data['btn_bg_color']:$btn_bg_color;
		$btn_font_color 	= $theme_data['btn_font_color']!=""?$theme_data['btn_font_color']:$btn_font_color;
		$theme_color 		= $theme_data['theme_color']!=""?$theme_data['theme_color']:$theme_color;
		$newslatter_font 	= $theme_data['newslatter_font']!=""?$theme_data['newslatter_font']:$newslatter_font;
		$newslatter_bg 		= $theme_data['newslatter_bg']!=""?$theme_data['newslatter_bg']:$newslatter_bg;
		$newslatter_img 	= base_url($theme_data['newslatter_img']);
	}
?>
</style>
