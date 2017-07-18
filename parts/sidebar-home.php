<?php 
	$category_id = get_query_var('cat');
	$category = get_category( $category_id );
	$has_children = get_terms( 'category', array( 'parent' => $category_id, 'hide_empty' => false ) );
	$parent = get_category($category->category_parent);
	$parent_name = $parent->cat_name;
?>

<div id="sidebar" class="l-3-10">

	<!-- <a class="bottom-mpu-ad" href="http://www.gereportsafrica.com" id="GE Logo" target="_blank"><img src="http://africanbusinessmagazine.com/wordpress/wp-content/uploads/2015/11/partnership-ge-3.png" style="float: left; clear: both; display:block; margin-bottom:22px; "></a> -->
		<?php get_template_part('parts/_popular-articles'); ?>
	<aside class="widget-area secondary">

	
		<?php  echo '<img src="http://africanbusinessmagazine.com/wordpress/wp-content/uploads/2015/11/total_brand_block_rgb-1.png" />'; get_template_part('parts/_ad-unit-top-mpu'); ?>
		<?php  get_template_part('parts/_ge-featured-video'); ?>

		<?php 
			if($parent_name == 'In Focus'){
				if( in_category( 'GE Health' ) ){
					get_template_part('parts/_ge-featured-video');
				}
			}else{
				dynamic_sidebar('Secondary'); 
			}
		?>
	</aside>
	<?php get_template_part('parts/_company_profile_navigation'); ?>
		
	<?php get_template_part('parts/_ad-unit-skyscraper'); ?>

</div><!-- /#sidebar -->