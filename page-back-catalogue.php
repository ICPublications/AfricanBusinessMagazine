<?php
/*
Template Name: Back Catalogue
*/

get_header(); 
?>

<?php
	// Query back catalogue from magazine category
	$query = new WP_Query( array(
		'cat' => 715,
		'posts_per_page' => -1
	) ); 
?>

	<div class="container">
		<section id="content" class="l-8-1">
			
			<h1 class="page-title title"><?php the_title(); ?></h1>
			
			<?php 
				if ( $query->have_posts() ): while ( $query->have_posts() ): $query->the_post(); 
					$imagesize = 'cover'; 
					$articlesize = 'thumb';
					
					include(locate_template('parts/_article-list.php')); 
				endwhile; endif; 
			?>
			
		</section><!-- /#content -->

		<?php get_template_part('sidebar', 'magazine'); ?>

	</div><!-- /.container -->
		
	<?php get_template_part('parts/_pre-footer'); ?>
					
<?php get_footer(); ?>