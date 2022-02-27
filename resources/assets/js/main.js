
$(window).on('load', function() {

    /*
    =========================================================================================
    * Spinner 
    =========================================================================================
    */
    
    $(".lynkto_loading").fadeOut("slow");
});
$(document).ready(function() {

    // for right nav menu
    $('.menu').click (function(){
        $(this).toggleClass('open');
    });

    $('.menu.btn1').click(function(){
        $('.left-full-menu').toggleClass('menu_show');
    });


    if ($(window).width() > 1025) {
        headerHeight = $('.header_area').outerHeight();
        $('.banner_area').css({
            'top': -headerHeight
        });
        $(window).on('scroll', function() {
            if ($(window).scrollTop() > 10) {
                $(".header_area").addClass("ds_padding fixed-top");
                $(".navbar-brand img").attr("src","resources/assets/images/logo.png");
            } else {
                $(".header_area").removeClass("ds_padding fixed-top");
                $(".navbar-brand img").attr("src","resources/assets/images/logo.png");
            }
        });
    } else {
        headerHeight = $('.header_area').outerHeight();
        $('.banner_area').css({
            'top': headerHeight
        });
        $(".navbar-brand img").attr("src","resources/assets/images/logo.png");
        $(".header_area").addClass("fixed-top");
        $(".header_area").removeClass("ds_padding");
        $(window).on('scroll', function() {
            if ($(window).scrollTop() > 0) {
                $(".header_area").addClass("fixed-top");
                $(".header_area").removeClass("ds_padding");
                $(".navbar-brand img").attr("src","resources/assets/images/logo.png");
            } 
            else {
                $(".header_area").addClass("fixed-top");
                $(".header_area").removeClass("ds_padding");
                $(".navbar-brand img").attr("src","resources/assets/images/logo.png");
            }
        });
    }




    // $('.banner_area').css({'marginTop' , '60px'});
    $(window).on('scroll', function() {
        

        $(".progress_cont").each(function() {
            var base = $(this);
            var windowHeight = $(window).height();
            var itemPos = base.offset().top;
            var scrollpos = $(window).scrollTop() + windowHeight - 100;
            if (itemPos <= scrollpos) {
                var auptcoun = base.find(".progress-bar").attr("aria-valuenow");
                base.find(".progress-bar").css({
                    "width": auptcoun + "%"
                });
                var str = base.find(".skill>span").text();
                var res = str.replace("%", "");
                if (res == 0) {
                    $({
                        countNumber: 0
                    }).animate({
                        countNumber: auptcoun
                    }, {
                        duration: 4000,
                        easing: 'linear',
                        step: function() {
                            base.find(".skill>span").text(Math.ceil(this.countNumber) + "%");
                        }
                    });
                }
            }
        });

        $(".page").each(function() {
            var bb = $(this).attr("id");
            var hei = $(this).outerHeight();
            var grttop = $(this).offset().top - 80;
            if ($(window).scrollTop() > grttop - 1 && $(window).scrollTop() < grttop + hei - 1) {
                var uu = $(".one-page > li >a[href='#" + bb + "']").parent().addClass("active");
            } else {
                var uu = $(".one-page > li >a[href='#" + bb + "']").parent().removeClass("active");
            }
        });

    });

    $(".nav-item > a").click(function() {
        $(this).parent().addClass("active");
        $(".nav-item > a").not(this).parent().removeClass("active");
        var TargetId = $(this).attr('href');
        $('html, body').animate({
            scrollTop: $(TargetId).offset().top - 50
        }, 1000, 'swing');
        return false;
    });

    /*
    =========================================================================================
    COUNTER
    =========================================================================================
    */
    $('.counter').counterUp({
        delay: 10,
        time: 1000
    });


    /*
    =========================================================================================
    RELATED SLIDER
    =========================================================================================
    */

   var testimonial_carosel = jQuery("#testimonial_carosel");
   testimonial_carosel.owlCarousel({
       loop: true,
       margin: 0,
       lazyLoad: true,
       smartSpeed: 1500,
       autoplay: false,
       nav: false,
       dots: false,
       responsive: {
           0: {
               items: 1
           },
           400: {
               items: 2
           },
           768: {
               items: 2
           },
           1200: {
               items: 4
           }
       }
   });


           /*
        =========================================================================================
        9. PORTFOLIO   
        =========================================================================================
        */ 
       $('#js-grid-masonry').cubeportfolio({
        filters: '#js-filters-masonry',
        layoutMode: 'grid',
        defaultFilter: '*',
        animationType: 'fadeOut',
        gapHorizontal: 20,
        gapVertical: 20,
        gridAdjustment: 'responsive',
        mediaQueries: [{
            width: 1500,
            cols: 3
        }, {
            width: 1100,
            cols: 3
        }, {
            width: 800,
            cols: 3
        }, {
            width: 480,
            cols: 2
        }, {
            width: 320,
            cols: 1
        }],
        caption: 'overlayBottomAlong',
        displayType: 'bottomToTop',
        displayTypeSpeed: 100,

        // lightbox
        lightboxDelegate: '.cbp-lightbox',
        lightboxGallery: true,
        lightboxTitleSrc: 'data-title',
        lightboxCounter: '<div class="cbp-popup-lightbox-counter">{{current}} of {{total}}</div>',
    });

});







// Pen JS Starts Here
jQuery(document).ready(function() {

    // ---------
    // SVG 
    var snapC = Snap("#svgC");

    // SVG C - "Squiggly" Path
    var myPathC = snapC.path("M62.9 14.9c-25-7.74-56.6 4.8-60.4 24.3-3.73 19.6 21.6 35 39.6 37.6 42.8 6.2 72.9-53.4 116-58.9 65-18.2 191 101 215 28.8 5-16.7-7-49.1-34-44-34 11.5-31 46.5-14 69.3 9.38 12.6 24.2 20.6 39.8 22.9 91.4 9.05 102-98.9 176-86.7 18.8 3.81 33 17.3 36.7 34.6 2.01 10.2.124 21.1-5.18 30.1").attr({
        id: "squiggle",
        fill: "none",
        strokeWidth: "1",
        stroke: "rgba(0,0,0,0.1)",
        strokeMiterLimit: "10",
        strokeDasharray: "5 10",
        strokeDashOffset: "180"
    });

    // SVG C - Triangle (As Polyline)
    var Triangle = snapC.polyline("0, 30, 15, 0, 30, 30");
    Triangle.attr({
        id: "plane",
        fill: "rgba(0,0,0,0.050)"
    });

    initTriangle();

    // Initialize Triangle on Path
    function initTriangle() {
        var triangleGroup = snapC.g(Triangle); // Group polyline 
        movePoint = myPathC.getPointAtLength(length);
        triangleGroup.transform('t' + parseInt(movePoint.x - 15) + ',' + parseInt(movePoint.y - 15) + 'r' + (movePoint.alpha - 90));
    }

    // SVG C - Draw Path
    var lenC = myPathC.getTotalLength();

    // SVG C - Animate Path
    function animateSVG() {

        myPathC.attr({
            stroke: 'rgba(0,0,0,0.1)',
            strokeWidth: 1,
            fill: 'none',
            // Draw Path
            "stroke-dasharray": "5 10",
            "stroke-dashoffset": "180"
        }).animate({ "stroke-dashoffset": 10 }, 4500, mina.easeinout);

        var triangleGroup = snapC.g(Triangle); // Group polyline

        setTimeout(function() {
            Snap.animate(0, lenC, function(value) {

                movePoint = myPathC.getPointAtLength(value);

                triangleGroup.transform('t' + parseInt(movePoint.x - 15) + ',' + parseInt(movePoint.y - 15) + 'r' + (movePoint.alpha - 90));

            }, 4500, mina.easeinout, function() {});
        });

    }


    // Animate Button
    function kapow() {
        $(window).on('scroll', function() {
            // Run SVG
            animateSVG();
        });
    }

    kapow();

});