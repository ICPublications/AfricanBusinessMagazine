<div id="article-author" class="author-bio l-module">
	<div class="author-img">
		<?php echo get_avatar( get_the_author_meta('email') ); ?>
	</div>
	<div class="author-info">
		<h5 class="author-title">Written by <?php the_author_link(); ?></h5>
		<p class="author-description"><?php the_author_meta('description'); ?></p>
	</div>
</div>