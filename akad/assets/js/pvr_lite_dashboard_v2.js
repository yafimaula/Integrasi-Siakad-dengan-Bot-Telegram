"use strict";
var v2 = function () {
    "use strict";

    var donutChart = $("#hero-donut");
    var data = {
        labels  : [ "USA", "Brazil", "Russia", "India", "Australia" ],
        datasets: [ {
            data                : [ 300, 150, 50, 75, 200 ],
            backgroundColor     : [ "#5797fc", "#7e6fff", "#4ecc48", "#ffcc29", "#f37070" ],
            hoverBackgroundColor: [ "#5797fc", "#7e6fff", "#4ecc48", "#ffcc29", "#f37070" ],
            borderWidth         : 0
        } ]
    };
    new Chart(donutChart, {
        type   : 'doughnut',
        data   : data,
        options: {
            legend          : {
                display: false
            },
            animation       : {
                animateScale: true
            },
            cutoutPercentage: 80
        }
    });

    $(".add_shadow").realshadow({
        followMouse: false,
        type       : 'drop'
    });

    $(".upcoming_event_carasol").owlCarousel({
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
                items: 1
            },
            1100: {
                items: 1
            },
            1200: {
                items: 1
            }
        }
    });
};
var Dashboard = function () {
    "use strict";
    return {
        init: function () {
            v2();
        }
    }
}();
$(function () {
    Dashboard.init();
});