<?php get_template_part( 'parts/head' ); ?>
	
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

		<?php if ( wp_attachment_is_image( $post->id ) ) : $image = wp_get_attachment_image_src( $post->id, "promoted"); ?>
			<img src="<?php echo $image[0];?>" class="attachment image" alt="<?php the_title_attribute(); ?>" title="<?php the_title_attribute(); ?>" />
		<?php endif; ?>

	<?php endwhile; endif; ?>
	
<?php get_template_part( 'parts/foot' ); ?>