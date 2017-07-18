<?php get_header(); ?>

	<div class="container">	
		<section id="content">
		
			<h1 id="page-title" class="title">Search results for <span class="search-term"><?php the_search_query(); ?></span></h1>		

			<?php 
				if ( have_posts() ) :
				
					echo '<p class="search-count">Displaying ' . $wp_query->post_count . ' of ' . $wp_query->found_posts . ' results</p>';
					
					while ( have_posts() ) : the_post();
						$articlesize = 'text';

						include(locate_template('parts/_article-list.php')); 
					endwhile; 

				else :

					// No results found ...
					echo "We couldn't find any results for your search. Try searching again:";

					// ... so display the search form ...
					get_search_form();

					// ... and sticky posts instead
					$sticky_query = new WP_Query( array(
						'posts_per_page' => 4,
						'post__in'  => get_option( 'sticky_posts' ),
						'ignore_sticky_posts' => 1
					) );

					if ( $sticky_query->have_posts() ):

						echo "Or maybe try these articles:";

						while ( $sticky_query->have_posts() ): 

							$sticky_query->the_post();
	 
							$articlesize = 'thumb'; 
							$imagesize = 'thumb'; // Specify image size for _articlelist.php
							include(locate_template('parts/_articlelist.php'));
						
						endwhile; 
					endif;

				endif;
			?>
			
			<?php get_template_part('parts/_pagination'); ?>	
	
		</section><!-- /#content -->

	</div><!-- /.container -->
		
	<?php get_template_part('parts/_pre-footer'); ?>

<?php get_footer(); ?>  