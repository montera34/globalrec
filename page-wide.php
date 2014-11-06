<?php  /* Template Name: Page Wide*/
get_header(); ?>
<div id="page-wide">
	<?php if (have_posts()) : while (have_posts()) : the_post();?>
		<div class="row">
			<div class="pull-right"><?php do_action('icl_language_selector'); ?></div>
			<h2 id="post-<?php the_ID(); ?>" class="col-md-12">
				<?php the_title();?>
			</h2>
		</div>
		<?php the_content(); ?>
		<?php endwhile; endif; ?>
</div>
<?php get_footer(); ?>
