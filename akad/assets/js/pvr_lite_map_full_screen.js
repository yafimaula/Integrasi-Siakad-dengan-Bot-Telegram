"use strict";
var full_screen = function () {
    "use strict";

    function t() {
        var t = {
            zoom            : 9,
            center          : new google.maps.LatLng(12.997, 77.644),
            mapTypeId       : google.maps.MapTypeId.ROADMAP,
            disableDefaultUI: true
        };
        e = new google.maps.Map(document.getElementById("google-map"), t);
    }

    var e;
    google.maps.event.addDomListener(window, "load", t);
    $(window).on("resize", function () {
        google.maps.event.trigger(e, "resize")
    });


};
var map = function () {
    "use strict";
    return {
        init: function () {
            full_screen();
        }
    }
}();
$(function () {
    map.init();
});