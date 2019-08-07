"use strict";
var randomScalingFactor = function () {
        return Math.round(100 * Math.random())
    },
    stacked_chart = {
        labels  : [ "January", "February", "March", "April", "May", "June", "July" ],
        datasets: [ {
            label          : 'USA',
            backgroundColor     : [ "#5797fc", "#7e6fff", "#4ecc48", "#ffcc29", "#f37070" ],
            hoverBackgroundColor: [ "#5797fc", "#7e6fff", "#4ecc48", "#ffcc29", "#f37070" ],
            stack          : 'Stack 0',
            data           : [
                randomScalingFactor(),
                randomScalingFactor(),
                randomScalingFactor(),
                randomScalingFactor(),
                randomScalingFactor(),
                randomScalingFactor(),
                randomScalingFactor()
            ]
        }, {
            label          : 'Brazil',
            backgroundColor     : [ "#5797fc", "#7e6fff", "#4ecc48", "#ffcc29", "#f37070" ],
            hoverBackgroundColor: [ "#5797fc", "#7e6fff", "#4ecc48", "#ffcc29", "#f37070" ],
            stack          : 'Stack 0',
            data           : [
                randomScalingFactor(),
                randomScalingFactor(),
                randomScalingFactor(),
                randomScalingFactor(),
                randomScalingFactor(),
                randomScalingFactor(),
                randomScalingFactor()
            ]
        }, {
            label          : 'India',
            backgroundColor: "#ffcc29",
            stack          : 'Stack 1',
            data           : [
                randomScalingFactor(),
                randomScalingFactor(),
                randomScalingFactor(),
                randomScalingFactor(),
                randomScalingFactor(),
                randomScalingFactor(),
                randomScalingFactor()
            ]
        } ]
    },

    point_sizes = {
        labels  : [ "January", "February", "March", "April", "May", "June", "July" ],
        datasets: [ {
            label           : "USA",
            data            : [
                randomScalingFactor(),
                randomScalingFactor(),
                randomScalingFactor(),
                randomScalingFactor(),
                randomScalingFactor(),
                randomScalingFactor(),
                randomScalingFactor()
            ],
            backgroundColor     : "#ffcc29",
            borderColor: "#ffcc29",
            fill            : false,
            borderDash      : [ 5, 5 ],
            pointRadius     : 3,
            pointHoverRadius: 3,
        }, {
            label          : "Brazil",
            data           : [
                randomScalingFactor(),
                randomScalingFactor(),
                randomScalingFactor(),
                randomScalingFactor(),
                randomScalingFactor(),
                randomScalingFactor(),
                randomScalingFactor()
            ],
            backgroundColor     : "#7e6fff",
            borderColor: "#7e6fff",
            fill           : false,
            borderDash     : [ 5, 5 ],
            pointRadius    : [ 2, 4, 6, 4, 0, 6, 3 ],
        }, {
            label           : "Russia",
            data            : [
                randomScalingFactor(),
                randomScalingFactor(),
                randomScalingFactor(),
                randomScalingFactor(),
                randomScalingFactor(),
                randomScalingFactor(),
                randomScalingFactor()
            ],
            backgroundColor     : "#5797fc",
            borderColor: "#5797fc",
            fill            : false,
            pointHoverRadius: 10,
        }, {
            label          : "India",
            data           : [
                randomScalingFactor(),
                randomScalingFactor(),
                randomScalingFactor(),
                randomScalingFactor(),
                randomScalingFactor(),
                randomScalingFactor(),
                randomScalingFactor()
            ],
            backgroundColor     : "#4ecc48",
            borderColor: "#4ecc48",
            fill           : false,
            pointHitRadius : 3,
        } ]
    },

    doughnutChartData = {
        labels  : [ "USA", "Brazil", "Russia", "India", "Australia"],
        datasets: [ {
            data           : [ randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor() ],
            backgroundColor     : [ "#5797fc", "#7e6fff", "#4ecc48", "#ffcc29", "#f37070" ],
            hoverBackgroundColor: [ "#5797fc", "#7e6fff", "#4ecc48", "#ffcc29", "#f37070" ],
            borderWidth    : 1,
            label          : "My dataset"
        } ]
    },

    pie_chart = {
        type   : 'pie',
        data   : {
            datasets: [ {
                data           : [
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                ],
                backgroundColor     : [ "#5797fc", "#7e6fff", "#4ecc48", "#ffcc29", "#f37070" ],
                hoverBackgroundColor: [ "#5797fc", "#7e6fff", "#4ecc48", "#ffcc29", "#f37070" ],
                label          : 'Dataset 1'
            } ],
            labels  : [ "USA", "Brazil", "Russia", "India", "Australia"],
        },
        options: {
            responsive: true,
            legend          : {
                display: true
            },
            animation       : {
                animateScale: true
            },
        }
    },

    Chartt = function () {
        "use strict";
        var a = document.getElementById("stacked_chart").getContext("2d"),
            c = (new Chart(a, {
                type   : 'bar',
                data   : stacked_chart,
                options: {
                    title     : {
                        display: true,
                        text   : "Chart.js Bar Chart - Stacked"
                    },
                    tooltips  : {
                        mode     : 'index',
                        intersect: false
                    },
                    responsive: true,
                    scales    : {
                        xAxes: [ {
                            stacked: true
                        } ],
                        yAxes: [ {
                            stacked: true
                        } ]
                    }
                }
            }),

                document.getElementById("point_sizes").getContext("2d")),
            e = (new Chart(c, {
                type   : "line",
                data   : point_sizes,
                options: {
                    responsive: true,
                    legend    : {
                        position: 'bottom',
                    },
                    hover     : {
                        mode: 'index'
                    },
                    scales    : {
                        xAxes: [ {
                            display   : true,
                            scaleLabel: {
                                display    : true,
                                labelString: 'Month'
                            }
                        } ],
                        yAxes: [ {
                            display   : true,
                            scaleLabel: {
                                display    : true,
                                labelString: 'Value'
                            }
                        } ]
                    },
                    title     : {
                        display: true,
                        text   : 'Chart.js Line Chart - Different point sizes'
                    }
                }
            }));

        var j = document.getElementById("doughnut_chart").getContext("2d");
        window.myDoughnut = new Chart(j, {
            type: "doughnut",
            data: doughnutChartData,
            options: {
                legend          : {
                    display: true
                },
                animation       : {
                    animateScale: true
                },
                cutoutPercentage: 80
            }
        });


        var ctx = document.getElementById("chart-area").getContext("2d");
        window.myPie = new Chart(ctx, pie_chart);


    },
    ChartJs = function () {
        "use strict";
        return {
            init: function () {
                Chartt()
            }
        }
    }();
$(function () {
    ChartJs.init();
});