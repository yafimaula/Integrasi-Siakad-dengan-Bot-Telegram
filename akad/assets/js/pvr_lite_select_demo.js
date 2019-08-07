"use strict";
var DataTableSelect = function () {
        "use strict";
        0 !== $("#data-table").length && $("#data-table").DataTable({
            select    : !0,
            responsive: !0
        })
    },
    TableManageTableSelect = function () {
        "use strict";
        return {
            init: function () {
                DataTableSelect()
            }
        }
    }();
$(function () {
    TableManageTableSelect.init();
});