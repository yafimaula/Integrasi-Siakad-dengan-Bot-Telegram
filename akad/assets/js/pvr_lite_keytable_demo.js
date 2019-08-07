"use strict";
var DataTableKeyTable = function () {
        "use strict";
        0 !== $("#data-table").length && $("#data-table").DataTable({
            scrollY   : 300,
            paging    : !1,
            autoWidth : !0,
            keys      : !0,
            responsive: !0
        })
    },
    TableManageKeyTable = function () {
        "use strict";
        return {
            init: function () {
                DataTableKeyTable()
            }
        }
    }();
$(function () {
    TableManageKeyTable.init();
});