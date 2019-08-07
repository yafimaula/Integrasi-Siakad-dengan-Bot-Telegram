"use strict";
var full_screen = function () {
    "use strict";

    var a = [ {
        featureType: "all",
        elementType: "all",
        stylers    : [ {
            invert_lightness: true
        }, {
            saturation: 15
        }, {
            lightness: 15
        }, {
            gamma: .8
        }, {
            hue: "#943BEA"
        } ]
    }, {
        featureType: "water",
        stylers    : [ {
            visibility: "on"
        }, {
            color: "#293036"
        } ]
    } ];

    function t() {
        var t = {
            zoom            : 15,
            center          : new google.maps.LatLng(12.997, 77.744),
            mapTypeId       : google.maps.MapTypeId.ROADMAP,
            disableDefaultUI: true
        };
        e = new google.maps.Map(document.getElementById("google-map"), t);
        e.setOptions({
            styles: a
        });
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