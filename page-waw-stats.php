<?php  /* Template Name: Waste Picker Groups Stats*/ 
get_header();

$prefixpost = "_post_";
$prefix_wpo = 'wpg-';
$prefixwpg = '_wpg_';

// Grabs continent from url to filter the list of organization displayed by continent
$continent = '';

if ( !empty($_GET['continent'])) {
	$continent = sanitize_text_field( $_GET['continent'] );
}

// Countries in contintents are defined in functions.php

//$continent = sanitize_text_field( $_GET['continent'] );
if ($continent == '' ) {
	$active_continent = $all;
} else if ( $continent == 'asia') {
	$active_continent = $asia;
	$continent_name = __('Asia','globalrec');
} else if ( $continent == 'latinamerica') {
	$active_continent = $latinamerica;
	$continent_name = __('Latin America','globalrec');
} else if ( $continent == 'africa') {
	$active_continent = $africa;
	$continent_name = __('Africa','globalrec');
} else if ( $continent == 'northamerica') {
	$active_continent = $northamerica;
	$continent_name = __('North America','globalrec');
} else if ( $continent == 'europe') {
	$active_continent = $europe;
	$continent_name = __('Europe','globalrec');
} else if ( $continent == 'all') {
	$active_continent = $all;
	$continent_name = __('All','globalrec');
}

$meta_query = array(
	array(
		'key'     => 'country',
		'value'   => $active_continent,
		'compare' => 'IN',
	)
);
?>
<div id="waw-stats">
	<?php if (have_posts()) : while (have_posts()) : the_post();?>
		<?php get_template_part( 'nav', 'waw' ); ?>
		<div class="row">
			<div class="pull-right"><?php do_action('icl_language_selector'); ?></div>
			<h2 id="post-<?php the_ID(); ?>" class="col-md-10	">
				<?php the_title();?> &laquo; <?php _e('Waste pickers Around the World (WAW)','globalrec'); ?>
			</h2>		
		</div>
		<div class="row content">
			<div class="col-md-9">
			<?php the_content(); ?>
			</div>
			<?php endwhile; endif; ?>
		</div>
		<div class="row">
			<div class="col-md-12">
			<?php
			$count_wpo = wp_count_posts( 'waste-picker-org' )->publish;
			//global $wpdb;
			
			//Iterate to all the available post of this ecosystem
			$args = array(
				'post_type' => 'waste-picker-org',
				'posts_per_page' => -1,
				'orderby' => 'title',
				'order' => 'ASC',
				'post_status' => 'publish',
				'tax_query' => array(
					'relation' => 'AND',
					array(
						'taxonomy' => 'wpg-member-occupation',
						'field'    => 'slug',
						'terms'    => 'waste-pickers',
					),
					array(
						'taxonomy' => 'wpg-member-type',
						'field'    => 'slug',
						'terms'    => array('members-are-waste-pickers', 'members-are-waste-picker-organizations'),
						'operator' => 'IN',
					),
				),
				'meta_query' => $meta_query,
			);
			$posts_array = get_posts( $args );
			$count_orgs = count($posts_array);
			//print_r($posts_array);
			
			//Get all the post ids
			foreach ($posts_array as $key => $value) {
				$post_id = $value->ID;
				$posts_ids[$key] = $post_id;
				$country_names[$key] = get_post_meta( $post_id, 'country', true );
				$organization_scope[$key] = wp_get_post_terms($post_id, $prefix_wpo .'scope');
				$organization_type[$key] = wp_get_post_terms($post_id, $prefix_wpo .'organization-type');
				$member_type[$key] = wp_get_post_terms($post_id, $prefix_wpo .'member-type');
				$member_occupation[$key] = wp_get_post_terms($post_id, $prefix_wpo . 'member-occupation');
				$year_formed[$key] = get_post_meta( $post_id, $prefixwpg . 'year_formed', true );
				$year_registered[$key] = get_post_meta( $post_id, $prefixwpg . 'registration_year', true );
				$material_type[$key] = wp_get_post_terms($post_id, $prefix_wpo . 'material-type');
				$activities[$key] = wp_get_post_terms($post_id, $prefix_wpo . 'activities');
				$workplace[$key] = wp_get_post_terms($post_id, $prefix_wpo . 'workplace-members');
				$municipality_what[$key] = wp_get_post_terms($post_id, $prefix_wpo . 'municipality-what');
				$language[$key] = wp_get_post_terms($post_id, $prefix_wpo . 'language');
				$number_individuals[$key] = get_post_meta( $post_id, '_wpg_number_individuals', true );
			}
			$country_names_count = array_count_values($country_names); //counts values of gogle page rank
			arsort($country_names_count);
			
			//Year formed and registered
			$year_formed_count = array_count_values($year_formed);
			$year_registered_count = array_count_values($year_registered);
			ksort($year_formed_count); //sorts by key
			ksort($year_registered_count); //sorts by key
			
			//Creates arrays which term as key and number of organizations as value
			$organization_scope_count = count_tax_array($organization_scope);
			$organization_type_count = count_multiterm_tax_array($organization_type);
			$member_type_count = count_multiterm_tax_array($member_type);
			$member_occupation_count = count_multiterm_tax_array($member_occupation);
			$material_type_count = count_multiterm_tax_array($material_type);
			$activities_count = count_multiterm_tax_array($activities);
			$workplace_count = count_multiterm_tax_array($workplace);
			$municipality_what_count = count_multiterm_tax_array($municipality_what);
			$language_count = count_multiterm_tax_array($language);
			?>
			<div class="row">
				<div class="col-md-5	">
					<ul class="list-group">
						<li class="list-group-item">
							<strong><?php _e('WAW in numbers','globalrec'); ?></strong>
						</li>
						<li class="list-group-item">
							<span class="badge"><?php echo $count_wpo; ?></span>
							<?php _e('Number of organizations in the data base','globalrec'); ?>
						</li>
						<li class="list-group-item">
							<span class="badge"><?php echo $count_orgs; ?></span>
							<?php _e('Number of organizations that are Waste Picker Organizations','globalrec'); ?> 
							<?php
							//Displays the name of the continent being used as filter
							echo $continent == 'all' || $continent == '' ? '' : '(<strong>'. $continent_name .'</strong>)'; ?>
						</li>
						<li class="list-group-item">
							<span class="badge"><?php echo number_format(array_sum($number_individuals)); ?></span>
							<?php _e('Waste pickers in waste picker organizations','globalrec'); ?>
						</li>
					</ul>
				</div>
				<div class="col-md-7">
					<ul class="nav nav-pills">
						<li role="presentation" class="disabled"><a href="?continent=all" title=""><?php _e('Filter by continent','globalrec'); ?>: </a></li>
						<li role="presentation"><a href="?continent=all" title="<?php _e('All','globalrec'); ?>"><?php _e('All','globalrec'); ?></a></li>
						<li role="presentation"><a href="?continent=asia" title="<?php _e('Asia','globalrec'); ?>"><?php _e('Asia','globalrec'); ?></a></li>
						<li role="presentation"><a href="?continent=latinamerica" title="<?php _e('Latin America','globalrec'); ?><"><?php _e('Latin America','globalrec'); ?></a></li>
						<li role="presentation"><a href="?continent=africa" title="<?php _e('Africa','globalrec'); ?>	"><?php _e('Africa','globalrec'); ?></a></li>
						<li role="presentation"><a href="?continent=northamerica" title="<?php _e('North America','globalrec'); ?>	"><?php _e('North America','globalrec'); ?></a></li>
						<li role="presentation"><a href="?continent=europe" title="<?php _e('Europe','globalrec'); ?>	"><?php _e('Europe','globalrec'); ?></a></li>
					</ul>
					<h3><?php echo $continent == 'all' || $continent == '' ? '' : '<strong>'. $continent_name .'</strong>'; ?></h3>
				</div>
			</div>
			<div class="row">
				<div class="col-md-5">
					<h3><?php _e('Table of contents','globalrec'); ?></h3>
					<nav>
						<ul>
							<li><a href="#scope"><?php _e('Organizational Reach','globalrec'); ?></a></li>
							<li><a href="#type-organization"><?php _e('Type of organization','globalrec'); ?></a></li>
							<li><a href="#country"><?php _e('Country','globalrec'); ?></a></li>
							<li><a href="#type-organization"><?php _e('Type of members','globalrec'); ?></a></li>
							<li><a href="#member-occupation"><?php _e('Occupation of members','globalrec'); ?></a></li>
							<li><a href="#year-formed"><?php _e('Year Formed','globalrec'); ?></a></li>
							<li><a href="#year-registered"><?php _e('Year Registered','globalrec'); ?></a></li>
							<li><a href="#materials"><?php _e('Materials collected','globalrec'); ?></a></li>
							<li><a href="#activitites"><?php _e('Activities','globalrec'); ?></a></li>
							<li><a href="#workplace"><?php _e('Workplace of Members','globalrec'); ?></a></li>
							<li><a href="#what-municipal"><?php _e('What kind of relationship exists with the municipality?','globalrec'); ?></a></li>
							<li><a href="#languages"><?php _e('Languages','globalrec'); ?></a></li>
						</ul>
					</nav>
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-5">
					<h3 id="scope"><?php _e('Organizational Reach','globalrec'); ?> <small><?php _e('number of organizations','globalrec'); ?> (%)</small></h3>
					<?php
					//reoders array manually TODO: make this work in all the languages. U	ntil them, deactivate
					// $organization_scope_count = array_merge(array_flip(array('local','regional','national','not known')), $organization_scope_count);
					//sets colors for scope
					$color_scope = array('local' => '#ff3399','regional' => '#ff3333','national' => '#ff9933','not known' => '#ccc','nacional' => '#ff9933');
					//calculates max scope value
					$max_count_org_scope = 0;
					foreach ($organization_scope_count as $value) {
						$max_count_org_scope = $value > $max_count_org_scope ? $value : $max_count_org_scope;
					}
			 		?>
					<?php foreach ($organization_scope_count as $key => $value) { ?>
					<div class="row">
						<div class="col-md-4 col-sm-4 col-xs-4 text-right">
						<?php echo '<p>'.ucfirst($key). ' <small>(' . round($value/$count_orgs*100,1) .'%)</small> </p>'; ?>
						</div>
						<div class="col-md-8 col-sm-8 col-xs-8">
							<div class="progress">
								<div class="progress-bar" style="width:<?php echo 100*$value/$max_count_org_scope; ?>%;background-color:<?php echo isset($color_scope[$key]) ? $color_scope[$key]: '#eee'; ?>;color:black">
									<span title="<?php echo round($value/$count_orgs*100,1). '% '. ucfirst($key); ?>">
										<small>
										<?php echo $value;
											if (($value/$count_orgs*100) > 6) {
												echo " (".round($value/$count_orgs*100,1) ."%)";
											}	?>
										</small>
									</span>
								</div>
							</div>
						</div>
					</div>
					<?php
					}
 					echo '<p><small>('. __('Total organizations formed by waste pickers','globalrec'). ': ' .$count_orgs. ')</small></p>';?>
					<div class="progress">
						<?php foreach ($organization_scope_count as $key => $value) { ?>
						<div class="progress-bar" style="width:<?php echo 100*$value/$count_orgs; ?>%;background-color:<?php echo $color_scope[$key]; ?>;">
							<span title="<?php echo round($value/$count_orgs*100,1). '% '. $key; ?>">
								<?php echo round($value/$count_orgs*100,1); ?>%
							</span>
						</div>
						<?php } ?>
					</div>
				</div><!-- ends Scope -->
				<div class="col-md-6 col-md-offset-1">
					<h3 id="type-organization"><?php _e('Type of organization','globalrec'); ?> <small><?php _e('number of organizations','globalrec'); ?> (%)</small></h3>
					<?php
					//calculates max organization type value
					$max_count_org_type = 0;
					foreach ($organization_type_count as $value) {
						$max_count_org_type = $value > $max_count_org_type ? $value : $max_count_org_type;
					}
					//sets up colors for each taxonomy term
					$color_type = array('cooperative' => '#99eeee', 'cooperative federation' => '#339999', 'association' => '#99cc33', 'trade union' => '#003366','not known' => '#ccc');
					foreach ($organization_type_count as $key => $value) {
					$percent_org_type = round($value/$count_orgs*100,1); ?>
					<div class="row">
						<div class="col-md-6 col-sm-6 col-xs-6 text-right">
							<?php echo '<p>'.ucfirst($key). ' <small>';
							 if ($percent_org_type > 4) {
											echo " (". $percent_org_type ."%)";
								}
							 
							 echo '</small></p>'; ?>
						</div>
						<div class="col-md-6 col-sm-6 col-xs-6 ">
							<div class="progress">
								<div class="progress-bar" style="width:<?php echo 100*$value/$max_count_org_type; ?>%;background-color:<?php echo isset($color_type[$key]) ? $color_type[$key]: '#ccc'; ?>;color:#000;">
									<span title="<?php echo $value; ?>">
										<small><?php
										echo $value;
										if ($percent_org_type > 6) {
											echo " (". $percent_org_type ."%)";
										} ?>
										</small>
									</span>
								</div>
							</div>
						</div>
					</div>
					<?php }
					echo '<p><small>('. __('Total organizations formed by waste pickers','globalrec'). ': ' .$count_orgs. ')</small></p>';?>
					<div class="progress">
					<?php foreach ($organization_type_count as $key => $value) { ?>
						<div class="progress-bar" style="width:<?php echo 100*$value/$count_orgs; ?>%;background-color:<?php echo isset($color_type[$key]) ? $color_type[$key]: '#eee'; ?>;color:#000;">
							<span title="<?php echo round($value/$count_orgs*100,1). '% '. $key; ?>">
								<?php
								if (($value/$count_orgs*100) > 4) {
									echo $value. " (".round($value/$count_orgs*100,1) ."%)";
								} ?>
							</span>
						</div>
					<?php } ?>
					</div>
				</div> <!-- ends Type of organization -->
			</div> <!-- ends row -->

	<div class="row">
		<div id="country" class="col-md-3"><h3><?php _e('Country','globalrec'); ?> <small><?php _e('number of organizations','globalrec'); ?> (%)</small></h3>
			<div class="row">
				<div class="col-md-12">
				<?php
				foreach ($country_names_count as $key => $value) {
					echo '<p>'. ucfirst($key) .': '. $value;
					echo $value < 5 ? '' : ' <small>('. round(100*$value/$count_orgs,1) . '%)</small>';
					echo '</p>';
				}
				?>
				</div>
			</div>
		</div>
		<div class="col-md-5">
			<h3 id="member-type"><?php _e('Type of members','globalrec'); ?> <small><?php _e('number of organizations','globalrec'); ?> (%)</small></h3>
			<?php
			foreach ($member_type_count as $key => $value) {
				echo '<p>'. ucfirst($key) .' '. $value . ' ('. round(100*$value/$count_orgs,1) . '%)</p>';
			}
			?>
		</div>
		<div class="col-md-4">
			<h3 id="member-occupation"><?php _e('Occupation of members','globalrec'); ?> <small><?php _e('number of organizations','globalrec'); ?> (%)</small></h3>
			<?php
			foreach ($member_occupation_count as $key => $value) {
				echo '<p>'. ucfirst($key) .' '. $value . ' ('. round(100*$value/$count_orgs,1) . '%)</p>';
			}
			?>
		</div>
	</div>
	<div class="row">
		<div class="col-md-3">
			<h3 id="year-formed"><?php _e('Year Formed','globalrec'); ?> <small><?php _e('number of organizations','globalrec'); ?></small></h3>
				<div class="row">
					<div class="col-md-4 col-sm-4 col-xs-4 text-right">
						<?php
						foreach ($year_formed_count as $key => $value) {
							echo $key=='' ? '<p>'.__('Not known','globalrec').'</p>' : '<p>'.ucfirst($key).'</p>';
						}
						?>
					</div>
					<div class="col-md-8">
						<?php
						$max_year_formed=0;
						foreach ($year_formed_count as $key => $value) {
							$max_year_formed = max( array( $max_year_formed, $value) ); //calculates max value
						}
						foreach ($year_formed_count as $year => $value) {
							?>
						<div class="progress">
							<div class="progress-bar" style="width:<?php echo 100*$value/$max_year_formed; ?>%;background-color:#999;color:black">
								<span title="<?php echo $value; ?> organizations formed">
									<?php echo $value; ?>
								</span>
							</div>
						</div>
				<?php } ?>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<h3 id="year-registered"><?php _e('Year Registered','globalrec'); ?> <small><?php _e('number of organizations','globalrec'); ?></small></h3>
				<div class="row">
					<div class="col-md-4 col-sm-4 col-xs-4 text-right">
						<?php
						foreach ($year_registered_count as $key => $value) {
							echo $key=='' ? '<p>'.__('Not known','globalrec').'</p>' : '<p>'.ucfirst($key).'</p>';
						}
						?>
					</div>
					<div class="col-md-8 col-sm-8 col-xs-8 ">
						<?php
						$max_year_registered = 0;
						foreach ($year_registered_count as $key => $value) {
							$max_year_registered = max( array( $max_year_registered, $value) ); //calculates max value
						}
						foreach ($year_registered_count as $key => $value) {
						?>
						<div class="progress">
							<div class="progress-bar" style="width:<?php echo 100*$value/$max_year_registered; ?>%;background-color:#999;color:black">
								<span title="<?php echo $value; ?> organizations formed">
									<?php echo $value; ?>
								</span>
							</div>
						</div>
				<?php } ?>
				</div>
			</div>
		</div>
		<div class="col-md-5">
			<h3 id="materials"><?php _e('Materials collected','globalrec'); ?> <small><?php _e('number of organizations','globalrec'); ?></small></h3>
				<div class="row">
					<div class="col-md-5 col-sm-5 col-xs-5 text-right">
						<?php
						foreach ($material_type_count as $key => $value) {
							echo '<p><a href="/wpg-material-type/'.strtolower( str_replace(" ","-",$key) ).'">'.ucfirst($key).'</a></p>';
						}
				?>
					</div>
					<div class="col-md-7 col-sm-7 col-xs-7">
						<?php
						$max_material_type = 0;
						foreach ($material_type_count as $key => $value) {
							$max_material_type = max( array( $max_material_type, $value) ); //calculates max value
						}
						foreach ($material_type_count as $key => $value) {
							?>
						<div class="progress">
							<div class="progress-bar" style="width:<?php echo 100*$value/$max_material_type; ?>%;background-color:#999;color:black">
								<span title="<?php echo $value; ?>">
									<?php echo $value; ?>
								</span>
							</div>
						</div>
				<?php } ?>
				</div>
			</div>
		</div>
	</div>
			<div class="row">
				<div class="col-md-9">
					<h3 id="activities"><?php _e('Activities','globalrec'); ?> <small><?php _e('number of organizations','globalrec'); ?></small></h3>
						<div class="row">
							<div class="col-md-8 col-sm-8 col-xs-8 text-right">
								<?php
								foreach ($activities_count as $key => $value) {
									echo $key=='' ? '<p>'.__('Not known','globalrec').'</p>' : '<p>'.ucfirst($key).'</p>';
								}
						?>
							</div>
							<div class="col-md-4 col-sm-4 col-xs-4">
								<?php
								$max_activities = 0;
								foreach ($activities_count as $key => $value) {
									$max_activities = max( array( $max_activities, $value) ); //calculates max value
								}
								foreach ($activities_count as $key => $value) {
									?>
								<div class="progress">
									<div class="progress-bar" style="width:<?php echo 100*$value/$max_activities; ?>%;background-color:#999;color:black">
										<span title="<?php echo $value; ?>">
											<?php echo $value; ?>
										</span>
									</div>
								</div>
						<?php } ?>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<h3 id="workplace"><?php _e('Workplace of Members','globalrec'); ?> <small><?php _e('number of organizations','globalrec'); ?></small></h3>
						<div class="row">
							<div class="col-md-7 col-sm-7 col-xs-7 text-right">
								<?php
								foreach ($workplace_count as $key => $value) {
									echo $key=='' ? '<p>'.__('Not known','globalrec').'</p>' : '<p>'.ucfirst($key).'</p>';
								}
						?>
							</div>
							<div class="col-md-5 col-sm-5 col-xs-5">
								<?php
								$max_workplace = 0;
								foreach ($workplace_count as $key => $value) {
									$max_workplace = max( array( $max_workplace, $value) ); //calculates max value
								}
								foreach ($workplace_count as $key => $value) {
									?>
								<div class="progress">
									<div class="progress-bar" style="width:<?php echo 100*$value/$max_workplace; ?>%;background-color:#999;color:black">
										<span title="<?php echo $value; ?>">
											<?php echo $value; ?>
										</span>
									</div>
								</div>
						<?php } ?>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<h3 id="what-municipal"><?php _e('What kind of relationship exists with the municipality?','globalrec'); ?> <small><?php _e('number of organizations','globalrec'); ?></small></h3>
						<div class="row">
							<div class="col-md-9 col-sm-9 col-xs-9 text-right">
								<?php
								foreach ($municipality_what_count as $key => $value) {
									echo $key=='' ? '<p>'.__('Not known','globalrec').'</p>' : '<p>'.ucfirst($key).'</p>';
								}
						?>
							</div>
							<div class="col-md-3 col-sm-3 col-xs-3">
								<?php
								$max_municipality_what = 0;
								foreach ($municipality_what_count as $key => $value) {
									$max_municipality_what = max( array( $max_municipality_what, $value) ); //calculates max value
								}
								foreach ($municipality_what_count as $key => $value) {
									?>
								<div class="progress">
									<div class="progress-bar" style="width:<?php echo 100*$value/$max_municipality_what; ?>%;background-color:#999;color:black">
										<span title="<?php echo $value; ?>">
											<?php echo $value; ?>
										</span>
									</div>
								</div>
						<?php } ?>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<h3 id="languages"><?php _e('Languages','globalrec'); ?> <small><?php _e('number of organizations','globalrec'); ?></small></h3>
						<div class="row">
							<div class="col-md-5 col-sm-5 col-xs-5 text-right">
								<?php
								foreach ($language_count as $key => $value) {
									echo $key=='' ? '<p>'.__('Not known','globalrec').'</p>' : '<p>'.ucfirst($key).'</p>';
								}
						?>
							</div>
							<div class="col-md-7 col-sm-7 col-xs-7">
								<?php
								$max_language = 0;
								foreach ($language_count as $key => $value) {
									$max_language = max( array( $max_language, $value) ); //calculates max value
								}
								foreach ($language_count as $key => $value) {
									?>
								<div class="progress">
									<div class="progress-bar" style="width:<?php echo 100*$value/$max_language; ?>%;background-color:#999;color:black">
										<span title="<?php echo $value; ?>">
											<?php echo $value; ?>
										</span>
									</div>
								</div>
						<?php } ?>
						</div>
					</div>
				</div>
			</div>
	</div>
</div>
<?php get_footer(); ?>
