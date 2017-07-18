<?php
/*
Template Name: Careers
*/

get_header(); ?>
	
	<div class="container">

		<section id="content">
			
			<h1 class="page-title title"><?php the_title(); ?>
			<!--
			<a targt="_blank" href="https://institutions.exacteditions.com/african-business"><span style="float:right;background-color: #00a1be;color: white;font-size: 18px;padding: 9px;">Click Here for Institutional Subscriptions</span></a>
			-->
			</h1>

			<?php
				$icjobsposts = get_posts( array(
				    'posts_per_page' => 3,
				    'category' => 1596
				) );
				 
				if ( $icjobsposts ) {
				    foreach ( $icjobsposts as $post ) :
				        setup_postdata( $post ); 

						echo '<a href="' .get_permalink(). '"><article class="post thumb-list" style=" color: black; border-bottom: 1px dashed lightgrey;">';
							echo '<div class="article-content" style="margin-left:0">';
								echo '<h2 class="post-title">' . get_the_title() .'</h2>';
								echo '<date class="post-date">' . get_the_date() .'</date>';
								echo '<p>' . get_the_excerpt() . '</p>';
							echo '</div>';
						echo '</article></a>';
				    endforeach; 
				    wp_reset_postdata();
				}
			?>

		</section><!-- /#content -->

	</div><!-- /.container -->

	<?php get_template_part('parts/_pre-footer'); ?>
					
<?php get_footer(); ?>