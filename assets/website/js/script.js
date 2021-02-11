$(document).ready(function () {
    //Slider Preloader 
    
    "use strict";
    var slider_preloader_status = $(".slider_preloader_statusr");
    var slider_preloader = $(".slider_preloader");
    var header_slider = $(".header-slider");
    slider_preloader_status.fadeOut();
    slider_preloader.delay(350).fadeOut('slow');
    header_slider.removeClass("header-slider-preloader");

    // Slider JS
    $('#animation-slide').owlCarousel({
        autoHeight: true,
        items: 1,
        loop: true,
        autoplay: false,
        dots: true,
        nav: true,
        autoplayTimeout: 7000,
        navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        autoplayHoverPause: false,
        touchDrag: true,
        mouseDrag: true
    });
    $("#animation-slide").on("translate.owl.carousel", function () {
        $(this).find(".owl-item .slide-text > *").removeClass("fadeInUp animated").css("opacity", "0");
        $(this).find(".owl-item .slide-img").removeClass("fadeInRight animated").css("opacity", "0");
    });
    $("#animation-slide").on("translated.owl.carousel", function () {
        $(this).find(".owl-item.active .slide-text > *").addClass("fadeInUp animated").css("opacity", "1");
        $(this).find(".owl-item.active .slide-img").addClass("fadeInRight animated").css("opacity", "1");
    });

//Sidebar Mobile menu
$("#mobile-menu").metisMenu();

$("#sidebar").mCustomScrollbar({
    theme: "minimal",
    scrollInertia: 100
});

$('#dismiss, .overlay').on('click', function () {
    $('#sidebar').removeClass('active');
    $('.overlay').fadeOut();
});

$('#sidebarCollapse').on('click', function () {
    $('#sidebar').addClass('active');
    $('.overlay').fadeIn();
});

    //Marquee
    $('#marquee-horizontal').marquee({direction: 'horizontal', delay: 0, timing: 15});

    //Page Header Parallax
    $('.page_header').parallaxBackground();

    //Table Header Fixed
    $('.tableFixHead').on('scroll', function () {
        $('thead', this).css('transform', 'translateY(' + this.scrollTop + 'px)');
    });

    //Back to Top
    $('.back-top').on('click', function () {
        $('html,body').animate({
            scrollTop: 0
        }, 700);
    });

    //Page Header Parallax
    $('.page_header').parallaxBackground();

    //Accordion
    $('.accordion > li:eq(0) a').addClass('active').next().slideDown();
    $('.accordion a').on('click', function (j) {
        var dropDown = $(this).closest('li').find('p');

        $(this).closest('.accordion').find('p').not(dropDown).slideUp();

        if ($(this).hasClass('active')) {
            $(this).removeClass('active');
        } else {
            $(this).closest('.accordion').find('a.active').removeClass('active');
            $(this).addClass('active');
        }

        dropDown.stop(false, true).slideToggle();

        j.preventDefault();
    });

    $('.toggle').on('click', function () {
        $('.form-container').stop().addClass('active');
    });

    $('.close').on('click', function () {
        $('.form-container').stop().removeClass('active');
    });


    //Confirm Password check
    function rePassword() {
        var pass = document.getElementById("newpassword").value;
        var r_pass = document.getElementById("r_pass").value;

        if (pass !== r_pass) {
            document.getElementById("r_pass").style.borderColor = '#ff0000';
            document.getElementById("r_pass").style.boxShadow = 'inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(255, 0, 0, .6)';
            return false;
        }
        else{
            document.getElementById("r_pass").style.borderColor = '#1cbbb4';
            document.getElementById("r_pass").style.boxShadow = 'inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(28, 187, 180, .6)';
            return true;
        }
    }
});