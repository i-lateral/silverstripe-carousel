(function($) {
    $.entwine("ss", function($) {
        // cache previous search results
        var searchCache = {};

        var display_fields = [
            "#Form_EditForm_CarouselShowIndicators_Holder",
            "#Form_EditForm_CarouselShowControls_Holder",
            "#Form_EditForm_CarouselWidth_Holder",
            "#Form_EditForm_CarouselHeight_Holder",
            "#Form_EditForm_CarouselInterval_Holder",
        ];

        $("input#Form_EditForm_ShowCarousel").entwine({
            onmatch: function() {
                this.togglefields();
            },
            onchange: function() {
                this.togglefields();
            },
            togglefields: function()
            {
                for (var i in display_fields) {
                    var field = $(display_fields[i]);
                    if ($(this).is(":checked")) {
                        field.show();
                    } else {
                        field.hide();
                    }
                }
            },
        });
    });
})(jQuery);