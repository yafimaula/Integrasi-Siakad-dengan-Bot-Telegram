"use strict";
var DataTableDefault = function () {
        "use strict";
        0 !== $("#data-table").length && $("#data-table").DataTable({
            responsive: true
        })
    },
    TableManageDefault = function () {
        "use strict";
        return {
            init: function () {
                DataTableDefault()
            }
        }
    }();
$(function () {
    TableManageDefault.init();
});