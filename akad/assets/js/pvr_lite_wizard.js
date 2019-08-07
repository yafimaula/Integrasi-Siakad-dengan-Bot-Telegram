"use strict";
var smartWizard = function () {
    "use strict";
    $("#smartwizard").on("showStep", function (e, anchorObject, stepNumber, stepDirection, stepPosition) {
        //alert("You are on step "+stepNumber+" now");
        if (stepPosition === 'first') {
            $("#prev-btn").addClass('disabled');
        } else if (stepPosition === 'final') {
            $("#next-btn").addClass('disabled');
        } else {
            $("#prev-btn").removeClass('disabled');
            $("#next-btn").removeClass('disabled');
        }
    });

    // Toolbar extra buttons
    var btnFinish = $('<button></button>').text('Finish')
        .addClass('btn btn-sm btn-success')
        .on('click', function () {
            alert('Finish Clicked');
        });
    var btnCancel = $('<button></button>').text('Cancel')
        .addClass('btn btn-sm btn-warning')
        .on('click', function () {
            $('#smartwizard').smartWizard("reset");
        });


    // Smart Wizard
    $('#smartwizard').smartWizard({
        selected        : 0,
        theme           : 'default',
        transitionEffect: 'fade',
        showStepURLhash : true,
        toolbarSettings : {
            toolbarPosition      : 'both',
            toolbarButtonPosition: 'right',
            toolbarExtraButtons  : [ btnCancel, btnFinish ]
        }
    });


    // External Button Events
    $("#reset-btn").on("click", function () {
        // Reset wizard
        $('#smartwizard').smartWizard("reset");
        return true;
    });

    $("#prev-btn").on("click", function () {
        // Navigate previous
        $('#smartwizard').smartWizard("prev");
        return true;
    });

    $("#next-btn").on("click", function () {
        // Navigate next
        $('#smartwizard').smartWizard("next");
        return true;
    });

    $("#theme_selector").on("change", function () {
        // Change theme
        $('#smartwizard').smartWizard("theme", $(this).val());
        return true;
    });

    // Set selected theme on page refresh
    $("#theme_selector").change();
};
var Wizard = function () {
    "use strict";
    return {
        init: function () {
            smartWizard();
        }
    }
}();
$(function () {
    Wizard.init();
});