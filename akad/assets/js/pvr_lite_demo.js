"use strict";
var toolTip = function () {
        $("[data-toggle=\"tooltip\"]").tooltip({
            placement: "top"
        });
    },
    Demo = function () {
        "use strict";
        return {
            init         : function () {
                this.initComponent();
            },
            initComponent: function () {
                toolTip();
            },
            icons        : function () {

            }
        }
    }();
$(function () {
    Demo.init();
});
window.dataLayer = window.dataLayer || [];
function gtag(){dataLayer.push(arguments);}
gtag('js', new Date());

gtag('config', 'UA-66289183-8');