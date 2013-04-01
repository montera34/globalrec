<?php  /* Template Name: Page Global Meetings*/ 
get_header(); ?>

<div class="container">
	<?php if (have_posts()) : while (have_posts()) : the_post();?>
		<h2 id="post-<?php the_ID(); ?>"><?php the_title();?></h2>		
			<?php the_content(); ?>	
			<?php endwhile; endif; ?>
			<?php	global $more;    // Declare global $more (before the loop). "para que seguir leyendo funcione"
				//mirar codigo madre en http://www.hashbangcode.com/blog/create-page-posts-wordpress-417.html
				$args = array(
				 'caller_get_posts' => 1,
				 'post_type' => 'global-meeting', 
				 'posts_per_page' => 35, 
				 'post_parent' => 0
				 
					);
				if ( $paged > 1 ) {
				 $args['paged'] = $paged;
					}
	 
				$my_query = new WP_Query($args);
				?>


  <table class="table table-hover table-condensed">
	<thead>
	 <tr>
          <th>Name</th>
	  <th>Location</th>
          <th>Year</th>
          <th>Type</th>
         </tr>
	</thead>
    <tbody>
	<?php if ( $my_query->have_posts() ) : while ( $my_query->have_posts() ) :  $my_query->the_post(); ?>
	<?php 	 //necessary to show the tags 
		global $wp_query;
		$wp_query->in_the_loop = true;
		$more = 0;       // Set (inside the loop) to display content above the more "seguir leyendo" tag. 
		

		//intento de añadir la class 'label' a los bg-type
		$id = $post->ID;
		$tax = 'gb-type';
		$op = '';
		$list = get_the_term_list($id,$tax,'','|','');
		if ($list) {
		   $terms = explode('|',$list);
		   $op = '';
		   foreach ($terms as $term) {
		      $class = 'item-' . ++$i;
		      $item = "<span class=\"label\">$term</span>";
		      $op .= $item;
		   }
		}
		?>

			<tr <?php post_class('global-meeting-list'); ?> id="post-<?php the_ID(); ?>">
				
				<td> <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">
					<?php the_title(); ?></a><div class="edit-button"><?php // edit_post_link(__('Edit This')); ?></div> 
				</td>
				<td><?php $text = get_post_meta( $post->ID, 'gm_location', true ); echo $text; ?> </td>
				<td>
					<?php // echo get_the_term_list( $post->ID, 'gb-type', ' ', ', ', '' ); ?> 
					<span class="label"><?php echo get_the_term_list( $post->ID, 'gb-year', ' ', ', ', '' ); ?></span> 
				</td>
				<td>	<?php echo $op; ?>
				</td>
			</tr>

	<?php endwhile; else: ?>
	<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
	<?php endif; ?>
    </tbody>
  </table>

	

	<div class="navigation">
  			<div class="alignleft"><?php 
				if ( !$max_page ) {
 					 $max_page = $my_query->max_num_pages;
					}
 
				if ( !$paged ) {
 					 $paged = 1;
					}
					$nextpage = intval($paged) + 1;
 
				if ( !is_single() && ( empty($paged) || $nextpage <= $max_page) ) {
  					$attr = apply_filters( 'next_posts_link_attributes', '' );
 					 echo '<a href="' . next_posts( $max_page, false ) . "\" $attr>". preg_replace('/&([^#])(?![a-z]{1,8};)/', '&$1', ' &laquo; Previous posts') .'</a>';
					}
					?></div>
  					<div class="alignright"><?php 
					if ( !is_single() && $paged > 1 ) {
  				$attr = apply_filters( 'previous_posts_link_attributes', '' );
  				echo '<a href="' . previous_posts( false ) . "\" $attr>". preg_replace( '/&([^#])(?![a-z]{1,8};)/', '&$1', 'Newer posts &raquo;' ) .'</a>';
					}
				?></div>
				</div>
</div><!-- #content -->
<?php get_footer(); ?>
