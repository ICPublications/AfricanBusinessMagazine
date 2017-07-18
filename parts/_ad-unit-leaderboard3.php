<?php 
	//$params = '&limit=1&orderby=impression_count&order=ASC&callback_function=customBannerOutput';
	$params = '&limit=1&orderby=random&callback_function=customBannerOutput';
?>
<aside class="ad-unit leaderboard" style="margin-bottom:33px; float:left; margin-top:33px; display: inline; */
    float: left;">
	<?php 
		if ( is_front_page() ) echo do_shortcode('[dfads params="groups=leaderboard-home-page&'.$params.'"]'); 
		else echo do_shortcode('[dfads params="groups=leaderboard-all-pages&'.$params.'"]'); 
	?>
	<span class="signpost">Advertisement</span>
</aside>