<?php  /* Template Name: video */ ?>
<?php
get_header();
?>
<?php
		global $more;    // Declare global $more (before the loop). "para que seguir leyendo funcione"
			//mirar codigo madre en http://www.hashbangcode.com/blog/create-page-posts-wordpress-417.html
			$args = array(
 			 'caller_get_posts' => 1,
			 'category_name' => 'video'
				);
			if ( $paged > 1 ) {
 			 $args['paged'] = $paged;
				}
				
 
			$my_query = new WP_Query($args);
			?>
<?php if ( $my_query->have_posts() ) : ?>
  		<?php while ( $my_query->have_posts() ) : 
 			 $my_query->the_post(); ?>
   					 <?php 	 //necessary to show the tags 
   					global $wp_query;
					$wp_query->in_the_loop = true;
  					  ?>
					  <?php $more = 0;       // Set (inside the loop) to display content above the more "seguir leyndo" tag. ?>


		<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
			<h3><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h3>
			<div class="postmetadata">
									<?php the_time('d \d\e F \d\e Y') ?>&nbsp;&nbsp;&nbsp;&bull;&nbsp;&nbsp;&nbsp;<?php the_category(', ') ?>
									<!--
									<?the_tags('&nbsp;&nbsp;&nbsp;&bull;&nbsp;&nbsp;&nbsp;<span class="tags">tags:&nbsp;','  ','</span>' ); ?>
									&nbsp;&nbsp;&nbsp;&bull;&nbsp;&nbsp;<?php comments_popup_link('0&nbsp;comentarios', '1&nbsp;comentario', '%&nbsp;comentarios'); ?>-->	
									&nbsp;&nbsp;&nbsp;&bull;&nbsp;&nbsp;<?php the_author_posts_link(); ?>
									
			</div>
			<div class="storycontent">
				<?php the_content(__('(more...)')); ?>
			</div>
			<div class="meta">
			<?php edit_post_link(__('Edit This')); ?></div>

			<div class="feedback">
				<?php wp_link_pages(); ?>
				<?php comments_popup_link(__('Comments (0)'), __('Comments (1)'), __('Comments (%)')); ?>
			</div>	
		</div>

<?php endwhile; else: ?>
<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
<?php endif; ?>

<?php posts_nav_link(' &#8212; ', __('&laquo; Newer Posts'), __('Older Posts &raquo;')); ?>

<?php get_footer(); ?>
