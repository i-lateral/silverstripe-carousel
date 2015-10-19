// global variables
var carousel_height = "$height";
var carousel_width = "$width";

// 2. This code loads the IFrame Player API code asynchronously.
var tag = document.createElement('script');

tag.src = "https://www.youtube.com/iframe_api";
var firstScriptTag = document.getElementsByTagName('script')[0];
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);


var carousel_videos = [$videos];

// 3. This function creates an <iframe> (and YouTube player)
//    after the API code downloads.
function onYouTubeIframeAPIReady() {
	var i;
	for (i = 0; i < carousel_videos.length; i++) {
		var video;
		video = new YT.Player(carousel_videos[i], {
			height: carousel_height,
			width: carousel_width,
			videoId: carousel_videos[i],
			// events not needed for this purpose 
			// ->addExtraEvents("'onReady': onPlayerReady","'onStateChange': onPlayerStateChange") may be usefull
			events: {
				'onReady': onPlayerReady,
			//  'onStateChange': onPlayerStateChange
			}
		});
		carousel_players.push(video);
	}
}
// 4. The API will call this function when the video player is ready.
function onPlayerReady(event) {
	carousel_yt_api = true;
}
