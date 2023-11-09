<?php

/**
 *
 * Adds classes to media images
 *
 */
function globalrec_image_classes($class) {
    $class .= ' img-responsive';
    return $class;
}
add_filter('get_image_tag_class', 'globalrec_image_classes' );


/**
 *
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

/**
 *
 *  the_archive_title()
 *
 */  
function globalrec_archive_title( $title ) {

	if ( is_post_type_archive() ) {
		$title = post_type_archive_title('',false);
	}
	elseif ( is_tax() ) {
		$tx = get_queried_object()->taxonomy;
		$tax = get_taxonomy( $tx );
		$title = single_term_title( '', false );
	}

	return $title;
}
add_filter( 'get_the_archive_title', 'globalrec_archive_title' );

/**
 *
 * Modify loops
 *
 */
function globalrec_loops( $query ) {

	if ( is_admin() )
		return $query;

	if ( ! $query->is_main_query() )
		return $query;
	
	if ( is_post_type_archive('document') ) {
		$query->set ( 'meta_key', '_dc_year');
		$query->set( 'orderby', array(
			'_dc_year' => 'DESC',
			'post_date' => 'DESC'
		));
}
	return $query;
}
add_action( 'pre_get_posts', 'globalrec_loops' );
?>
