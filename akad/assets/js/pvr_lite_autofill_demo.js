"use strict";
var DataTableAutofill = function () {
    "use strict";
    if ($('#data-table').length !== 0) {
        $('#data-table').DataTable({
            autoFill  : true,
            responsive: true
        });
    }
};

var TableManageAutofill = function () {
    "use strict";
    return {
        //main function
        init: function () {
            DataTableAutofill();
        }
    };
}();
$(function () {
    TableManageAutofill.init();
});