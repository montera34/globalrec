<?php
// include config vars
include_once("gforms-vars.php");

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
// update
add_action( 'gform_after_submission_'.$f_wpg_submit, 'globalrec_gform_update_wpg_taxs', 10, 2);


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
		foreach ( $ts as $t ) {
			if ( is_object_in_term( $u_id, $tx, $t->term_id ) )
				$choices[] = array( 'text' => $t->name, 'value' => $t->slug, 'isSelected' => true);
			else
				$choices[] = array( 'text' => $t->name, 'value' => $t->slug, 'isSelected' => false );
		}
 
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

?>
