<?php
	echo '<h4 class="section-heading">Related Posts</h4>';
		
	// List 6 posts in parent category

	$category = get_the_category(); 
	$parent_category = $category[0]->category_parent;
	$posts_per_page = ($related_posts_count) ? $related_posts_count : 6;

	// Check if category has parent
	if($parent_category) {
		$cat_id = $parent_category;
	} else {
		$category_array = get_the_category();
		$cat_id = $category_array[0]->cat_ID;
	}

	$args = array(
		'cat' => $cat_id,
		'post__not_in' => array($post->ID),
		'posts_per_page' => $posts_per_page
	);

	$related_posts = new WP_Query($args);
	
	if ( $related_posts->have_posts() ) {
		
		listPosts($related_posts, $posts_per_page);
		
	} else {
	
		$args = array(
			'post__in'  => get_option( 'sticky_posts' ),
			'ignore_sticky_posts' => 1,
			'posts_per_page' => $posts_per_page
		);
		$sticky_posts = new WP_Query($args);
		
		listPosts($sticky_posts, $posts_per_page);
		
	}
	
	function listPosts($the_posts, $post_count) {
		echo '<ul class="related-articles list-articles cf l-module post-count-'.$post_count.'">';

		while ( $the_posts->have_posts() ) : $the_posts->the_post(); ?>
		
			<li class="related-article">
				<article>
					<figure class="article-image img-placeholder landscape">
						<?php if ( has_post_thumbnail()) : ?>
							<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
								<?php the_post_thumbnail('promoted-small'); ?>
							</a>
						<?php endif; ?>
					</figure>
					<h3 class="article-title">
						<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					</h3>
					<div class="article-copy">
						<p><?php the_excerpt(); ?></p>
					</div>
				</article>
			</li>
			
		<?php endwhile; 
		
		echo '</ul>';
		
	}
	
	wp_reset_query();
?>