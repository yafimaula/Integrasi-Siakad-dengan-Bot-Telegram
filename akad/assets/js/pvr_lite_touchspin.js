"use strict";
var spin = function () {
    "use strict";
    $("input[name='demo1']").TouchSpin({
        min           : 0,
        max           : 100,
        step          : 0.1,
        decimals      : 2,
        boostat       : 5,
        maxboostedstep: 10,
        postfix       : '%'
    });

    $("input[name='demo2']").TouchSpin({
        min           : -1000000000,
        max           : 1000000000,
        stepinterval  : 50,
        maxboostedstep: 10000000,
        prefix        : '$'
    });

    $("input[name='demo3']").TouchSpin();

    $("input[name='demo3_21']").TouchSpin({
        initval: 40
    });

    $("input[name='demo4']").TouchSpin({
        postfix: "a button",
        postfix_extraclass: "btn btn-purple m-b-0"
    });

    $("input[name='demo5']").TouchSpin({
        prefix: "pre",
        postfix: "post"
    });

    $("input[name='demo6']").TouchSpin({
        buttondown_class: "btn btn-purple",
        buttonup_class: "btn btn-purple"
    });
};
var Touchspin = function () {
    "use strict";
    return {
        init: function () {
            spin();
        }
    }
}();
$(function () {
    Touchspin.init();
});