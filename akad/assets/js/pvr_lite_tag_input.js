"use strict";
var input_tag = function () {
    "use strict";

    var cities = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('text'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        prefetch      : 'assets/plugins/bootstrap-tagsinput/cities.json'
    });
    cities.initialize();

    var citynames = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        prefetch      : {
            url   : 'assets/plugins/bootstrap-tagsinput/citynames.json',
            filter: function (list) {
                return $.map(list, function (cityname) {
                    return {name: cityname};
                });
            }
        }
    });
    citynames.initialize();

    $('.typeaheadjs').tagsinput({
        typeaheadjs: {
            name      : 'citynames',
            displayKey: 'name',
            valueKey  : 'name',
            source    : citynames.ttAdapter()
        }
    });


    var elt = $('.example_objects_as_tags');
    elt.tagsinput({
        itemValue  : 'value',
        itemText   : 'text',
        typeaheadjs: {
            name      : 'cities',
            displayKey: 'text',
            source    : cities.ttAdapter()
        }
    });

    elt.tagsinput('add', {"value": 1, "text": "Amsterdam", "continent": "Europe"});
    elt.tagsinput('add', {"value": 4, "text": "Washington", "continent": "America"});
    elt.tagsinput('add', {"value": 7, "text": "Sydney", "continent": "Australia"});
    elt.tagsinput('add', {"value": 10, "text": "Beijing", "continent": "Asia"});
    elt.tagsinput('add', {"value": 13, "text": "Cairo", "continent": "Africa"});

    /**
     * Categorizing tags
     */
    var elt = $('.example_tagclass');
    elt.tagsinput({
        tagClass   : function (item) {
            switch (item.continent) {
                case 'Europe'   :
                    return 'badge badge-primary';
                case 'America'  :
                    return 'badge badge-danger badge-important';
                case 'Australia':
                    return 'badge badge-success';
                case 'Africa'   :
                    return 'badge badge-purple';
                case 'Asia'     :
                    return 'badge badge-warning';
            }
        },
        itemValue  : 'value',
        itemText   : 'text',
        // typeaheadjs: {
        //   name: 'cities',
        //   displayKey: 'text',
        //   source: cities.ttAdapter()
        // }
        typeaheadjs: [
            {
                hint     : true,
                highlight: true,
                minLength: 2
            },
            {
                name      : 'cities',
                displayKey: 'text',
                source    : cities.ttAdapter()
            }
        ]
    });
    elt.tagsinput('add', {"value": 1, "text": "Amsterdam", "continent": "Europe"});
    elt.tagsinput('add', {"value": 4, "text": "Washington", "continent": "America"});
    elt.tagsinput('add', {"value": 7, "text": "Sydney", "continent": "Australia"});
    elt.tagsinput('add', {"value": 10, "text": "Beijing", "continent": "Asia"});
    elt.tagsinput('add', {"value": 13, "text": "Cairo", "continent": "Africa"});

// HACK: overrule hardcoded display inline-block of typeahead.js
    $(".twitter-typeahead").css('display', 'inline');
};
var Tag = function () {
    "use strict";
    return {
        init: function () {
            input_tag();
        }
    }
}();
$(function () {
    Tag.init();
});