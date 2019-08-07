"use strict";
var vectormap = function () {
    "use strict";
    if ("#world-map".length !== 0) {
        var e = $(window).height();
        var mapData = {
            "AU": 760,
            "IN": 200,
            "RU": 300,
            "US": 2920,
            "BR": 550,
        };
        $("#world-map").css("height", e-123);
        $("#world-map").vectorMap({
            map              : "world_mill_en",
            normalizeFunction: "polynomial",
            hoverOpacity     : .5,
            hoverColor       : false,
            markerStyle      : {
                initial: {
                    fill  : "#FFA534",
                    stroke: "transparent",
                    r     : 3
                }
            },
            regionStyle      : {
                initial      : {
                    fill            : "rgb(174, 141, 239)",
                    "fill-opacity"  : 1,
                    stroke          : "none",
                    "stroke-width"  : .4,
                    "stroke-opacity": 1
                },
                hover        : {
                    "fill-opacity": .8
                },
                selected     : {
                    fill: "yellow"
                },
                selectedHover: {}
            },
            series           : {
                regions: [ {
                    values           : mapData,
                    scale            : [ "#5797fc", "#7e6fff", "#4ecc48", "#ffcc29", "#f37070" ],
                    normalizeFunction: 'polynomial'
                } ]
            },
            focusOn          : {
                x    : .5,
                y    : .5,
                scale: 0
            },
            backgroundColor  : "#FFFFFF",
            markers          : [ {
                latLng: [ 41.9, 12.45 ],
                name  : "Vatican City"
            }, {
                latLng: [ 43.73, 7.41 ],
                name  : "Monaco"
            }, {
                latLng: [ -.52, 166.93 ],
                name  : "Nauru"
            }, {
                latLng: [ -8.51, 179.21 ],
                name  : "Tuvalu"
            }, {
                latLng: [ 43.93, 12.46 ],
                name  : "San Marino"
            }, {
                latLng: [ 47.14, 9.52 ],
                name  : "Liechtenstein"
            }, {
                latLng: [ 7.11, 171.06 ],
                name  : "Marshall Islands"
            }, {
                latLng: [ 17.3, -62.73 ],
                name  : "Saint Kitts and Nevis"
            }, {
                latLng: [ 3.2, 73.22 ],
                name  : "Maldives"
            }, {
                latLng: [ 35.88, 14.5 ],
                name  : "Malta"
            }, {
                latLng: [ 12.05, -61.75 ],
                name  : "Grenada"
            }, {
                latLng: [ 13.16, -61.23 ],
                name  : "Saint Vincent and the Grenadines"
            }, {
                latLng: [ 13.16, -59.55 ],
                name  : "Barbados"
            }, {
                latLng: [ 17.11, -61.85 ],
                name  : "Antigua and Barbuda"
            }, {
                latLng: [ -4.61, 55.45 ],
                name  : "Seychelles"
            }, {
                latLng: [ 7.35, 134.46 ],
                name  : "Palau"
            }, {
                latLng: [ 42.5, 1.51 ],
                name  : "Andorra"
            }, {
                latLng: [ 14.01, -60.98 ],
                name  : "Saint Lucia"
            }, {
                latLng: [ 6.91, 158.18 ],
                name  : "Federated States of Micronesia"
            }, {
                latLng: [ 1.3, 103.8 ],
                name  : "Singapore"
            }, {
                latLng: [ 1.46, 173.03 ],
                name  : "Kiribati"
            }, {
                latLng: [ -21.13, -175.2 ],
                name  : "Tonga"
            }, {
                latLng: [ 15.3, -61.38 ],
                name  : "Dominica"
            }, {
                latLng: [ -20.2, 57.5 ],
                name  : "Mauritius"
            }, {
                latLng: [ 26.02, 50.55 ],
                name  : "Bahrain"
            }, {
                latLng: [ .33, 6.73 ],
                name  : "SÃ£o TomÃ© and PrÃ­ncipe"
            } ]
        });
    }
};
var map = function () {
    "use strict";
    return {
        init: function () {
            vectormap();
        }
    }
}();
$(function () {
    map.init();
});