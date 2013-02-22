<?php
get_header();
?>
	<div id="content">
		<?php get_sidebar(); ?>
		<div id="main">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>


			<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
				<a href="/life-and-voices"> <!-- needs to be internationalized-->				
				Life and voices 
				</a>>
			 <h3 class="">
				
				<a href="<?php the_permalink() ?>" rel="bookmark">
					<?php the_title(); ?>
				</a>
			</h3>
			<div class="edit-button"><?php edit_post_link(__('Edit This')); ?></div>
				
			<div class="postmetadata">						
			</div>	
			<div class="size-thumbnail wp-image-2864 alignleft" style="float:left;font-size:12px;">
			<?php the_post_thumbnail( 'thumbnail' ); ?> <br>
			<?php if ( is_user_logged_in() ) { ?> 
				 email: <?php
					global $post;
					$text = get_post_meta( $post->ID, 'bio_email', true );
					echo $text; 	
					echo "<br>telephone:";
					$text = get_post_meta( $post->ID, 'bio_telephone', true );
					echo $text; 
				}
					?>
			</div> 
			<div class="" style="margin:0 0 0 170px;">
			<?php the_content(__('(more...)')); ?>
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
	<!--div class="feedback">
		<?php // wp_link_pages(); ?>
		<?php // comments_popup_link(__('Comments (0)'), __('Comments (1)'), __('Comments (%)')); ?>
	</div-->

	</div>
<?php // comments_template(); // Get wp-comments.php template ?>

<?php endwhile; else: ?>
<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
<?php endif; ?>



<?php get_footer(); ?>
</div><!-- #main -->
</div><!-- #content -->
