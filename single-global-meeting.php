<?php get_header(); ?>

<div class="">
	<div class="row">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div <?php post_class("col-md-8 content") ?> id="post-<?php the_ID(); ?>">
			<ul class="breadcrumb">
			  <li><a href="<?php echo get_permalink(icl_object_id(2721,'page')) ?>"><?php _e('Global Meetings','globalrec'); ?></a></li>
			  <li><?php the_title(); ?> </li>
			</ul>
			<?php the_post_thumbnail( 'medium' ); ?>
			<?php if ( is_user_logged_in() ) { ?><div class="btn btn-xs btn-default pull-right"> <?php edit_post_link(__('Edit This')); ?></div> <?php } ?>
			<h3>
				<a href="<?php the_permalink() ?>" rel="bookmark">
					<?php the_title(); ?>
				</a>
			</h3>
			<h4><?php
				$text = get_post_meta( $post->ID, 'gm_location', true );
				echo $text; 
				echo ", ";
				$text = get_post_meta( $post->ID, 'gm_date', true );
				echo $text;
				?>
			</h4>				
			<hr>
			<strong>Abstract</strong>
			<?php the_excerpt(); ?>
			<hr>
			<?php the_content(__('(more...)')); ?>		
		</div>
		<!--right column -->
		<div class="col-md-offset-1 col-md-3"> 
			<?php if (get_post_meta( $post->ID, 'gm_downloads', true )) { echo '<h4>Downloads</h4>';} ?> 
			<?php 	$text = get_post_meta( $post->ID, 'gm_downloads', true );
			echo $text;  ?>	
		
			<?php if (get_post_meta($post->ID, 'gm_tag', true)) { echo '<h4>Related posts</h4>';} ?>
			<?php 
			//includes the loop with the related post according to the custom field gm-tag
			echo  get_template_part( 'related', 'postbytag'); //includes the file related-postbytag.php ?>
			
		</div>
	</div>
	<div class="row">
		<div class="col-md-12"> 
		<?php include("share.php")?>
		<div >
			<?php if(function_exists('pf_show_link')){echo pf_show_link();} ?> <?php //the_tags( ); ?> 
		</div>

		<?php //comments_template(); // Get wp-comments.php template TODO: avoid templates from the related posts ?>

		</div>
		<?php endwhile; else: ?>
		<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
		<?php endif; ?>
 		</div>
	</div>	
		
	
	<?php get_footer(); ?>
</div><!-- #container -->
