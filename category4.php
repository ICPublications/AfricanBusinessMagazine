<?php 
	get_header(); 
	
	$company_id;
	$name;
	$banner_img;
	$bio;
	$company_col;
	$company_url;
	$twitter_id;
	$focus_link; 
	$facebook_link; 
	$twitter_link;					
	$linkedin_link;
	$youtube_link; 
	$google_plus_link; 
	$press_release_link;

	$company_page = get_page_by_title( 'ecobank' );
	$page_id = $page->ID;

	$category_id = get_query_var('cat');
	$category = get_category( $category_id );
	$has_children = get_terms( 'category', array( 'parent' => $category_id, 'hide_empty' => false ) );
	$parent = get_category($category->category_parent);
	$parent_name = $parent->cat_name;

	class company
	{
		public function __construct($id, $name){
			$this->id = $id;
			$this->name = $name;
			$this->banner_img = get_field( "banner_image", $id );
			$this->bio = get_field( "bio", $id );
			$this->company_col = get_field( "company_col", $id );
			$this->company_url = get_field( "company_url", $id );
			$this->focus_link = get_field( "focus_link", $id );
			$this->twitter_id = get_field( "twitter_id", $id );
			$this->facebook_link = get_field( "facebook_link", $id );
			$this->twitter_link = get_field( "twitter_link", $id );			
			$this->linkedin_link = get_field( "linkedin_link", $id );
			$this->youtube_link = get_field( "youtube_link", $id );
			$this->google_plus_link = get_field( "google_plus_link", $id );
			$this->press_release_link = get_field( "press_release_link", $id );
		} 
	    function get_id(){
	        echo $this->id;
	    }
	    function get_name(){
	        echo $this->name;
	    }
	}

//
	$ecobank = new company('8750', 'Ecobank');
	$afdb = new company('9143', 'African Development Bank');
	$cverde = new company('9745', 'Cape Verde');
	$wbank = new company('10125', 'World Bank');
	$ge = new company('10472', 'General Electric');
	

	$companies = array($ecobank, $afdb, $cverde, $wbank, $ge);

	foreach($companies as $company){
		if($company->name == $category->name){
			$company_id = $company->id;
			$name = $company->name;
			$banner_img = $company->banner_img;
			$bio = $company->bio;
			$company_col = $company->company_col;
			$company_url = $company->company_url;
			$twitter_id = $company->twitter_id;
			$focus_link = $company->focus_link;
			$facebook_link = $company->facebook_link;
			$twitter_link = $company->twitter_link;			
			$linkedin_link = $company->youtube_link;_link;
			$youtube_link = $company->linkedin;
			$google_plus_link = $company->google_plus_link;
			$press_release_link = $company->press_release_link;
			break;
		}
	}
	
	// $category->cat_name
	/* $banner_img = get_field( "banner_image", 8750 );
	$bio = get_field( "bio", 8750 );
	$company_col = get_field( "company_col", 8750 );
	$company_url = get_field( "company_url", 8750 ); */

?>
	
	<div class="container" style="<?php if( $parent_name == 'In Focus'){ echo 'margin-top: -60px;'; } ?>">	
		<?php 
			if( $parent_name == 'In Focus'){
				//echo $category_post->ID;

					echo '<a class="" href="'. $company_url.'"><img src="'.  $banner_img .'" style="width:100%" /></a>';
					if($press_release_link!=""){ 
						echo '<nav id="company-profile-links" style="margin-top: 20px">';
							//echo '<a href="http://www.ecobank.com" style="color: '. $company_col .'">Website</a>';
							echo '<a href="'. $press_release_link .'" style="color: '. $company_col .'">Press Releases</a>';
						echo '</nav>';
					}
				}
			?>

			<?php if($company_id=='9143' && false && $parent_name=='In Focus'){ ?>
			<div id="intro-para" class="row" style="margin-top: -21px;">
		        <div class="container">
		            <div class="col-xs-6 col-md-3 center-block" style="float:none; margin-bottom:-61px; text-align:center">
		                <a href="#" class="thumbnail">
		                    <img style="width:100px" src="http://africanbusinessmagazine.com/wordpress/wp-content/uploads/2015/05/afbb50.png" alt="">
		                </a>
		            </div>
		            <hr style="border-color: black; border-width: 2px; margin-bottom:65px">
		        </div>
		    </div>
			<div class="row">
		        <div class="container">
		        	<h2 style="text-align: center; font-size: 40px; margin-bottom: 15px;">- AfDB Presidential Election -</h2>
		        	<p style="text-align:center; padding-left:20px; padding-right:20px; font-size:12px">The board of the African Development Bank will vote on a new president for the institution this May, with eight candidates vying to replace outgoing head Donald Kaberuka.
Nigerian agriculture minister Akinwumi Adesina; former Tunisian finance minister Jaloul Ayed; Kordjé Bedoumra, Cristina Duarte, Sufian Ahmed and Samura Kamara – the finance ministers of Chad, Cabo Verde, Ethiopia and Sierra Leone, respectively; retired AfDB vice president Thomas Sakala from Zimbabwe; and Birama Boubacar Sidibé, the vice president of the Islamic Development Bank, are all running for the position.
The candidates will be eliminated in a series of voting rounds at the AfDB’s annual meetings in Abidjan, Côte d’Ivoire, as the bank prepares to return to its former home after more than a decade based in a temporary headquarters in Tunis.</p>

		            <div id="person1" class="col-xs-6 col-md-2 person-pic">
		                <a href="#" class="thumbnail">
		                    <img src="http://africanbusinessmagazine.com/wordpress/wp-content/uploads/2015/05/akinwumiadesina.jpg" alt="">
		                </a>
		                <div style="height: 38px; background-color: black; color:white;
 text-align: center; font-size:13px           ">
  Akinwumi Adesina
  </div>
		            </div>
		            <div id="person2" class="col-xs-6 col-md-2 person-pic">
		                <a href="#" class="thumbnail">
		                    <img src="http://africanbusinessmagazine.com/wordpress/wp-content/uploads/2015/05/jaloulayed.jpg" alt="">
		                </a>
		                <div style="height: 38px; background-color: black; color:white;
 text-align: center; font-size:13px           ">
  Jaloul Ayed
  </div>
		            </div>
		            <div id="person3" class="col-xs-6 col-md-2 person-pic">
		                <a href="#" class="thumbnail">
		                    <img src="http://africanbusinessmagazine.com/wordpress/wp-content/uploads/2015/05/kordjebedoumra.jpg" alt="">
		                </a>
		                <div style="height: 38px; background-color: black; color:white;
 text-align: center; font-size:13px           ">
  Kordjé Bedoumra
  </div>
		            </div>
		            <div id="person4" class="col-xs-6 col-md-2 person-pic">
		                <a href="#" class="thumbnail">
		                    <img src="http://africanbusinessmagazine.com/wordpress/wp-content/uploads/2015/05/cristina-duarte1.jpg" alt="">
		                </a>
		                <div style="height: 38px; background-color: black; color:white;
 text-align: center; font-size:13px           ">
  Cristina Duarte
  </div>
		            </div>
		            <div id="person5" class="col-xs-6 col-md-2 person-pic">
		                <a href="#" class="thumbnail">
		                    <img src="http://africanbusinessmagazine.com/wordpress/wp-content/uploads/2015/05/samurahamara.jpg" alt="">
		                </a>
		                <div style="height: 38px; background-color: black; color:white;
 text-align: center; font-size:13px           ">
  Samura Kamara
  </div>
		            </div>
		            <div id="person6" class="col-xs-6 col-md-2 person-pic">
		                <a href="#" class="thumbnail">
		                    <img src="http://africanbusinessmagazine.com/wordpress/wp-content/uploads/2015/05/thomaszondosakala.jpg" alt="">
		                </a>
		                <div style="height: 38px; background-color: black; color:white;
 text-align: center; font-size:13px           ">
  Thomas Zondo Sakala
  </div>
		            </div>
		            <div id="person7" class="col-xs-6 col-md-2 person-pic">
		                <a href="#" class="thumbnail">
		                    <img src="http://africanbusinessmagazine.com/wordpress/wp-content/uploads/2015/05/sufianahmed1.jpg" alt="">
		                </a>
		                <div style="height: 38px; background-color: black; color:white;
 text-align: center; font-size:13px           ">
  Sufian Ahmed
  </div>
		            </div>
		            <div id="person8" class="col-xs-6 col-md-2 person-pic">
		                <a href="#" class="thumbnail">
		                    <img src="http://africanbusinessmagazine.com/wordpress/wp-content/uploads/2015/05/birama1.jpg" alt="">
		                </a>
		                <div style="height: 38px; background-color: black; color:white;text-align: center; font-size:13px           ">
					Birama Boubacar Sidibé
					</div>
		            </div>

		        </div>
		    </div>
		    <div class="row">
				<div class="container">
			            <hr style="border-color: gainsboro; border-width: 2px;">
			            <div id="person-info-holder" class="container pg-empty-placeholder" style="width:100%; margin-left:0; margin-right:0; margin-top:25px;">
			                <div id="person1-large" class="col-xs-12 person-info">
			                    <div class="col-xs-7">
			                        <h2>Akinwumi Adesina</h2>
			                        <p>Akinwumi Adesina of Nigeria is more of an agricultural development specialist than a financier. His vision is based on continuing decentralisation and increasing support for private initiatives.</p>
			                    	<ul>
				                            <?php
												$postslist = get_posts('orderby=date&tag=akinwumi-adesina');

												foreach ( $postslist as $post ) : setup_postdata( $post ); 
													echo '<li>';
														echo '<a href="' .  get_permalink() . '">' . get_the_title() . '</a>';
													echo '</li>';
												endforeach; 
												wp_reset_postdata();
				                            ?>
				                            <li><a href="http://africanbusinessmagazine.com/uncategorised/governance-and-financial-reform-are-key-jaloul-ayed/">A Voice for What Africa Needs – Akinwumi Adesina</a></li>
				                        </ul>
			                    </div>
			                    <div class="col-xs-5">
			                        <a href="#" class="thumbnail">
			                            <img src="http://africanbusinessmagazine.com/wordpress/wp-content/uploads/2015/05/akinwumi-large.jpg" alt="">
			                        </a>
			                    </div>
			                </div>
			                <div id="person2-large" class="col-xs-12 person-info">
			                    <div class="col-xs-7">
			                        <h2>Jaloul Ayed</h2>
			                        <p>Tunisia's former Finance Minister, Jaloul Ayed, asserts that it is his banking experience which allowed him to gain a clear understanding of Africa's full potential.  He calls for an AfDB closer to its markets.</p>
			                    	<ul>
				                            <?php
												$postslist = get_posts('orderby=date&tag=jaloul-ayed');

												foreach ( $postslist as $post ) : setup_postdata( $post ); 
													echo '<li>';
														echo '<a href="' .  get_permalink() . '">' . get_the_title() . '</a>';
													echo '</li>';
												endforeach; 
												wp_reset_postdata();
				                            ?>
				                            <li><a href="http://africanbusinessmagazine.com/uncategorised/governance-and-financial-reform-are-key-jaloul-ayed/">Governance and financial reform are key – Jaloul Ayed</a></li>
				                        </ul>
			                    </div>
			                    <div class="col-xs-5">
			                        <a href="#" class="thumbnail">
			                            <img src="http://africanbusinessmagazine.com/wordpress/wp-content/uploads/2015/05/jaloulayed-large.jpg" alt="">
			                        </a>
			                    </div>
			                </div>
			                <div id="person3-large" class="col-xs-12 person-info">
			                    <div class="col-xs-7">
			                        <h2>Kordjé Bedoumra</h2>
			                        <p>Following his time at the AfDBM Korjé Bedoumra intends to improve operational efficiency an pursue both short-term and long-term policies.</p>
			                            <ul>
				                            <?php
												$postslist = get_posts('orderby=date&tag=kordje-bedoumra');

												foreach ( $postslist as $post ) : setup_postdata( $post ); 
													echo '<li>';
														echo '<a href="' .  get_permalink() . '">' . get_the_title() . '</a>';
													echo '</li>';
												endforeach; 
												wp_reset_postdata();
				                            ?>
				                        </ul>
				                    </div>
			                    <div class="col-xs-5">
			                        <a href="#" class="thumbnail">
			                            <img src="http://africanbusinessmagazine.com/wordpress/wp-content/uploads/2015/05/kordje.jpg" alt="">
			                        </a>
			                    </div>
			                </div>
			                <div id="person4-large" class="col-xs-12 person-info">
			                    <div class="col-xs-7">
			                        <h2>Cristina Duarte</h2>
			                        <p>Hon. Cristina Duarte is the Minister of Finance in Cape Verde, and Governor of the African Development Bank Group.</p>
			                        <ul>
				                            <?php
												$postslist = get_posts('orderby=date&tag=cristina-duarte');

												foreach ( $postslist as $post ) : setup_postdata( $post ); 
													echo '<li>';
														echo '<a href="' .  get_permalink() . '">' . get_the_title() . '</a>';
													echo '</li>';
												endforeach; 
												wp_reset_postdata();
				                            ?>
				                        </ul>
			                    </div>
			                    <div class="col-xs-5">
			                        <a href="#" class="thumbnail">
			                            <img src="http://africanbusinessmagazine.com/wordpress/wp-content/uploads/2015/05/cristina.jpg" alt="">
			                        </a>
			                    </div>
			                </div>
			                <div id="person5-large" class="col-xs-12 person-info">
			                    <div class="col-xs-7">
			                        <h2>Samura Kamara</h2>
			                        <p>With broad experience in a number of financial institutions.  Sierra leone's Samura Kamara believes he is the right person to ensure the AfDB works for Africa.</p>
			                        <ul>
				                            <?php
												$postslist = get_posts('orderby=date&tag=samura-kamara');

												foreach ( $postslist as $post ) : setup_postdata( $post ); 
													echo '<li>';
														echo '<a href="' .  get_permalink() . '">' . get_the_title() . '</a>';
													echo '</li>';
												endforeach; 
												wp_reset_postdata();
				                            ?>
				                        </ul>
			                    </div>
			                    <div class="col-xs-5">
			                        <a href="#" class="thumbnail">
			                            <img src="http://africanbusinessmagazine.com/wordpress/wp-content/uploads/2015/05/samura.jpg" alt="">
			                        </a>
			                    </div>
			                </div>
			                <div id="person6-large" class="col-xs-12 person-info">
			                    <div class="col-xs-7">
			                        <h2>Thomas Zondo Sakala</h2>
			                        <p>With plenty of experience working at the AfDB, Zimbabwe's Thomas Sakala believes he is well suited to keep the Banks's programmes and strategies on the right track.</p>
			                    	<ul>
			                    		<li><a href="http://africanbusinessmagazine.com/?p=9250">Candidate Interview: Thomas Zondo Sakala Former Vice president  of AfDB, Zimbabwe</a></li>
			                    	</ul>
			                    </div>
			                    <div class="col-xs-5">
			                        <a href="#" class="thumbnail">
			                            <img src="http://africanbusinessmagazine.com/wordpress/wp-content/uploads/2015/05/thomassakala.jpg" alt="">
			                        </a>
			                    </div>
			                </div>
			                <div id="person7-large" class="col-xs-12 person-info">
			                    <div class="col-xs-7">
			                        <h2>Sufian Ahmed</h2>
			                        <p>Having overseen Ethiopia's strong growth into one of Africa's leading economies. its finance minister, Sufian Ahmed, believes the AfDB will be ssafe in his experienced hands.</p>
			                    	<ul>
			                    		<li><a href="http://africanbusinessmagazine.com/uncategorised/sufian-ahmed-minister-of-finance-and-economic-development-ethiopia/">Candidate Interview: Sufian Ahmed Minister of Finance and Economic Development, Ethiopia</a></li>
			                    	</ul>
			                    </div>
			                    <div class="col-xs-5">
			                        <a href="#" class="thumbnail">
			                            <img src="http://africanbusinessmagazine.com/wordpress/wp-content/uploads/2015/05/sufianahmed-large.jpg" alt="">
			                        </a>
			                    </div>
			                </div>
			                <div id="person8-large" class="col-xs-12 person-info">
			                    <div class="col-xs-7">
			                        <h2>Birama Boubacar Sidibé</h2>
			                        <p>With a wealth of experience in African development institutions, Mali's Birama Boubacar Sidibé intends to make the AfDB more efficent in its decentralised organisation and expand its business operations.</p>
			                    	<ul>
			                    		<li><a href="http://africanbusinessmagazine.com/?p=9254">Candidate Interview: Birama Boubacar Sidibé Vice president of the Islamic Bank of Development, Mali</a></li>
			                    	</ul>
			                    </div>
			                    <div class="col-xs-5">
			                        <a href="#" class="thumbnail">
			                            <img src="http://africanbusinessmagazine.com/wordpress/wp-content/uploads/2015/05/birama-large.jpg" alt="">
			                        </a>
			                    </div>
			                </div>
			                <div id="person-placehold" class="col-xs-12 person-info" style="display:block; width: 100%;">
			                    <div class="col-xs-7" style="width:100%">
			                        <h2 style="text-align:center; margin-top: 140px;">Select A Candidate Above to See Their Profile</h2>
			                    </div>
			                </div>
			            </div>
			        </div>
			    </div>

			    <div class="container">
			    	<hr style="border-color: gainsboro; border-width: 2px;">
		                
<p style="text-align:left; padding-left:20px; padding-right:20px;">Donald Kaberuka, the former finance minister of Rwanda, has run the institution for just under a decade, winning plaudits for rebuilding its international reputation, and for taking a prominent role in shaping an African response to the global financial crisis in 2008–9. Under his presidency, the bank’s shareholders approved a 200% capital increase.
Voting power is spread across the shareholding of the bank, which includes most African countries and several international funders, meaning that individual nations’ politics could have an influence on the outcome.</p>

<p style="text-align:left; padding-left:20px; padding-right:20px; margin-bottom:50px">“I don’t think it alone is prohibitive for any one candidate, nor will it guarantee success, but it is a factor,” says Scott Morris, who led the US’ engagement with the AfDB during the first Obama administration as deputy assistant secretary for development finance and debt at the Treasury Department.
“I guess I would say that if you are from a small country, purely from the measure of shareholding you’re fighting an uphill battle. On the other hand, the current president is one of those small country candidates. I still think it’s anyone’s guess how this turns out.”</p>
		        
		        </div>

			   <?php } ?>

		<section id="content" class="l-8-1">
			
		<?php 
			if( $parent_name == 'In Focus'){ 
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
								echo "<a href=\"". get_category_link( $sub_category->term_id) ."\">";
								echo $sub_category->name;
								echo "</a>";
								echo "</li>";
							}

							echo "</ul>";
						endif;
						$category = get_the_category();
    					if ($category[0]->parent != '') { 

						$parent = get_the_category( $category[0]->parent);
    						//echo "<a href=\"" . get_category_link( $category[0]->parent) . "\">Back to " . $parent[0]->name . " </a>";
    					} 
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
						elseif ( ($i == 1 || $i == 2 || $i == 3 || $i == 4) && $paged == 1 && $notclassifieds ) :
							$imagesize = 'medium'; 
							$articlesize = 'medium'; 
						else : 
							$imagesize = 'thumbnail'; 
							$articlesize = 'thumb';
						endif;

						if( ( $i == 1 || $i == 3 ) && $paged == 1 ) { echo '<div class="row cf">'; } // Open row for medium sized images
						if( ( $i == 3 || $i == 5 ) && $paged == 1 ) { echo '</div>'; } // Close row for medium sized images

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
			if( $parent_name == 'In Focus'){ 
			?>
				<div id="sidebar" class="l-4-9">
					<?php  echo '<h3 style="border-bottom: 1px solid ' . $company_col . '; color: '. $company_col .'">About '. $name . '</h3>'; ?>
					<div id="company-bio" style="background-color: grey; color: white; font-family:'futura-pt',sans-serif; padding:11px;">
						<?php echo $bio ?>
					</div>
					<?php if($press_release_link!=""){ ?>
					<?php  echo '<h3 style="border-bottom: 1px solid ' . $company_col . '; color: '. $company_col .'">Press Releases</h3>'; ?>
					<div id="press-releases" style="font-family:'futura-pt',sans-serif; padding:11px;">
						<ul id="press-release-list">
							<?php
								if( have_rows('press_releases', $company_id) ):

									$i = 0;
								 	// loop through the rows of data
								    while ( have_rows('press_releases', $company_id) && $i<6 ) : the_row();

								        echo '<li><a style="color: '. $company_col .'" href=  "'. get_sub_field('press_release_link') .'"  target="blank" >- '. get_sub_field('press_release_name') .'</a></li>';

								        $i++;
								    endwhile;

								else :

								    // no rows found

								endif;				
								echo '<li><a style="color: '. $company_col .'" href="'. $press_release_link .'" target="blank">See More</a></li>';
							?>

							
						</ul>
					</div>

					<?php } ?>
					<?php if($linkedin_link!=""){ ?>
					<div id="networks">
						<?php  echo '<h3 style="border-bottom: 1px solid ' . $company_col . '; color: '. $company_col .'">Networks</h3>'; ?>
							<?php 
								echo '<a style="color: '. $company_col .'" href="'. $facebook_link .'"><span class="icon-alone" data-icon=""></span><span class="screen-reader-text">Facebook</span></a>';
								echo '<a style="color: '. $company_col .'" href="'. $twitter_link .'"><span class="icon-alone" data-icon=""></span><span class="screen-reader-text">Twitter</span></a>';					
								echo '<a style="color: '. $company_col .'" href="'. $linkedin_link .'"><span class="icon-alone" data-icon=""></span><span class="screen-reader-text">Linked In</span></a>';
								echo '<a style="color: '. $company_col .'" href="'. $youtube_link .'"><span class="icon-alone" data-icon=""></span><span class="screen-reader-text">Youtube</span></a>';
								echo '<a style="color: '. $company_col .'" href="'. $google_plus_link .'"><span class="icon-alone" data-icon=""></span><span class="screen-reader-text">Google Plus</span></a>';
							?>
						<a class="twitter-timeline" href=<?php echo '"'. $twitter_link .'"' ?> data-widget-id=<?php echo '"' . $twitter_id .'"' ?> > Tweets by <?php echo $name; ?></a>
						<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
					</div>
					
					<?php } ?>
					<div style="margin-bottom:50px;">
						<?php if($name=='Cape Verde'){ ?>
							<?php  echo '<h3 style="border-bottom: 1px solid ' . $company_col . '; color: '. $company_col .'">At A Glance</h3>'; ?>
							<img style="margin-top:20px; margin-bottom:20px" src="http://africanbusinessmagazine.com/wordpress/wp-content/uploads/2015/07/vital1.jpg" />
							<img style="top:30px" src="http://africanbusinessmagazine.com/wordpress/wp-content/uploads/2015/07/Screen-Shot-2015-07-17-at-11.51.28.png" />
						<?php } ?>
					</div>
					
				</div><!-- /#sidebar -->
			<?php 
			}else{
				get_template_part('sidebar');
		} ?>

	</div><!-- /.container -->
	
	<?php get_template_part('parts/_pre-footer'); ?>

<?php get_footer(); ?>  