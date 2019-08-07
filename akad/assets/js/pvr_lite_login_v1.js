"use strict";
var loginv1 = function () {
    "use strict";
    $(".form-control").focus(function () {
        $(this).parent().addClass("focused")
    }), $(".form-control").focusout(function () {
        var a = $(this);
        a.parents(".form-group-pvr").hasClass("form-float") ? "" == a.val() && a.parents(".form-line-pvr").removeClass("focused") : a.parents(".form-line-pvr").removeClass("focused")
    }), $("body").on("click", ".form-float .form-line-pvr .form-label", function () {
        $(this).parent().find("input").focus()
    });

    $.backstretch("assets/img/bg-login.jpg");
};
var Auth = function () {
    "use strict";
    return {
        init: function () {
            loginv1();
        }
    }
}();
$(function () {
    Auth.init();
});