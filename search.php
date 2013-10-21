<?php get_header(); ?>
<div>
	<div class="row">
		<div class="row">
			<div class="col-md-6"><h2>Search results: <?php the_search_query(); ?></h2></div>
			<div class="col-md-6">Keep searching: <?php get_search_form(); ?></div>
			<br>
		</div>
		<ul class="">	
			<?php if (have_posts() ) : 
			$count = 0;
			while (have_posts()) : the_post(); 
			$count++;
			if ( $count == 1 ) { echo "<div class='row-fluid'>"; }
			?>
			<li id="post-<?php the_ID(); ?>" <?php post_class('col-md-3'); ?>	>
				<?php include("loop.boxes.php")?>
			</li>
			<?php if ( $count == 4 ) { echo "</div><!-- .row --><hr>"; $count = 0; }?>

			<?php endwhile; else: ?>
			<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
			<?php endif; ?>
		</ul>
	</div>
</div> 
<?php get_footer(); ?>
