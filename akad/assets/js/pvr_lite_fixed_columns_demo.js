"use strict";
var DataTableFixedColumns = function () {
        "use strict";
        0 !== $("#data-table").length && $("#data-table").DataTable({
            scrollY       : 300,
            scrollX       : !0,
            scrollCollapse: !0,
            paging        : !1,
            fixedColumns  : !0
        })
    },
    TableManageFixedColumns = function () {
        "use strict";
        return {
            init: function () {
                DataTableFixedColumns()
            }
        }
    }();
$(function () {
    TableManageFixedColumns.init();
});