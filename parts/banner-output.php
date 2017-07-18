<?php
	function customBannerOutput( $ads, $args ) {
		
		$ad_count = count( $ads );
		$i = 1;
		$html = '';
	
		// Loop through ads.
		foreach ($ads as $ad) {
	
			$first_last = ' ';
			if ( $i == 1 ) {
				$first_last = ' first';
			} elseif ( $i == $ad_count ) {
				$first_last = ' last';
			}
		
			$html .= '<div class="banner-ad pos-'.$i.$first_last.$args->container_class.'">';
			$html .= $ad->post_content;
			$html .= "</div>";
		
			$i++;
		}
	
		return $html;
		
	}
?>