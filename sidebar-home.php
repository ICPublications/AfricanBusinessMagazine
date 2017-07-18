<?php 
	$category_id = get_query_var('cat');
	$category = get_category( $category_id );
	$has_children = get_terms( 'category', array( 'parent' => $category_id, 'hide_empty' => false ) );
	$parent = get_category($category->category_parent);
	$parent_name = $parent->cat_name;
?>

<div id="sidebar" class="l-3-10" style="padding-bottom:30px;">
	<!-- <a class="bottom-mpu-ad" id="GE Logo" target="_blank" href="http://www.gereportsafrica.com/" ><img src="http://africanbusinessmagazine.com/wordpress/wp-content/uploads/2015/11/Untitled.png" style="float: left; clear: both; display:block; margin-bottom:22px; "></a> -->
	<aside class="widget-area secondary" >
		<a href="http://africanbusinessmagazine.com/category/company-profile/top-african-brands/">
			<script src="https://fast.wistia.com/embed/medias/pkkws0f1vp.jsonp" async></script><script src="https://fast.wistia.com/assets/external/E-v1.js" async></script><div class="wistia_responsive_padding" style="padding:56.25% 0 0 0;position:relative;"><div class="wistia_responsive_wrapper" style="height:100%;left:0;position:absolute;top:0;width:100%;"><div class="wistia_embed wistia_async_pkkws0f1vp volume=0 videoFoam=true" style="height:100%;width:100%">&nbsp;</div></div></div>

			<!-- <img src="http://africanbusinessmagazine.com/wordpress/wp-content/uploads/2017/03/TopBrands3.jpg" /> -->
		</a>
		<?php  /* get_template_part('parts/_ad-unit-top-mpu'); */ ?>
		<?php // get_template_part('parts/_ge-featured-video'); ?>

		<?php 
			if($parent_name == 'In Focus'){
				if( in_category( 'GE Health' ) ){
					get_template_part('parts/_ge-featured-video');
				}
			}else{
				dynamic_sidebar('Secondary'); 

			}
		?>
			<?php get_template_part('parts/_popular-articles'); ?>	
		<!-- <h4 class="tab-title">From the Press</h4>
		<div class="tab-panel">
			<ol class="list-article" style="margin-bottom:50px;">
				<?php
					

					$args = array(
						'post_type' => 'post',
						'cat' => '1269',
						'order' => 'DESC',
						'posts_per_page' => 5,
					);

				/*	$popular_posts = new WP_Query( $args );
					if ( $popular_posts->have_posts() ): while ( $popular_posts->have_posts() ): $popular_posts->the_post();  */
					//while($popular_posts->have_posts()) : $popular_posts->the_post(); ?>
					<?php
					$popular_posts = get_posts( $args ); 

					foreach ( $popular_posts as $post ) : setup_postdata( $post ); 
					?>
						<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li> 

					<?php 

					endforeach;

					/* endwhile; 
							endif; */ 

				/*
					$popular = get_posts( array(
						'post_type' => 'post',
						'posts_per_page' => 7,
						'meta_key' => 'post_views_count',
						'orderby' => 'meta_value_num',
						'order' => 'DESC'
					) ); 
					foreach ( $popular as $post ) : setup_postdata( $post ); 
				
					//endforeach;

					*/

					wp_reset_query();
				?>
			</ol>
	</aside> -->
	<?php get_template_part('parts/_ad-unit-top-mpu'); ?>
	<?php get_template_part('parts/_company_profile_navigation'); ?>
	
	<?php get_template_part('parts/_ad-unit-skyscraper'); ?>

</div><!-- /#sidebar -->