<?php get_header(); ?>
	<div id="content">
		<?php get_sidebar(); ?>
		<div id="main">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			<div class="edit-button"><?php edit_post_link(__('Edit This')); ?></div>
			<div <?php post_class() ?> id="post-<?php the_ID(); ?>"><a href="http://globalrec.org/global-meetings/">Global Meeting</a> > <br>
				<div class="main-column"> <!--left column -->
					<h3 class=""> 
						<a href="<?php the_permalink() ?>" rel="bookmark">
							<?php the_title(); ?>
						</a>	
					</h3>
					<p class="">
					  <?php	$text = get_post_meta( $post->ID, 'gm_date', true );
						echo $text; 	
						echo "<br>";
						$text = get_post_meta( $post->ID, 'gm_location', true );
						echo $text; 
						?>				
					</p>
					<?php the_post_thumbnail( 'medium' ); ?><br><br>
					<strong>Abstract</strong>
					<?php the_excerpt(); ?><?php // the_excerpt(__('(more...)')); ?>
					<br>
					-
					<br>
					<?php the_content(__('(more...)')); ?>
				</div>
				<div class="side-column"> <!--right column -->
					<div class="txt-basic">
						<?php if (get_post_meta( $post->ID, 'gm_downloads', true )) { echo '<strong>Downloads</strong>';} ?><br> 
						<?php 	$text = get_post_meta( $post->ID, 'gm_downloads', true );
						echo $text;  ?>	
					</div>
					<?php if (get_post_meta($post->ID, 'gm_tag', true)) { echo 'Related posts';} ?><br> 
							<?php 
					//includes the loop with the related post accorfding to the custom field gb-tag
					echo  get_template_part( 'related', 'postbytag'); //includes the file related-postbytag.php with the sharing links  ?>
				</div>
			</div>
			<div class="main-column" style="clear:left;">
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
				<div class="feedback">
					<?php //wp_link_pages(); ?>
					<?php //comments_popup_link(__('Comments (0)'), __('Comments (1)'), __('Comments (%)')); ?>
				</div>
			

				<?php comments_template(); // Get wp-comments.php template ?>
			</div>
		</div>
		<?php endwhile; else: ?>
		<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
		<?php endif; ?>
 
		<?php get_footer(); ?>
</div><!-- #main -->
</div><!-- #content -->
