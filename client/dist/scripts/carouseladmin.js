(function($) {
    $.entwine("ss", function($) {
        $("input#Form_EditForm_ShowCarousel").entwine({
            onmatch: function (event) {
                alert("item");
            }
        });
    });
})(jQuery);