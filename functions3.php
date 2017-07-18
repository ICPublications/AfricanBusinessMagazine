<?php
// -------------------------------------
// Hide Wordpress admin bar
// -------------------------------------
// add_filter('show_admin_bar', '__return_false');

// -------------------------------------
// Remove generator
// -------------------------------------
remove_action('wp_head', 'wp_generator');

// -------------------------------------
// Enable shortcodes in text widget
// -------------------------------------
add_filter('widget_text', 'do_shortcode');

// -------------------------------------
// Prevent removal of <p> and <br /> tags in editor
// -------------------------------------
remove_filter('the_content', 'wpautop');

// -------------------------------------
// Adjust read more indicator
// -------------------------------------
function new_excerpt_more( $more ) {
	return ' ...';
}
add_filter('excerpt_more', 'new_excerpt_more');

// -------------------------------------
// Adjust excerpt length
// -------------------------------------
function custom_excerpt_length( $length ) {
	return 25;
}
add_filter('excerpt_length', 'custom_excerpt_length', 999);

// -------------------------------------
// Add support for post formats
// -------------------------------------
add_theme_support( 'post-formats', array( 'gallery' ) );

/*-------------------------------------
// Enable dynamic sidebar areas
-------------------------------------*/
function theme_widgets_init() {
	// Pre Footer
	register_sidebar( array (
		'name' => 'Pre Footer',
		'id' => 'prefooter',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<h3 class="widget-title hide">',
		'after_title' => '</h3>',
	) );
	// After Content
	register_sidebar( array (
		'name' => 'After Content',
		'id' => 'contentafter',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<h3 class="widget-title hide">',
		'after_title' => '</h3>',
	) );
	// Secondary
	register_sidebar( array (
		'name' => 'Secondary',
		'id' => 'secondary',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	// Site Header
	register_sidebar( array (
		'name' => 'Site Header',
		'id' => 'siteheader',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<h3 class="widget-title hide">',
		'after_title' => '</h3>',
	) );
	// Site Footer
	register_sidebar( array (
		'name' => 'Site Footer',
		'id' => 'sitefooter',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<h3 class="widget-title hide">',
		'after_title' => '</h3>',
	) );
}
add_action('init', 'theme_widgets_init');

// -------------------------------------
// Configure custom menus
// -------------------------------------
function register_menus() {
	register_nav_menus(array( 
		'primary' => __( 'Primary Menu' ),
		'secondary' => __( 'Secondary Menu' ),
		'footer-1' => __( 'Footer Menu 1' ),
		'footer-2' => __( 'Footer Menu 2' ),
		'footer-3' => __( 'Footer Menu 3' ),
		'footer-4' => __( 'Footer Menu 4' ),
		'footer-5' => __( 'Footer Menu 5' ),
	));
}
add_action('init', 'register_menus');

// -------------------------------------
// Get custom menu names - http://www.andrewgail.com/getting-a-menu-name-in-wordpress/
// -------------------------------------
function ag_get_menu( $theme_location ) {
	if( ! $theme_location ) return false;
 
	$theme_locations = get_nav_menu_locations();
	if( ! isset( $theme_locations[$theme_location] ) ) return false;
 
	$menu_obj = get_term( $theme_locations[$theme_location], 'nav_menu' );
	if( ! $menu_obj ) $menu_obj = false;
 
	return $menu_obj;
}

function ag_get_menu_name( $theme_location ) {
	if( ! $theme_location ) return false;
 
	$menu_obj = ag_get_menu( $theme_location );
	if( ! $menu_obj ) return false;
 
	if( ! isset( $menu_obj->name ) ) return false;
 
	return $menu_obj->name;
}

// -------------------------------------
// Add default posts and comments RSS feed links to head
// -------------------------------------
add_theme_support('automatic-feed-links');

// -------------------------------------
// Customise default gallery output
// -------------------------------------

// Remove default gallery css
// add_filter( 'use_default_gallery_style', '__return_false' );

// Remove default gallery image width and height attributes
// add_filter( 'wp_get_attachment_link', 'remove_img_width_height', 10, 1 );
// function remove_img_width_height($html) {
//     $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
//     return $html;
// }

// Update gallery output
require_once('parts/gallery-output.php');

// -------------------------------------
// Customise banner ad output
// -------------------------------------

// Update banner ad output
require_once('parts/banner-output.php');

// -------------------------------------
// Add additional classes to body tag
// -------------------------------------
add_filter('body_class', 'add_category_to_single');
function add_category_to_single($classes) {
    global $post;
    $classes[] = 'page-'.$post->post_name;
    if ($post->post_parent) {
      $ppost = get_post($post->post_parent);
      $classes[] = 'section-'.$ppost->post_name;
    }
  // return the $classes array
  return $classes;
}

// -------------------------------------
// Custom image sizes
// -------------------------------------
if ( function_exists( 'add_theme_support' ) ) { 
	add_theme_support( 'post-thumbnails' ); 
}

// -------------------------------------
// Responsive thumbnails
// -------------------------------------
function get_responsive_thumbnail($sizes) {

	// Get post ID for image reference
	$imageid = get_post_thumbnail_id( get_the_ID() );

	// Get alt text
	$alt = get_post_meta( $imageid, '_wp_attachment_image_alt', true );
	
	// Initialise array for image sizes
	$i = 0;
	$img_sizes = array();

	$output = '<picture>';
	$output .= '<!--[if IE 9]><video style="display: none;"><![endif]-->';
	
	// Loop through each image size in the array
	foreach($sizes as $size) {
		
		// Get the correct attachment based on image size
		$img_sizes[$i] = wp_get_attachment_image_src( $imageid, $size[0] );

		// Generate the html for picturefill
		$output .= '<source srcset="' . $img_sizes[$i][0] . '" media="(min-width:' . $size[1] . 'px)">';

		if($size[2]) {
			$output .= '<img class="responsive-img" srcset="' . $img_sizes[$i][0] . '" alt="' . $alt . '" title="' . get_the_title($imageid) . '">';	
		}

		// Increment counter
		$i++;
	}

	$output .= '<!--[if IE 9]></video><![endif]-->';
	$output .= '</picture>';

	return $output;

}

// -------------------------------------
// Remove img width / height attributes
// -------------------------------------
add_filter( 'post_thumbnail_html', 'remove_width_attribute', 10 );
add_filter( 'image_send_to_editor', 'remove_width_attribute', 10 );

function remove_width_attribute( $html ) {
   $html = preg_replace( '/(width|height)="\d*"\s/', "", $html );
   return $html;
}

/* Remove dimensions from avatars */
add_filter( 'get_avatar', 'remove_width_attribute', 10 );

// -------------------------------------
// Query posts from categories
// -------------------------------------
function buildSubmenu($category_id, $num_of_posts) {
	
	$query = new WP_Query( array(
		'cat' => $category_id,
		'posts_per_page' => $num_of_posts
	) );

	if ( $query->have_posts() ) : 

		echo '<ul class="sub-menu">';
		
		echo "<h4 class='hide-for-small'>Latest stories</h4>";

		while ( $query->have_posts() ) : $query->the_post();
			echo '<li><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
		endwhile;

		echo '</ul>';

	endif; 
	wp_reset_postdata();

}

// -------------------------------------
// Popular posts
// -------------------------------------
function getPostViews($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0 View";
    }
    return $count.' Views';
}
function setPostViews($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}

// -------------------------------------
// Enable widget titles in admin without display on site (wrap titles in [] to hide)
// -------------------------------------
function flexible_widget_titles( $widget_title ) {
	$title = trim( $widget_title ); // get rid of any leading and trailing spaces
	if ( $title[0] == '[' && $title[strlen($title) - 1] == ']' ) $title = ''; // check the first and last character
	return $title;
}
add_filter( 'widget_title', 'flexible_widget_titles' );

// -------------------------------------
// Enable querying of tags by magazine date title
// -------------------------------------
// Give me a slug form title
function sluggify( $url ) {
    # Prep string with some basic normalization
    $url = strtolower($url);
    $url = strip_tags($url);
    $url = stripslashes($url);
    $url = html_entity_decode($url);
    # Remove quotes (can't, etc.)
    $url = str_replace('\'', '', $url);
    # Replace non-alpha numeric with hyphens
    $match = '/[^a-z0-9]+/';
    $replace = '-';
    $url = preg_replace($match, $replace, $url);
    $url = trim($url, '-');
    return $url;
}


// -------------------------------------
// Support for category specific single templates (e.g. single-magazine.php)
// -------------------------------------
add_filter('single_template', create_function(
	'$the_template',
	'foreach( (array) get_the_category() as $cat ) {
		if ( file_exists(TEMPLATEPATH . "/single-{$cat->slug}.php") )
		return TEMPLATEPATH . "/single-{$cat->slug}.php"; }
	return $the_template;' )
);

// -------------------------------------
// Global variables
// -------------------------------------
$magazine_title = '';

// -------------------------------------
// Add javascript variables to the doc head
// -------------------------------------
function js_variables(){ ?>
  <script type="text/javascript">
    var ajaxurl = <?php echo json_encode( admin_url( 'admin-ajax.php' ) ); ?>;      
    var ajaxnonce = <?php echo json_encode( wp_create_nonce('ajax-nonce') ); ?>;
  </script><?php
}

add_action ( 'wp_head', 'js_variables' );

// -------------------------------------
// Post like functions
// -------------------------------------
$timebeforerevote = 1;

add_action('wp_ajax_nopriv_post-like', 'post_like');
add_action('wp_ajax_post-like', 'post_like');

// Creates global variables for use in js
// wp_localize_script('like_post', 'ajax_var', array(
// 	'url' => admin_url('admin-ajax.php'),
// 	'nonce' => wp_create_nonce('ajax-nonce')
// ));


function post_like()
{
	$nonce = $_POST['nonce'];
 
    if ( ! wp_verify_nonce( $nonce, 'ajax-nonce' ) )
        die ( 'Busted!');
		
	if(isset($_POST['post_like']))
	{
		$ip = $_SERVER['REMOTE_ADDR'];
		$post_id = $_POST['post_id'];
		
		$meta_IP = get_post_meta($post_id, "voted_IP");

		$voted_IP = $meta_IP[0];
		if(!is_array($voted_IP))
			$voted_IP = array();
		
		$meta_count = get_post_meta($post_id, "votes_count", true);

		if(!hasAlreadyVoted($post_id))
		{
			$voted_IP[$ip] = time();

			update_post_meta($post_id, "voted_IP", $voted_IP);
			update_post_meta($post_id, "votes_count", ++$meta_count);
			
			echo $meta_count;
		}
		else
			echo "already";
	}
	exit;
}

function hasAlreadyVoted($post_id)
{
	global $timebeforerevote;

	$meta_IP = get_post_meta($post_id, "voted_IP");
	$voted_IP = $meta_IP[0];
	if(!is_array($voted_IP))
		$voted_IP = array();
	$ip = $_SERVER['REMOTE_ADDR'];
	
	if(in_array($ip, array_keys($voted_IP)))
	{
		$time = $voted_IP[$ip];
		$now = time();
		
		if(round(($now - $time) / 60) > $timebeforerevote)
			return false;
			
		return true;
	}
	
	return false;
}

function getPostLikeLink($post_id)
{
	$themename = "icpublications";

	$vote_count = get_post_meta($post_id, "votes_count", true);

	$output = '<div class="article-like"><p class="star-container">';
	if(hasAlreadyVoted($post_id))
		$output .= ' <span title="'.__('I rate this article', $themename).'" class="like alreadyvoted"></span>';
	else
		$output .= '<a href="#" data-post_id="'.$post_id.'">
					<span  title="'.__('I rate this article', $themename).'"class="like"></span>
				</a>';
	$output .= '<span class="count">'.$vote_count.'</span></p>';
	$output .= '<p class="rate-prompt">Rate this article</p>';
	$output .= '</div>';
	
	return $output;
}

// -------------------------------------
// Replace default search input with html5
// -------------------------------------
function html5_search_form( $form ) {
    $form = '<form role="search" method="get" id="searchform" class="searchform" action="' . home_url( '/' ) . '" >
    <input type="search" placeholder="'.__("What are you searching for...").'" value="' . get_search_query() . '" name="s" id="s" />
    <input type="submit" id="searchsubmit" value="Search" />
    </form>';

    return $form;
}
add_filter( 'get_search_form', 'html5_search_form' );

// -------------------------------------
// Only include posts from search results
// -------------------------------------
if ( !is_admin() ) {
	function SearchFilter($query) {
		if ($query->is_search) {
			$query->set('post_type', 'post');
		}
		return $query;
	}
	add_filter('pre_get_posts','SearchFilter');
}


// -------------------------------------
// Useful shortcodes
// -------------------------------------
// [template_url]
add_shortcode('template_url', 'template_shortcode');

function template_shortcode() {
	return get_bloginfo('template_url');
}

// [url]
add_shortcode('url', 'blogpath_shortcode');

function blogpath_shortcode() {
	return get_bloginfo('url');
}

// [youtube id="{video_id}"]
add_shortcode('youtube', 'youtube_shortcode');

function youtube_shortcode($atts) {
	extract( shortcode_atts( array(
		'id' => false,
		'width' => 560,
		'height' => 315,
		'ratio' => '16x9',
		'align' => 'none'
	), $atts ) );
	
	if ( $id ) 
		return '<div class="video-container align-'. $align .'">' . 
			'<div class="video video-youtube ratio-'.$ratio.'">' .
				'<iframe width="' . $width . '" height="' . $height . '" src="//www.youtube.com/embed/' . $id . '" frameborder="0" allowfullscreen></iframe>' .
			'</div>' .
		'</div>';
}

// [soundcloud id="{video_id}"]
add_shortcode('soundcloud', 'soundcloud_shortcode');

function soundcloud_shortcode($atts) {
	extract( shortcode_atts( array(
		'url' => false,
		'params' => 'color=a61e24&amp;auto_play=false&amp;hide_related=true&amp;show_artwork=false',
		'width' => '100%',
		'height' => 115,
		'iframe' => true,
		'align' => 'none'
	), $atts ) );
	
	$url = urlencode( $url );
	
	if ( $url ) 
		return '<div class="audio-container align-'. $align .'">' . 
			'<div class="audio audio-soundcloud">' .
				'<iframe width="' . $width . '" height="' . $height . '" src="https://w.soundcloud.com/player/?url=' . $url . '&amp;' . $params . '" scrolling="no" frameborder="no"></iframe>' .
			'</div>' .
		'</div>';
}

// [banner group="{group_slug}"]
add_shortcode('banner', 'banner_shortcode');

function banner_shortcode($atts) {
	extract( shortcode_atts( array(
		'group' => -1,
		'limit' => 1,
		'size' => 'mpu',
		'align' => 'left'
	), $atts ) );
	
	return '<div class="ad-unit '.$size.' align-'.$align.'">' . 
		do_shortcode('[dfads params="groups='.$group.'&limit='.$limit.'&callback_function=customBannerOutput"]') . 
	'</div>';
}

// -------------------------------------
// Extend page break links to include next/prev buttons
// -------------------------------------
require_once('parts/page-links-output.php');

// -------------------------------------
// Customise avatar output
// -------------------------------------
require_once('parts/avatar-output.php');

// -------------------------------------
// Strip inline styles from the content
// -------------------------------------
add_filter( 'the_content', 'the_content_filter', 20 );

function the_content_filter( $content ) {
	return preg_replace('/style=\"[^\"]*/', '', $content);
}

// -------------------------------------
// Remove canonical redirects
// -------------------------------------
add_filter('redirect_canonical','pif_disable_redirect_canonical');

function pif_disable_redirect_canonical($redirect_url) {
	if (is_singular()) $redirect_url = false;
	return $redirect_url;
}

if(!function_exists('custom_post_type')){

	function custom_post_type(){
		register_post_type('publications', array(
			'label' => 'Publications',
			'public' => true,
			'show_ui' => true,
			'capability_type' => 'Post',
			'hierarchical' => false,
			'rewrite' => array('slug' => ''),
			'query_var' => true,
			'supports' => array(
				'title',
				'thumbnail',)

		));
		flush_rewrite_rules();
	}
add_action('init', 'custom_post_type');
}

?>