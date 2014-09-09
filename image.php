<?php get_header(); ?>
<div class="container">
	<article id="post-<?php the_ID(); ?>">
		<div class="row">
			<div class="col-md-12">
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<h3>
					<a href="<?php echo get_permalink($post->post_parent); ?>" rev="attachment" title="<?php echo _e('Back to','globalrec').' '.get_the_title($post->post_parent) ?>" alt="<?php echo get_the_title($post->post_parent); ?>">
					&laquo; <?php echo _e("Back to","globalrec").' "'.get_the_title($post->post_parent).'"' ?>
					</a>
				</h3>
				<div class="row">
					<div class="col-md-1 btn btn-default pull-left"><?php previous_image_link( false, '&laquo; Prev' ); ?></div>
					<div class="col-md-10">
						<?php
						$imageurl = wp_get_attachment_image_src( $post->ID, 'large');
						$imageurlfull = wp_get_attachment_image_src( $post->ID, 'full');
						echo "<a href='".$imageurlfull[0]."'><img src='".$imageurl[0]."' class='img-responsive'></a>"; ?>
						<?php the_title(); ?>
					</div>
					<div class="col-md-1 btn btn-default pull-right"><?php next_image_link( false, 'Next &raquo;' ); ?> </div>
				</div>
		</div>
	</article>
	<?php endwhile; else: ?>
	<p><?php echo _e('No content.','globalrec') ?></p>
	<?php endif; ?>
</div>
<?php get_footer(); ?>
