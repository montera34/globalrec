<?php get_header();
$categories = get_the_category();
$separator = ' ';
$output = '';
$output2 = ''; ?>

<div class="container">
	<div class="row">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div <?php post_class('col-md-8') ?> id="post-<?php the_ID(); ?>">
			<div class="row">
			<?php
				if($categories){
					foreach($categories as $category) {
						$output .= '<a href="'.get_category_link( $category->term_id ).'" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) . '" class="label pull-right" style="margin-right:5px">'.$category->cat_name.' </a> '.$separator;
					}
				echo trim($output, $separator);
				}
			?>
			</div>
			<div class="row">
				<div class="col-md-12">
				<?php if ( is_user_logged_in() ) { echo '<div class="btn btn-sm btn-default pull-right">'; edit_post_link(__('Edit This')); echo "</div>";} ?>
				<h3>
					<a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a>
				</h3>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<h4>
						<?php 
							$written_by = get_post_meta( $post->ID, '_gr_written-by', true ); 
						 	if ($written_by != '')  { //if the text is written by a journalist the field "written" by will be filled
								echo "<small>submitted by ";
								the_author_posts_link();
								echo "</small><br><small>written by </small>";	
								echo $written_by;
							}
							else {
								echo "<small>by </small>";
								the_author_posts_link();
							}
					 	?> 
					</h4>
				</div>
				<div class="col-md-4">
					<?php 
						$region = get_the_term_list( $post->ID, 'post-region', '', ', ', '' );
						if ( $region != '')  : 
						echo "<h4><small>Region </small>";	
						echo get_the_term_list( $post->ID, 'post-region', '', ', ', '' ); 
						echo "</h4>";
						endif;
					 	?>
				</div>
				<div class="col-md-4"> 	
					<h4><small class="pull-right">
						<?php the_time('F d, Y') ?>					
					</small></h4>
				</div>
			</div>
			
		 	<hr style="margin:3px 0 3px 0;">

			<div class="row">
				<div class="col-md-offset-6 col-md-3"><?php _e('Check translation','globalrec'); ?>:</div>
				<div class="col-md-2 ontop"><?php do_action('icl_language_selector'); ?></div>
			</div>

			<div id="post-content">
				<?php 
				$article_url = get_post_meta( $post->ID, '_gr_article-url', true );
				$article_title = get_post_meta( $post->ID, '_gr_article-title', true );
				$article_published_in = get_post_meta( $post->ID, '_gr_published-in', true );
				if ($article_url != '') {
						echo "<div class='row'><div class='col-md-12'><a href='".$article_url."'>".$article_title."</a><br>";
						echo $written_by. ". ";
						if ($article_published_in != '') {
							echo $article_published_in. ". ";	
						}
						echo get_post_meta( $post->ID, '_gr_article-date', true );
						echo "</div></div>";	
					}
				the_content(__('(more...)')); ?>
			</div>

			<?php include("share.php")?>

			<div class="post-metadata">
				<?php if(function_exists('pf_show_link')){echo pf_show_link();} ?> | 
				<?php
					if($categories){
						foreach($categories as $category) {
							$output2 .= '<a href="'.get_category_link( $category->term_id ).'" title="' 
							. esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) 
							. '" class="label">'.$category->cat_name.'</a>'.$separator;
						}
					echo trim($output2, $separator);
					} 
					?> | 
				<?php the_tags( ); ?>
			</div>
			<div class="feedback">
				<?php wp_link_pages(); ?>
				<?php comments_popup_link(__(' '), __('Comments (1)'), __('Comments (%)')); ?>
			</div>
		<?php comments_template(); // Get wp-comments.php template ?>

		<?php endwhile; else: ?>
		<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
		<?php endif; ?>
	
		<?php posts_nav_link(' &#8212; ', __('&laquo; Newer Posts'), __('Older Posts &raquo;')); ?>
		</div>
		<!-- begin sidebar -->
		<div id="menu" class="col-md-offset-1 col-md-3">
			<?php  dynamic_sidebar( 'blog-sidebar' ) ?>
		</div>
		<!-- end sidebar -->
	</div>
	<?php get_footer(); ?>
</div>
