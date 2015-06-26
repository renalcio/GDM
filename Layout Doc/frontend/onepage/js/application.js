var topnav           = $('.topnav');
var header           = $('header');
var topText          = $('.top-text');
var topnavHeight     = topnav.height();
var headerHeight     = header.height();
var windowWidth = $(window).width();
var windowHeight = $(window).height();

$(window).load(function() {

    'use strict';
    setTimeout(function() {
        $('.loader-overlay').addClass('loaded');
        $('body > section').animate({
            opacity: 1,
        }, 400);
    }, 500);

});

$(window).scroll(function() {

    'use strict';
    var scrollPos = $(window).scrollTop();
    scrollPos > 220 ? $('.sticky-section').addClass('nav-bg') : $('.sticky-section').removeClass('nav-bg');
    navbarScroll(topnav, topnavHeight);
    fadeText(this);

});


$(window).resize(function() {
    portfolioIsotope();
});

$(window).bind("load", function() {
    portfolioIsotope();
});

/* ----------------------------- 
Backgroung slider
----------------------------- */
$(window).ready(function() {

    'use strict';
    
    handleNavigation();
    navbarScroll(topnav, topnavHeight);
    rotateText();
    imageZoom();
    var scrollPos = $(window).scrollTop();

    /* Full Height */
    $('.height-full').each(function(){
        var contentHeight = $(this).height();
        if(contentHeight < windowHeight) {
            if($('html').hasClass('border-page')) {
                $(this).height(windowHeight - 40);
            }
            else {
                $(this).height(windowHeight);
            }      
        }
    });

    if($.fn.appear){
        $('.animated').appear({force_process: true});
    }

    $('.animated').on('appear', function(event, $all_appeared_elements) {
       var element = $(this),
            animation = element.data('animation'),
            animationDelay = element.data('animation-delay');
        if (animationDelay) {
            setTimeout(function() {
                element.addClass(animation + " visible");
            }, animationDelay);
        } else {
            element.addClass(animation + " visible");
        }
    });

    $('.next-section').on('click', function(e){
        e.preventDefault();
        var scrollToElement = $(this).parent().next();
        if($(this).parent().parent().parent().parent().is('header')) scrollToElement = $(this).parent().parent().parent().parent().next();
        $('html, body').animate({
            scrollTop: scrollToElement.offset().top - 60
        }, 1000);
    });

    /* Background Slider */
    if($('.bg-slider').length && $.fn.backstretch){
        $('.bg-slider').height(windowHeight);
        if($('.bg-slider').attr('data-images')) {
            var bgImages = [];
            bgImages = $('.bg-slider').attr('data-images').split(',');
            // Access the instance
            var instance = $('.bg-slider').data('images');
            // Then, you can manipulate the images array directly
            $('.bg-slider').backstretch(
                instance,
            {
                fade: 600,
                duration: 4000
            });
            
        }
        else{
            $('.bg-slider').backstretch([
                'images/bg/bg-6.jpg',
                'images/bg/bg-2.jpg',
                'images/bg/bg-3.jpg'],
            {
                fade: 600,
                duration: 4000
            });
        }

    }

    /* Scroll into viewPort Animation */
    if($.fn.appear){
        $('.animated').appear(function() {
            var element = $(this),
                animation = element.data('animation'),
                animationDelay = element.data('animation-delay');
            if (animationDelay) {
                setTimeout(function() {
                    element.addClass(animation + " visible");
                }, animationDelay);
            } else {
                element.addClass(animation + " visible");
            }
        });
    }
       
    /* Testimonial Slider */
    if($('.testimonials-slider').length){
        $('.testimonials-slider').bxSlider({
            pagerCustom: '#testimonials-pager',
            pager: true,
            touchEnabled: true,
            controls: false
        });
    }

    /* Image Carousel */
    $('[data-plugin-carousel]:not(.manual), .owl-carousel:not(.manual)').each(function() {
        var $this = $(this), opts = null,
        pluginOptions = $this.data('plugin-options'),
        defaults = {
            "autoPlay": 3000,
            "items": 1,
            "singleItem": true,
            "itemsDesktop" : [1199,5],
            "itemsDesktopSmall" : [980,4],
            "itemsTablet": [768,3],
            "itemsMobile" : [479,2],
        };

        opts = $.extend( {}, defaults, pluginOptions );
        $this.owlCarousel(opts); 
    });


    /* Background Image */
    var backgroundImage = $("header, section");
    backgroundImage.each(function(){
        if ($(this).attr("data-img")){
            if($(this).parent().hasClass('demo-page')){
                $(this).css("background-image", "url(images/" + $(this).data("img") + ")");
            }else{
                $(this).css("background-image", "url(images/" + $(this).data("img") + ")");
            }
            
        }
    });

    /* Parallax */
    $('.parallax').each(function(){
        var parallaxSpeed = $(this).data('speed') ? $(this).data('speed') : 0.1;
        $(this).parallax("50%", parallaxSpeed);
    });

    scrollTop();

}); 


/* Image Zoom */
function imageZoom(){
    if($('.portfolioContainer').length && $.fn.magnificPopup){

        $('.portfolioContainer').magnificPopup({
            
            type: 'image',
            delegate: '.magnific',
           gallery:{enabled:true} 
        });
    }

    
}

/* Fade Text / Element on Scroll */
function fadeText() {
    var topScroll = $(document).scrollTop();
    if ($('.fade-text').length && topScroll <= headerHeight){
        $('.fade-text').css('opacity', (1 - topScroll/headerHeight * 1));
    }
}

/* Text Rotation */
function rotateText(){
    $('[data-plugin-rotate-text]:not(.manual), .rotate-text:not(.manual)').each(function() {
        var $this = $(this), opts = null,
        pluginOptions = $this.data('plugin-options'),
        defaults = {
            "animation": "dissolve",  // Options are dissolve (default), fade, flip, flipUp, flipCube, flipCubeUp and spin.
            "separator": ",",  // If you don't want commas to be the separator, you can define a new separator (|, &, * etc.) by yourself using this field.
            "speed": 3500  // How many milliseconds until the next word show.
        };
        opts = $.extend( {}, defaults, pluginOptions );
        $this.textrotator(opts); 
    });
}

/* Scroll to top button */
function scrollTop() {
    if ($(this).scrollTop() > 100) $('.scrollup').fadeIn();
    else $('.scrollup').fadeOut();
    $(window).scroll(function() {
        if ($(this).scrollTop() > 100) $('.scrollup').fadeIn();
        else $('.scrollup').fadeOut();
    });
    $('.scrollup').click(function() {
        $("html, body").animate({
            scrollTop: 0
        }, 1000);
        return false;
    });
}


/**** NAVIGATION ****/
function handleNavigation(){
    $('.nav').onePageNav({
        currentClass: 'current',
        scrollSpeed: 1000,
        easing: 'easeInOutQuint',
        filter: ':not(.toggle-search)'
    });
};

/* Navbar Height / Background on Scroll */
function navbarScroll(topnav, topnavHeight) {
    var topScroll = $(window).scrollTop();
    if (topnav.length > 0) {
        if(topScroll >= topnavHeight) {
            topnav.removeClass('topnav-top');
            if(!topnav.hasClass('bg-black') && !topnav.hasClass('bg-white')) topnav.removeClass('transparent');
        } else {
            topnav.addClass('topnav-top');
            if(!topnav.hasClass('bg-black') && !topnav.hasClass('bg-white')) topnav.addClass('transparent');
        }
    }
};

/* Portfolio Isotope */
function portfolioIsotope(){
    if($('.portfolioContainer').length){
        var $container = $('.portfolioContainer');
        $container.isotope();
        $('.portfolioFilter a').click(function(){
            $('.portfolioFilter .current').removeClass('current');
            $(this).addClass('current');
            var selector = $(this).attr('data-filter');
            $container.isotope({
                filter: selector,
                transitionDuration: "0.7s"
             });
             return false;
        }); 
    }
};
