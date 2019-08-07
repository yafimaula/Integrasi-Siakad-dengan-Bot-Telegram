"use strict";
var DataTableFixedHeader = function () {
        "use strict";
        0 !== $("#data-table").length && $("#data-table").DataTable({
            lengthMenu : [ 20, 40, 60 ],
            fixedHeader: {
                header      : !0,
                headerOffset: $("#header").height()
            },
            responsive : !0
        })
    },
    TableManageFixedHeader = function () {
        "use strict";
        return {
            init: function () {
                DataTableFixedHeader()
            }
        }
    }();
$(function () {
    TableManageFixedHeader.init();
});