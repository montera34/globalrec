<?php get_header(); ?>
<div id="page">
	<div class="container">
		<div class="row-fluid">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<a href="<?php echo get_permalink($post->post_parent); ?>" rev="attachment" title="back to a <?php echo get_the_title($post->post_parent) ?>" alt="volver a <?php echo get_the_title($post->post_parent) ?>">&laquo; Back to <?php echo get_the_title($post->post_parent) ?></a>
			<div class="span8">
				<div class="btn pull-left"><?php previous_image_link( false, '&laquo; Prev' ); ?></div>
				<div class="nav-image-up"></div>
				<div class="btn pull-right"><?php next_image_link( false, 'Next &raquo;' ); ?> </div>
			</div>

			<?php $attachment_link = get_the_attachment_link($post->ID, true, array(950, 800)); // This also populates the iconsize for the next line ?>
			<!--<h3><?php the_excerpt(); ?></h3>-->	

			<?php $_post = &get_post($post->ID); $classname = ($_post->iconsize[0] <= 128 ? 'small' : '') . 'attachment'; // This lets us style narrow icons specially ?>

			<div class="span8" id="post-<?php the_ID(); ?>">

				<p class="<?php echo $classname; ?>"><?php echo $attachment_link; ?><br /></p>
				<?php the_title(); ?>
				<?php the_content('<p class="serif">Read the rest of this entry &raquo;</p>'); ?>

				<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
				<div class="clear"></div>
				<p class="postmetadata alt quiet">
					<small>
						<!--Posted on <?php the_time('l, F jS, Y') ?> at <?php the_time() ?>
						and is filed under <?php the_taxonomies(); ?>.
						Subscribe to comments via <?php post_comments_feed_link('RSS 2.0'); ?>.

						<?php if (('open' == $post-> comment_status) && ('open' == $post->ping_status)) {
							// Both Comments and Pings are open ?>-->
							You can <a href="#respond">leave a response</a>, or <a href="<?php trackback_url(); ?>" rel="trackback">trackback</a> from your own site.

						<?php } elseif (!('open' == $post-> comment_status) && ('open' == $post->ping_status)) {
							// Only Pings are Open ?>
							Comments are currently closed, but you can <a href="<?php trackback_url(); ?> " rel="trackback">trackback</a> from your own site.

						<?php } elseif (('open' == $post-> comment_status) && !('open' == $post->ping_status)) {
							// Comments are open, Pings are not ?>
							Post a comment. Pinging is currently not allowed.

						<?php } elseif (!('open' == $post-> comment_status) && !('open' == $post->ping_status)) {
							// Neither Comments, nor Pings are open ?>
							Both comments and pings are currently closed.

						<?php } edit_post_link('Edit this entry.','',''); ?>

					</small>
				</p>
			</div>
		</div>
		<div class="row-fluid">
		<?php comments_template(); ?>
		</div>
		<?php endwhile; else: ?>

		<p>Sorry, nothing came through.</p>

		<?php endif; ?>
	</div> 
</div> 

<?php get_footer(); ?>
