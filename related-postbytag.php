<?php $prueba=get_post_meta($post->ID, 'gm_tag', true); 
if ( $prueba) { ?>

<?php // show related post //
	echo '<div class="list-group">';
	global $more; // Declare global $more (before the loop). "para que seguir leyendo funcione"
			
	$tagnow = get_post_meta($post->ID, 'gm_tag', true);
 
	//mirar codigo madre en http://www.hashbangcode.com/blog/create-page-posts-wordpress-417.html
	$args = array(
	 'ignore_sticky_posts' => 1,
	 'tag' => $tagnow
		);
	if ( $paged > 1 ) {
	 $args['paged'] = $paged;
	 }

	$my_query = new WP_Query($args);
				 
	if ( $my_query->have_posts() ) : while ( $my_query->have_posts() ) : $my_query->the_post();  
 	//necessary to show the tags 
		global $wp_query;
		$wp_query->in_the_loop = true;
		$more = 0;       // Set (inside the loop) to display content above the more "seguir leyendo" tag.
		$published_date = get_post_meta( $post->ID, '_gr_article-date', true );  ?>
		<a  id="post-<?php the_ID(); ?>" href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>" class="list-group-item">
			<?php the_title();
			echo $published_date != ''? ' ('.$published_date.')</a>' : '</a>';  ?> 
		</a>

	<?php endwhile; else: ?>
	<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
	<?php endif;
	echo '</div>';
	}?>
<?php wp_reset_query(); ?>
