var carousel_players = [];
var carousel_yt_api = false;
(function($) {

    $(document).ready(function() {
        /**
         * Flexslider animation
         */
        $('.flexslider').flexslider({
            animation: "slide",
            selector: ".slides > .slide",
            video: true,
			before: function() {
				if (carousel_yt_api == true) {
					var i;
					for (i = 0; i < carousel_players.length; i++) {
						carousel_players[i].pauseVideo()
					}
				}
			}
        });

        // Add the line below to your own JS to set the opacity of the carousel
        $('.flexslider .slide .slide-content').css({ opacity: 0.75 });
    });
})(jQuery)
