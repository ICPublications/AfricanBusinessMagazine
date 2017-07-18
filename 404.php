<?php 
	get_header(); 
	
	// Get 404 Page
	$page = get_page_by_title( 'Error Page: 404' );
	$post = get_post( $page->ID );
?>

	<div class="container">	
		<section id="content">
				
			<h1 id="page-title" class="title"><?php echo $post->post_title; ?></h1>
			<?php echo $post->post_content; ?>

		</section><!-- /#content -->
	</div><!-- /.container -->
	
	<?php get_template_part('parts/_pre-footer'); ?>
					
<?php get_footer(); ?>