<?php  /* Template Name: Waste Picker Groups List*/ 
get_header(); ?>
<div id="page-wpg">
	<?php if (have_posts()) : while (have_posts()) : the_post();?>
		<div class="row">
			<h2 id="post-<?php the_ID(); ?>" class="col-md-10">
				<?php the_title();?>	
			</h2>		
			<div class="pull-right"><?php do_action('icl_language_selector'); ?></div>
		</div>
		<?php the_content(); ?>	
		<?php endwhile; endif; ?>
		<?php
			$args = array(
			 'post_type' => 'waste-picker-group', 
			 'posts_per_page' => -1, 
			 'orderby' => 'title',
			 'order' => 'ASC',
				);
			$my_query = new WP_Query($args);
			?>

  <table class="table table-hover table-condensed">
	<thead>
		<tr>
			<th><?php _e('Name','globalrec'); ?></th>
			<th><?php _e('Type','globalrec'); ?></th>
			<th><?php _e('Location','globalrec'); ?></th>
			<th><?php _e('Year formed','globalrec'); ?></th>
		</tr>
	</thead>
    <tbody>
	<?php if ( $my_query->have_posts() ) : while ( $my_query->have_posts() ) :  $my_query->the_post(); ?>
	<?php 	 //necessary to show the tags 
		global $wp_query;
		$wp_query->in_the_loop = true;
		$more = 0;       // Set (inside the loop) to display content above the more "seguir leyendo" tag. 
		?>

			<tr <?php post_class(''); ?> id="post-<?php the_ID(); ?>">
				<td> <a href="<?php the_permalink() ?>" rel="bookmark" title="Go to <?php the_title_attribute(); ?> page">
					<?php the_title(); ?></a> 
					<?php if ( is_user_logged_in() ) { ?><div class="btn btn-xs btn-default"> <?php edit_post_link(__('Edit This')); ?></div> <?php } ?>
				</td>
				<td>
					<?php echo get_post_meta( $post->ID, '_wpg_members-type', true ); ?>
				</td>
				<td><?php
						$city_id = get_post_meta( $post->ID, '_wpg_cityselect', true );
						$city = get_post($city_id);
						$city_link = get_permalink($city->ID);
						$city_name = $city->post_title;
						if ($city != '') { //displays the city from the selection list '_wpg_cityselect', if it exists, if not displays the city from the open field '_wpg_city'
							if ($city_name == 'Not specified' ) {
								echo get_post_meta( $post->ID, 'city', true ). ", ";
							} else {
								echo '<a href="'.$city_link.'">'.$city_name.'</a>, ';
							}
						} else {
							echo get_post_meta( $post->ID, 'city', true ). ", ";
						}
						$country_id = get_post_meta( $post->ID, '_wpg_countryselect', true );
						$country = get_post($country_id);
						$country_link = get_permalink($country->ID);
						$country_name = $country->post_title;
						if ($country != '') { //displays the country from the selection list '_wpg_countryselect', if it has been selected, if not it displays the country from the open field '_wpg_city'
							if ($country_name == 'Not specified') {//if the "not specified" option is selected
								echo get_post_meta( $post->ID, 'country', true );
							} else {//if a country has been selected
								echo '<a href="'.$country_link.'">'.$country_name.'</a>';
							}
						} else {
						echo get_post_meta( $post->ID, 'country', true );
						} ?>
				</td>
				<td>
					<?php echo get_post_meta( $post->ID, '_wpg_year-formed', true ); ?>
				</td>

			</tr>

	<?php endwhile; else: ?>
	<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
	<?php endif; ?>
    </tbody>
  </table>
</div>
<?php get_footer(); ?>
