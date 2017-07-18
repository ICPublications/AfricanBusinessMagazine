<?php 
/* 
	Template Name: Blank
*/
get_template_part( 'parts/head' ); 
?>
	
	<section id="blank">

		<h1 id="page-title" class="title"><?php the_title(); ?></h1>
	
		<?php the_content(); ?>

	</section>

<?php get_template_part( 'parts/foot' ); ?>