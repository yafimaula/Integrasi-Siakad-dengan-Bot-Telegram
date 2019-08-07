"use strict";
var DataTableScroller = function () {
        "use strict";
        0 !== $("#data-table").length && $("#data-table").DataTable({
            ajax          : "assets/plugins/DataTables/json/scroller-demo.json",
            deferRender   : !0,
            scrollY       : 300,
            scrollCollapse: !0,
            scroller      : !0,
            responsive    : !0
        })
    },
    TableManageScroller = function () {
        "use strict";
        return {
            init: function () {
                DataTableScroller()
            }
        }
    }();
$(function () {
    TableManageScroller.init();
});
