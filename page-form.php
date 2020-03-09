<?php
/* Template name: Form */
get_header();

// Feedback
$action = get_query_var('action');
$error = get_query_var('horror');
if( $action == '' && $error == '' ) {
	$alert = '';
}
else {
	if ( $error == 'submit' ) {
echo 'HAR';
		$alert_class = 'danger';
		$msg = __('There has been an error while submiting your organization. Sorry about that :(','globalrec');
		$btns = '<a class="btn btn-'.$alert_class.'" href="'.get_permalink().'">'.__('Try again','globalrec').'</a>';
	}
	elseif ( $action == 'submit') {
		$alert_class = 'info';
		$msg = __('Your organization has been submitted. An editor is reviewing the content and if anything is fine, it will be published soon. Thank you!','globalrec');
		$btns = '<a class="btn btn-'.$alert_class.'" href="'.get_permalink().'">'.__('Submit another organization','globalrec').'</a>';
	}
	$alert = globalrec_get_alert($msg,$btns,$alert_class);
}
?>
<div class="container">
	<?php 
	if ( have_posts() ) :
		while ( have_posts() ) : the_post(); ?>
			<article id="post-<?php the_ID(); ?>"> 
				<div class="row">
					<div class="col-md-2 pull-right"><?php do_action('icl_language_selector'); ?></div>
					<h2 id="post-<?php the_ID(); ?>" class="col-md-10">
						<?php the_title();?>	
					</h2>		
				</div>
				<div class="row">
					<div class="col-md-8 content">
						<?php echo $alert;
						if ( $action == '' && $error == '')
							the_content();
						?>
					</div>
				</div>
			</article>
		<?php endwhile;
	else :
	endif;?>
</div><!-- #page -->

<?php get_footer(); ?>
