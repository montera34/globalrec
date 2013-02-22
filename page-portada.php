<?php
 /* Template Name: Portada Poqito */
get_header();
?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>


<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
	 <h3 style="display:none;"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h3>

	<div class="storycontent-wide">
		<?php the_content(__('(more...)')); ?>
	</div>
	<div class="meta">
	<?php edit_post_link(__('Edit This')); ?></div>

	<!--div class="feedback">
		<?php wp_link_pages(); ?>
		<?php comments_popup_link(__('Comments (0)'), __('Comments (1)'), __('Comments (%)')); ?>
	</div-->

</div>

<!--?php comments_template(); // Get wp-comments.php template ?-->

<?php endwhile; else: ?>
<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
<?php endif; ?>

<?php posts_nav_link(' &#8212; ', __('&laquo; Newer Posts'), __('Older Posts &raquo;')); ?>

<?php get_footer(); ?>
