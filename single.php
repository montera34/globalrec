<?php get_header(); ?>

<div class="container">
	<div class="row-fluid">
	<?php get_sidebar(); ?>
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div <?php post_class('span9') ?> id="post-<?php the_ID(); ?>">
			<?php the_post_thumbnail( 'medium' ); ?>
			<h3 class=""><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a><?php edit_post_link(); ?></h3>			
			<div class="postmetadata"><small>
				<?php the_time('F d, Y') ?> &nbsp;&nbsp;
				In category <?php the_category(', ') ?>&nbsp;&nbsp;
				by <?php the_author_posts_link(); ?>&nbsp;&nbsp;
				<?php if (get_the_term_list( $post->ID, 'post-region', '', ', ', '' ) != '')  : 
				echo "Region ";	
				echo get_the_term_list( $post->ID, 'post-region', '', ', ', '' ); 
				endif;
			 	?> 						
			</small></div>
		<div class="">
		<?php include("share.php")?>
		</div>
		<hr>
		<?php the_content(__('(more...)')); ?>
		<div class="postmetadata">
		<?php if(function_exists('pf_show_link')){echo pf_show_link();} ?>  &nbsp;&nbsp;| <?php the_tags( ); ?> 
		</div>
		<div class="feedback">
			<?php wp_link_pages(); ?>
			<?php comments_popup_link(__('Comments (0)'), __('Comments (1)'), __('Comments (%)')); ?>
		</div>
	

	<?php comments_template(); // Get wp-comments.php template ?>

	<?php endwhile; else: ?>
	<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
	<?php endif; ?>

	<?php posts_nav_link(' &#8212; ', __('&laquo; Newer Posts'), __('Older Posts &raquo;')); ?>
	</div>
	<?php get_footer(); ?>
	
</div>
