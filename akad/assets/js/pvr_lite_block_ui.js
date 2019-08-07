"use strict";
function run_waitMe_body(effect) {
    $('body').addClass('waitMe_body');
    var img = '';
    var text = '';
    if (effect == 'img') {
        img = 'background:url(\'assets/img/img.svg\')';
    } else if (effect == 'text') {
        text = 'Loading...';
    } else {
        img = "background:#9368E9"
    }
    var elem = $('<div class="waitMe_container ' + effect + '"><div style="' + img + ';">' + text + '</div></div>');
    $('body').prepend(elem);

    setTimeout(function () {
        $('body.waitMe_body').addClass('hideMe');
        setTimeout(function () {
            $('body.waitMe_body').find('.waitMe_container:not([data-waitme_id])').remove();
            $('body.waitMe_body').removeClass('waitMe_body hideMe');
        }, 200);
    }, 4000);
}

function run_waitMe(el, num, effect, body) {
    var text;
    text = 'Please wait...';
    var fontSize;
    fontSize = '';
    switch (num) {
        case 1:
            var maxSize;
            maxSize = '';
            var textPos;
            textPos = 'vertical';
            break;
        case 2:
            text = '';
            maxSize = 30;
            textPos = 'vertical';
            break;
        case 3:
            maxSize = 30;
            textPos = 'horizontal';
            fontSize = '18px';
            break;
    }
    el.waitMe({
        effect  : effect,
        text    : text,
        bg      : (body == undefined) ? 'rgba(255,255,255,0.7)' : "rgba(0, 0, 0, 0.8)",
        color   : (body == undefined) ? '#9368E9' : '#FFFFFF',
        maxSize : maxSize,
        waitTime: (body == undefined) ? -1 : 4000,
        source  : 'assets/img/img.svg',
        textPos : textPos,
        fontSize: fontSize,
        onClose : function (el) {
        }
    });
}

var block = function () {
    "use strict";
    var current_effect = $('#waitMe_ex_effect').val();
    var current_body_effect = $('#waitMe_ex_body_effect').val();
    $('#waitMe_ex').on("click", function () {
        run_waitMe($('.containerBlock'), 1, current_effect);
    });
    $('.waitMe_ex_close').on("click", function () {
        $('.containerBlock').waitMe('hide');
    });

    $('#waitMe_ex_effect').on("change", function () {
        current_effect = $(this).val();
        run_waitMe($('.containerBlock'), 1, current_effect);
    });

    $('#waitMe_ex_effect_body').on("change", function () {
        current_effect = $(this).val();
        run_waitMe($('body'), 1, current_effect, "body");
    });

    $('#waitMe_ex_effect').on("click", function () {
        current_effect = $(this).val();
    });

    $('#waitMe_ex_body').on("click", function () {
        run_waitMe_body(current_body_effect);
    });

    $('#waitMe_ex_body_effect').on("change", function () {
        current_body_effect = $(this).val();
        run_waitMe_body(current_body_effect);
    });

};
var BlockUI = function () {
    "use strict";
    return {
        init: function () {
            block();
        }
    }
}();
$(function () {
    BlockUI.init();
});