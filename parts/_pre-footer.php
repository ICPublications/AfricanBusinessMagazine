<section class="pre-footer">
	<div class="container">
	
		<?php 

			if(is_front_page()) { 
				dynamic_sidebar('Pre Footer'); 
			} 
		?>
		
		<?php get_template_part('parts/_sister-sites'); ?>
	
	</div><!-- /.container -->
</section><!-- /.pre-footer -->