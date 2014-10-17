<?php  /* Template Name: Page blog*/ get_header(); ?>

<div class="row">
	<div id="blog" class="col-md-9">	
		<header class="row">
			<div class="pull-right"><?php do_action('icl_language_selector'); ?></div>
			<h2 id="post-<?php the_ID(); ?>" class="col-md-6">
				<?php the_title();?>	
			</h2>		
		</header>
		<?php
		global $more;    // Declare global $more (before the loop). "para que seguir leyendo funcione"
			//mirar codigo madre en http://www.hashbangcode.com/blog/create-page-posts-wordpress-417.html
			$args = array(
				'ignore_sticky_posts' => 1,
				'posts_per_page'=>	15
				);
			if ( $paged > 1 ) {
			 $args['paged'] = $paged;
				}
			$wp_query = new WP_Query($args);
			$wp_count = $wp_query->post_count; //The number of posts being displayed
			?>

		<?php if ($wp_query->have_posts() ) :
		$count = 0;
		while ( $wp_query->have_posts()) : $wp_query->the_post();
		$count++;
		if ( $count == 1 || $count % 3 == 1) { echo "<div class='row'>"; }
		?>
		<article id="post-<?php the_ID(); ?>" <?php post_class('col-md-4'); ?> >
			<?php include("loop.boxes.php")?>
		</article>
		<?php if ( $count % 3 == 0 || $count == $wp_count){ echo "</div><!-- .row --><hr>";} ?>

		<?php endwhile; else: ?>
		<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
		<?php endif; ?>
		<div class="row">
			<div class="col-md-12">
				<div class="pull-right">
					<?php echo custom_pagination(); ?>
				</div>
			</div>
		</div>
	</div>
	<aside class="col-md-3">
		<?php  dynamic_sidebar( 'blog-sidebar' ) ?>
	</aside>
</div>
<?php get_footer(); ?>
