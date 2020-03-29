<?php header("HTTP/1.1 404 Not Found"); ?>
<?php get_header() ?>
<article id="post-<?php the_ID(); ?>">
	<div class="row">
		<h2 id="post-<?php the_ID(); ?>" class="col-md-10">
			error 404: <?php _e('Nothing Found', 'globalrec') ?>
		</h2>
	</div>
	<div class="row">
		<div class="col-md-8 content">
			<p><?php _e('Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'globalrec') ?></p>
			<?php get_search_form(); ?>
		</div>
	</div>
</article>
<?php get_footer() ?>
