<div id="sidebar" class="l-4-9">

	<aside class="subscribe" class="l-module">
		
		<?php

			// Query previous issues
			$j = 1;
			$prev_issues = new WP_Query( array(
				'category_name' => 'magazine',
				'posts_per_page' => 12
			) );

			if ( $prev_issues->have_posts() ) : while ( $prev_issues->have_posts() ) : $prev_issues->the_post();
					
				$postid = get_the_ID();
				$pagelink = get_permalink( $postid );
				
				$imageid = get_post_thumbnail_id( $postid );		
				$alt = get_post_meta( $imageid, '_wp_attachment_image_alt', true );		
			
				if ( $j == 1 ) : 

					// Check for current issue image passed from magazine
					if ( $current_issue_thumb ) :

				?>

					<div class="latest-cover l-module">
						<?php echo $current_issue_thumb; ?>
						<a class="btn tertiary block" href="<?php bloginfo('url'); ?>/subscribe/">Subscribe now</a>
					</div>

				<?php
						
					// Otherwise show latest issue cover
					else :
						$thumb = wp_get_attachment_image_src( $imageid, 'large' );
					
						if ( $thumb ) : 
					?>

						<div class="latest-cover l-module">
							<a href="<?php echo $pagelink; ?>">
								<img class="post-image" src="<?php echo $thumb[0]; ?>" alt="<?php echo $alt; ?>" title="<?php echo get_the_title($imageid); ?>">
							</a>
							<a class="btn tertiary block" href="<?php bloginfo('url'); ?>/subscribe/">Subscribe now</a>
						</div>

					<?php 
						endif;

					endif;
				
				endif; 
			
				if ( $j == 2 ) : 
			?>
			
	</aside>
	
	<aside class="l-module">
		<h3 class="section-heading title-invert">Past issues</h3>
			<ul class="list-images">

			<?php 
				endif; 
				
					if ( $j > 1 ) : 
					
						$thumb = wp_get_attachment_image_src( $imageid, 'small-img' );
						
						if ($thumb) :
					?>

				<li>
					<a href="<?php echo $pagelink; ?>">
						<img class="post-image" src="<?php echo $thumb[0]; ?>" alt="<?php echo $alt; ?>" title="<?php echo get_the_title($imageid); ?>">
					</a>	
				</li>

					<?php 
						endif; 
				
					endif; 
			
					$j++; 
					
					endwhile; 
				endif;

				wp_reset_query();

			?>
					
			</ul>
			<a class="btn tertiary block" href="<?php bloginfo('url'); ?>/magazine-archive/">See all past issues</a>
		</aside>

</div>