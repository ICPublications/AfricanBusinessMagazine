<?php 
/* 
	Template Name: Tag
*/
	get_header(); 
	
	global $post;
	// $page_slug = get_post( $post )->post_name;
	
	$page_content = str_replace( array("\r", "\n"), "", get_the_content() );
	$formatted_content = trim( strip_tags( str_replace( array("</li><li>"), ",", $page_content ) ) );
	$tag_name = single_cat_title('', false);
?>

	<div class="container">	
		<section id="content" class="l-8-1">
				
			<header class="l-small-module">
				<h1 id="page-title" class="title">Tagged in: <em><?php echo $tag_name; ?></em></h1>

				<a class="rss-link" href="<?php bloginfo('url'); ?>?tag=<?php echo $tag_name; ?>&feed=rss2">
					<span class="icon-alone" data-icon="&#xe610;"></span><span class="screen-reader-text">RSS 2</span>
				</a>
			</header>
			
			<?php 
				$i = 0; // Set post counter
				$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1; // Gets current page of pagination

				if ( have_posts() ) : 
					while ( have_posts() ) : the_post();
					
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