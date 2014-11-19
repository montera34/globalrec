<?php  /* Template Name: Waste Picker Groups List*/ 
get_header(); ?>
<div id="page-wpg">
	<?php if (have_posts()) : while (have_posts()) : the_post();?>
		<div class="row">
			<div class="pull-right"><?php do_action('icl_language_selector'); ?></div>
			<h2 id="post-<?php the_ID(); ?>" class="col-md-10	">
				<?php the_title();?>	
			</h2>		
		</div>
		<ul class="nav nav-tabs" role="tablist">
			<li role="presentation"><a href="">Home</a></li>
			<li role="presentation"><a href="about">About</a></li>
			<li role="presentation"><a href="">Map by Members' Occupation</a></li>
			<li role="presentation"><a href="oganizations-type">Map by Oganizations' type</a></li>
			<li role="presentation"><a href="scope">Map by Scope</a></li>
			<li role="presentation"><a href="#wpg-list">List of Waste picker groups</a></li>
			<li role="presentation"><a href="supporters">Supporters</a></li>
		</ul>
		<div class="row">
			<div class="col-md-3 legend-map">
			<h3><a href=""><span class="glyphicon glyphicon-user"></span> Members' occupation</a></h3>
			<ul>
				<li><span class="label" style="background-color: #428bca;">Waste Pickers</span></li>
				<li><span class="label" style="background-color: #777;">Waste Collectors</span></li>
				<li><span class="label" style="background-color: #5cb85c;">Scrap dealers</span></li>
				<li><span class="label" style="background-color: #f0ad4e;">Itinerant buyers</span></li>
			</ul>
			<h3><a href="oganizations-type"><span class="glyphicon glyphicon-tag"></span> Organizations' type</a></h3>
			<ul>
				<li><span class="label" style="background-color: #003366">Trade Union</span></li>
				<li><span class="label" style="background-color: #339999">Cooperative federation</span></li>
				<li><span class="label" style="background-color: #99EEEE">Cooperative</span></li>
				<li><span class="label" style="background-color: #99CC33">Association</span></li>
				<li><span class="label" style="background-color: #660099">NGO</span></li>
				<li><span class="label" style="background-color: #FFFF99;color:black">CBO</span></li>
				<li><span class="label" style="background-color: #996600">Self-help group</span></li>
			</ul>
			<h3><a href="scope"><span class="glyphicon glyphicon-globe"></span> Scope</a></h3>
			<ul>
				<li><span class="label" style="background-color: #ff3399;">Local</span></li>
				<li><span class="label" style="background-color: #ff3333;">Regional</span></li>
				<li><span class="label" style="background-color: #ff9933;">National</span></li>
				<li><span class="label" style="background-color: #ffff66; color: black;">International</span></li>
			</ul>
			</div>
			<div class="col-md-9">
			<?php
				$args = array( 'layers' => "'waste pickers','waste collectors','scrap dealers','itinerant buyers'", 'colors' => "'#428BCA','#777','#5CB85C','#F0AD4E'" ); 
				wpmap_showmap($args);
			?>
			</div>
		</div>
		<div class="row content">
			<div class="col-md-9 col-md-offset-3">
			<?php the_content(); ?>
			</div>
			<?php endwhile; endif; ?>
		</div>
		<div class="row">
		<h2>WAW stats</h2>
		<?php
			$count_wpo = wp_count_posts( 'waste-picker-group' )->publish;
			global $wpdb;
			//$wastepickers = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->postmeta WHERE meta_value = 'Members are Waste Pickers';");
			//$wastepickers_orgs = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->postmeta WHERE meta_value = 'Members are Waste Picker Organisations';");
			//$orgs_india = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->postmeta WHERE meta_value = 'India';");//AND meta_key = 'country' ??
			
			$wp_members = get_number_posts ('_wpg_members_type','members are waste pickers');
			$wp_orgs = get_number_posts ('_wpg_members_type','members are waste picker organizations');
			$wp_support = get_number_posts ('_wpg_members_type','waste picker support organization');
			$wp_potential = get_number_posts ('_wpg_members_type','potential supporters');
			
			$wp_wp_occupation = get_number_posts ('_wpg_members_occupation','waste pickers');
			$wp_swm_occupation = get_number_posts ('_wpg_members_occupation','solid waste management');
			$wp_wc_occupation = get_number_posts ('_wpg_members_occupation','waste collectors');
			$wp_sd_occupation = get_number_posts ('_wpg_members_occupation','scrap dealers');
			
			$local_orgs = get_number_posts_double ('_wpg_organization_scope','local');
			$regional_orgs = get_number_posts_double ('_wpg_organization_scope','regional');
			$national_orgs = get_number_posts_double ('_wpg_organization_scope','national');
			$international_orgs = get_number_posts_double ('_wpg_organization_scope','international');
			
			$tradeunions_orgs = get_number_posts_double ('_wpg_organization_type','Trade Union');
			$wpg_orgs = get_number_posts_double ('_wpg_organization_type','Waste Picker Group');
			$ngo_orgs = get_number_posts_double ('_wpg_organization_type','NGO');
			$coop_orgs = get_number_posts_double ('_wpg_organization_type','Cooperative');
			$coopfed_orgs = get_number_posts_double ('_wpg_organization_type','Cooperative Federation');
					
			$wp_india = get_number_posts_double ('country','India');
			$wp_bangladesh = get_number_posts_double ('country','Bangladesh');
			$wp_colombia = get_number_posts_double ('country','Colombia');
			$wp_brazil = get_number_posts_double ('country','Brazil');
			$wp_kenya = get_number_posts_double ('country','Kenya');
			$wp_south_africa = get_number_posts_double ('country','South Africa');
			$wp_organizations =	$wp_orgs+$wp_members;
			
			echo '<p>Number of organizations in the data base: ' .$count_wpo. '.</p>';
			echo '<p>Number of organizations that are formed by waste pickers: ' .$wp_wp_occupation. '.</p>';
			
			echo '<div class="row"><div class="col-md-3">';
			echo '<h3>Type of members</h3>';
			echo '<p>Organizations with waste pickers as members: ' . $wp_members. ' (' . round($wp_members/$count_wpo*100,1) .'%).</p>';
			echo '<p>Organizations with waste picker organizations: ' . $wp_orgs . ' (' . round($wp_orgs/$count_wpo*100,1) .'%).</p>';
			echo '<p>Waste picker support organization: ' . $wp_support . ' (' . round($wp_support/$count_wpo*100,1) .'%).</p>';
			echo '<p>Potential supporters organizations: ' . $wp_potential . ' (' . round($wp_potential/$count_wpo*100,1) .'%).</p>';
			echo '</div><div class="col-md-2">';
			
			echo '<h3>Members\' occupation</h3>';
			echo '<p>Members are waste pickers: ' . $wp_wp_occupation. ' (' . round($wp_wp_occupation/$count_wpo*100,1) .'%).</p>';
			echo '<p>Members are waste collectors: ' . $wp_wc_occupation. ' (' . round($wp_wc_occupation/$count_wpo*100,1) .'%).</p>';
			echo '<p>Members are solid waste management: ' . $wp_swm_occupation. ' (' . round($wp_swm_occupation/$count_wpo*100,1) .'%).</p>';
			echo '<p>Members are scrap dealers: ' . $wp_sd_occupation. ' (' . round($wp_sd_occupation/$count_wpo*100,1) .'%).</p>';
			echo '</div><div class="col-md-2">';
			
			echo '<h3>Scope</h3>';
			echo '<p>Local: ' . $local_orgs. ' (' . round($local_orgs/$wp_wp_occupation*100,1) .'%).</p>';
			echo '<p>Regional: ' . $regional_orgs. ' (' . round($regional_orgs/$wp_wp_occupation*100,1) .'%).</p>';
			echo '<p>National: ' . $national_orgs. ' (' . round($national_orgs/$wp_wp_occupation*100,1) .'%).</p>';
			echo '<p>International: ' . $international_orgs. ' (' . round($international_orgs/$wp_wp_occupation*100,1) .'%).</p>';
			echo '<p><small>(total formed by waste pickers: ' . $wp_wp_occupation. ')</small></p>';
			echo '</div><div class="col-md-2">';
			
			echo '<h3>Type of organization</h3>';
			echo '<p>Trade Unions: ' . $tradeunions_orgs. ' (' . round($tradeunions_orgs/$wp_wp_occupation*100,1) .'%).</p>';
			echo '<p>Waste Picker Group: ' . $wpg_orgs. ' (' . round($wpg_orgs/$wp_wp_occupation*100,1) .'%).</p>';
			echo '<p>NGO: ' . $ngo_orgs. ' (' . round($ngo_orgs/$wp_wp_occupation*100,1) .'%).</p>';
			echo '<p>Cooperative: ' . $coop_orgs. ' (' . round($coop_orgs/$wp_wp_occupation*100,1) .'%).</p>';
			echo '<p>Cooperative Federation: ' . $coopfed_orgs. ' (' . round($coopfed_orgs/$wp_wp_occupation*100,1) .'%).</p>';
			echo '<p><small>(total formed by waste pickers: ' . $wp_wp_occupation. ')</small></p>';
			echo '</div><div class="col-md-3">';
			
			echo '<h3>Country</h3>';
			echo '<p>In India: ' . $wp_india . '  (' . round($wp_india/$wp_wp_occupation*100,1) .'%).</p>';
			echo '<p>In Bangladesh: ' . $wp_bangladesh . '  (' . round($wp_bangladesh/$wp_wp_occupation*100,1) .'%).</p>';
			echo '<p>In Colombia: ' . $wp_colombia . '  (' . round($wp_colombia/$wp_wp_occupation*100,1) .'%).</p>';
			echo '<p>In Brazil: ' . $wp_brazil . '  (' . round($wp_brazil/$wp_wp_occupation*100,1) .'%).</p>';
			echo '<p>In Kenya: ' . $wp_kenya . '  (' . round($wp_kenya/$wp_wp_occupation*100,1) .'%).</p>';
			echo '<p>In South Africa: ' . $wp_south_africa . '  (' . round($wp_south_africa/$wp_wp_occupation*100,1) .'%).</p>';
			echo '<p><small>(total formed by waste pickers: ' . $wp_wp_occupation. ')</small></p>';
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
				'meta_query' => array(
						 array(
								'key'     => '_wpg_members_type',
								'value'   => 'potential supporters',
								'compare' => 'NOT LIKE',
						 ),
					 ),
				);
			$my_query = new WP_Query($args);
			?>
	<h2>WAW Group List</h2>
  <table class="table table-hover table-condensed" id="wpg-list">
	<thead>
		<tr>
			<th><?php _e('Name','globalrec'); ?></th>
			<th><?php _e('Scope','globalrec'); ?></th>
			<th><?php _e('Type of Organization','globalrec'); ?></th>
			<th><?php _e('Type of Member','globalrec'); ?></th>
			<!--<th><?php _e('Members\' occupation','globalrec'); ?></th>-->
			<th><?php _e('Number of members','globalrec');
						echo "<br>(";
						_e('Number of groups','globalrec');
						echo ")"; ?></th>
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
				<td class="text-right">
					<?php
					//echo list_of_items($post_id,'_wpg_members_occupation','');
					$number_wp = get_post_meta( $post_id, '_wpg_number_individuals', true );
					$number_wpg = get_post_meta( $post_id, '_wpg_number_groups', true );
					echo $number_wp !='' ?  number_format($number_wp) : '';
					echo $number_wpg !='' ? ' ('.number_format($number_wpg).')' : '';
					?>
				</td>
				<td><?php 
						//City
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
		</div>
	<?php endwhile; else: ?>
	<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
	<?php endif; ?>
    </tbody>
  </table>
</div>
<?php get_footer(); ?>
