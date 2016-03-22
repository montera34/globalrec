<?php get_header(); ?>
<div id="search">
	<div class="row">
		<div class="col-md-8">
			<h2>
				<?php _e("Search results","globalrec") ?>: "<?php the_search_query(); ?>"
				</h2>
		</div>
		<div class="col-md-4">
			<?php // _e("Keep searching","globalrec") ?>
			 <?php get_search_form(); ?>
		</div>
	</div>
		<?php if (have_posts() ) :
		$count = 0;
		while (have_posts()) : the_post();
		$count++;
	if ( $count == 1 ) { echo "<div class='row'>"; }
		?>
		<div id="post-<?php the_ID(); ?>" <?php post_class('col-md-3'); ?>	>
			<?php include("loop.boxes.php")?>
		</div>
	<?php if ( $count == 4 ) { echo "</div><!-- .row --><hr>"; $count = 0; }?>

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
<?php get_footer(); ?>
