<?php
function custom_wp_link_pages( $args = '' ) {
	$defaults = array(
		'before' => '<nav id="post-pagination" class="pagination">', 
		'after' => '</nav>',
		'text_before' => '',
		'text_after' => '',
		'next_or_number' => 'number', 
		'nextpagelink' => __( 'Next &raquo;' ),
		'previouspagelink' => __( '&laquo; Prev' ),
		'pagelink' => '%',
		'echo' => 1
	);

	$r = wp_parse_args( $args, $defaults );
	$r = apply_filters( 'wp_link_pages_args', $r );
	extract( $r, EXTR_SKIP );

	global $page, $numpages, $multipage, $more, $pagenow;

	$output = '';
	if ( $multipage ) {
		$output = $before;
		if ( $next_or_number == 'number' ) {
			for ( $i = 1; $i < ( $numpages + 1 ); $i = $i + 1 ) {
				$j = str_replace( '%', $i, $pagelink );
				$output .= ' ';
				if ( $i != $page || ( ( ! $more ) && ( $page == 1 ) ) )
					$output .= _wp_link_page( $i );
				else
					$output .= '<span class="current">';

				$output .= $text_before . $j . $text_after;
				if ( $i != $page || ( ( ! $more ) && ( $page == 1 ) ) )
					$output .= '</a>';
				else
					$output .= '</span>';
			}
		} elseif ( $next_or_number == 'both' ) {
			if ( $more ) {
				$i = $page - 1;
				if ( $i && $more ) {
					$output .= _wp_link_page( $i );
					$output .= $text_before . $previouspagelink . $text_after . '</a> ';
				}
			}
			for ( $i = 1; $i < ( $numpages + 1 ); $i = $i + 1 ) {
				$j = str_replace( '%', $i, $pagelink );
				$output .= ' ';
				if ( $i != $page || ( ( ! $more ) && ( $page == 1 ) ) )
					$output .= _wp_link_page( $i );
				else
					$output .= '<span class="current">';

				$output .= $text_before . $j . $text_after;
				if ( $i != $page || ( ( ! $more ) && ( $page == 1 ) ) )
					$output .= '</a>';
				else
					$output .= '</span>';
			}
			if ( $more ) {
				$i = $page + 1;
				if ( $i <= $numpages && $more ) {
					$output .= ' ' . _wp_link_page( $i );
					$output .= $text_before . $nextpagelink . $text_after . '</a>';
				}
			}
		} else {
			if ( $more ) {
				$i = $page - 1;
				if ( $i && $more ) {
					$output .= _wp_link_page( $i );
					$output .= $text_before . $previouspagelink . $text_after . '</a>';
				}
				$i = $page + 1;
				if ( $i <= $numpages && $more ) {
					$output .= _wp_link_page( $i );
					$output .= $text_before . $nextpagelink . $text_after . '</a>';
				}
			}
		}
		$output .= $after;
	}

	if ( $echo )
		echo $output;

	return $output;
}
?>