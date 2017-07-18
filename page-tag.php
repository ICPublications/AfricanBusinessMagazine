<?php 
/* 
	Template Name: Tag
*/
	get_header(); 
	
	global $post;
	// $page_slug = get_post( $post )->post_name;
	
	$page_content = str_replace( array("\r", "\n"), "", get_the_content() );
	$formatted_content = trim( strip_tags( str_replace( array("</li><li>"), ",", $page_content ) ) );
	$tag_list = explode( ",", $formatted_content );
?>

	<div class="container">	
		<section id="content" class="l-8-1">
				
			<h1 id="page-title" class="title"><?php the_title(); ?></h1>
			
			<?php 
				$tag_query = new WP_Query( array(
					'tag_slug__in' => $tag_list
				) );
				
				$i = 0; // Set post counter
				$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1; // Gets current page of pagination

				if ( $tag_query->have_posts() ) : 
					while ( $tag_query->have_posts() ) : $tag_query->the_post();
					
						if ( $i == 0 && $paged == 1 ) : // Specify image size for _article-list.php
							$imagesize = 'promoted'; 
							$articlesize = 'promoted'; 
						elseif ( ($i == 1 || $i == 2) && $paged == 1 ) :
							$imagesize = 'medium'; 
							$articlesize = 'medium'; 
						else : 
							$imagesize = 'thumbnail'; 
							$articlesize = 'thumb';
						endif;

						include( locate_template('parts/_article-list.php') ); 

						$i ++; // Increment counter

					endwhile; 
				else :
					echo '<p><em>Sorry, there are no posts in this category.</em></p>';
				endif;
				
				get_template_part('parts', '_pagination.php'); 
			?>
	
		</section><!-- /#content -->

		<?php get_template_part('sidebar', 'category'); ?>

	</div><!-- /.container -->
		
	<?php get_template_part('parts/_pre-footer'); ?>

<?php get_footer(); ?>  