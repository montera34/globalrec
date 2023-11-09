<?php get_header();

// document fields
$dc_fs_out = '';
$dc = pods('document',$post->ID);
$dc_y = $dc->display('_dc_year');
$dc_y_out = ( !empty($dc_y) ) ? '<small>'.__('Publication year: ','globalrec').$dc_y.'</small>' : '';
$dc_f = $dc->field('_dc_file');
$dc_f_out = '';
if ( !empty($dc_f) ) {
	$f_perma = $dc->display('_dc_file');
	$f_size = size_format( filesize( get_attached_file( $dc_f['ID'] ) ) );
	$f_mime = $dc_f['post_mime_type'];
	if ( strpos( $f_mime, 'pdf' ) !== false ) {
		$dc_f_l = __('Download: ','globalrec').'<span class="dashicons dashicons-pdf"></span> ('.$f_size.')';
	}
	elseif ( strpos( $f_mime, 'image' ) !== false ) {
		$dc_f_l = __('Download: ','globalrec').'<span class="dashicons dashicons-format-image"></span> ('.$f_size.')';
	}
	else {
		$dc_f_l = __('Download file','globalrec').' ('.$f_size.')';
	}
	$dc_f_out = '<div><small><a href="'.$f_perma.'">'.$dc_f_l.'</a></small></div>';
}
$dc_fs_out = '
<div class="dc-meta">'.
	$dc_y_out.$dc_f_out
.'</div>
';
?>

<div class="container">
	<div class="row">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div <?php post_class("col-md-8 content") ?> id="post-<?php the_ID(); ?>">
			<ul class="breadcrumb">
			  <li><a href="/documents"><?php _e('Documents','globalrec'); ?></a></li>
			  <li><?php the_title(); ?> </li>
			</ul>
			<h3>
				<a href="<?php the_permalink() ?>" rel="bookmark">
					<?php the_title(); ?>
				</a>
			</h3>
			<?php echo $dc_fs_out; ?>
			<hr>
			<?php the_content(__('(more...)')); ?>		
		</div>
		<div class="col-md-4"> 
			<?php the_post_thumbnail( 'medium' ); ?>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12"> 
		<?php include("share.php")?>
		<div >
			<?php if(function_exists('pf_show_link')){echo pf_show_link();} ?> <?php //the_tags( ); ?> 
		</div>

		<?php //comments_template(); // Get wp-comments.php template TODO: avoid templates from the related posts ?>

		</div>
		<?php endwhile; else: ?>
		<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
		<?php endif; ?>
 		</div>
	</div>	
		
	
	<?php get_footer(); ?>
</div><!-- #container -->
