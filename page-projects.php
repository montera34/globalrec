<?php  /* Template Name: Projects */ ?>
<?php
get_header();
?>
<?php //mirar codigo madre en http://www.hashbangcode.com/blog/create-page-posts-wordpress-417.html
			$ids = array();
			$args = array(
 			 	'caller_get_posts' => 1,
				'post_type' => 'proyectos',
				'posts_per_page' => 8,
				'tipo' => 'destacado',
				'orderby' =>'title',//'menu_order'
				'order' => 'ASC'
				);
			if ( $paged > 1 ) {
 			 $args['paged'] = $paged;
				}
			$loop = new WP_Query($args);
			
	
	if ( $loop->have_posts() ) : while ( $loop->have_posts() ) : $loop->the_post(); 
	//necessary to show the tags global $wp_query; 
	$loop->in_the_loop = true;  
	$do_not_duplicate[] = $post->ID
	?>


		<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
			<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">
				<div class="attach-post-image" style="height:100px;width:150px;display:block;background:url('<?php echo get_post_meta($post->ID, 'image-project', true); ?>') 
					top center no-repeat; float:left; margin:0 5px 0 0;border:1px solid #ccc;"></div>
			</a>
			<h3><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h3>

			<div class="storycontent">
				<?php the_excerpt(); ?> 
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
