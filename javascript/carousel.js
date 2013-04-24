(function($) {
	$(document).ready(function() {
		$('.carousel-slides')
			.tabs({
				activate: function(event, ui) {					
					new_left = $(this).width() + 'px';
					old_left = '-' + $(this).width() + 'px';
                    
                    // If we are at the end of the tabs, loop back around
					if(ui.oldPanel) {
						new_index = ui.newPanel.index();
						old_index = ui.oldPanel.index();
						
						if(new_index < old_index) {
							new_left = '-' + $(this).width() + 'px';
							old_left = $(this).width() + 'px';
						}
					}    
					
					// Dont use the builtin fx effects.          
					$(ui.newPanel)
						.css('left',new_left)
						.show()
						.animate({ left: 0 }, 500);
					
					if(ui.oldPanel) {
						ui.oldPanel
                            .show()
                            .animate({ left: old_left }, 500);
					}
				}
			})
			.tabs('rotate', 5000, true);
			
			
		// Add hover effect to stop tab animation
		$('.carousel-slides').hover(
			function() {
				$(this).tabs('rotate', 0, false);
			}, function() {
				$(this).tabs('rotate', 5000, true);
			}
		);
		
		// Set transparency on h2's
		$('.carousel-slides .carousel-slide .carousel-slide-content').css({ opacity: 0.75 });
	});
})(jQuery)
