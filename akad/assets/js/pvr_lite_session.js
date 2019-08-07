"use strict";
var session = function () {
    "use strict";
    $.sessionTimeout({
        title             : "Session Timeout Notification",
        message           : "Your session is about to expire.",
        //keepAliveUrl      : "../demo/timeout-keep-alive.php",
        redirUrl          : "index.html",
        logoutUrl         : "pvr_login_v1.html",
        warnAfter         : 5e3,
        redirAfter        : 15e3,
        ignoreUserActivity: !0,
        countdownMessage  : "Redirecting in {timer} seconds.",
        countdownBar      : !0
    });

    var now = new Date(),
        hourDeg = now.getHours() / 12 * 360 + now.getMinutes() / 60 * 30,
        minuteDeg = now.getMinutes() / 60 * 360 + now.getSeconds() / 60 * 6,
        secondDeg = now.getSeconds() / 60 * 360,
        stylesDeg = [
            "@-webkit-keyframes rotate-hour{from{transform:rotate(" + hourDeg + "deg);}to{transform:rotate(" + (hourDeg + 360) + "deg);}}",
            "@-webkit-keyframes rotate-minute{from{transform:rotate(" + minuteDeg + "deg);}to{transform:rotate(" + (minuteDeg + 360) + "deg);}}",
            "@-webkit-keyframes rotate-second{from{transform:rotate(" + secondDeg + "deg);}to{transform:rotate(" + (secondDeg + 360) + "deg);}}",
            "@-moz-keyframes rotate-hour{from{transform:rotate(" + hourDeg + "deg);}to{transform:rotate(" + (hourDeg + 360) + "deg);}}",
            "@-moz-keyframes rotate-minute{from{transform:rotate(" + minuteDeg + "deg);}to{transform:rotate(" + (minuteDeg + 360) + "deg);}}",
            "@-moz-keyframes rotate-second{from{transform:rotate(" + secondDeg + "deg);}to{transform:rotate(" + (secondDeg + 360) + "deg);}}"
        ].join("");
    document.getElementById("clock-animations").innerHTML = stylesDeg;
};
var Session = function () {
    "use strict";
    return {
        init: function () {
            session();
        }
    }
}();
$(function () {
    Session.init();
});