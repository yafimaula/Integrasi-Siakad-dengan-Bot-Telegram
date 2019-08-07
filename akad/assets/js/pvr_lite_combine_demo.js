"use strict";
var DataTableCombinationSetting = function () {
        "use strict";
        0 !== $("#data-table").length && $("#data-table").DataTable({
            dom       : "lBfrtip",
            buttons   : [ {
                extend   : "copy",
                className: "btn-purple",
                text:"<i class='fa fa-copy'></i>"
            }, {
                extend   : "excel",
                className: "btn-purple",
                text:"<i class='fa fa-file-excel-o'></i>"
            }, {
                extend   : "pdf",
                className: "btn-purple",
                text:"<i class='fa fa-file-pdf-o'></i>"
            }, {
                extend   : "print",
                className: "btn-purple",
                text:"<i class='fa fa-print'></i>"
            } ],
            responsive: !0,
            autoFill  : !0,
            colReorder: !0,
            keys      : !0,
            rowReorder: !0,
            select    : !0
        })
    },
    TableManageCombine = function () {
        "use strict";
        return {
            init: function () {
                DataTableCombinationSetting()
            }
        }
    }();
$(function () {
    TableManageCombine.init();
});