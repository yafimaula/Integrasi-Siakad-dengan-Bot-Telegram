"use strict";
var color_picker = function () {
    "use strict";

    $("#default").colorpicker();

    $('#cp2').colorpicker();

    $('#format').colorpicker({
        format: "rgba"
    });

    $('#horizontal').colorpicker({
        horizontal: true
    });

    $('#alpha').colorpicker({
        useAlpha: false
    });

    $('#hash').colorpicker({
        useHashPrefix: false
    });

};
var Color = function () {
    "use strict";
    return {
        init: function () {
            color_picker();
        }
    }
}();
$(function () {
    Color.init();
});