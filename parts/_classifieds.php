<article id="classifieds" class="tabs l-module">
	<h3 class="section-heading title-invert">Classifieds</h3>
	
	<ul class="tab-nav">
		<li class="tab-link"><a href="#jobs">Jobs</a></li>
		<li class="tab-link"><a href="#announcements">Announcements</a></li>
		<li class="tab-link"><a href="#tenders">Tenders</a></li>
	</ul>
	<div id="jobs" class="tab">
		<h4 class="tab-title">Jobs</h4>
		<ul class="tab-panel">
			<?php 
				$jobs_query = get_posts( array(
					'cat' => get_cat_ID( 'Jobs' ),
					'posts_per_page' => 12
				) );

				foreach ( $jobs_query as $post ) : setup_postdata( $post );
			?>
				<li class="job"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
			<?php 
				endforeach;
				wp_reset_postdata();
			?>
		</ul>
	</div>
	<div id="announcements" class="tab">
		<h4 class="tab-title">Announcements</h4>
		<ul class="tab-panel">
			<?php 
				$announcements_query = get_posts( array(
					'cat' => get_cat_ID( 'Announcement' ),
					'posts_per_page' => 5
				) );

				foreach ( $announcements_query as $post ) : setup_postdata( $post );
			?>
				<li class="announcement"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
			<?php 
				endforeach;
				wp_reset_postdata();
			?>
		</ul>
	</div>
	<div id="tenders" class="tab">
		<h4 class="tab-title">Tenders</h4>
		<ul class="tab-panel">
			<?php 
				$tenders_query = get_posts( array(
					'cat' => get_cat_ID( 'Tenders' ),
					'posts_per_page' => 5
				) );

				foreach ( $tenders_query as $post ) : setup_postdata( $post );
			?>
				<li class="tender"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
			<?php 
				endforeach;
				wp_reset_postdata();
			?>
		</ul>
	</div>

	<a href="<?php echo get_category_link( get_cat_ID( 'Classifieds' ) ); ?>" class="btn tertiary block">See more classifieds</a>
</article>