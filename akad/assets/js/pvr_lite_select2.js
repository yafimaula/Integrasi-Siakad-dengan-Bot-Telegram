"use strict";
var select2 = function () {
    "use strict";

    $("#select2").select2({
        placeholder: 'Select An Option'
    });

    $("#select2_multiple").select2({
        placeholder: 'Select An Option'
    });

    var data = [
        {
            id  : 0,
            text: 'enhancement'
        },
        {
            id  : 1,
            text: 'bug'
        },
        {
            id  : 2,
            text: 'duplicate'
        },
        {
            id  : 3,
            text: 'invalid'
        },
        {
            id  : 4,
            text: 'wontfix'
        }
    ];

    $(".js-example-data-array").select2({
        data: data
    });

    $("#limiting").select2({
        maximumSelectionLength: 2
    });

    $("#clearable").select2({
        placeholder: 'This is my placeholder',
        allowClear : true
    });

    $("#hide-search").select2({
        minimumResultsForSearch: Infinity
    });

};

var Select = function () {
    "use strict";
    return {
        init: function () {
            select2();
        }
    }
}();
$(function () {
    Select.init();
});