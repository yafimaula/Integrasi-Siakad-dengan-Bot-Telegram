"use strict";
var DataTableButtons = function () {
        "use strict";
        0 !== $("#data-table").length && $("#data-table").DataTable({
            dom       : "Bfrtip",
            buttons   : [ {
                extend   : "copy",
                className: "btn-purple"
            }, {
                extend   : "csv",
                className: "btn-purple"
            }, {
                extend   : "excel",
                className: "btn-purple"
            }, {
                extend   : "pdf",
                className: "btn-purple"
            }, {
                extend   : "print",
                className: "btn-purple"
            } ],
            responsive: !0
        })
    },
    TableManageButtons = function () {
        "use strict";
        return {
            init: function () {
                DataTableButtons()
            }
        }
    }();
$(function () {
    TableManageButtons.init();
});