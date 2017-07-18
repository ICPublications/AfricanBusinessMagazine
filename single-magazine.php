<?php get_header(); ?>

	<div class="container">

		<div class="banner-text l-module">
			<h1 id="page-title" class="title"><?php the_title(); ?></h1>
			<p><?php the_content(); ?></p>
			<?php 
				// Store reference to this months cover
				$current_issue_thumb = get_the_post_thumbnail(); 
			?>
		</div>

		<section id="content" class="l-8-1">
		
			<?php
				$tag = sluggify( get_the_title() );
				$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;

				// Query latest issue articles
				$args = array(
					'tag' => $tag,
					'posts_per_page' => 10,
					'paged' => $paged
				);

				query_posts($args);

				if ( have_posts() ): while ( have_posts() ) : the_post();

					$articlesize = 'thumb'; 
					$imagesize = 'thumbnail';
					
					include(locate_template('parts/_article-list.php'));
			
				endwhile; endif;
				
				include(locate_template('parts/_pagination.php'));
				
				wp_reset_postdata();
			?>

		</section><!-- /#content -->

		<?php include(locate_template('sidebar-magazine.php')); ?>

	</div><!-- /.container -->

	<?php get_template_part('parts/_pre-footer'); ?>
					
<?php get_footer(); ?>