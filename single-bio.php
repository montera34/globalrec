<?php get_header(); ?>

<div class="container">
	<div class="row">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div <?php post_class('col-md-12') ?> id="post-<?php the_ID(); ?>">
			<div class="row">	
				<div class="col-md-8">
					<ul class="breadcrumb">
						<li><a href="/life-and-voices">Who we are</a></li>
						<li><?php the_title(); ?> </li>
					</ul>
				</div>
				<div class="btn btn-default btn-sm pull-right"><?php edit_post_link(__('Edit This')); ?></div>
			</div>
		</div>		
		<div class="row">
			<div class="col-md-3"><small>
				<?php the_post_thumbnail( 'medium',array('class'=> "img-rounded img-responsive",'alt'=> trim(strip_tags( $wp_postmeta->_wp_attachment_image_alt )),'title'	=> trim(strip_tags( $attachment->post_title ))) ); ?> <br>
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
			<div class="col-md-7">
			<?php the_content(__('(more...)')); ?>
			</div>
		</div>
	</div>
	<?php include("share.php")?>
	<?php // comments_template();  Get wp-comments.php template ?>

	<?php endwhile; else: ?>
	<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
	<?php endif; ?>

	<?php posts_nav_link(' &#8212; ', __('&laquo; Newer Posts'), __('Older Posts &raquo;')); ?>
	</div>
	<?php get_footer(); ?>
	
</div>
