<?php 
	$category2 = get_the_category(get_the_ID());

	$category_id = get_query_var('cat');
	$category = get_category( $category_id );
	$category_post_name = get_category(get_the_ID());
	$category_name = get_cat_name($category_id);
	$has_children = get_terms( 'category', array( 'parent' => $category_id, 'hide_empty' => false ) );
	$parent = get_category($category->category_parent);
	$parent_name = $parent->cat_name;
?>

<div id="sidebar" class="l-4-9">

	<aside class="sidebar">
		<?php 
		//	if($parent_name == 'In Focus'){
			//	if( in_category( 'GE Health' ) ){
					get_template_part('parts/_ge-featured-video');
			//	}
		//	}else{
		//		dynamic_sidebar('Secondary'); 
		//	}
		?>
	</aside>
	<?php get_template_part('parts/_popular-articles');  ?>
	<?php 
		if($category_name == "Energy"){

			echo '<aside class="ad-unit skyscraper skyscraper-all-pages" style="margin-bottom:20px"><a target="_blank" href="http://9nl.org/u1ha"><img src="http://africanbusinessmagazine.com/wordpress/wp-content/uploads/2017/06/0483_PGAF_Banner_160x600.jpg" /></a></aside><span class="signpost">Advertisement</span>';

			require_once('parts/_ad-unit-mobile2.php');


		}else{

			foreach(get_the_category() as $cat){
				if($cat->cat_name =="Energy"){
					echo '<aside class="ad-unit skyscraper skyscraper-all-pages" style="margin-bottom:20px"><a target="_blank" href="http://9nl.org/u1ha"><img src="http://africanbusinessmagazine.com/wordpress/wp-content/uploads/2017/06/0483_PGAF_Banner_160x600.jpg" /></a></aside><span class="signpost">Advertisement</span>';
					require_once('parts/_ad-unit-mobile2.php');

					return;
				}else{
					get_template_part('parts/_ad-unit-all-pages-skyscraper');

					return;
				}
			}
		}
	?>
	<?php //get_template_part('parts/_ad-unit-mpu'); ?>
	<?php get_template_part('parts/_latest-issues'); ?>
	<?php //get_template_part('parts/_company_profile_navigation'); ?>
	<?php  ?>
	<?php get_template_part('parts/_featured-events'); ?>
	
</div><!-- /#sidebar -->