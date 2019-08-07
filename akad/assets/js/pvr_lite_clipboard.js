"use strict";
var copy = function () {
    "use strict";
    $(function () {
        $(".click_to_copy").tooltip({
            title  : "Copied",
            trigger: "click"
        });
        $('.click_to_copy').on('shown.bs.tooltip', function () {
            setTimeout(function () {
                $(".click_to_copy").tooltip("hide")
            }, 500)
        });
        $('.demo-2').on('shown.bs.tooltip', function () {
            setTimeout(function () {
                $(".demo-2").tooltip("hide")
            }, 500)
        });
        $('.demo-2').on("click", function () {
            $(this).CopyToClipboard();
            $(".demo-2").tooltip({
                title  : "Copied",
                trigger: "click"
            });
        });
    });
};
var Clipboard = function () {
    "use strict";
    return {
        init: function () {
            copy();
        }
    }
}();
$(function () {
    Clipboard.init();
});