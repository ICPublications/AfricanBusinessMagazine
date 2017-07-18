<?php
add_filter( 'get_avatar', 'my_custom_avatar' );

function my_custom_avatar( $avatar ) {
	$xpath = new DOMXPath(@DOMDocument::loadHTML($avatar));
	$src = $xpath->evaluate("string(//img/@src)");
	
	return "<img src='{$src}' class='avatar photo' alt='Author Thumbnail' />";
}
?>