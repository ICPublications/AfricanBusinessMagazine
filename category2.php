<?php 
	get_header(); 
	
	$category_id = get_query_var('cat');
	$category = get_category( $category_id );
	$has_children = get_terms( 'category', array( 'parent' => $category_id, 'hide_empty' => false ) );
	$parent = get_category($category->category_parent);
	$parent_name = $parent->cat_name;
	$category_post = get_page_by_title( 'Ecobank' );
	// $category->cat_name
	$banner_img = get_field( "banner_image", 8750 );
	$bio = get_field( "bio", 8750 );
	$company_col = get_field( "company_col", 8750 );
?>
	
	<div class="container" style="<?php if( $parent_name == 'Company Profile'){ echo 'margin-top: -60px;'; } ?>">	
		<?php 
			if( $parent_name == 'Company Profile'){
				//echo $category_post->ID;
					echo '<a href="http://www.ecobank.com"><img src="'.  $banner_img .'" style="width:100%" /></a>';
					echo '<nav id="company-profile-links" style="margin-top: 20px">';
						//echo '<a href="http://www.ecobank.com" style="color: '. $company_col .'">Website</a>';
						echo '<a href="http://www.ecobank.com/group/press_releases.aspx" style="color: '. $company_col .'">Press Releases</a>';
					echo '</nav>';
				}
			?>

		<section id="content" class="l-8-1">
		<?php 
			if( $parent_name == 'Company Profile'){ 
				//echo $category_post->ID;
				echo '<h3 style="border-bottom: 1px solid ' . $company_col . '; color: '. $company_col .'">News</h3>';
			}else{
			?>
				<header class="l-small-module">
					<h1 id="page-title" class="title"><?php echo $category->name; ?></h1>

					<a class="rss-link" href="<?php bloginfo('url'); ?>?cat=<?php echo $category_id;?>&feed=rss2">
						<span class="icon-alone" data-icon="&#xe610;"></span><span class="screen-reader-text">RSS 2</span>
					</a>

					<?php
						if ( $has_children ) :
							echo "<ul class='category-list'>";
							$sub_categories = Array(
								'orderby' => 'id',
								'show_count' => 0,
								'title_li' => '',
								'use_desc_for_title' => 1,
								'child_of' => $category_id
							);

							foreach (get_categories($sub_categories) as $sub_category) {
								echo "<li>";
								echo $sub_category->name;
								echo "</li>";
							}

							echo "</ul>";
						endif;
					?>
				</header>
		<?php
			}
		?>

			<?php
				$i = 0; // Set post counter
				$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1; // Gets current page of pagination
				$notclassifieds = ( $category->name != 'Classifieds' ) ? true : false; // Check if category is 'Classifieds'

				if ( have_posts() ) : 
					while ( have_posts() ) : the_post();
					
						if ( $i == 0 && $paged == 1 && $notclassifieds ) : // Specify image size for _article-list.php
							$imagesize = 'promoted'; 
							$articlesize = 'promoted'; 
						elseif ( ($i == 1 || $i == 2) && $paged == 1 && $notclassifieds ) :
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

		<?php 
			if( $parent_name == 'Company Profile'){ 
			?>
				<div id="sidebar" class="l-4-9">
					<?php  echo '<h3 style="border-bottom: 1px solid ' . $company_col . '; color: '. $company_col .'">About Ecobank</h3>'; ?>
					<div id="company-bio" style="background-color: grey; color: white; font-family:'futura-pt',sans-serif; padding:11px;">
						<?php echo $bio ?>
					</div>
					<?php  echo '<h3 style="border-bottom: 1px solid ' . $company_col . '; color: '. $company_col .'">Press Releases</h3>'; ?>
					<div id="press-releases" style="font-family:'futura-pt',sans-serif; padding:11px;">
						<ul id="press-release-list">
							<?php
								if( have_rows('press_releases', 8750) ):

									$i = 0;
								 	// loop through the rows of data
								    while ( have_rows('press_releases', 8750) && $i<6 ) : the_row();

								        echo '<li><a style="color: '. $company_col .'" href=  "'. get_sub_field('press_release_link') .'"  target="blank" >- '. get_sub_field('press_release_name') .'</a></li>';

								        $i++;
								    endwhile;

								else :

								    // no rows found

								endif;				
								echo '<li><a style="color: '. $company_col .'" href="http://www.ecobank.com/group/press_releases.aspx" target="blank">See More</a></li>';
							?>

							
						</ul>
					</div>
					<div id="networks">
						<?php  echo '<h3 style="border-bottom: 1px solid ' . $company_col . '; color: '. $company_col .'">Networks</h3>'; ?>
							<?php 
								echo '<a style="color: '. $company_col .'" href="https://www.facebook.com/EcobankGroup"><span class="icon-alone" data-icon=""></span><span class="screen-reader-text">Facebook</span></a>';
								echo '<a style="color: '. $company_col .'" href="http://twitter.com/#!/GroupEcobank"><span class="icon-alone" data-icon=""></span><span class="screen-reader-text">Twitter</span></a>';					
								echo '<a style="color: '. $company_col .'" href="https://www.linkedin.com/pub/ecobank-group/47/134/26a"><span class="icon-alone" data-icon=""></span><span class="screen-reader-text">Linked In</span></a>';
								echo '<a style="color: '. $company_col .'" href="https://www.youtube.com/user/EcobankGroup"><span class="icon-alone" data-icon=""></span><span class="screen-reader-text">Youtube</span></a>';
								echo '<a style="color: '. $company_col .'" href="https://plus.google.com/explore/ECOBANK"><span class="icon-alone" data-icon=""></span><span class="screen-reader-text">Google Plus</span></a>';
							?>
						<a class="twitter-timeline" href="https://twitter.com/GroupEcobank" data-widget-id="573847999069167616">Tweets by @GroupEcobank</a>
						<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
					</div>

					
				</div><!-- /#sidebar -->
			<?php 
			}else{
				get_template_part('sidebar');
		} ?>

	</div><!-- /.container -->
	
	<?php get_template_part('parts/_pre-footer'); ?>

<?php get_footer(); ?>  