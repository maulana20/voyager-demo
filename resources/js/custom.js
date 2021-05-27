const { find } = require("lodash");

var general = {
    init: function() {
        general.scrollNav();
        general.scrollSmooth();
        general.owlCarousel();
    },

    scrollNav: function () {
        let closed = true;

        $(window).scroll(function() {
            if ($("#mainNav").offset().top > 50) {
                $("#mainNav").addClass("navbar-dws shadow-lg");
            } else {
                closed = true;
                $("#mainNav").removeClass("navbar-dws shadow-lg");
            }
        });

        $('.navbar-toggler').on('click', function() {
            if (closed) {
                closed = false;
                $("#mainNav").addClass("navbar-dws shadow-lg");
            } else {
                if ($("#mainNav").offset().top < 50) {
                    closed = true;
                    $("#mainNav").removeClass("navbar-dws shadow-lg");
                }
            }
        });
    },

    scrollSmooth: function () {
        var el = $('.js-scroll-trigger');
        if (!el.length) return;

        $('a.js-scroll-trigger[href*="#"]:not([href="#"])').click(function() {
            if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                if (target.length) {
                    $('html, body').animate({
                        scrollTop: (target.offset().top - 54)
                    }, 1000, "easeInOutExpo");
                    return false;
                }
            }
        });
    },
    
    owlCarousel: function () {
        $('.posts').owlCarousel({
            loop:false,
            dots:false,
            margin:10,
            nav:true,
            responsive:{
                0:{
                    items:1
                },
                600:{
                    items:3
                },
                1000:{
                    items:4
                }
            }
        })
    }
}

$(document).ready(function () {
    general.init();
});
