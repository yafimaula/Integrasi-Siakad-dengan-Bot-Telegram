"use strict";
var v1 = function () {
    "use strict";
    if ($("#pvrLineChart_1").length) {
        var pvrLineChart = $("#pvrLineChart_1");
        var pvrLineGradient = pvrLineChart[ 0 ].getContext('2d').createLinearGradient(0, 0, 0, 200);
        pvrLineGradient.addColorStop(0, 'rgba(147,104,233,0.48)');
        pvrLineGradient.addColorStop(1, 'rgba(148, 59, 234, 0.7)');
        var liteLineData = {
            labels  : [ "January 1", "January 5", "January 10", "January 15", "January 20", "January 25" ],
            datasets: [ {
                label                    : "Sold",
                fill                     : true,
                lineTension              : 0.4,
                backgroundColor          : pvrLineGradient,
                borderColor              : "#8f1cad",
                borderCapStyle           : 'butt',
                borderDash               : [],
                borderDashOffset         : 0.0,
                borderJoinStyle          : 'miter',
                pointBorderColor         : "#fff",
                pointBackgroundColor     : "#2a2f37",
                pointBorderWidth         : 2,
                pointHoverRadius         : 6,
                pointHoverBackgroundColor: "#943BEA",
                pointHoverBorderColor    : "#fff",
                pointHoverBorderWidth    : 2,
                pointRadius              : 4,
                pointHitRadius           : 5,
                data                     : [ 13, 28, 19, 24, 43, 49 ],
                spanGaps                 : false
            } ]
        };
        var mypvrLineChart = new Chart(pvrLineChart, {
            type   : 'line',
            data   : liteLineData,
            options: {
                tooltips: {
                    enabled: false
                },
                legend  : {
                    display: false
                },
                scales  : {
                    xAxes: [ {
                        display  : false,
                        ticks    : {
                            fontSize : '11',
                            fontColor: '#969da5'
                        },
                        gridLines: {
                            color        : 'rgba(0,0,0,0.0)',
                            zeroLineColor: 'rgba(0,0,0,0.0)'
                        }
                    } ],
                    yAxes: [ {
                        display: false,
                        ticks  : {
                            beginAtZero: true,
                            max        : 55
                        }
                    } ]
                }
            }
        });
    }

    if ($("#pvrLineChart_2").length) {
        var pvrLineChart = $("#pvrLineChart_2");
        var pvrLineGradient = pvrLineChart[ 0 ].getContext('2d').createLinearGradient(0, 0, 0, 200);
        pvrLineGradient.addColorStop(0, 'rgba(255, 165, 52,0.48)');
        pvrLineGradient.addColorStop(1, 'rgba(255, 82, 33, 0.7)');
        var liteLineData = {
            labels  : [ "January 1", "January 5", "January 10", "January 15", "January 20", "January 25" ],
            datasets: [ {
                label                    : "Sold",
                fill                     : true,
                lineTension              : 0.4,
                backgroundColor          : pvrLineGradient,
                borderColor              : "#FFA534",
                borderCapStyle           : 'butt',
                borderDash               : [],
                borderDashOffset         : 0.0,
                borderJoinStyle          : 'miter',
                pointBorderColor         : "#fff",
                pointBackgroundColor     : "#2a2f37",
                pointBorderWidth         : 2,
                pointHoverRadius         : 6,
                pointHoverBackgroundColor: "#FF5221",
                pointHoverBorderColor    : "#fff",
                pointHoverBorderWidth    : 2,
                pointRadius              : 4,
                pointHitRadius           : 5,
                data                     : [ 13, 28, 39, 24, 43, 19 ],
                spanGaps                 : false
            } ]
        };
        var mypvrLineChart = new Chart(pvrLineChart, {
            type   : 'line',
            data   : liteLineData,
            options: {
                tooltips: {
                    enabled: false
                },
                legend  : {
                    display: false
                },
                scales  : {
                    xAxes: [ {
                        display  : false,
                        ticks    : {
                            fontSize : '11',
                            fontColor: '#969da5'
                        },
                        gridLines: {
                            color        : 'rgba(0,0,0,0.0)',
                            zeroLineColor: 'rgba(0,0,0,0.0)'
                        }
                    } ],
                    yAxes: [ {
                        display: false,
                        ticks  : {
                            beginAtZero: true,
                            max        : 55
                        }
                    } ]
                }
            }
        });
    }

    if ($("#pvrLineChart_3").length) {
        var pvrLineChart = $("#pvrLineChart_3");
        var pvrLineGradient = pvrLineChart[ 0 ].getContext('2d').createLinearGradient(0, 0, 0, 200);
        pvrLineGradient.addColorStop(0, 'rgba(135, 203, 22,0.48)');
        pvrLineGradient.addColorStop(1, 'rgba(109, 192, 48, 0.7)');
        var liteLineData = {
            labels  : [ "January 1", "January 5", "January 10", "January 15", "January 20", "January 25" ],
            datasets: [ {
                label                    : "Sold",
                fill                     : true,
                lineTension              : 0.4,
                backgroundColor          : pvrLineGradient,
                borderColor              : "#87CB16",
                borderCapStyle           : 'butt',
                borderDash               : [],
                borderDashOffset         : 0.0,
                borderJoinStyle          : 'miter',
                pointBorderColor         : "#fff",
                pointBackgroundColor     : "#2a2f37",
                pointBorderWidth         : 2,
                pointHoverRadius         : 6,
                pointHoverBackgroundColor: "#6DC030",
                pointHoverBorderColor    : "#fff",
                pointHoverBorderWidth    : 2,
                pointRadius              : 4,
                pointHitRadius           : 5,
                data                     : [ 13, 28, 39, 24, 43, 19 ],
                spanGaps                 : false
            } ]
        };
        var mypvrLineChart = new Chart(pvrLineChart, {
            type   : 'line',
            data   : liteLineData,
            options: {
                tooltips: {
                    enabled: false
                },
                legend  : {
                    display: false
                },
                scales  : {
                    xAxes: [ {
                        display  : false,
                        ticks    : {
                            fontSize : '11',
                            fontColor: '#969da5'
                        },
                        gridLines: {
                            color        : 'rgba(0,0,0,0.0)',
                            zeroLineColor: 'rgba(0,0,0,0.0)'
                        }
                    } ],
                    yAxes: [ {
                        display: false,
                        ticks  : {
                            beginAtZero: true,
                            max        : 55
                        }
                    } ]
                }
            }
        });
    }

    if ("#chartdiv_aminated".length !== 0) {
        var chartData = [ {
            "date"     : "2012-01-01",
            "distance" : 227,
            "townName" : "New York",
            "townName2": "New York",
            "townSize" : 25,
            "latitude" : 40.71,
            "duration" : 408
        }, {
            "date"    : "2012-01-02",
            "distance": 371,
            "townName": "Washington",
            "townSize": 14,
            "latitude": 38.89,
            "duration": 482
        }, {
            "date"    : "2012-01-03",
            "distance": 433,
            "townName": "Wilmington",
            "townSize": 6,
            "latitude": 34.22,
            "duration": 562
        }, {
            "date"    : "2012-01-04",
            "distance": 345,
            "townName": "Jacksonville",
            "townSize": 7,
            "latitude": 30.35,
            "duration": 379
        }, {
            "date"     : "2012-01-05",
            "distance" : 480,
            "townName" : "Miami",
            "townName2": "Miami",
            "townSize" : 10,
            "latitude" : 25.83,
            "duration" : 501
        }, {
            "date"    : "2012-01-06",
            "distance": 386,
            "townName": "Tallahassee",
            "townSize": 7,
            "latitude": 30.46,
            "duration": 443
        }, {
            "date"    : "2012-01-07",
            "distance": 348,
            "townName": "New Orleans",
            "townSize": 10,
            "latitude": 29.94,
            "duration": 405
        }, {
            "date"     : "2012-01-08",
            "distance" : 238,
            "townName" : "Houston",
            "townName2": "Houston",
            "townSize" : 16,
            "latitude" : 29.76,
            "duration" : 309
        }, {
            "date"    : "2012-01-09",
            "distance": 218,
            "townName": "Dalas",
            "townSize": 17,
            "latitude": 32.8,
            "duration": 287
        }, {
            "date"    : "2012-01-10",
            "distance": 349,
            "townName": "Oklahoma City",
            "townSize": 11,
            "latitude": 35.49,
            "duration": 485
        }, {
            "date"    : "2012-01-11",
            "distance": 603,
            "townName": "Kansas City",
            "townSize": 10,
            "latitude": 39.1,
            "duration": 890
        }, {
            "date"     : "2012-01-12",
            "distance" : 534,
            "townName" : "Denver",
            "townName2": "Denver",
            "townSize" : 18,
            "latitude" : 39.74,
            "duration" : 810
        }, {
            "date"    : "2012-01-13",
            "townName": "Salt Lake City",
            "townSize": 12,
            "distance": 425,
            "duration": 670,
            "latitude": 40.75,
            "alpha"   : 0.4
        }, {
            "date"       : "2012-01-14",
            "latitude"   : 36.1,
            "duration"   : 470,
            "townName"   : "Las Vegas",
            "townName2"  : "Las Vegas",
            "bulletClass": "lastBullet"
        }, {
            "date": "2012-01-15"
        } ];
        var chart = AmCharts.makeChart("chartdiv_aminated", {
            "type" : "serial",
            "theme": "light",

            "dataDateFormat": "YYYY-MM-DD",
            "dataProvider"  : chartData,

            "addClassNames": true,
            "startDuration": 1,
            //"color": "#FFFFFF",
            "marginLeft"   : 0,

            "categoryField": "date",
            "categoryAxis" : {
                "parseDates"   : true,
                "minPeriod"    : "DD",
                "autoGridCount": false,
                "gridCount"    : 50,
                "gridAlpha"    : 0.1,
                "gridColor"    : "#FFFFFF",
                "axisColor"    : "#555555",
                "dateFormats"  : [ {
                    "period": 'DD',
                    "format": 'DD'
                }, {
                    "period": 'WW',
                    "format": 'MMM DD'
                }, {
                    "period": 'MM',
                    "format": 'MMM'
                }, {
                    "period": 'YYYY',
                    "format": 'YYYY'
                } ]
            },

            "valueAxes": [ {
                "id"       : "a1",
                "title"    : "distance",
                "gridAlpha": 0,
                "axisAlpha": 0
            }, {
                "id"           : "a2",
                "position"     : "right",
                "gridAlpha"    : 0,
                "axisAlpha"    : 0,
                "labelsEnabled": false
            }, {
                "id"           : "a3",
                "title"        : "duration",
                "position"     : "right",
                "gridAlpha"    : 0,
                "axisAlpha"    : 0,
                "inside"       : true,
                "duration"     : "mm",
                "durationUnits": {
                    "DD": "d. ",
                    "hh": "h ",
                    "mm": "min",
                    "ss": ""
                }
            } ],
            "graphs"   : [ {
                "id"                   : "g1",
                "valueField"           : "distance",
                "title"                : "distance",
                "type"                 : "column",
                "fillAlphas"           : 0.9,
                "valueAxis"            : "a1",
                "balloonText"          : "[[value]] miles",
                "legendValueText"      : "[[value]] mi",
                "legendPeriodValueText": "total: [[value.sum]] mi",
                "lineColor"            : "#263138",
                "alphaField"           : "alpha"
            }, {
                "id"                   : "g2",
                "valueField"           : "latitude",
                "classNameField"       : "bulletClass",
                "title"                : "latitude/city",
                "type"                 : "line",
                "valueAxis"            : "a2",
                "lineColor"            : "#786c56",
                "lineThickness"        : 1,
                "legendValueText"      : "[[value]]/[[description]]",
                "descriptionField"     : "townName",
                "bullet"               : "round",
                "bulletSizeField"      : "townSize",
                "bulletBorderColor"    : "#786c56",
                "bulletBorderAlpha"    : 1,
                "bulletBorderThickness": 2,
                "bulletColor"          : "#000000",
                "labelText"            : "[[townName2]]",
                "labelPosition"        : "right",
                "balloonText"          : "latitude:[[value]]",
                "showBalloon"          : true,
                "animationPlayed"      : true
            }, {
                "id"                   : "g3",
                "title"                : "duration",
                "valueField"           : "duration",
                "type"                 : "line",
                "valueAxis"            : "a3",
                "lineColor"            : "#ff5755",
                "balloonText"          : "[[value]]",
                "lineThickness"        : 1,
                "legendValueText"      : "[[value]]",
                "bullet"               : "square",
                "bulletBorderColor"    : "#ff5755",
                "bulletBorderThickness": 1,
                "bulletBorderAlpha"    : 1,
                "dashLengthField"      : "dashLength",
                "animationPlayed"      : true
            } ],

            "chartCursor": {
                "zoomable"                 : false,
                "categoryBalloonDateFormat": "DD",
                "cursorAlpha"              : 0,
                "valueBalloonsEnabled"     : false
            },
            "legend"     : {
                "bulletType"      : "round",
                "equalWidths"     : false,
                "valueWidth"      : 120,
                "useGraphSettings": true,
                //"color": "#FFFFFF"
            }
        });
    }

    if ("#world-map".length !== 0) {
        var e = $(window).height();
        $("#world-map").css("height", e - 123);

        var mapData = {
            "AU": 760,
            "IN": 200,
            "RU": 300,
            "US": 2920,
            "BR": 550,
        };


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

    if ("#clock-animations".length !== 0) {
        var now = new Date(),
            hourDeg = now.getHours() / 12 * 360 + now.getMinutes() / 60 * 30,
            minuteDeg = now.getMinutes() / 60 * 360 + now.getSeconds() / 60 * 6,
            secondDeg = now.getSeconds() / 60 * 360,
            stylesDeg = [
                "@-webkit-keyframes rotate-hour{from{transform:rotate(" + hourDeg + "deg);}to{transform:rotate(" + (hourDeg + 360) + "deg);}}",
                "@-webkit-keyframes rotate-minute{from{transform:rotate(" + minuteDeg + "deg);}to{transform:rotate(" + (minuteDeg + 360) + "deg);}}",
                "@-webkit-keyframes rotate-second{from{transform:rotate(" + secondDeg + "deg);}to{transform:rotate(" + (secondDeg + 360) + "deg);}}",
                "@-moz-keyframes rotate-hour{from{transform:rotate(" + hourDeg + "deg);}to{transform:rotate(" + (hourDeg + 360) + "deg);}}",
                "@-moz-keyframes rotate-minute{from{transform:rotate(" + minuteDeg + "deg);}to{transform:rotate(" + (minuteDeg + 360) + "deg);}}",
                "@-moz-keyframes rotate-second{from{transform:rotate(" + secondDeg + "deg);}to{transform:rotate(" + (secondDeg + 360) + "deg);}}"
            ].join("");
        document.getElementById("clock-animations").innerHTML = stylesDeg;
    }

    $(".add_shadow").realshadow({
        followMouse: false,
        type       : 'drop'
    });

    $("[data-click=todolist]").on('click', function () {
        var e = $(this).closest("li");
        if ($(e).hasClass("active")) {
            $(e).removeClass("active")
        } else {
            $(e).addClass("active")
        }
    });

    $("#datepicker-inline").datepicker({
        todayHighlight: true
    });

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
};
var Dashboard = function () {
    "use strict";
    return {
        init: function () {
            v1();
        }
    }
}();
$(function () {
    Dashboard.init();
});