"use strict";
var ecommerce = function () {
    "use strict";
    $("#blog-slide").owlCarousel({
        items             : 3,
        autoplay          : true,
        loop              : true,
        margin            : 30,
        autoplayTimeout   : 5000,
        autoplayHoverPause: true,
        lazyLoad          : true,
        nav               : true,
        navText           : [ '<i class="material-icons badge f-s-18" data-color="purple">arrow_back</i> ', ' &nbsp;<i class="material-icons badge f-s-18" data-color="purple">arrow_forward</i>' ],
        navClass          : [ 'owl-prev', 'owl-next' ],
        responsive        : {
            0   : {
                items: 1
            },
            600 : {
                items: 2
            },
            1100: {
                items: 3
            }
        },
        animateOut        : 'fadeOut'
    });

    $("#product_car").owlCarousel({
        items             : 5,
        autoplay          : true,
        loop              : true,
        margin            : 30,
        autoplayTimeout   : 5000,
        autoplayHoverPause: true,
        lazyLoad          : true,
        center            : true,
        nav               : true,
        navText           : [ '<i class="material-icons badge f-s-18" data-color="purple">arrow_back</i> ', ' &nbsp;<i class="material-icons badge f-s-18" data-color="purple">arrow_forward</i>' ],
        navClass          : [ 'owl-prev', 'owl-next' ],
        responsive        : {
            0   : {
                items: 1
            },
            600 : {
                items: 3
            },
            1100: {
                items: 4
            },
            1200: {
                items: 5
            }
        },
        animateOut        : 'fadeOut'
    });

    $(".cart-btn").on("click", function () {
        var tit = $.trim($(this).closest("article").find(".title_pro").text());
        var tag = $.trim($(this).closest("article").find(".tag").text());
        swal(tit + " Added to Cart!", tag + " | 5 Review(s)", "success")
    });
};
var Ecommerce = function () {
    "use strict";
    return {
        init: function () {
            ecommerce();
        }
    }
}();
$(function () {
    Ecommerce.init();
});