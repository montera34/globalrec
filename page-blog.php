<?php  /* Template Name: Page blog*/ 
get_header(); ?>

<div class="container">
<?php get_sidebar(); ?>
	<div id="blog">	
	<ul class="thumbnails">	
		<?php
		global $more;    // Declare global $more (before the loop). "para que seguir leyendo funcione"
			//mirar codigo madre en http://www.hashbangcode.com/blog/create-page-posts-wordpress-417.html
			$args = array(
			 'caller_get_posts' => 1
				);
			if ( $paged > 1 ) {
			 $args['paged'] = $paged;
				}

			$my_query = new WP_Query($args);
			?>

		<?php if ($my_query->have_posts() ) : 
		$count = 0;
		while ( $my_query->have_posts()) : $my_query->the_post(); 
		$count++;
		if ( $count == 1 ) { echo "<div class='row'>"; }
		?>
		<?php include("loop.boxes.php")?>

		<?php if ( $count == 2 ) { echo "</div><!-- .row -->"; $count = 0; }?>

		<?php endwhile; else: ?>
		<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
		<?php endif; ?>
	</ul>
	<div class="navigation">
  			<div class="alignleft"><?php 
				if ( !$max_page ) {
 					 $max_page = $my_query->max_num_pages;
					}
 
				if ( !$paged ) {
 					 $paged = 1;
					}
					$nextpage = intval($paged) + 1;
 
				if ( !is_single() && ( empty($paged) || $nextpage <= $max_page) ) {
  					$attr = apply_filters( 'next_posts_link_attributes', '' );
 					 echo '<a href="' . next_posts( $max_page, false ) . "\" $attr>". preg_replace('/&([^#])(?![a-z]{1,8};)/', '&$1', ' &laquo; Previous posts') .'</a>';
					}
					?></div>
  					<div class="alignright"><?php 
					if ( !is_single() && $paged > 1 ) {
  				$attr = apply_filters( 'previous_posts_link_attributes', '' );
  				echo '<a href="' . previous_posts( false ) . "\" $attr>". preg_replace( '/&([^#])(?![a-z]{1,8};)/', '&$1', 'Newer posts &raquo;' ) .'</a>';
					}
				?></div>
				</div>
	</div><!-- #blog -->
</div>	<!-- #main -->
</div><!-- #content -->
<?php get_footer(); ?>
