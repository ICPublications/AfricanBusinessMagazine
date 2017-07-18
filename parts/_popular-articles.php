<article id="featured-posts" class="tabs l-module">
	<ul class="tab-nav">
		<li class="tab-link is-active-tab"><a style="color: #c00418" href="#popular-posts">Most Popular</a></li>
	</ul>
	<div id="popular-posts" class="tab">
		<h4 class="tab-title">Popular</h4>
		<div class="tab-panel">
			<ol class="list-article">
				<?php
					

					$args = array(
						'post_type' => 'post',
						'cat' => '-877, -878, -67, -70, -1056, -68, -69, -1, -1061, -1079, -1106, -1062, -715',
						'date_query' => array(
					        array(
					            'column' => 'post_date',
					            'after' => '2 weeks ago',
					        )
					    ),
						'meta_key' => 'post_views_count',
						'orderby' => 'meta_value_num',
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
		</div>
	</div>
</article>