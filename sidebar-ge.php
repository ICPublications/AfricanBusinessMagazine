<?php
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
	echo '<div id="sidebar" class="l-4-9">';
?>
						<?php  echo '<h3 style="border-bottom: 1px solid ' . $company_col . '; color: '. $company_col .'">About General Electric</h3>'; ?>
						<div id="company-bio" style="background-color: grey; color: white; font-family:'futura-pt',sans-serif; padding:11px;">
							<?php echo $bio ?>
						</div>
						<?php if($press_release_link!=""){ ?>
						<?php  echo '<h3 style="border-bottom: 1px solid ' . $company_col . '; color: '. $company_col .'">Press Releases</h3>'; ?>
						<div id="press-releases" style="font-family:'futura-pt',sans-serif; padding:11px;">
							<ul id="press-release-list">
								<?php
									if( have_rows('press_releases', 10472) ):

										$i = 0;
									 	// loop through the rows of data
									    while ( have_rows('press_releases', 10472) && $i<6 ) : the_row();

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
							<?php
						echo '</div>';
						
					echo '</div><!-- /#sidebar -->';
?>