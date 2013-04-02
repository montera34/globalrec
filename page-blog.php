<?php  /* Template Name: Page blog*/ 
get_header(); ?>

<div class="container">
	<div class="row-fluid">
		<div class="span3">
			<?php get_sidebar(); ?>
		</div>
		<div id="blog" class="span9">	
			<ul class="thumbnails">	
			<?php
			global $more;    // Declare global $more (before the loop). "para que seguir leyendo funcione"
				//mirar codigo madre en http://www.hashbangcode.com/blog/create-page-posts-wordpress-417.html
				$args = array(
				 'caller_get_posts' => 1,
				'posts_per_page'=>	12
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
			if ( $count == 1 ) { echo "<div class='row-fluid'>"; }
			?>
				<?php include("loop.boxes.php")?>

			<?php if ( $count == 3 ) { echo "</div><!-- .row --><hr>"; $count = 0; }?>

			<?php endwhile; else: ?>
			<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
			<?php endif; ?>
			</ul>
		</div>
		<div class="row-fluid">
  			<div class="span12">
				<?php posts_nav_link(); ?>
			</div>
		</div>
	<?php get_footer(); ?>
</div>

