<?php

add_filter( 'post_gallery', 'my_post_gallery', 10, 2 );
function my_post_gallery( $output, $attr) {
    global $post, $wp_locale;

    static $instance = 0;

    // We're trusting author input, so let's at least make sure it looks like a valid orderby statement
    if ( isset( $attr['orderby'] ) ) {
        $attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
        if ( !$attr['orderby'] )
            unset( $attr['orderby'] );
    }

    extract(shortcode_atts(array(
        'order'      => 'ASC',
        'orderby'    => 'menu_order ID',
        'id'         => $post->ID,
        'containertag' => 'ul',
        'itemtag'    => 'li',
        'icontag'    => 'figure',
        'captiontag' => 'figcaption',
        'columns'    => 3,
        'size'       => 'thumbnail',
        'include'    => '',
        'exclude'    => ''
    ), $attr));

    $id = intval($id);
    if ( 'RAND' == $order )
        $orderby = 'none';

    if ( !empty($include) ) {
        $include = preg_replace( '/[^0-9,]+/', '', $include );
        $_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

        $attachments = array();
        foreach ( $_attachments as $key => $val ) {
            $attachments[$val->ID] = $_attachments[$key];
        }
    } elseif ( !empty($exclude) ) {
        $exclude = preg_replace( '/[^0-9,]+/', '', $exclude );
        $attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
    } else {
        $attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
    }

    if ( empty($attachments) ) 
        return '';

    if ( is_feed() ) {
        $output = "\n";
        foreach ( $attachments as $att_id => $attachment ) {
            $output .= wp_get_attachment_link($att_id, $size, true) . "\n";
        }
        return $output;
    }

    $itemtag = tag_escape($itemtag);
    $captiontag = tag_escape($captiontag);
    $columns = intval($columns);
    $itemwidth = $columns > 0 ? floor(100/$columns) : 100;
    $float = is_rtl() ? 'right' : 'left';

    $selector = "gallery-{$instance}";
        
    $output = '<div id="' . $selector . '" class="gallery slimline galleryid-' . $id . '">';
    $output .= '<' . $containertag . ' class="gallery-items">';

    $i = 0;
    foreach ( $attachments as $id => $attachment ) {
        // $link = isset($attr['link']) && 'file' == $attr['link'] ? wp_get_attachment_link($id, $size, false, false) : wp_get_attachment_link($id, $size, true, false);
        $small = wp_get_attachment_image_src($id, 'small');
        $medium = wp_get_attachment_image_src($id, 'medium');
        $large = wp_get_attachment_image_src($id, 'large');
        $full = wp_get_attachment_image_src($id, 'full');

        $alt = get_post_meta($id, '_wp_attachment_image_alt', true);
        $title = get_the_title($id);

        $output .= '<' . $itemtag . ' class="gallery-item">';
        $output .= '<' . $icontag . ' class="gallery-icon">';
        $output .= '<a class="colorbox" href="' . $full[0]  . '">';
        $output .= '<picture>';
        $output .= '<!--[if IE 9]><video style="display: none;"><![endif]-->';
        $output .= '<source srcset="' . $large[0] . '" media="(min-width:1023px)">';
        $output .= '<source srcset="' . $medium[0] . '" media="(min-width:767px)">';
        $output .= '<source srcset="' . $small[0] . '">';
        $output .= '<!--[if IE 9]></video><![endif]-->';
        $output .= '<img class="responsive-img" srcset="' . $small[0] . '" alt="' . $alt . '" title="' . $title . '" />';
        $output .= '</picture>';
        $output .= '</a>';
        $output .= '</' . $icontag . '>';
        
        if ( $captiontag && trim($attachment->post_excerpt) ) {
            $output .= '<' . $captiontag . ' class="gallery-caption-holder"><div class="gallery-caption">' . wptexturize($attachment->post_excerpt) . '</div></' . $captiontag . '>';
        }
        $output .= '</' . $itemtag . '>';
    }

    $output .= '</' . $containertag . '>';

    // Thumbnail nav
    $output .= '<nav class="thumbnail-nav-holder">';
    $output .= '<ul class="thumbnail-nav" data-gallery="' . $instance . '">';
    foreach ( $attachments as $id => $attachment ) {
        $thumbnail = wp_get_attachment_image_src($id, 'thumbnail');
        $full = wp_get_attachment_image_src($id, 'full');

        $alt = get_post_meta($id, '_wp_attachment_image_alt', true);
        $title = get_the_title($id);
        
        $output .= '<li class="thumbnail">';
        $output .= '<a class="thumbnail-link" href="' . $full[0]  . '">';
        $output .= '<img class="thumbnail-image" src="' . $thumbnail[0] . '" alt="' . $alt . '" title="' . $title . '">';
        $output .= '</a>';
        $output .= '</li>';
    }
    $output .= '</ul>';
    $output .= '</nav>';
    $output .= '</div> <!-- END Gallery -->';

    $instance++;

    return $output;
}

?>