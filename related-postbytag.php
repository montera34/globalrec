<?php //wp_reset_query(); ?>

<?php $prueba=get_post_meta($post->ID, 'gm_tag', true); 
if ( $prueba) { ?>

<?php // show related post //
	global $more;    // Declare global $more (before the loop). "para que seguir leyendo funcione"
			
	$tagnow = get_post_meta($post->ID, 'gm_tag', true);
 
	//mirar codigo madre en http://www.hashbangcode.com/blog/create-page-posts-wordpress-417.html
	$args = array(
	 'caller_get_posts' => 1,
	 'tag' => $tagnow
		);
	if ( $paged > 1 ) {
	 $args['paged'] = $paged;}

	$my_query = new WP_Query($args);
				 
	if ( $my_query->have_posts() ) : while ( $my_query->have_posts() ) : $my_query->the_post();  
 	//necessary to show the tags 
		global $wp_query;
		$wp_query->in_the_loop = true;
		$more = 0;       // Set (inside the loop) to display content above the more "seguir leyendo" tag. ?>


		<div id="post-<?php the_ID(); ?>">
		
			<h5 class="">
				<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">
					<?php the_title(); ?>
				</a>
			</h5>
		</div>

	<?php endwhile; else: ?>
	<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
	<?php endif; }?>
