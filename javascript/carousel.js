(function($) {
    $(document).ready(function() {
        /**
         * Flexslider animation
         */
        $('.flexslider').flexslider({
            animation: "slide",
            selector: ".slides > .slide"
        });

        // Add the line below to your own JS to set the opacity of the carousel
        $('.flexslider .slide .slide-content').css({ opacity: 0.75 });
    });
})(jQuery)
