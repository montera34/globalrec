<?php
// include config vars
include_once("gforms-vars.php");

// REGISTER QUERY VARS
add_filter( 'query_vars', 'globalrec_add_query_vars' );
function globalrec_add_query_vars( $vars ) {
	$vars[] = "action";
	$vars[] = "horror";
	return $vars;
}

// GET FEEDBACK MESSAGE
function globalrec_get_alert($msg,$btns,$class) {
	return '
		<div class="alert alert-'.$class.' alert-dismissible text-center" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<p><strong>'.$msg.'</strong></p>
			<p>'.$btns.'</p>
		</div>
	';
}

// ADD CLASSES TO FORM ELEMENTS
add_filter( 'gform_pre_render', 'globalrec_gform_fields_classes' );
function globalrec_gform_fields_classes( $form ) {

	foreach ( $form['fields'] as &$f )
		$f->cssClass = 'form-group '. $f->cssClass;

	return $form;

}

// ADD CLASSES TO SUBMIT BUTTON
# https://docs.gravityforms.com/gform_submit_button/#5-append-custom-css-classes-to-the-button
# https://stackoverflow.com/questions/8218230/php-domdocument-loadhtml-not-encoding-utf-8-correctly
add_filter( 'gform_submit_button', 'alisal_submit_button_classes', 10, 2 );
function alisal_submit_button_classes( $button, $form ) {

	$dom = new DOMDocument();
	$dom->loadHTML('<?xml encoding="utf-8" ?>' . $button);
	$input = $dom->getElementsByTagName( 'input' )->item(0);
	$classes = $input->getAttribute( 'class' );
	$classes .= " btn btn-default";
	$input->setAttribute( 'class', $classes );

	return $dom->saveHtml( $input );

}

// FORMS ACTIONS
//
// SUBMIT WPG
// populate
add_filter( 'gform_pre_render_'.$f_wpg_submit, 'globalrec_gform_populate_wpg_taxs' );
add_filter( 'gform_pre_validation_'.$f_wpg_submit, 'globalrec_gform_populate_wpg_taxs' );
add_filter( 'gform_pre_submission_filter_'.$f_wpg_submit, 'globalrec_gform_populate_wpg_taxs' );
add_filter( 'gform_pre_render_'.$f_wpg_submit, 'globalrec_gform_populate_cpt' );
add_filter( 'gform_pre_validation_'.$f_wpg_submit, 'globalrec_gform_populate_cpt' );
add_filter( 'gform_pre_submission_filter_'.$f_wpg_submit, 'globalrec_gform_populate_cpt' );
// update
add_action( 'gform_after_submission_'.$f_wpg_submit, 'globalrec_gform_insert_wpg_post', 10, 2);


// POPULATE DROPDOWN W/ WPG TAX TERMS
function globalrec_gform_populate_wpg_taxs( $form ) {
 
	global $tx_wpg_lang, $tx_wpg_member, $tx_wpg_scope;

	foreach ( $form['fields'] as &$f ) {
 		if ( $f->inputName != $tx_wpg_lang && $f->inputName != $tx_wpg_member && $f->inputName != $tx_wpg_scope )
	    		continue;

		$tx = $f->inputName;

		$args = array(
			'taxonomy' => $tx,
			'hide_empty' => false,
			'orderby' => 'name',
			'order' => 'ASC'
		);
		$ts = get_terms($args);

		$choices = array();
		foreach ( $ts as $t )
			$choices[] = array( 'text' => $t->name, 'value' => $t->slug, 'isSelected' => false );
 
		$f->placeholder = ' ';
		$f->choices = $choices;

	}

	return $form;

}

// POPULATE DROPDOWN W/ PT POSTS
function globalrec_gform_populate_cpt( $form ) {
 
	global $pt_country, $pt_city;

	foreach ( $form['fields'] as &$f ) {
 		if ( $f->inputName != $pt_country && $f->inputName != $pt_city )
	    		continue;

		$pt = $f->inputName;

		$args = array(
			'suppress_filters' => false, // to get just posts in current lang, not all of them
			'post_type' => $pt,
			'nopaging' => true,
			'orderby' => 'name',
			'order' => 'ASC'
		);
		$ps = get_posts($args);

		$choices = array();
		foreach ( $ps as $p )
			$choices[] = array( 'text' => $p->post_title, 'value' => $p->ID, 'isSelected' => false );
 
		$f->placeholder = ' ';
		$f->choices = $choices;

	}

	return $form;

}

// UPDATE WPG TAXS TERMS
// https://docs.gravityforms.com/gform_after_submission/#1-update-post
function globalrec_gform_update_wpg_taxs($entry, $form) {

	global $pt_wpg, $tx_wpg_lang, $tx_wpg_member, $tx_wpg_scope;

	foreach ( $form['fields'] as $f ) {
 		if ( $f->inputName != $tx_wpg_lang && $f->inputName != $tx_wpg_member && $f->inputName != $tx_wpg_scope )
	    		continue;

//		if ( $f->inputName == $tx_user_activity || $f->inputName == $tx_user_scope ) {
		$v = is_object( $f ) ? $f->get_value_export( $entry ) : '';
		$slugs = explode( ',', $v );
		$tx = $f->inputName;
//		}
//		elseif ( $f->inputName == $tx_user_activity_others || $f->inputName == $tx_user_scope_others ) {
//			$v = $entry[$f->id];
//			$slugs2 = explode( ',', $v );
//			$slugs2 = array_map('trim',$slugs2);
//		}

		/* Sets the terms (we're just using a single term) for the user. */
		wp_set_object_terms( $pt_wpg, $slugs, $tx, false);
		clean_object_term_cache( $pt_wpg, $tx );

	}
	return;
}

// CREATE WPG POST
function globalrec_gform_insert_wpg_post($entry, $form) {

	global $pt_wpg, $post,
		$tx_wpg_lang, $tx_wpg_member, $tx_wpg_scope,
		$cf_wpg_mail, $cf_wpg_phone, $cf_wpg_website, $cf_wpg_country, $cf_wpg_city;

	$fs = array(); // to store custom fields
	$slugs = array(); // to store terms

	// loop throug all form fields
	foreach ( $form['fields'] as $f ) {
		if ( $f->inputName == '' )
			continue;


		// if tax field
		if ( $f->inputName == $tx_wpg_lang || $f->inputName == $tx_wpg_member || $f->inputName == $tx_wpg_scope ) {
			$tx = $f->inputName;
			$v = is_object( $f ) ? $f->get_value_export( $entry ) : '';
			$slugs[$tx] = explode( ',', $v );
		}
		else {
			$fs[$f->inputName] = $entry[$f->id];
		}

	}

	// post insert
	$args = array(
		'post_type' => $pt_wpg,
		'post_status' => 'draft',
		'post_author' => 1, // admin user as author, because user is not logged in
		'post_title' => wp_strip_all_tags( $fs['post_title'] ),
		'post_content' => wp_strip_all_tags( $fs['post_content'] ),
	);
	foreach ( array($cf_wpg_mail, $cf_wpg_phone, $cf_wpg_website, $cf_wpg_country, $cf_wpg_city) as $cf )
		$args['meta_input'][$cf] = $fs[$cf];

	$wpg = wp_insert_post($args);

	$sep = ( $post->post_status == 'draft' ) ? '&' : '?';

	// set post terms
	if ( $wpg != 0 ) {
		foreach ( $slugs as $tx => $s ) {
			wp_set_object_terms( $wpg, $s, $tx, false);
			clean_object_term_cache( $wpg, $tx );
		}
		$target = get_permalink().$sep.'horror=submit';
	}
	else {
		$target = get_permalink().$sep.'action=submit';
	}

	ob_start();
	wp_safe_redirect( $target );
	exit;
}
?>
