    // add to slide in template
    // <!-- 1. The <iframe> (and video player) will replace this <div> tag. -->
    // <div id="yt_id"></div>

    <script>
		
		var height = $height;
		var width = $width;
		var players = array();
	</script>
	<script>
      // 2. This code loads the IFrame Player API code asynchronously.
      var tag = document.createElement('script');

      tag.src = "https://www.youtube.com/iframe_api";
      var firstScriptTag = document.getElementsByTagName('script')[0];
      firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

      // 3. This function creates an <iframe> (and YouTube player)
      //    after the API code downloads.
      function onYouTubeIframeAPIReady() {
        yt_id = new YT.Player('yt_id', {
          height: 'height',
          width: 'width',
          videoId: 'yt_id',
          // events not needed for this purpose (an ->addEvents('name','call') function may be usefull)
          //events: {
          //  'onReady': onPlayerReady,
          //  'onStateChange': onPlayerStateChange
          //}
        });
        players.add(yt_id);
      }
      
      //new flexslider code:
		$('.flexslider').flexslider({
            animation: "slide",
            selector: ".slides > .slide",
            before: function() {
				players.each().pauseVideo()
			}
        });
    </script>
