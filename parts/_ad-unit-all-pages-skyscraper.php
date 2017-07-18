<?php 
	//$params = '&orderby=impression_count&order=random&callback_function=customBannerOutput';
	$params = '&limit=1&orderby=random&callback_function=customBannerOutput';
?>
<aside class="ad-unit skyscraper skyscraper-all-pages" style="margin-bottom:20px">
	<?php echo do_shortcode('[dfads params="groups=skyscraper-all-pages&'.$params.'"]'); ?>
	<span class="signpost">Advertisement</span>
</aside>

<?php require_once('_ad-unit-mobile2.php'); ?>