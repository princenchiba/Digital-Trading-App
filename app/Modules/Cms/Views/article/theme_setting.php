
<?php
    $body_background_color              = '#03a9f4';
    $body_font_color                    = '#03a9f4';
    $menu_bg_color                      = '#03a9f4';
    $menu_font_color                    = '#ffffff';
    $footer_bg_color                    = '#0099de';
    $footer_font_color                  = '#ffffff';
    $top_footer_horizontal_border_color = '#ffffff';
    $footer_menu_border_color           = '#ffffff';
    $bottom_footer_background_color     = '#ffffff';
    $bottom_footer_font_color           = '#ffffff';
    $btn_bg_color                       = '#03a9f4';
    $btn_font_color                     = '#ffffff';
    $theme_color                        = '#03a9f4';
    $newslatter_font                    = '#ffffff';
    $newslatter_bg                      = '#FAF7FF';
    $form_background_color              = '#000';
    $form_border_color                  = '#90979e';
    $form_label_color                   = '#FFF';
    $form_input_field_background_color  = '#000';
    $input_field_border_color           = '#000';
    $input_field_color                  = '#000';
    $newslatter_img = base_url('assets/website/img/newslatter-bg.jpg');

    if ($theme)
    {
        $theme_data = json_decode($theme->settings, true);

        $body_background_color              = $theme_data['body_background_color'] != "" ? $theme_data['body_background_color'] : $body_background_color;
        $body_font_color                    = $theme_data['body_font_color'] != "" ? $theme_data['body_font_color'] : $body_font_color;
        $menu_bg_color                      = $theme_data['menu_bg_color'] != "" ? $theme_data['menu_bg_color'] : $menu_bg_color;
        $menu_font_color                    = $theme_data['menu_font_color'] != "" ? $theme_data['menu_font_color'] : $menu_font_color;
        $footer_bg_color                    = $theme_data['footer_bg_color'] != "" ? $theme_data['footer_bg_color'] : $footer_bg_color;
        $footer_font_color                  = $theme_data['footer_font_color'] != "" ? $theme_data['footer_font_color'] : $footer_font_color;
        $btn_bg_color                       = $theme_data['btn_bg_color'] != "" ? $theme_data['btn_bg_color'] : $btn_bg_color;
        $btn_font_color                     = $theme_data['btn_font_color'] != "" ? $theme_data['btn_font_color'] : $btn_font_color;
        $top_footer_horizontal_border_color = $theme_data['top_footer_horizontal_border_color'] != "" ? $theme_data['top_footer_horizontal_border_color'] : $top_footer_horizontal_border_color;
        $footer_menu_border_color           = $theme_data['footer_menu_border_color'] != "" ? $theme_data['footer_menu_border_color'] : $footer_menu_border_color;
        $bottom_footer_background_color     = $theme_data['bottom_footer_background_color'] != "" ? $theme_data['bottom_footer_background_color'] : $bottom_footer_background_color;
        $bottom_footer_font_color           = $theme_data['bottom_footer_font_color'] != "" ? $theme_data['bottom_footer_font_color'] : $bottom_footer_font_color;
        $theme_color                        = $theme_data['theme_color'] != "" ? $theme_data['theme_color'] : $theme_color;
        $newslatter_font                    = $theme_data['newslatter_font'] != "" ? $theme_data['newslatter_font'] : $newslatter_font;
        $newslatter_bg                      = $theme_data['newslatter_bg'] != "" ? $theme_data['newslatter_bg'] : $newslatter_bg;
        $form_background_color              = $theme_data['form_background_color'] != "" ? $theme_data['form_background_color'] : $form_background_color;
        $form_border_color                  = $theme_data['form_border_color'] != "" ? $theme_data['form_border_color'] : $form_border_color;
        $form_label_color                   = $theme_data['form_label_color'] != "" ? $theme_data['form_label_color'] : $form_label_color;
        $form_input_field_background_color  = $theme_data['form_input_field_background_color'] != "" ? $theme_data['form_input_field_background_color'] : $form_input_field_background_color;
        $input_field_border_color           = $theme_data['input_field_border_color'] != "" ? $theme_data['input_field_border_color'] : $input_field_border_color;
        $input_field_color                  = $theme_data['input_field_color'] != "" ? $theme_data['input_field_color'] : $input_field_color;
        $newslatter_img                     = base_url($theme_data['newslatter_img']);
    }
?>

<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="fs-17 font-weight-600 mb-0"></h6>
                    </div>
                    <div class="text-right">
                        <div class="actions">
                            <a href="#" class="action-item"></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <?php echo form_open_multipart('admin/cms/themes-setting'); ?>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label font-weight-600"><?php echo display('body_background_color');?><i class="text-danger">*</i></label>
                                <div class="col-sm-5">
                                    <input name="body_background_color" class="form-control" value="<?php echo esc(@$body_background_color);?>" type="color" id="body_background_color">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label font-weight-600"><?php echo display('body_font_color');?><i class="text-danger">*</i></label>
                                <div class="col-sm-5">
                                    <input name="body_font_color" class="form-control" value="<?php echo esc(@$body_font_color);?>" type="color" id="body_font_color">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label font-weight-600"><?php echo display('menu_background_color');?><i class="text-danger">*</i></label>
                                <div class="col-sm-5">
                                    <input name="menu_bg_color" class="form-control" value="<?php echo esc($menu_bg_color);?>" type="color" id="menu_bg_color">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label font-weight-600"><?php echo display('menu_font_color');?><i class="text-danger">*</i></label>
                                <div class="col-sm-5">
                                    <input name="menu_font_color" class="form-control" value="<?php echo esc($menu_font_color);?>" type="color" id="menu_font_color">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label font-weight-600"><?php echo display('footer_background_color');?><i class="text-danger">*</i></label>
                                <div class="col-sm-5">
                                    <input name="footer_bg_color" class="form-control" value="<?php echo esc($footer_bg_color);?>" type="color" id="footer_bg_color">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label font-weight-600"><?php echo display('footer_font_color');?><i class="text-danger">*</i></label>
                                <div class="col-sm-5">
                                    <input name="footer_font_color" class="form-control" value="<?php echo esc(@$footer_font_color);?>" type="color" id="footer_font_color">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label font-weight-600"><?php echo display('top_footer_horizontal_border_color');?><i class="text-danger">*</i></label>
                                <div class="col-sm-5">
                                    <input name="top_footer_horizontal_border_color" class="form-control" value="<?php echo esc($top_footer_horizontal_border_color);?>" type="color" id="top_footer_horizontal_border_color">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label font-weight-600"><?php echo display('footer_menu_border_color');?><i class="text-danger">*</i></label>
                                <div class="col-sm-5">
                                    <input name="footer_menu_border_color" class="form-control" value="<?php echo esc($footer_menu_border_color);?>" type="color" id="footer_menu_border_color">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label font-weight-600"><?php echo display('bottom_footer_background_color');?><i class="text-danger">*</i></label>
                                <div class="col-sm-5">
                                    <input name="bottom_footer_background_color" class="form-control" value="<?php echo esc($bottom_footer_background_color);?>" type="color" id="bottom_footer_background_color">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label font-weight-600"></label>
                                <div class="col-sm-5">
                                    <?php if(!empty($newslatter_img)){ ?>
                                        <img width="100" src="<?php echo esc($newslatter_img);?>">
                                    <?php } else { ?>
                                        <img width="100" src="<?php echo base_url('assets/website/img/newslatter-bg.jpg');?>">
                                    <?php }?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"><?php echo display('newsletter_images');?><i class="text-danger">*</i></label>
                                <div class="col-sm-5">
                                    <input name="newslatter_img" class="form-control" type="file" id="newslatter_img" value="">
                                    <input type='hidden' name='newslatter_img_old' value='<?php echo @$theme_data['newslatter_img']; ?>'>
                                </div>
                            </div>
                            <div class="form-group row">
                                 <label class="col-sm-3 col-form-label font-weight-600"></label>
                                <div class="col-sm-8">
                                    <button type="submit" class="btn btn-success"><?php echo display('update');?></button>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label font-weight-600"><?php echo display('bottom_footer_font_color');?><i class="text-danger">*</i></label>
                                <div class="col-sm-5">
                                    <input name="bottom_footer_font_color" class="form-control" value="<?php echo esc($bottom_footer_font_color);?>" type="color" id="bottom_footer_font_color">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label font-weight-600"><?php echo display('button_background_color');?><i class="text-danger">*</i></label>
                                <div class="col-sm-5">
                                    <input name="btn_bg_color" class="form-control" value="<?php echo esc($btn_bg_color);?>" type="color" id="btn_bg_color">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label font-weight-600"><?php echo display('button_font_color');?><i class="text-danger">*</i></label>
                                <div class="col-sm-5">
                                    <input name="btn_font_color" class="form-control" value="<?php echo esc($btn_font_color);?>" type="color" id="btn_font_color">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label font-weight-600"><?php echo display('form_background_color');?><i class="text-danger">*</i></label>
                                <div class="col-sm-5">
                                    <input name="form_background_color" class="form-control" value="<?php echo esc($form_background_color);?>" type="color" id="form_background_color">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label font-weight-600"><?php echo display('form_border_color');?><i class="text-danger">*</i></label>
                                <div class="col-sm-5">
                                    <input name="form_border_color" class="form-control" value="<?php echo esc($form_border_color);?>" type="color" id="form_border_color">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label font-weight-600"><?php echo display('form_label_color');?><i class="text-danger">*</i></label>
                                <div class="col-sm-5">
                                    <input name="form_label_color" class="form-control" value="<?php echo esc($form_label_color);?>" type="color" id="form_label_color">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label font-weight-600"><?php echo display('form_input_field_background_color');?><i class="text-danger">*</i></label>
                                <div class="col-sm-5">
                                    <input name="form_input_field_background_color" class="form-control" value="<?php echo esc($form_input_field_background_color);?>" type="color" id="form_input_field_background_color">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label font-weight-600"><?php echo display('input_field_border_color');?><i class="text-danger">*</i></label>
                                <div class="col-sm-5">
                                    <input name="input_field_border_color" class="form-control" value="<?php echo esc($input_field_border_color);?>" type="color" id="input_field_border_color">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label font-weight-600"><?php echo display('input_field_color');?><i class="text-danger">*</i></label>
                                <div class="col-sm-5">
                                    <input name="input_field_color" class="form-control" value="<?php echo esc($input_field_color);?>" type="color" id="input_field_color">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label font-weight-600"><?php echo display('theme_color');?><i class="text-danger">*</i></label>
                                <div class="col-sm-5">
                                    <input name="theme_color" class="form-control" value="<?php echo esc($theme_color);?>" type="color" id="theme_color">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label font-weight-600"><?php echo display('newsletter_background_color');?><i class="text-danger">*</i></label>
                                <div class="col-sm-5">
                                    <input name="newslatter_bg" class="form-control" value="<?php echo esc($newslatter_bg);?>" type="color" id="newslatter_bg">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label font-weight-600"><?php echo display('newsletter_font_color');?><i class="text-danger">*</i></label>
                                <div class="col-sm-5">
                                    <input name="newslatter_font" class="form-control" value="<?php echo esc($newslatter_font);?>" type="color" id="newslatter_font">
                                </div>
                            </div>
                        </div>
                    </div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>