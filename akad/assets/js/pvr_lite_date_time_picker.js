"use strict";
var picker = function () {
    "use strict";

    var start_date = new Date();
    $("#sandbox-container .date_picker").datepicker();

    $('#sandbox-container .input-daterange').datepicker({});

    $('#sandbox-container .input-group.date').datepicker({});

    $('#sandbox-container .date_format').datepicker({
        format: "dd/mm/yyyy"
    });

    $('#sandbox-container .date_week_start').datepicker({
        weekStart: 1
    });

    $('#sandbox-container .date_start_date').datepicker({
        startDate: start_date
    });

    $('#sandbox-container .date_end_date').datepicker({
        endDate: start_date
    });

    $('#sandbox-container .date_start_view').datepicker({
        startView: 2
    });

    $('#sandbox-container .date_today_button').datepicker({
        todayBtn: "linked"
    });

    $('#sandbox-container .date_clear_button').datepicker({
        clearBtn: true
    });

    $('#sandbox-container .date_inline').datepicker({});

    $('#sandbox-container .date_multi_date').datepicker({
        multidate: true
    });

    $('#sandbox-container .date_cal_weeks').datepicker({
        calendarWeeks: true
    });

    $('#sandbox-container .date_auto_close').datepicker({
        autoclose: true
    });

    $('#sandbox-container .date_tdy_highlight').datepicker({
        todayHighlight: true
    });

    $("#dpStartDate").datepicker("setDate", "07/13/1992");


    $(".date_time_pick").on("click", function () {
        $(this).prev().trigger("focus")
    });

    $('#date-time-picker .date_time_picker').datetimepicker({
        fontAwesome: true
    });

    $("#date-time-picker .form_datetime").datetimepicker({
        format     : "dd MM yyyy - hh:ii",
        fontAwesome: true
    });

    $("#date-time-picker .date_time_positionning").datetimepicker({
        fontAwesome   : true,
        pickerPosition: "top-left"
    });

    $("#date-time-picker .date_time_mirror_field").datetimepicker({
        fontAwesome: true,
        format     : "dd MM yyyy - hh:ii",
        linkField  : "mirror_field",
        linkFormat : "yyyy-mm-dd hh:ii",
        autoclose  : true
    });

    $("#date-time-picker .date_time_meridian").datetimepicker({
        format      : "dd MM yyyy - HH:ii P",
        showMeridian: true,
        autoclose   : true,
        todayBtn    : true,
        fontAwesome : true,
    });

    $("#date-time-picker .date_time_only").datetimepicker({
        fontAwesome : true,
        format      : "HH:ii P",
        showMeridian: true,
        autoclose   : true,
        startView   : 1
    });

    $("#date-time-picker .date_time_inline").datetimepicker({
        fontAwesome : true,
        format      : "HH:ii P",
        showMeridian: true,
        autoclose   : true,
        startView   : 1
    });

};
var DateTimePicker = function () {
    "use strict";
    return {
        init: function () {
            picker();
        }
    }
}();
$(function () {
    DateTimePicker.init();
});