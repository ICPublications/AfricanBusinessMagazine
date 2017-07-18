<?php get_header(); ?>

	<div class="container">	
		<section id="content">
				
			<h1 class="page-title title"><?php the_title(); ?></h1>
		
			<?php 
				the_content(); 				
				custom_wp_link_pages( array('next_or_number' => 'both') );
			?>

		</section><!-- /#content -->
		
		<?php // get_template_part('sidebar'); ?>
		
	</div><!-- /.container -->
	
	<?php get_template_part('parts/_pre-footer'); ?>
					
<?php get_footer(); ?>