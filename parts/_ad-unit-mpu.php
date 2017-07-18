<?php 
	//$params = '&limit=1&orderby=impression_count&order=ASC&callback_function=customBannerOutput';
	$params = '&limit=1&orderby=random&callback_function=customBannerOutput';
?>
<aside class="ad-unit mpu l-module">
	<?php 
		if ( is_front_page() ) echo do_shortcode('[dfads params="groups=mpu-home-page&'.$params.'"]'); 
		else echo do_shortcode('[dfads params="groups=mpu-all-pages&'.$params.'"]'); 
	?>
	<span class="signpost">Advertisement</span>
</aside>

<?php require_once('_ad-unit-mobile3.php'); ?>