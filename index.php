<?php 
	get_header(); 
	
	$category_id = get_query_var('cat');
	$category = get_category( $category_id );
	$has_children = get_terms( 'category', array( 'parent' => $category_id, 'hide_empty' => false ) );
?>

	<div class="container">	
		<section id="content">
			
			<header class="l-small-module">
				<h1 id="page-title" class="title"><?php echo $category->name; ?></h1>

				<a class="rss-link" href="<?php bloginfo('url'); ?>?cat=<?php echo $category_id;?>&feed=rss2">
					<span class="icon-alone" data-icon="&#xe610;"></span><span class="screen-reader-text">RSS 2</span>
				</a>

				<?php
					if ( $has_children ) :
						echo "<ul class='category-list'>";
						$cat_selection = Array(
							'orderby' => 'id',
							'show_count' => 0,
							'title_li' => '',
							'use_desc_for_title' => 1,
							'child_of' => $category_id
						);

						foreach (get_categories($cat_selection) as $category) {
							echo "<li>";
							echo $category->name;
							echo "</li>";
						}

						echo "</ul>";
					endif;
				?>
			</header>

			<?php
				$i = 0; // Set post counter
				$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1; // Gets current page of pagination

				if ( have_posts() ) : 
					while ( have_posts() ) : the_post();
					
						if ( $i == 0 && $paged == 1 ) : // Specify image size for _article-list.php
							$imagesize = 'promoted'; 
							$articlesize = 'promoted'; 
						elseif ( ($i == 1 || $i == 2) && $paged == 1 ) :
							$imagesize = 'medium'; 
							$articlesize = 'medium'; 
						else : 
							$imagesize = 'thumbnail'; 
							$articlesize = 'thumb';
						endif;

						if($i == 1 && $paged == 1 ) { echo '<div class="row cf">'; } // Open row for medium sized images
						if($i == 3 && $paged == 1 ) { echo '</div>'; } // Close row for medium sized images

						include( locate_template('parts/_article-list.php') ); 

						$i ++; // Increment counter

					endwhile; 
				else :
					echo '<p><em>Sorry, there are no posts in this category.</em></p>';
				endif;
				
				get_template_part('parts/_pagination'); 
			?>
	
		</section><!-- /#content -->

		<?php get_template_part('sidebar'); ?>

	</div><!-- /.container -->
	
	<?php get_template_part('parts/_pre-footer'); ?>

<?php get_footer(); ?>  