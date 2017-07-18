<!-- 
<article class="featured-events l-module">
	<h3 class="section-heading title-invert">Events</h3>
	<?php
		include_once( ABSPATH . WPINC . '/feed.php' );

		$rss = fetch_feed( 'http://www.events-africa.com/news-rss.xml' );

		if ( !is_wp_error( $rss ) ) :
			$maxitems = $rss->get_item_quantity( 5 ); 
			$rss_items = $rss->get_items( 0, $maxitems );
		endif;
	?>
	<ul class="list-boxed">
		<?php if ( $maxitems == 0 ) : ?>
			<li class="event"><h4 class="event-title"><em><?php echo('No events.'); ?></em></h4></li>
		<?php else : ?>
			<?php foreach ( $rss_items as $item ) : ?>
				<li class="event">
					<h4 class="event-title">
						<a class="event-link" href="<?php echo esc_url( $item->get_permalink() ); ?>"><?php echo esc_html( $item->get_title() ); ?></a>
					</h4>
					<time class="event-date"><?php echo esc_html( $item->get_date('l j F Y') ); ?></time>
				</li>
			<?php endforeach; ?>
		<?php endif; ?>
	</ul>
	<a href="http://www.ic-events.net/" class="btn tertiary block" target="_blank">See more events</a>
</article>
 -->

<article class="featured-events l-module">
	<h3 class="section-heading title-invert">Events</h3>
	<ul class="list-boxed">
		<?php 
			function customorderby($orderby) {
				return 'mt1.meta_value+0 ASC, mt2.meta_value+0 ASC, mt3.meta_value+0 ASC';
			}

			$args = array(
				'post_type' => 'icevents', 
				'meta_key' => 'event_date_year',
				'meta_query' => array(
					array('key' => 'event_date_year'),
					array('key' => 'event_date_mon'),
					array('key' => 'event_date_day')
				),
				'posts_per_page' => -1
			);

			add_filter('posts_orderby','customorderby');
			$events = new WP_Query($args); 
			remove_filter('posts_orderby','customorderby');

			if ( $events->have_posts() ) : ?>
				
				<?php $counter = 0; ?>

				<?php while ( $events->have_posts() ) : $events->the_post(); ?>
				<?php 
					$post_meta = get_post_meta($post->ID);
					$day = $post_meta['event_date_day'][0];
					$mon = $post_meta['event_date_mon'][0];
					$year = $post_meta['event_date_year'][0];
					$end_day = $post_meta['event_end_date_day'][0];
					$end_mon = $post_meta['event_end_date_mon'][0];
					$end_year = $post_meta['event_end_date_year'][0];
					$event_date = date('d F Y', strtotime($year.$mon.$day));
					$event_end_date = date('d F Y', strtotime($end_year.$end_mon.$end_day));
					
					$todays_date = date("Y-m-d"); 
					if( $counter < 10 && strtotime($end_year.'-'.$end_mon.'-'.$end_day) > strtotime($todays_date)){ echo '<!--'. $end_year.'-'.$end_mon.'-'.$end_day .'+'. $todays_date .';-->'?>

						<?php $counter++ ?>
						<li class="event ">
							<h4 class="event-title">
								<a class="event-link" href="<?php echo get_post_meta($post->ID, 'event_link', true); ?>" target="_blank"><?php the_title(); ?></a>
							</h4>
							<?php if ($day && $mon & $year) : ?>
								<time class="event-date">
									<?php echo $event_date; ?>
									<?php if ($end_day && $end_mon & $end_year) : ?> - <?php echo $event_end_date; ?><?php endif; ?>
								</time>
							<?php endif; ?>
						</li>
					
				<?php }; endwhile; ?>
		<?php else : ?>
			<li class="event"><h4 class="event-title"><em>No events.</em></h4></li>
		<?php endif; ?>
		<?php wp_reset_query(); ?>
	</ul>		
	<a href="http://www.ic-events.net/" class="btn tertiary block" target="_blank">See more events</a>
</article>