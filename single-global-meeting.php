<?php get_header(); ?>

<div class="container">
	<div class="row-fluid">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div <?php post_class("span8") ?> id="post-<?php the_ID(); ?>">
			 <!-- change links in production -->
			<ul class="breadcrumb">
			  <li><a href="#">Home</a> <span class="divider">/</span></li>
			  <li><a href="/global-meetings/">Global Meetings</a> <span class="divider">/</span></li>
			  <li><?php the_title(); ?> </li>
			</ul>
			<?php the_post_thumbnail( 'medium' ); ?>
			<h3> 
				<a href="<?php the_permalink() ?>" rel="bookmark">
					<?php the_title(); ?>
				</a>	
			</h3>
			<div class="btn btn-small pull-right"><?php edit_post_link(__('Edit This')); ?></div>
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
		<div class="offset1 span3"> 
			<?php if (get_post_meta( $post->ID, 'gm_downloads', true )) { echo '<h4>Downloads</h4>';} ?> 
			<?php 	$text = get_post_meta( $post->ID, 'gm_downloads', true );
			echo $text;  ?>	
		
			<?php if (get_post_meta($post->ID, 'gm_tag', true)) { echo '<h4>Related posts</h4>';} ?>
			<?php 
			//includes the loop with the related post accorfding to the custom field gb-tag
			echo  get_template_part( 'related', 'postbytag'); //includes the file related-postbytag.php with the sharing links  ?>
			
		</div>
	</div>
	<div class="row-fluid">
		<div class="span12"> 
		<?php include("share.php")?>
		<div >
			<?php if(function_exists('pf_show_link')){echo pf_show_link();} ?>  &nbsp;&nbsp;| <?php the_tags( ); ?> 
		</div>
		<div >
			<?php //wp_link_pages(); ?>
			<?php //comments_popup_link(__('Comments (0)'), __('Comments (1)'), __('Comments (%)')); ?>
		</div>
	

		<?php comments_template(); // Get wp-comments.php template ?>

		</div>
		<?php endwhile; else: ?>
		<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
		<?php endif; ?>
 		</div>
	</div>	
		
	
	<?php get_footer(); ?>
</div><!-- #container -->
