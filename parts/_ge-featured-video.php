<aside class="featured-video" style="padding:0; border:none">
<h4 class="section-heading">GE's Future of Work</h4>
<div id="ytplayer" style="border-bottom: 1px solid #ddd; padding-bottom:40px"></div>
</aside>

<script>
  // Load the IFrame Player API code asynchronously.
  var tag = document.createElement('script');
  tag.setAttribute("id", "yt1");
  tag.src = "https://www.youtube.com/player_api";
  var firstScriptTag = document.getElementsByTagName('script')[0];
  firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

  // Replace the 'ytplayer' element with an <iframe> and
  // YouTube player after the API code downloads.
  var player1;
  function onYouTubePlayerAPIReady() {
    player1 = new YT.Player('ytplayer', {
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
