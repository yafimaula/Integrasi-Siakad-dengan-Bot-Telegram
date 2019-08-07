"use strict";
var blog = function () {
    "use strict";
    if ($(".blog-masonry-list").length) {
        setTimeout(function () {
            var $container = $(".blog-masonry-list");
            $container.isotope({
                layoutMode     : 'masonry',
                percentPosition: true,
                itemSelector   : ".blog-masonry-box"
            });
        }, 500);

        $("#minimizeSidebar").on("click", function () {
            setTimeout(function () {
                $container.isotope('reLayout');
            }, 500)
        })

    }
};
var Blog = function () {
    "use strict";
    return {
        init: function () {
            blog();
        }
    }
}();
$(function () {
    Blog.init();
});