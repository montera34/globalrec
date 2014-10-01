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
			$count_wpo = wp_count_posts( 'waste-picker-group' )->publish;
			global $wpdb;
			//$wastepickers = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->postmeta WHERE meta_value = 'Members are Waste Pickers';");
			//$wastepickers_orgs = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->postmeta WHERE meta_value = 'Members are Waste Picker Organisations';");
			//$orgs_india = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->postmeta WHERE meta_value = 'India';");//AND meta_key = 'country' ??
			
			$wp_members = get_number_posts ('_wpg_members_type','Members are Waste Pickers');
			$wp_orgs = get_number_posts ('_wpg_members_type','members are Waste Picker Organizations');
			
			$local_orgs = get_number_posts ('_wpg_organization_scope','local');
			$regional_orgs = get_number_posts ('_wpg_organization_scope','regional');
			$national_orgs = get_number_posts ('_wpg_organization_scope','national');
			$international_orgs = get_number_posts ('_wpg_organization_scope','international');
			
			$tradeunions_orgs = get_number_posts ('_wpg_organization_type','Trade Union');
			$wpg_orgs = get_number_posts ('_wpg_organization_type','Waste Picker Group');
			$ngo_orgs = get_number_posts ('_wpg_organization_type','NGO');
			$coop_orgs = get_number_posts ('_wpg_organization_type','Cooperative');
			$coopfed_orgs = get_number_posts ('_wpg_organization_type','Cooperative Federation');
					
			$wp_india = get_number_posts ('country','India');
			$wp_colombia = get_number_posts ('country','Colombia');
			$wp_brazil = get_number_posts ('country','Brazil');
			$wp_kenya = get_number_posts ('country','Kenya');
			
			echo '<p>Number of organizations in the data base: ' .$count_wpo. '.</p>';
			//echo '<p>There are ' . $wastepickers . ' that have waste pickers as members (' . round($wastepickers/$count_wpo*100,1) .'%).</p>';
			
			echo '<div class="row"><div class="col-md-4">';
			echo '<h3>Type of members</h3>';
			echo '<p>Oraganizations with waste pickers as members: ' . $wp_members. ' (' . round($wp_members/$count_wpo*100,1) .'%).</p>';
			echo '<p>Organizations with waste picker organizations: ' . $wp_orgs . ' (' . round($wp_orgs/$count_wpo*100,1) .'%).</p>';
			echo '</div><div class="col-md-2">';
			
			echo '<h3>Scope</h3>';
			echo 'Local: ' . $local_orgs. ' (' . round($local_orgs/$count_wpo*100,1) .'%).</p>';
			echo 'Regional: ' . $regional_orgs. ' (' . round($regional_orgs/$count_wpo*100,1) .'%).</p>';
			echo 'National: ' . $national_orgs. ' (' . round($national_orgs/$count_wpo*100,1) .'%).</p>';
			echo 'International: ' . $international_orgs. ' (' . round($international_orgs/$count_wpo*100,1) .'%).</p>';
			echo '</div><div class="col-md-3">';
			
			echo '<h3>Type of organization</h3>';
			echo 'Trade Unions: ' . $tradeunions_orgs. ' (' . round($tradeunions_orgs/$count_wpo*100,1) .'%).</p>';
			echo 'Waste Picker Group: ' . $wpg_orgs. ' (' . round($wpg_orgs/$count_wpo*100,1) .'%).</p>';
			echo 'NGO: ' . $ngo_orgs. ' (' . round($ngo_orgs/$count_wpo*100,1) .'%).</p>';
			echo 'Cooperative: ' . $coop_orgs. ' (' . round($coop_orgs/$count_wpo*100,1) .'%).</p>';
			echo 'Cooperative Federation: ' . $coopfed_orgs. ' (' . round($coopfed_orgs/$count_wpo*100,1) .'%).</p>';
			echo '</div><div class="col-md-3">';
			
			echo '<h3>Country</h3>';
			echo '<p>In India: ' . $wp_india . '  (' . round($wp_india/$count_wpo*100,1) .'%).</p>';
			echo '<p>In Colombia: ' . $wp_colombia . '  (' . round($wp_colombia/$count_wpo*100,1) .'%).</p>';
			echo '<p>In Brazil: ' . $wp_brazil . '  (' . round($wp_brazil/$count_wpo*100,1) .'%).</p>';
			echo '<p>In Kenya: ' . $wp_kenya . '  (' . round($wp_kenya/$count_wpo*100,1) .'%).</p>';
			echo '</div></div>';
			?>
			
			<?php
			// set the meta_key to the appropriate custom field meta key
			$meta_key = '_wpg_number_individuals';
			$allwp = $wpdb->get_var( $wpdb->prepare("SELECT sum(meta_value) FROM $wpdb->postmeta WHERE meta_key = %s",$meta_key) );
			echo "<p>There are " .number_format($allwp). " of waste pickers in waste picker organizations.</p>";
			?> 
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
			<th><?php _e('Scope','globalrec'); ?></th>
			<th><?php _e('Type of Organization','globalrec'); ?></th>
			<th><?php _e('Type of Member','globalrec'); ?></th>
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
		$post_id = $post->ID;
		?>

			<tr <?php post_class(''); ?> id="post-<?php the_ID(); ?>">
				<td> <a href="<?php the_permalink() ?>" rel="bookmark" title="Go to <?php the_title_attribute(); ?> page">
					<strong><?php the_title(); ?></strong></a> 
					<?php if ( is_user_logged_in() ) { ?><div class="btn btn-xs btn-default"> <?php edit_post_link(__('Edit This')); ?></div> <?php } ?>
				</td>
				<td>
					<?php echo list_of_items($post_id,'_wpg_organization_scope',''); ?>
				</td>
				<td>
					<?php echo list_of_items($post_id,'_wpg_organization_type',''); ?>
				</td>
				<td>
					<?php 
					$member_type = get_post_meta( $post_id, '_wpg_members_type', true );
					if (gettype($member_type) == 'array') {
						echo list_of_items($post_id,'_wpg_members_type','');
					} else {
						echo get_post_meta( $post_id, '_wpg_members_type', true ); 
					} ?>
					
				</td>
				<td><?php 
						//City
						//echo get_post_meta( $post->ID, '_wpg_email', true );
						$city_id = get_post_meta( $post_id, '_wpg_cityselect', true );
						$city = get_post($city_id);
						$city2 = get_post_meta( $post_id, 'city', true );
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
						$country_id = get_post_meta( $post_id, '_wpg_countryselect', true );
						$country = get_post($country_id);
						$country2 =get_post_meta( $post_id, 'country', true );
						$country2_slug = strtolower (str_replace(" ","-",$country2));
						$country_link = get_permalink($post_id);
						$country_name = $country->post_title;
						if ($country != '') { //displays the country from the selection list '_wpg_countryselect', if it has been selected, if not it displays the country from the open field '_wpg_city'
							if ($country_name == 'Not specified') {//if the "not specified" option is selected
								echo $country2;
							} else {//if a country has been selected
								echo '<a href="/country/'.$country2_slug.'">'.$country2.'</a>';
							}
						} else {
						echo get_post_meta( $post_id, 'country', true );
						} ?>
				</td>
				<td> 
					<?php 
						$yearformed = get_post_meta( $post_id, '_wpg_year_formed', true );
						$yearregistred = get_post_meta( $post_id, '_wpg_registration_year', true );
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
