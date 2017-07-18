<?php
	// Set global variable for magazine title
	global $magazine_title;

	//For 
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
	$top_banner = get_field('top_banner', 8750); 
	$company_url = get_field( "company_url", 8750 );
?>

<?php get_template_part( 'parts/head' ); ?>
		
		<ul class="toggle-buttons">
			<li><a id="search-toggle" href="#" data-icon="&#xe61f;"><span class="screen-reader-text">Search</span></a></li>
			<li><a id="social-toggle" href="#" data-icon="&#xe620;"><span class="screen-reader-text">Social</span></a></li>
			<li><a id="secondary-toggle" href="#" data-icon="&#xe61e;"><span class="screen-reader-text">Menu</span></a></li>
		</ul>	
		<header id="site-header">

			<div class="menu-primary-wrapper fixed-nav js-menu-build">
				<div class="container">

					<?php dynamic_sidebar('Site Header'); ?>
					
					<nav id="menu-primary-container" class="menu static">
						<ul id="menu-primary" class="cf">
							<?php 
								$categories = array(
									array('Sector Reports', 'Sectors', 5),
									array('Regions', 'Regions', 5),
									array('Interviews', 'Interviews', 5),
									array('Arts and Culture', 'Culture', 5),
									array('Management', 'Management', 5),
									array('African Banker', 'African Banker', 5),
									array('In Focus', 'In Focus', 5)
								);
								
								foreach ( $categories as $category ) : 
								
									$category_name = $category[0];
									$category_label = $category[1];
									$category_id = get_cat_ID( $category_name );
									$category_link = get_category_link( $category_id );
									
									?>
									<li>
										<?php if($category_name != 'In Focus'){ ?>
											<a href="<?php echo $category_link; ?>"><?php echo $category_label; ?></a>
										<?php }else{ ?>
											<a><?php echo $category_label; ?></a>
										<?php } ?>
										<?php buildSubmenu( $category_id, $category_name ); ?>	
										<?php //buildSubmenu2( $category_id , $category_name); ?>
									</li>
									
								<?php endforeach; ?>
								
							<li class="hide-for-small">
								<a id="large-search-toggle" href="#" data-toggle="searchform"><span class="icon-alone" data-icon="&#xe61f;"></span><span class="screen-reader-text">Search</span></a>
							</li>	
						</ul>
					</nav>

					<nav id="menu-region-container" class="menu static">
						<ul id="menu-region" class="cf">
							<li><a href="<?php bloginfo('url'); ?>/north-africa/">North Africa</a></li>
							<li><a href="<?php bloginfo('url'); ?>/east-africa/">East Africa</a></li>
							<li><a href="<?php bloginfo('url'); ?>/south-africa/">South Africa</a></li>
							<li><a href="<?php bloginfo('url'); ?>/west-africa/">West Africa</a></li>	
							<li><a href="<?php bloginfo('url'); ?>/central-africa/">Central Africa</a></li>	
						</ul>
					</nav>

				</div><!-- /.container -->
			</div><!-- /.bg-1 -->	
			
			<div class="menu-secondary-wrapper js-menu-build">
				<div class="container">	
					
					<!-- Secondary Navigation -->
					<?php 
					// wp_nav_menu( array( 
					// 	'theme_location' => 'secondary', 
					// 	'container' => 'nav', 
					// 	'container_id' => 'menu-secondary-container', 
					// 	'container_class' => 'menu static', 
					// 	'menu_class' => 'cf'
					// ) ); 
					?>

					<nav id="menu-secondary-container" class="menu static">
						<ul id="menu-secondary" class="cf">
							<li class="hide-for-medium"><a id="cat-toggle" href="#">Articles by category</a></li>
							<li class="hide-for-medium"><a id="region-toggle" href="#">Articles by region</a></li>
							<li><a href="<?php bloginfo('url'); ?>/advertisers/">Advertisers</a></li>
							<li>
								<a class="hide-for-small" href="<?php bloginfo('url'); ?>/magazine/">Magazine</a>
								<ul id="magazine-dropdown" class="sub-menu cf">
									<?php
										// Query latest issue
										$query = new WP_Query( array(
											'category_name' => 'magazine',
											'posts_per_page' => 1
										) ); 
										if ( $query->have_posts() ): while ( $query->have_posts() ): $query->the_post();
									?>
									<li class="latest-cover">
										<?php if ( has_post_thumbnail()) : ?>
											<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
											<?php the_post_thumbnail('small-img'); ?>
											</a>
										<?php endif; ?>
									</li>
									<li class="hide-for-medium"><a href="<?php bloginfo('url'); ?>/magazine/">Latest issue</a></li>
									<li class="hide-for-medium"><a href="<?php bloginfo('url'); ?>/subscribe/">Subscribe</a></li>
									<li class="hide-for-medium"><a href="<?php bloginfo('url'); ?>/back-catalogue/">Back catalogue</a></li>	
									<li>
										<h4>In this month's issue</h4>
										<ul>
										<?php
											// Query latest issue articles
											$current_articles = new WP_Query( array(
												'tag' => sluggify( get_the_title() ),
												'posts_per_page' => 5
											) );

											if ( $current_articles->have_posts() ) : while ( $current_articles->have_posts() ) : $current_articles->the_post(); ?>
												<li><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" ><?php the_title(); ?></a></li>
											<?php endwhile; endif; ?>
										</ul>

									</li>
									<?php endwhile; endif; wp_reset_postdata(); ?>
								</ul>
							</li>
							<li><a href="<?php bloginfo('url'); ?>/subscribe/">Subscribe</a></li>
							<li><a href="<?php bloginfo('url'); ?>/press/">Press</a></li>
						</ul>
					</nav>

					<ul class="connect list-icons">
						<li>
							<a href="http://africanbusinessmagazine.com/feed/" title="Follow African Business Magazine's RSS Feed">
								<span class="icon-alone" data-icon="&#xe610;"></span><span class="screen-reader-text">RSS Feed</span>
							</a>
						</li>
						<li>
							<a href="https://www.facebook.com/pages/African-Business-Magazine/114117578656259" title="Visit African Business Magazine's Facebook Page">
								<span class="icon-alone" data-icon="&#xe611;"></span><span class="screen-reader-text">Facebook</span>
							</a>
						</li>
						<li>
							<a href="https://twitter.com/AfricanBizMag" title="Visit African Business Magazine's Twitter Page">
								<span class="icon-alone" data-icon="&#xe602;"></span><span class="screen-reader-text">Twitter</span>							
							</a>
						</li>
						<li>
							<a href="http://www.linkedin.com/company/ic-publications/" title="Visit IC Publication's LinkedIn Page">
								<span class="icon-alone" data-icon="&#xe609;"></span><span class="screen-reader-text">Linked In</span>
							</a>
						</li>
						<li>
							<a href="https://www.youtube.com/user/ICEventsLondon" title="Visit IC Publication's LinkedIn Page">
								<span class="icon-alone" data-icon="&#xe600;"></span><span class="screen-reader-text">Youtube</span>
							</a>
						</li>
						<li>
							<a href="https://plus.google.com/112863002386865475011/posts" title="Visit IC Publication's Google Plus Page">
								<span class="icon-alone" data-icon="&#xe60d;"></span><span class="screen-reader-text">Google Plus</span>
							</a>
						</li>
						<li>
						  	<?php 
						  		if( !(is_category('143')) ){
									echo '<a href="http://magazinedelafrique.com/category/african-business/">';
								}else{ 
									echo '<a href="http://magazinedelafrique.com/category/african-banker/">';
								} 
							?>

							<img src="http://africanbusinessmagazine.com/wordpress/wp-content/uploads/2015/04/french-flag.png" style="width: 19px;"></a>
						</li>
					</ul>
				</div><!-- /.container -->
			</div><!-- /.bg-1 -->

			<div class="large-container">
				<?php 
					if($parent_name == 'In Focus'){

						echo '<aside class="ad-unit check leaderboard">';
							echo '<a href="'. $company_url .'"><img src="'. $top_banner .'" /></a>';
							echo '<span class="signpost">Advertisement</span>';
						echo '</aside>';

					}else{
						get_template_part('parts/_ad-unit-leaderboard');
					}
				?>

				<?php if ( is_front_page() ) : ?>
					<h1 id="site-logo">
						<img src="<?php bloginfo('template_url'); ?>/lib/img/abm-logo.png" title="<?php bloginfo('title'); ?>" alt="<?php the_title(); ?>" itemprop="image">
					</h1>
				<?php else : ?>
					<h2 id="site-logo">
						<a href="<?php bloginfo('url'); ?>" title="Return to <?php bloginfo('title'); ?>'s homepage">
							<img src="<?php bloginfo('template_url'); ?>/lib/img/abm-logo.png" title="<?php bloginfo('title'); ?>" alt="<?php the_title(); ?>" itemprop="image">
						</a>
					</h2>
				<?php endif; ?>

			</div><!-- /.container -->		

		</header>
				
		<?php 
			// remove mobile ad that replaces the leaderboard
			// get_template_part('parts/_ad-unit-mobile1'); 
		?>