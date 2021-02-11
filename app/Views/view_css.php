<style {csp-style-nonce}>
	<?php
		if(empty($theme->newslatter_img)){
			$newslatter_img = base_url('assets/website/img/newslatter-bg.jpg');
		} else {
			$newslatter_img = base_url($theme->newslatter_img);
		}
	?>
	.section_title h3 span {
	    color: <?php echo @$theme->menu_bg_color;  ?>;
	}
	/* footer font color*/
    .navbar-dark .navbar-nav .nav-link {
        color: <?php echo @$theme->menu_font_color; ?>!important;
    }
    .dropdown-menu {
	    background-color: <?php echo @$theme->menu_bg_color;  ?>;
	    border: 1px solid <?php echo @$theme->menu_bg_color;  ?>;
	}
	.dropdown-item {
	    color: <?php echo @$theme->menu_font_color; ?>;
	}
	.page-scroll {
	    color: <?php echo @$theme->footer_font_color;  ?>;	
	}
	.footer .social-link li a i {
		color: <?php echo @$theme->footer_font_color;  ?>;
	}
	.footer p {
    	color: <?php echo @$theme->footer_font_color;  ?>;
	}
	.link-widgets .link-title {
	    color: <?php echo @$theme->footer_font_color;  ?>;
	}
	.link-widgets ul li a {
	    color: <?php echo @$theme->footer_font_color;  ?>;
	}
	/* footer background color*/
	.page-scroll {
	    background-color: <?php echo @$theme->footer_bg_color;  ?>;
	}
	.footer {
		background: <?php echo @$theme->footer_bg_color;  ?>;
	}
	/*Button primary color*/	
	.btn-kingfisher-daisy {
	    background-color: <?php echo @$theme->btn_bg_color;  ?>;
	    border-color: <?php echo @$theme->btn_bg_color;  ?>;
	    color: <?php echo @$theme->btn_font_color;  ?>;
	}
	.btn-kingfisher-daisy:hover{
	    background-color: <?php echo @$theme->btn_bg_color;  ?>;
	    border-color: <?php echo @$theme->btn_bg_color;  ?>;
	}
	.newslatter-form .btn {
	    background-color:<?php echo @$theme->btn_bg_color;  ?>;
	    color: <?php echo @$theme->btn_font_color;  ?>;
	    border-color: <?php echo @$theme->btn_bg_color;  ?>;
	}
	.nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
	    background-color: <?php echo @$theme->btn_bg_color;  ?>;
	    border: 1px solid <?php echo @$theme->btn_bg_color;  ?>;
	}
	.animation-slide.owl-theme .owl-nav .owl-next:hover {
	    -webkit-box-shadow: -100px 0 0 <?php echo @$theme->btn_bg_color;  ?> inset;
	}
	/*btn font color*/
	.btn-kingfisher-daisy:hover{
	    color: <?php echo @$theme->btn_font_color;  ?>;
	}
	.nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
	    color: <?php echo @$theme->btn_font_color;  ?>;
	}
	/*Theme color*/
	.section_title h3 span {
	    color: <?php echo @$theme->theme_color;  ?>;
	}
	.coin-name {
	    border-left: 6px solid <?php echo @$theme->theme_color;  ?>;
	}
	.coin-name h5 {
	    color: <?php echo @$theme->theme_color;  ?>;
	}
	.content-title {
	    border-left: 6px solid <?php echo @$theme->theme_color;  ?>;
	}
	.post-date {
	    color: <?php echo @$theme->theme_color;  ?>;
	}	
    .notices .card-header{
        background-color:  <?php echo @$theme->theme_color;  ?>;
        color: <?php echo @$theme->btn_font_color;  ?>;
    }
    .widget_title::before {

        background-color: <?php echo @$theme->theme_color;  ?>;
    }
    .widget_category li span {
        color: <?php echo @$theme->body_font_color;  ?>;
    }
    .breadcrumb-item + .breadcrumb-item::before{
        border-left-color: <?php echo @$theme->theme_color;  ?>;
    }
    .amChartsButton, .amChartsButtonSelected {
        background-color: <?php echo @$theme->theme_color;  ?>!important;
    }
    a {
        color: <?php echo @$theme->theme_color;  ?>;
    }
    a:hover {
        color: <?php echo @$theme->theme_color;  ?>;
    }
	.newslatter {
	    color: <?php echo @$theme->newslatter_font;  ?>;
	    background-color: <?php echo @$theme->newslatter_bg; ?>;
	    background-attachment: fixed;
	    background-image: url(<?php echo @$newslatter_img; ?>);
	}
	.newslatter p{
	    color: <?php echo @$theme->newslatter_font;  ?>;
	}
	.navbar-dark .navbar-nav .nav-link {
	    border-right: 1px solid <?php echo @$theme->menu_bg_color;  ?>;
	}
	.bg-kingfisher-daisy {
        background-color: <?php echo @$theme->menu_bg_color; ?>;
        border-bottom:1px solid <?php echo @$theme->menu_bg_color;  ?>;
    }
	.footer hr {
	    border-top: 1px solid <?php echo @$theme->top_footer_horizontal_border_color;  ?>;
	}
	.link-widgets .link-title {
	    border-bottom: 1px solid <?php echo @$theme->footer_menu_border_color;  ?>;
	}
	.secondary-footer {
	    background: <?php echo @$theme->bottom_footer_background_color; ?>;
	}
	.secondary-footer p{
	    color: <?php echo @$theme->bottom_footer_font_color; ?>;
	}
	.form-design h3{
		color: <?php echo @$theme->form_label_color; ?>;
	}
	.form-design label{
		color: <?php echo @$theme->form_label_color; ?>;
	}
	.bio-info dd{
		color: <?php echo @$theme->menu_font_color; ?>;
	}
	.bio-info dt{
		color: <?php echo @$theme->menu_font_color; ?>;
	}
	.confirm-withdraw dl dd{
		color: <?php echo @$theme->body_font_color; ?>;
	}
	.confirm-withdraw dl dt{
		color: <?php echo @$theme->body_font_color; ?>;
	}
	.breadcrumb-content {
	    background-color: <?php echo @$theme->body_background_color; ?>;
	}
	.breadcrumb li a {
	    color: <?php echo @$theme->body_font_color; ?>;
	}
	.breadcrumb-item.active {
	    color: <?php echo @$theme->body_font_color; ?>;
	}
	.breadcrumb-item + .breadcrumb-item::before {
	    border-left-color: <?php echo @$theme->body_font_color; ?>;
	}
	.form-control {
	    border-radius: 0;
	    height: 35px;
	    background-color: <?php echo @$theme->form_input_field_background_color; ?>;
	    border-color: <?php echo @$theme->input_field_border_color;  ?>;
	    color: <?php echo @$theme->input_field_color; ?>; 
	}
	.form-control:focus {
	    background-color: <?php echo @$theme->form_input_field_background_color; ?>;
	}
	.form-content {
	    background:  <?php echo @$theme->form_background_color; ?>;
	    border: 1px solid <?php echo @$theme->form_border_color;  ?>;
	    background-image: none;
	    box-shadow: none;
	}
	.content-title {
	    border-left: 6px solid <?php echo @$theme->menu_font_color; ?>;
	}
	.content-title h4{
	    color: <?php echo @$theme->menu_font_color; ?>;
	}
	.table-bg {
	    background-color: <?php echo @$theme->menu_bg_color;  ?>;
	    height: 50px;
	}
	.table thead th {
	    vertical-align: middle;
	    border: 1px solid <?php echo @$theme->footer_menu_border_color;  ?>;
	}
	.profile-table .table th, .payment-process .table th {
	    background-color: <?php echo @$theme->menu_bg_color;  ?>;
	}
	.table td, .table th {
	    vertical-align: middle;
	}
	.table {
	    color: <?php echo @$theme->menu_font_color; ?>;
	}
	.table-bordered th, .table-bordered td {
	    border: 1px solid <?php echo @$theme->footer_menu_border_color;  ?>;
	}
	.history-table {
	    border: 1px solid <?php echo @$theme->footer_menu_border_color;  ?>;
	}
	.post_heading a{
		color: <?php echo @$theme->body_font_color; ?>;
	}
	.post_body p {
	    color:<?php echo @$theme->form_label_color; ?>;
	}
	.widget_title{
	    color:<?php echo @$theme->body_font_color; ?>;
	}
	.widget_category li a {
	    color: <?php echo @$theme->body_font_color; ?>;
	}
	.widget_category li span {
	    color: <?php echo @$theme->body_font_color; ?>;
	}
	.post_meta span, .post_meta span a {
	    color: <?php echo @$theme->form_label_color; ?>;
	}
	.faq-des{
	    color: <?php echo @$theme->form_label_color; ?>;
	}
	.form-title {
	    color: <?php echo @$theme->menu_font_color; ?>;
	}
	.contact-service .media-body div {
	    color: <?php echo @$theme->body_font_color; ?>;
	}
	.superheadline {
	    color: <?php echo @$theme->body_font_color; ?>;
	}
	.haeder-text h1 {
		color: <?php echo @$theme->body_font_color; ?>;
	}
	.haeder-text p {
		color: <?php echo @$theme->body_font_color; ?>;
	}
	.accordion li {
	    background: <?php echo @$theme->menu_bg_color; ?>;
	}
	.accordion li a {
	    color: <?php echo @$theme->body_font_color; ?>;
	}
	.accordion li p {
	    color: <?php echo @$theme->body_font_color; ?>;
	}
	.about_text {
	    color: <?php echo @$theme->body_font_color; ?>;
	    margin-top: 20px;
	}
	.transfer-details {
	    color: <?php echo @$theme->body_font_color; ?>;
	}
	.post_meta span, .post_meta span a {
	    color: <?php echo @$theme->body_font_color; ?>;
	}
	.accordion a::after {
	    border-right: 1px solid <?php echo @$theme->body_font_color; ?>;
	    border-bottom: 1px solid <?php echo @$theme->body_font_color; ?>;
	}

	.profile-verify, .password_change-content {
	    box-shadow:none;
	    border: 1px solid <?php echo @$theme->form_border_color;  ?>;
	}
	.confirm-withdraw, .confirm-transfer {
	   margin: 0px auto; 
	}
	.modal-content {
	    background-color: <?php echo @$theme->form_background_color; ?>;
	    border: 1px solid <?php echo @$theme->form_border_color; ?>;
	}  
	.modal-header {
	    border-bottom: 1px solid <?php echo @$theme->form_border_color; ?>;
	} 
	.modal-footer{
	    border-top: 1px solid <?php echo @$theme->form_border_color; ?>;;    
	}
	.modal-title, .modal-body label, .modal-header .close span {
	    color: <?php echo @$theme->form_label_color; ?>;
	}
	.f_name {
	    color: <?php echo @$theme->body_font_color; ?>;
	}

	/* Change autocomplete styles in WebKit */
	input:-webkit-autofill,
	input:-webkit-autofill:hover, 
	input:-webkit-autofill:focus,
	textarea:-webkit-autofill,
	textarea:-webkit-autofill:hover,
	textarea:-webkit-autofill:focus,
	select:-webkit-autofill,
	select:-webkit-autofill:hover,
	select:-webkit-autofill:focus {
	  border: 1px solid <?php echo @$theme->input_field_border_color;  ?>;
	  -webkit-text-fill-color: <?php echo @$theme->input_field_color; ?>; 
	  -webkit-box-shadow: 0 0 0px 1000px #060d13 inset;
	  transition: background-color 5000s ease-in-out 0s;
	}
	body {
	    color: <?php echo @$theme->body_font_color; ?>;
	    background-color: <?php echo @$theme->body_background_color; ?>;
    }
</style>