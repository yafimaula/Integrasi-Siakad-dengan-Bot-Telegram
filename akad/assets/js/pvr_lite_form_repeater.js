"use strict";
var repeter = function () {
    "use strict";
    $('.repeater').repeater({
        defaultValues: {
            'textarea-input': 'foo',
            'text-input'    : 'bar',
            'select-input'  : 'B',
            'checkbox-input': [ 'A', 'B' ],
            'radio-input'   : 'B'
        },
        show         : function () {
            $(this).slideDown();
        },
        hide         : function (deleteElement) {
            swal({
                    title             : "Are you sure?",
                    text              : "Are you sure you want to delete this element?",
                    type              : "warning",
                    showCancelButton  : true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText : "Yes, delete it!",
                    closeOnConfirm    : false
                },
                function () {
                    swal({
                        title: "Deleted!",
                        type : "success",
                        text : "Your element has been deleted.!",
                        timer: 1000
                    });
                    $(this).slideUp(deleteElement);
                });
        },
        ready        : function (setIndexes) {

        }
    });
};
var FormRepeter = function () {
    "use strict";
    return {
        init: function () {
            repeter();
        }
    }
}();
$(function () {
    FormRepeter.init();
});