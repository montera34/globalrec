<?php  /* Template Name: Page Waste Picker Groups*/ 
get_header(); ?>

<div class="container">
	<div class="row-fluid">
	<?php if (have_posts()) : while (have_posts()) : the_post();?>
		<h2 id="post-<?php the_ID(); ?>" class="span10">
			<?php the_title();?>
		</h2>
		<div class="pull-right"><?php do_action('icl_language_selector'); ?></div>
	</div>		
	<div class="row-fluid">	
		<?php the_content(); ?>	
		<?php endwhile; endif; ?>
		<?php	global $more;    // Declare global $more (before the loop). "para que seguir leyendo funcione"
			//mirar codigo madre en http://www.hashbangcode.com/blog/create-page-posts-wordpress-417.html
			$args = array(
			 'caller_get_posts' => 1,
			 'post_type' => 'waste-picker-group', 
			 'posts_per_page' => 35, 
			 'post_parent' => 0
				);
			if ( $paged > 1 ) {
			 $args['paged'] = $paged;
				}
 
			$my_query = new WP_Query($args);
			?>
</div><!-- #content -->
<?php get_footer(); ?>
