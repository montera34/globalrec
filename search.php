<?php get_header();

$tit = "Search results";
?>


<div id="gallery-tit" class="row">
	<div class="container">
		<div class="row">
			<div class="span3"><h2><?php echo $tit ?></h2></div>
		</div>
	</div>
</div><!-- #gallery-tit -->
<div id="gallery-items" class="row">
	<div class="container">
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
			<li id="post-<?php the_ID(); ?>" <?php post_class('span4'); ?>	>
				<?php include("loop.boxes.php")?>
			</li>
			<?php if ( $count == 3 ) { echo "</div><!-- .row --><hr>"; $count = 0; }?>

			<?php endwhile; else: ?>
			<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
			<?php endif; ?>
		</ul>
	</div><!-- .container -->
</div><!-- #gallery-items -->
<?php get_footer(); ?>
