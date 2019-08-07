"use strict";
var inputmask = function () {
    "use strict";
    $("input").inputmask();
};
var Mask = function () {
    "use strict";
    return {
        init: function () {
            inputmask();
        }
    }
}();
$(function () {
    Mask.init();
});