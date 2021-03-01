<?php

/*
 * Adds classes to media images
 */
function globalrec_image_classes($class) {
    $class .= ' img-responsive';
    return $class;
}
add_filter('get_image_tag_class', 'globalrec_image_classes' );


/*
 * Responsive embeds
 * 
 * to make this works it is necessary to add some styles to the CSS
 *
 */
function globalrec_oembed_html( $cached_html ) {
	$cached_html = '<div class="iframe-container">' . $cached_html . '</div>';
	return $cached_html;
}
add_filter( 'embed_oembed_html', 'globalrec_oembed_html', 99 );

?>
