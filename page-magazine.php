<?php get_header(); ?>

	<div class="container">
		<?php 
			// Query latest issue
			$query = new WP_Query( array(
				'category_name' => 'magazine',
				'posts_per_page' => 1
			) );
			
			if ( $query->have_posts() ): while ( $query->have_posts() ): $query->the_post(); ?>


			<div class="banner-text l-large-module">
				<h1 id="page-title" class="title">Latest issue: <strong><?php the_title(); ?></strong></h1>
				<?php the_content(); ?>
			</div>

			<section id="content" class="l-8-1">
			
				<?php
					// Query latest issue articles
					$current_articles = new WP_Query( array(
						'tag' => sluggify( get_the_title() ),
						'posts_per_page' => -1
					) );

					if ( $current_articles->have_posts() ): 
						while ( $current_articles->have_posts() ): 

							$current_articles->the_post();
  
							$articlesize = 'thumb';
							$imagesize = 'thumbnail';
							
							include(locate_template('parts/_article-list.php'));
					
						endwhile; 
					endif; 
				?>

			</section><!-- /#content -->

		<?php endwhile; endif; ?>

		<?php include(locate_template('sidebar-magazine.php')); ?>

	</div><!-- /.container -->
		
	<?php get_template_part('parts/_pre-footer'); ?>
					
<?php get_footer(); ?>