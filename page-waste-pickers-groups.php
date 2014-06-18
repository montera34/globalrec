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
			<th><?php _e('Year formed','globalrec'); ?> (<?php _e('registration year','globalrec'); ?>)</th>
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
					<?php echo get_post_meta( $post->ID, '_wpg_members_type', true ); ?>
				</td>
				<td><?php 
						//City
						//echo get_post_meta( $post->ID, '_wpg_email', true );
						$city_id = get_post_meta( $post->ID, '_wpg_cityselect', true );
						$city = get_post($city_id);
						$city2 = get_post_meta( $post->ID, 'city', true );
						$city2_slug = strtolower (str_replace(" ","-",$city2));
						$city_link = get_permalink($city->ID);
						$city_name = $city->post_title;
						
						if (!empty($city2)) {
							/*if ($city_name == 'Not specified' ) {
								echo $city2. ", ";
							} else {
								echo '<a href="/city/'.$city2_slug.'">'.$city2.'</a>, ';
							}
						} else {
							echo $city2;
							if (!empty($city2)) { echo ", ";};
						}*/
								echo '<a href="/city/'.$city2_slug.'">'.$city2.'</a>, ';
							}
						
						//Country
						$country_id = get_post_meta( $post->ID, '_wpg_countryselect', true );
						$country = get_post($country_id);
						$country2 =get_post_meta( $post->ID, 'country', true );
						$country2_slug = strtolower (str_replace(" ","-",$country2));
						$country_link = get_permalink($country->ID);
						$country_name = $country->post_title;
						if ($country != '') { //displays the country from the selection list '_wpg_countryselect', if it has been selected, if not it displays the country from the open field '_wpg_city'
							if ($country_name == 'Not specified') {//if the "not specified" option is selected
								echo $country2;
							} else {//if a country has been selected
								echo '<a href="/country/'.$country2_slug.'">'.$country2.'</a>';
							}
						} else {
						echo get_post_meta( $post->ID, 'country', true );
						} ?>
				</td>
				<td> 
					<?php 
						$yearformed = get_post_meta( $post->ID, '_wpg_year_formed', true );
						$yearregistred = get_post_meta( $post->ID, '_wpg_registration_year', true );
						echo $yearformed;
						if (!empty($yearregistred)) {
							echo " (".$yearregistred.")";
						} ?>
				</td>

			</tr>

	<?php endwhile; else: ?>
	<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
	<?php endif; ?>
    </tbody>
  </table>
</div>
<?php get_footer(); ?>
