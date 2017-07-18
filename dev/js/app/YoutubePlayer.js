define(['jquery'], function($) {
	
	// Constructor
	var YoutubePlayer = function(container, videoId, autoplay) {
	
		// Properties
		this.container = container;
		this.videoId = videoId;
		this.autoplay = autoplay;
		this.player = false;
		
		// Methods
		this.setup = function() {
			var that = this;
      if (typeof(YT) == 'undefined' || typeof(YT.Player) == 'undefined') {
        window.onYouTubeIframeAPIReady = function() {
          that.loadPlayer();
        };
        $.getScript('//www.youtube.com/iframe_api');
      } else {
        that.loadPlayer();
      }
    };
    this.loadPlayer = function() {
      this.player = new YT.Player(this.container, {
        videoId: this.videoId,
        width: 356,
        height: 200,
        playerVars: {
					'rel': 0,
					'modestbranding': 1,
					'showinfo': 0,
					'theme': 'light',
					'autoplay': this.autoplay
        }
      });
    };
	};
	
	return YoutubePlayer;

});