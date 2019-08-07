"use strict";
var am_chart = function () {
        "use strict";
        var chart = AmCharts.makeChart("chartdiv", {
            "type"          : "serial",
            "theme"         : "none",
            "marginTop"     : 0,
            "marginRight"   : 20,
            "dataProvider"  : [ {
                "year" : "1950",
                "value": -0.307
            }, {
                "year" : "1951",
                "value": -0.168
            }, {
                "year" : "1952",
                "value": -0.073
            }, {
                "year" : "1953",
                "value": -0.027
            }, {
                "year" : "1954",
                "value": -0.251
            }, {
                "year" : "1955",
                "value": -0.281
            }, {
                "year" : "1956",
                "value": -0.348
            }, {
                "year" : "1957",
                "value": -0.074
            }, {
                "year" : "1958",
                "value": -0.011
            }, {
                "year" : "1959",
                "value": -0.074
            }, {
                "year" : "1960",
                "value": -0.124
            }, {
                "year" : "1961",
                "value": -0.024
            }, {
                "year" : "1962",
                "value": -0.022
            }, {
                "year" : "1963",
                "value": 0
            }, {
                "year" : "1964",
                "value": -0.296
            }, {
                "year" : "1965",
                "value": -0.217
            }, {
                "year" : "1966",
                "value": -0.147
            }, {
                "year" : "1967",
                "value": -0.15
            }, {
                "year" : "1968",
                "value": -0.16
            }, {
                "year" : "1969",
                "value": -0.011
            }, {
                "year" : "1970",
                "value": -0.068
            }, {
                "year" : "1971",
                "value": -0.19
            }, {
                "year" : "1972",
                "value": -0.056
            }, {
                "year" : "1973",
                "value": 0.077
            }, {
                "year" : "1974",
                "value": -0.213
            }, {
                "year" : "1975",
                "value": -0.17
            }, {
                "year" : "1976",
                "value": -0.254
            }, {
                "year" : "1977",
                "value": 0.019
            }, {
                "year" : "1978",
                "value": -0.063
            }, {
                "year" : "1979",
                "value": 0.05
            }, {
                "year" : "1980",
                "value": 0.077
            }, {
                "year" : "1981",
                "value": 0.12
            }, {
                "year" : "1982",
                "value": 0.011
            }, {
                "year" : "1983",
                "value": 0.177
            }, {
                "year" : "1984",
                "value": -0.021
            }, {
                "year" : "1985",
                "value": -0.037
            }, {
                "year" : "1986",
                "value": 0.03
            }, {
                "year" : "1987",
                "value": 0.179
            }, {
                "year" : "1988",
                "value": 0.18
            }, {
                "year" : "1989",
                "value": 0.104
            }, {
                "year" : "1990",
                "value": 0.255
            }, {
                "year" : "1991",
                "value": 0.21
            }, {
                "year" : "1992",
                "value": 0.065
            }, {
                "year" : "1993",
                "value": 0.11
            }, {
                "year" : "1994",
                "value": 0.172
            }, {
                "year" : "1995",
                "value": 0.269
            }, {
                "year" : "1996",
                "value": 0.141
            }, {
                "year" : "1997",
                "value": 0.353
            }, {
                "year" : "1998",
                "value": 0.548
            }, {
                "year" : "1999",
                "value": 0.298
            }, {
                "year" : "2000",
                "value": 0.267
            }, {
                "year" : "2001",
                "value": 0.411
            }, {
                "year" : "2002",
                "value": 0.462
            }, {
                "year" : "2003",
                "value": 0.47
            }, {
                "year" : "2004",
                "value": 0.445
            }, {
                "year" : "2005",
                "value": 0.47
            } ],
            "valueAxes"     : [ {
                "axisAlpha": 0,
                "position" : "left"
            } ],
            "graphs"        : [ {
                "id"               : "g1",
                "balloonText"      : "[[category]]<br><b><span style='font-size:14px;'>[[value]]</span></b>",
                "bullet"           : "round",
                "bulletSize"       : 6,
                "lineColor"        : "#d1655d",
                "lineThickness"    : 2,
                "negativeLineColor": "#637bb6",
                "type"             : "smoothedLine",
                "valueField"       : "value"
            } ],
            "chartScrollbar": {
                "graph"                  : "g1",
                "gridAlpha"              : 0,
                "color"                  : "#888888",
                "scrollbarHeight"        : 55,
                "backgroundAlpha"        : 0,
                "selectedBackgroundAlpha": 0.1,
                "selectedBackgroundColor": "#888888",
                "graphFillAlpha"         : 0,
                "autoGridCount"          : true,
                "selectedGraphFillAlpha" : 0,
                "graphLineAlpha"         : 0.2,
                "graphLineColor"         : "#c2c2c2",
                "selectedGraphLineColor" : "#888888",
                "selectedGraphLineAlpha" : 1

            },
            "chartCursor"   : {
                "categoryBalloonDateFormat": "YYYY",
                "cursorAlpha"              : 0,
                "valueLineEnabled"         : true,
                "valueLineBalloonEnabled"  : true,
                "valueLineAlpha"           : 0.5,
                "fullWidth"                : true
            },
            "dataDateFormat": "YYYY",
            "categoryField" : "year",
            "categoryAxis"  : {
                "minPeriod"       : "YYYY",
                "parseDates"      : true,
                "minorGridAlpha"  : 0.1,
                "minorGridEnabled": true
            },
            "export"        : {
                "enabled": false
            }
        });

        chart.addListener("rendered", zoomChart);
        if (chart.zoomChart) {
            chart.zoomChart();
        }

        function zoomChart() {
            chart.zoomToIndexes(Math.round(chart.dataProvider.length * 0.4), Math.round(chart.dataProvider.length * 0.55));
        }
    },
    animateamChart = function () {
        "use strict";
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
    };
var Chart = function () {
    "use strict";
    return {
        init: function () {
            am_chart();
            animateamChart();
        }
    }
}();
$(function () {
    Chart.init();
});