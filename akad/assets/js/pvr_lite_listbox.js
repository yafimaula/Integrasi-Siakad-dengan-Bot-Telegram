"use strict";
var list = function () {
    "use strict";
    var demo1 = $('select[name="duallistbox_demo1[]"]').bootstrapDualListbox();
    $("#demoform").submit(function () {
        alert($('[name="duallistbox_demo1[]"]').val());
        return false;
    });
};
var Dual_list = function () {
    "use strict";
    return {
        init: function () {
            list();
        }
    }
}();
$(function () {
    Dual_list.init();
});