<?php  /* Template Name: Page blog*/ get_header(); ?>

<div class="row">
	<div id="blog" class="col-md-9">	
		<div class="row">
			<div class="pull-right"><?php do_action('icl_language_selector'); ?></div>
			<h2 id="post-<?php the_ID(); ?>" class="col-md-6">
				<?php the_title();?>	
			</h2>		
		</div>	
		<?php
		global $more;    // Declare global $more (before the loop). "para que seguir leyendo funcione"
			//mirar codigo madre en http://www.hashbangcode.com/blog/create-page-posts-wordpress-417.html
			$args = array(
				'ignore_sticky_posts' => 1,
				'posts_per_page'=>	12
				);
			if ( $paged > 1 ) {
			 $args['paged'] = $paged;
				}
			$my_query = new WP_Query($args);
			$my_count = $my_query->post_count; //The number of posts being displayed
			?>

		<?php if ($my_query->have_posts() ) : 
		$count = 0;
		while ( $my_query->have_posts()) : $my_query->the_post(); 
		$count++;
		if ( $count == 1 || $count % 3 == 1) { echo "<div class='row'>"; }
		?>
		<div id="post-<?php the_ID(); ?>" <?php post_class('col-md-4'); ?>	>
			<?php include("loop.boxes.php")?>
		</div>
		<?php if ( $count % 3 == 0 || $count == $my_count) { echo "</div><!-- .row --><hr>";}?>

		<?php endwhile; else: ?>
		<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
		<?php endif; ?>
		<div class="row">
			<div class="col-md-12">
				<div class="pull-left btn btn-large">
					<?php if ( !$max_page ) {
					 $max_page = $my_query->max_num_pages;
					}
					if ( !$paged ) {
					 $paged = 1;
					}
					$nextpage = intval($paged) + 1;
					if ( !is_single() && ( empty($paged) || $nextpage <= $max_page) ) {
						$attr = apply_filters( 'next_posts_link_attributes', '' );
					 echo '<div class="btn btn-default"><a href="' . next_posts( $max_page, false ) . "\" $attr>".  __('Older Posts &raquo;') .'</a></div>';
					}
					?>
				</div>
				<div class="pull-right btn btn-large"><?php 
					if ( !is_single() && $paged > 1 ) {
					$attr = apply_filters( 'previous_posts_link_attributes', '' );
					echo '<div class="btn btn-default"><a href="' . previous_posts( false ) . "\" $attr>".  __('&laquo; Newer Posts') .'</a></div>';
					}?>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-3">
		<?php  dynamic_sidebar( 'blog-sidebar' ) ?>
	</div>
</div>
<?php get_footer(); ?>
