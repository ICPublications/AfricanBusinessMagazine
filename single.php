<?php get_header();

	$banner_img = get_field( "banner_image", 10472 );
	$bio = get_field( "bio", 10472 );
	$company_col = get_field( "company_col", 10472 );
	$company_url = get_field( "company_url", 10472 );
	$focus_link = get_field( "focus_link", 10472 );
	$twitter_id = get_field( "twitter_id", 10472 );
	$facebook_link = get_field( "facebook_link", 10472 );
	$twitter_link = get_field( "twitter_link", 10472 );			
	$linkedin_link = get_field( "linkedin_link", 10472 );
	$outube_link = get_field( "youtube_link", 10472 );
	$google_plus_link = get_field( "google_plus_link", 10472 );
	$press_release_link = get_field( "press_release_link", 10472 );

?>
		
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

		<?php setPostViews(get_the_ID()); // For recording most popular articles ?>
	
		<div class="share-utils" data-parent>
			<div class="container">
				<a href="#" class="close" data-icon="&#xe612;"><span class="screen-reader-text">Close</span></a>
				<h5 class="hide-for-small"><?php the_title() ?></h5>
				<ul class="share-options">
					<li><span class="btn popup st_facebook_custom fb" data-icon="&#xe611;"><span class="share-text">Facebook</span></span></li>
					<li><span class="btn popup st_twitter_custom twit" data-icon="&#xe602;"><span class="share-text">Twitter</span></span></li>
					<li><span class="btn popup st_sharethis_custom share" data-icon="&#xe604;"><span class="share-text">Share</span></span></li>
					<li><a href="#article-rating" class="scroll btn rate" data-icon="&#xe618;"><span class="share-text">Rate</span></a></li>
					<li><a href="#disqus_thread" class="scroll btn comment" data-icon="&#xe61d;"><span class="share-text">Comment</span></a></li>
				</ul>	
			</div>	
		</div>

		<div class="container">	
			<section id="content" <?php if ( !has_post_format( 'gallery' ) ) : ?>class="l-8-1"<?php endif; ?>>
			<?php 
				if( in_category( 'General Electric' ) ){
					//echo $category_post->ID;
						echo '<a class="" href="'. $company_url.'"><img src="'.  $banner_img .'" style="width:100%" /></a>';
						if($press_release_link!=""){ 
							echo '<nav id="company-profile-links" style="margin-top: 20px">';
								//echo '<a href="http://www.ecobank.com" style="color: '. $company_col .'">Website</a>';
								//echo '<a href="'. $press_release_link .'" style="color: '. $company_col .'">Press Releases</a>';
							echo '</nav>';
						}
					}
			?>

				<article class="single-article <?php if ( in_category( 'Advertorials' )) { echo 'advertorial'; } ?>">
					<?php 
						$category = get_the_category(); 
						$parent_category = $category[0]->category_parent;

						// Check if category has parent
						if($parent_category) {
							$category_name = get_cat_name($parent_category);
						} else {
							$category_array = get_the_category();
							$category_name = $category_array[0]->cat_name;
						}

						$category_link = get_category_link( get_cat_ID($category_name) );
					?>
					
					<header class="article-header">
						
						<!-- <h2 class="category-title <?php if ( in_category( 'African Banker' )) { echo 'abk'; } ?>">
							<a href="<?php echo $category_link; ?>">
								<?php echo $category_name; ?>
							</a>
						</h2> -->

						<?php 
							// Get abk article banner
							if ( in_category( 'African Banker' ) ) {
								get_template_part('parts/_abk-banner');
							}
						?>

						<h1 class="page-title title"><?php the_title(); ?></h1>
												<div class="share-buttons">
    
     <!-- Twitter -->
    <a href="https://twitter.com/share?url=<?php echo urlencode(get_permalink()) ?>" target="_blank">
        <img src="https://simplesharebuttons.com/images/somacro/twitter.png" alt="Twitter" />
    </a>
    <!-- Facebook -->
    <a href="http://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()) ?>" target="_blank">
        <img src="https://simplesharebuttons.com/images/somacro/facebook.png" alt="Facebook" />
    </a>
    
    <!-- LinkedIn -->
    <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo urlencode(get_permalink()) . '&title=' . get_the_title() . '&summary=' . strip_tags(get_the_excerpt()) . '&source=African Business Magazine'; ?>" target="_blank">
        <img src="https://simplesharebuttons.com/images/somacro/linkedin.png" alt="LinkedIn" />
    </a>

</div>
						<ul class="article-meta l-small-module cf">
							<li><a class="scroll" href="#article-author"><?php the_author(); ?></a></li>
							<li><time datetime="<?php the_time('c'); ?>"><?php the_date(); ?></time></li>
							<li><a class="scroll" href="#disqus_thread"><?php comments_number( 'no comments', 'one comment', '% comments' ); ?></a></li>
						</ul>
						
						<?php 
							if ( !has_post_format( 'gallery' ) ) :
								// Get responsive thumbnail
								if ( has_post_thumbnail() ) {
									echo get_responsive_thumbnail(array( array('promoted-large', 800), array('promoted-medium', 500), array('promoted-small', 320, true) ));
								}
							endif;
						?>

					</header>

					<div class="single-article-content cf">
						<?php
							the_content();
							custom_wp_link_pages( array('next_or_number' => 'both') );
						?>
					</div><!-- /.single-article-content -->

					<?php if ( !has_post_format( 'gallery' ) ) : ?>
						<footer class="article-footer">
							<div id="article-rating" class="article-rate cf">
								<?php echo getPostLikeLink(get_the_ID());?>
							</div>

							<!-- Tags -->
							<?php the_tags('<ul class="cf article-tags l-small-module"><li>','</li><li>','</li></ul>'); ?>
							<!-- /.Tags -->
							
							<?php get_template_part('parts/_author-bio'); ?>
						</footer>
					<?php endif; ?>	
				
				</article><!-- /.single-article -->	
				
				<?php if ( !has_post_format( 'gallery' ) ) : ?>
					<nav class="comments-links">
						<a class="comment-link" href="<?php bloginfo('url'); ?>/discussion-guidelines">Read our Discussion Policy</a>
					</nav>
					<?php comments_template(); ?>

					<div class="after-content">
						<?php get_template_part('parts/_related-posts'); ?>
						<?php dynamic_sidebar('After Content'); ?>
					</div><!-- /.after-content -->	
				<?php else : ?>
					<?php 
						$related_posts_count = 4;
						include( locate_template( 'parts/_related-posts.php' ) );
					?>

				<?php endif; ?>	
		
			</section><!-- /#content -->

			<?php 
				// Check if gallery page
				if ( !has_post_format( 'gallery' ) ) {
					if( in_category( 'General Electric' ) ){
						get_template_part('sidebar-ge');
			?>
					

				<?php
					}else{
						get_template_part('sidebar');
					} 
				}

			?>

		</div><!-- /.container -->

		<?php if ( has_post_format( 'gallery' ) ) : ?>
			<section class="after-content">
				<div class="container">
					<?php get_template_part('parts/_classifieds'); ?>
					<?php get_template_part('parts/_featured-events'); ?>
					<?php get_template_part('parts/_ad-unit-mpu'); ?>
				</div>
			</section><!-- /.after-content -->
		<?php endif; ?>
		
		<?php get_template_part('parts/_pre-footer'); ?>
			
	<?php endwhile; endif; ?>	

<?php get_footer(); ?>  