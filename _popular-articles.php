<article id="featured-posts" class="tabs l-module">
	<ul class="tab-nav">
		<li class="tab-link is-active-tab"><a style="color: #c00418" href="#popular-posts">Most Popular</a></li>
		<li class="tab-link"><a href="#discussed-posts">Most Discussed</a></li>
	</ul>
	<div id="popular-posts" class="tab">
		<h4 class="tab-title">Popular</h4>
		<div class="tab-panel">
			<ol class="list-article">
				<?php
					$popular = get_posts( array(
						'post_type' => 'post',
						'posts_per_page' => 7,
						'meta_key' => 'post_views_count',
						'orderby' => 'meta_value_num',
						'order' => 'DESC'
					) );
					foreach ( $popular as $post ) : setup_postdata( $post ); 
				?>
					<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
				<?php
					endforeach;
					wp_reset_postdata();
				?>
			</ol>
		</div>
	</div>
	<div id="discussed-posts" class="tab">
		<h4 class="tab-title">Most Discussed</h4>
		<div class="tab-panel">
			<ol class="list-article">
				<?php
					$discussed = get_posts( array(
						'post_type' => 'post',
						'posts_per_page' => 7,
						'orderby' => 'comment_count',
						'order' => 'DESC'
					) );
					foreach ( $discussed as $post ) : setup_postdata( $post );
				?>
					<li>
						<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> 
						<small><?php comments_number('<span class="comment-count">0</span>  <span data-icon="&#xe61d;"></span><span class="screen-reader-text">comment</span>', '<span class="comment-count">1</span> <span data-icon="&#xe61d;"></span><span class="screen-reader-text">comment</span>', '<span class="comment-count">%</span> <span data-icon="&#xe61d;"></span><span class="screen-reader-text">comments</span>'); ?></small>
					</li>
				<?php
					endforeach;
					wp_reset_postdata();
				?>
			</ol>
		</div>
	</div>
</article>