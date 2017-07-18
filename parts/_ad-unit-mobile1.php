<?php 
	//$params = '&limit=1&orderby=impression_count&order=ASC&callback_function=customBannerOutput';
	$params = '&limit=1&orderby=random&callback_function=customBannerOutput';
?>
<aside class="ad-unit mobile">
	<?php 
		if ( is_front_page() ) echo do_shortcode('[dfads params="groups=mobile-1-home-page&'.$params.'"]'); 
		else echo do_shortcode('[dfads params="groups=mobile-1-all-pages&'.$params.'"]'); 
	?>
</aside>