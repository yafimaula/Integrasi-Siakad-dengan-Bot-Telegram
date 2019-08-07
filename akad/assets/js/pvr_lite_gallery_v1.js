"use strict";
var gallery_v1 = function () {
    "use strict";
    $(function () {
        var classes = [ "bounce", "flash", "pulse", "rubberBand", "shake", "swing", "tada", "wobble", "jello", "bounceIn", "bounceInDown", "bounceInLeft", "bounceInRight", "bounceInUp", "fadeIn", "fadeInDown", "fadeInDownBig", "fadeInLeft", "fadeInLeftBig", "fadeInRight", "fadeInRightBig", "fadeInUp", "fadeInUpBig", "flip", "flipInX", "flipInY", "lightSpeedIn", "rotateIn", "rotateInDownLeft", "rotateInDownRight", "rotateInUpLeft", "rotateInUpRight", "slideInUp", "slideInDown", "slideInLeft", "slideInRight", "zoomIn", "zoomInDown", "zoomInLeft", "zoomInRight", "zoomInUp", "jackInTheBox", "rollIn" ];
        var length = classes.length;
        var links = $('.superbox-img');
        $.each(links, function (key, value) {
            $(value).addClass("animated " + classes[ Math.floor(Math.random() * length) ]);
        });

        $('.superbox').SuperBox();
    });
};
var gallery = function () {
    "use strict";
    return {
        init: function () {
            gallery_v1();
        }
    }
}();
$(function () {
    gallery.init();
});