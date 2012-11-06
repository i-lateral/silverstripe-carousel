(function($) {
	$(document).ready(function() { 		 
		$('.carousel-slides')
			.tabs({
				show: function(event, ui) {					
					var lastOpenedPanel = $(this).data("lastOpenedPanel");
					
					new_left = '765px';
					old_left = '-765px';
					
					if(lastOpenedPanel) {
						new_index = ui.index;
						old_index = parseInt(lastOpenedPanel.attr('id').replace('carousel-slide-', ''));
						
						console.log(new_index);
						console.log(old_index);
						
						if(new_index < old_index) {
							new_left = '-765px';
							old_left = '765px';
						}
					}
					    
					if (!$(this).data("topPositionTab")) {
						$(this).data("topPositionTab", $(ui.panel).position().top)
					}         
					
					// Dont use the builtin fx effects. This will fade in/out both tabs, we dont want that
					// Fadein the new tab yourself            
					$(ui.panel)
						.css('left',new_left)
						.show()
						.animate({ left: 0 }, 500);
					
					if (lastOpenedPanel) {
						// 1. Show the previous opened tab by removing the jQuery UI class
						// 2. Make the tab temporary position:absolute so the two tabs will overlap
						// 3. Set topposition so they will overlap if you go from tab 1 to tab 0
						// 4. Remove position:absolute after animation
						lastOpenedPanel
						.toggleClass("ui-tabs-hide")
						.animate({ left: old_left }, 500)
						.css({ left: 0 });
					}
					
					//Saving the last tab has been opened
					$(this).data("lastOpenedPanel", $(ui.panel));
				}
			})
			.tabs('rotate', 8000, true);
			
	});
			
	// Add hover effect to stop tab animation
	$('.carousel-slides').hover(
		function() {
			$(this).tabs('rotate', 0, false);
		}, function() {
			$(this).tabs('rotate', 8000, true);
		}
	);
})(jQuery)
