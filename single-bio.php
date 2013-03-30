<?php get_header(); ?>

<div class="container">
	<div class="row-fluid">
	<?php get_sidebar(); ?>
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div class="row">
			<div <?php post_class('span9') ?> id="post-<?php the_ID(); ?>">
			<div class="row">	
				<div class="span8">
					<h3>
						<a href="/life-and-voices"> <!-- needs to be internationalized-->				
						Life and voices 
						</a> > <?php the_title(); ?>
					</h3>
				</div>
				<div class="btn btn-small pull-right"><?php edit_post_link(__('Edit This')); ?></div>
			</div>
			
			<div class="row">
				<div class="span3"><small>
					<?php the_post_thumbnail( 'thumbnail',array('class'=> "img-rounded",'alt'=> trim(strip_tags( $wp_postmeta->_wp_attachment_image_alt )),'title'	=> trim(strip_tags( $attachment->post_title ))) ); ?> <br>
					<?php if ( is_user_logged_in() ) { ?> 
						 email: <?php
							global $post;
							$text = get_post_meta( $post->ID, 'bio_email', true );
							echo $text; 	
							echo "<br>telephone:<br>";
							$text = get_post_meta( $post->ID, 'bio_telephone', true );
							echo $text; 
						}?>
					</small>
				</div> 
				<div class="span9">
				<?php the_content(__('(more...)')); ?>
				</div>
			</div>
		</div>
	</div>
	<div class="share">
		<a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php the_permalink(); ?>" data-text="<?php the_title(); ?>" data-via="global_rec" data-lang="en">Tweet</a>
		<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
		<!-- Place this tag where you want the +1 button to render -->
		<g:plusone size="small" annotation="inline" width="120"></g:plusone>
		<div class="fb-like" data-href="<?php echo get_permalink(); ?>" data-send="false" data-layout="button_count" data-width="20" data-show-faces="false">
		</div>
		<div class="postmetadata">
		<?php if(function_exists('pf_show_link')){echo pf_show_link();} ?>  &nbsp;&nbsp;| <?php the_tags( ); ?> 
		</div>
	</div>
	<?php // comments_template();  Get wp-comments.php template ?>

	<?php endwhile; else: ?>
	<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
	<?php endif; ?>

	<?php posts_nav_link(' &#8212; ', __('&laquo; Newer Posts'), __('Older Posts &raquo;')); ?>
	</div>
	<?php get_footer(); ?>
	
</div>
