<?php 
	$category_id = get_query_var('cat');
	$category = get_category( $category_id );
	$has_children = get_terms( 'category', array( 'parent' => $category_id, 'hide_empty' => false ) );
	$parent = get_category($category->category_parent);
	$parent_name = $parent->cat_name;
?>

<article class="post <?php echo $articlesize; ?>-list">

	<?php if ( $articlesize !== 'text' ) : ?>
	
		<div class="article-image">
			<div class="img-placeholder <?php echo $imagesize; ?> landscape">
			
				<a href="<?php the_permalink(); ?>">
					<?php 

						// Show full image for magazine covers
						if($imagesize == 'cover') :
							the_post_thumbnail('medium');
						
						else :
								if ( $articlesize == 'promoted' ) :
									echo get_responsive_thumbnail(array( array('promoted-large', 800), array('promoted-medium', 500), array('promoted-small', 320, true) ));
									
								elseif ( $articlesize == 'medium' ) :
									echo get_responsive_thumbnail(array( array('promoted-medium', 500), array('promoted-small', 320, true) ));
								else :
									the_post_thumbnail('promoted-small');
								endif;
						
						endif; 

					?>
				</a>

			</div>


		</div>
		
	<?php endif; ?>		
	
	<div class="article-content">
		<h2 class="post-title"><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h2>
		<?php if($parent_name !='In Focus'){ ?>
			<date class="post-date"><?php the_time('j F, Y'); ?></date>
		<?php } ?>
		<?php the_excerpt(); ?>
	</div>	
	<?php 
		if(is_category('1136') && $articlesize == 'promoted') :
			echo '<a target="_blank" href="http://www.gereportsafrica.com"><img src="http://africanbusinessmagazine.com/wordpress/wp-content/uploads/2015/10/GE_Reports-SSA_Energy_728x90.jpg" /></a>';
		endif;
	?>
	
</article>