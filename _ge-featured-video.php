<aside class="featured-video">
<h4 class="section-heading">Advertisement</h4>
<div id="ytplayer"></div>
</aside>

<script>
  // Load the IFrame Player API code asynchronously.
  var tag = document.createElement('script');
  tag.src = "https://www.youtube.com/player_api";
  var firstScriptTag = document.getElementsByTagName('script')[0];
  firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

  // Replace the 'ytplayer' element with an <iframe> and
  // YouTube player after the API code downloads.
  var player;
  function onYouTubePlayerAPIReady() {
    player = new YT.Player('ytplayer', {
      height: '129',
      width: '210',
      videoId: 'aZPtBwdhv9Y',
      events: {
        'onReady': onPlayerReady
      }
    });
  }

function onPlayerReady(event) {
  event.target.setVolume(0);
  event.target.playVideo();
}
</script>