"use strict";
var DataTableColReorder = function () {
        "use strict";
        0 !== $("#data-table").length && $("#data-table").DataTable({
            colReorder: !0,
            responsive: !0
        })
    },
    TableManageColReorder = function () {
        "use strict";
        return {
            init: function () {
                DataTableColReorder()
            }
        }
    }();
$(function () {
    TableManageColReorder.init();
});