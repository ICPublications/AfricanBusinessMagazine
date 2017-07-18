<?php 
	//$params = 'limit=1&orderby=impression_count&order=ASC&callback_function=customBannerOutput';
?>
<aside id="infocus-aside" style="border-top: 1px solid #c00418; border-bottom: 1px solid #c00418; margin-bottom: 20px; padding-bottom: 20px;">
	<h4 style="color: #c00418;">In Focus</h4>
	<?php // echo do_shortcode('[dfads params="groups=skyscraper-home-page&'.$params.'"]'); ?>

	<?php $loop = new WP_Query( array( 'post_type' => 'partnering-companies', 'posts_per_page' => -1, 'orderby' => 'date') ); ?>
	<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
		<?php 
			$home_page_thumbnail = get_field('home_page_thumbnail');
			$focus_link = get_field('focus_link');
		?>
		<?php
			echo '<a href="'. $focus_link .'" ><img style="width:100%" src="'. $home_page_thumbnail .'" /></a>';
		?>
	<?php endwhile; wp_reset_query(); ?>
</aside>

<?php // require_once('_ad-unit-mobile2.php'); ?>