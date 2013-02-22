<?php  /* Template Name: Letras */ ?>
<?php
get_header();
?>
<?php //mirar codigo madre en http://www.hashbangcode.com/blog/create-page-posts-wordpress-417.html
			$ids = array();
			$args = array(
 			 	'caller_get_posts' => 1,
				'post_type' => 'letras',
				//'posts_per_page' => 8,
				//'tipo' => 'destacado',
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
			
			<h3><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h3>

			<span class="disc"><?php echo get_the_term_list( $post->ID, 'disco', 'Disco: ', ', ', '' ); ?></span>
			<div class="storycontent">
				<?php the_content(__('(more...)')); ?>
			</div>
			<div class="meta">
			<?php edit_post_link(__('Edit This')); ?></div>

			<div class="feedback">
				<?php wp_link_pages(); ?>
				<!-- ?php comments_popup_link(__('Comments (0)'), __('Comments (1)'), __('Comments (%)')); ?-->
			</div>	
		</div>

<?php endwhile; else: ?>
<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
<?php endif; ?>

<?php posts_nav_link(' &#8212; ', __('&laquo; Newer Posts'), __('Older Posts &raquo;')); ?>

<?php get_footer(); ?>
