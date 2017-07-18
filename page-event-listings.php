<?php get_header(); ?>

	<div class="container">	
		<section id="content" class="l-8-1">
				
			<h1 class="page-title title"><?php the_title(); ?></h1>
				<?php 
					function customorderby($orderby) {
						return 'mt1.meta_value+0 ASC, mt2.meta_value+0 ASC, mt3.meta_value+0 ASC';
					}

					$args = array(
						'post_type' => 'icevents', 
						'meta_key' => 'event_date_year',
						'meta_query' => array(
							array('key' => 'event_date_year'),
							array('key' => 'event_date_mon'),
							array('key' => 'event_date_day')
						),
						'posts_per_page' => -1
					);

					add_filter('posts_orderby','customorderby');
					$events = new WP_Query($args); 
					remove_filter('posts_orderby','customorderby');

					if ( $events->have_posts() ) : ?>

						<?php while ( $events->have_posts() ) : $events->the_post(); ?>
						<?php 
							$post_meta = get_post_meta($post->ID);
							$day = $post_meta['event_date_day'][0];
							$mon = $post_meta['event_date_mon'][0];
							$year = $post_meta['event_date_year'][0];
							$end_day = $post_meta['event_end_date_day'][0];
							$end_mon = $post_meta['event_end_date_mon'][0];
							$end_year = $post_meta['event_end_date_year'][0];
							$event_date = date('d F Y', strtotime($year.$mon.$day));
							$event_end_date = date('d F Y', strtotime($end_year.$end_mon.$end_day));
							$event_image = get_field("event_image"); 
							$event_link = get_field("event_link"); 
							$new_image = get_field("new_image"); 
						
						if( strtotime($end_year.$end_mon.$end_day) >= time() ){
							echo '<article class="post thumb-list">';
								echo '<div class="article-image">';
									echo '<div class="thumbnail landscape" style="text-align: center;">';
										echo '<a href="' .$event_link. '">';
											echo '<img class="attachment-promoted-small wp-post-image" alt="Railway" src="' . $new_image . '" style="max-height:150px; margin-left: auto; margin-right:auto;" />';	
										echo '</a>';
									echo '</div>';
								echo '</div>';

								echo '<div class="article-content">';
									echo '<h2 class="post-title"><a href="' .$event_link. '">' . get_the_title() .'</a></h2>';
									echo '<date class="post-date">' . $event_date . ' - ' . $event_end_date .'</date>';
								echo '</div>';
							echo '</article>';
						}
						endwhile;
						endif; 
						?>
				


			<?php 
				the_content(); 	
				custom_wp_link_pages( array('next_or_number' => 'both') );
			?>

		</section><!-- /#content -->
		
		<?php get_template_part('sidebar-home'); ?>
		
	</div><!-- /.container -->
	
	
					
<?php get_footer(); ?>

<article class="post thumb-list">

		
		
		
			
	
	
	
</article>
<?php get_template_part('parts/_pre-footer'); ?>