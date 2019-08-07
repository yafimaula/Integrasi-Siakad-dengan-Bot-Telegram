"use strict";
var spinner = function () {
    "use strict";
    Ladda.bind('button', {
        callback: function (instance) {
            var progress = 0;
            var interval = setInterval(function () {
                progress = Math.min(progress + Math.random() * 0.1, 1);
                instance.setProgress(progress);
                if (progress === 1) {
                    instance.stop();
                    clearInterval(interval);
                }
            }, 200);
        }
    });
};
var LaddaButton = function () {
    "use strict";
    return {
        init: function () {
            spinner();
        }
    }
}();
$(function () {
    LaddaButton.init();
});