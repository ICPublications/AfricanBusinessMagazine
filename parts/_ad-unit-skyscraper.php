<?php 
	//$params = '&limit=1&orderby=impression_count&order=ASC&callback_function=customBannerOutput';
	$params = '&limit=1&orderby=random&callback_function=customBannerOutput';
?>
<aside class="ad-unit skyscraper">
	<?php echo do_shortcode('[dfads params="groups=skyscraper-home-page&'.$params.'"]'); ?>
	<span class="signpost">Advertisement</span>
</aside>

<?php require_once('_ad-unit-mobile2.php'); ?>