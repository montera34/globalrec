<?php  /* Template Name: Waste Picker Groups Stats*/ 
get_header();

$prefixpost = "_post_";
$prefix_wpo = 'wpg-';
$prefixwpg = '_wpg_';
?>
<div id="waw-stats">
	<?php if (have_posts()) : while (have_posts()) : the_post();?>
		<?php get_template_part( 'nav', 'waw' ); ?>
		<div class="row">
			<div class="pull-right"><?php do_action('icl_language_selector'); ?></div>
			<h2 id="post-<?php the_ID(); ?>" class="col-md-10	">
				<?php the_title();?> &laquo; Waste pickers Around the World (WAW)
			</h2>		
		</div>
		<div class="row content">
			<div class="col-md-9 col-md-offset-3">
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
			$organization_type_count = count_tax_array($organization_type);
			$member_type_count = count_tax_array($member_type);
			$member_occupation_count = count_tax_array($member_occupation);
			$material_type_count = count_tax_array($material_type);
			$activities_count = count_tax_array($activities);
			$workplace_count = count_tax_array($workplace);
			$municipality_what_count = count_tax_array($municipality_what);
			$language_count = count_tax_array($language);
			?>
			<div class="row">
				<div class="col-md-5	">
					<ul class="list-group">
						<li class="list-group-item">
							<strong>WAW in numbers</strong>
						</li>
						<li class="list-group-item">
							<span class="badge"><?php echo $count_wpo; ?></span>
							Number of organizations in the data base
						</li>
						<li class="list-group-item">
							<span class="badge"><?php echo $count_orgs; ?></span>
							Number of organizations that are Waste Picker Organizations <br>(waste pickers selected as member occupation)
						</li>
						<li class="list-group-item">
							<span class="badge"><?php echo number_format(array_sum($number_individuals)); ?></span>
							Waste pickers in waste picker organizations.
						</li>
					</ul>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<h3>Table of contents</h3>
					<nav>
						<ul>
							<li><a href="#scope">Scope</a></li>
							<li><a href="#type-organization">Type of organization</a></li>
							<li><a href="#country">Country</a></li>
							<li><a href="#type-organization">Type of members</a></li>
							<li><a href="#member-occupation">Occupation of members</a></li>
							<li><a href="#year-formed">Year Formed</a></li>
							<li><a href="#year-registered">Year Registered</a></li>
							<li><a href="#materials">Materials collected</a></li>
							<li><a href="#activitites">Activities</a></li>
							<li><a href="#workplace">Workplace of Members</a></li>
							<li><a href="#what-municipal">What kind of relationship exists with the municipality?</a></li>
							<li><a href="#languages">Languages</a></li>
						</ul>
					</nav>
				</div>
			</div>
			<?php
			
			echo '<div class="row">';
			echo '<div class="col-md-6">';
			echo '<h3 id="scope">Scope <small>number of organizations (%)</small></h3>';
			//reoders array manually
			$organization_scope_count = array_merge(array_flip(array('local','regional','national','not set')), $organization_scope_count);
			//sets colors for scope
			$color_scope = array('local' => '#ff3399','regional' => '#ff3333','national' => '#ff9933','not set' => '#ccc');
			 ?>
			<div class="row">
				<div class="col-md-4 col-sm-4 col-xs-4 text-right">
					<?php foreach ($organization_scope_count as $key => $value) {
						echo '<p>'.ucfirst($key). ' <small>(' . round($value/$count_orgs*100,1) .'%)</small> </p>';
					}
					$max_count_org_scope = 0;
					foreach ($organization_scope_count as $value) {
						$max_count_org_scope = $value > $max_count_org_scope ? $value : $max_count_org_scope;
					}
					echo '<p><small>(Total organizations formed by waste pickers: ' .$count_orgs. ')</small></p>';
					?>
				</div>
				<div class="col-md-8 col-sm-8 col-xs-8">
					<?php foreach ($organization_scope_count as $key => $value) { ?>
					<div class="progress">
						<div class="progress-bar" style="width:<?php echo 100*$value/$max_count_org_scope; ?>%;background-color:<?php echo $color_scope[$key]; ?>;color:black">
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
					<?php } ?>
				</div>
			</div>
			<div class="progress">
			<?php foreach ($organization_scope_count as $key => $value) { ?>
					<div class="progress-bar" style="width:<?php echo 100*$value/$count_orgs; ?>%;background-color:<?php echo $color_scope[$key]; ?>;">
						<span title="<?php echo round($value/$count_orgs*100,1). '% '. $key; ?>">
							<?php echo round($value/$count_orgs*100,1); ?>%
						</span>
					</div>
			<?php } ?>
			</div>
		</div>
		<div class="col-md-6">
			<h3 id="type-organization">Type of organization <small>number of organizations (%)</small></h3>
			<div class="row">
				<div class="col-md-6 col-sm-6 col-xs-6 text-right">
				<?php
				$color_type = array('cooperative' => '#99eeee', 'cooperative federation' => '#339999', 'association' => '#99cc33', 'trade union' => '#003366','not set' => '#ccc');
			
				foreach ($organization_type_count as $key => $value) {
					echo '<p>'.ucfirst($key). ' <small>(' . round($value/$count_orgs*100,1) .'%)</small></p>';
				}
				$max_count_org_type = 0;
				foreach ($organization_type_count as $value) {
					$max_count_org_type = $value > $max_count_org_type ? $value : $max_count_org_type;
				}
				echo '<p><small>(Total organizations formed<br>by waste pickers: ' .$count_orgs. ')</small></p>';
				?>
				</div>
				<div class="col-md-6 col-sm-6 col-xs-6 ">
					<?php foreach ($organization_type_count as $key => $value) { ?>
					<div class="progress">
						<div class="progress-bar" style="width:<?php echo 100*$value/$max_count_org_type; ?>%;background-color:<?php echo isset($color_type[$key]) ? $color_type[$key]: '#ccc'; ?>;color:#000;">
							<span title="<?php echo $value; ?>">
								<small><?php
								echo $value;
								if (($value/$count_orgs*100) > 6) {
									echo " (".round($value/$count_orgs*100,1) ."%)";
								} ?>
								</small>
							</span>
						</div>
					</div>
					<?php } ?>
				</div>
			</div>
			<div class="progress">
		<?php foreach ($organization_type_count as $key => $value) { ?>
				<div class="progress-bar" style="width:<?php echo 100*$value/$count_orgs; ?>%;background-color:<?php echo isset($color_type[$key]) ? $color_type[$key]: '#ccc'; ?>;color:#000;">
					<span title="<?php echo round($value/$count_orgs*100,1). '% '. $key; ?>">
						<?php
						if (($value/$count_orgs*100) > 4) {
							echo $value. " (".round($value/$count_orgs*100,1) ."%)";
						} ?>
					</span>
				</div>
			<?php } ?>
			</div>
		</div>
	</div>
	<div class="row">
		<div id="country" class="col-md-3"><h3>Country <small>number (%)</small></h3>
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
			<h3 id="member-type">Type of members <small>number of organizations (%)</small></h3>
			<?php
			foreach ($member_type_count as $key => $value) {
				echo '<p>'. ucfirst($key) .' '. $value . ' ('. round(100*$value/$count_orgs,1) . '%)</p>';
			}
			?>
		</div>
		<div class="col-md-4">
			<h3 id="member-occupation">Occupation of members <small>number of orgs (%)</small></h3>
			<?php
			foreach ($member_occupation_count as $key => $value) {
				echo '<p>'. ucfirst($key) .' '. $value . ' ('. round(100*$value/$count_orgs,1) . '%)</p>';
			}
			?>
		</div>
	</div>
	<div class="row">
		<div class="col-md-3">
			<h3 id="year-formed">Year Formed</h3>
				<div class="row">
					<div class="col-md-4 col-sm-4 col-xs-4 text-right">
						<?php
						foreach ($year_formed_count as $key => $value) {
							echo $key=='' ? '<p>Not set</p>' : '<p>'.ucfirst($key).'</p>';
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
			<h3 id="year-registered">Year Registered</h3>
				<div class="row">
					<div class="col-md-4 col-sm-4 col-xs-4 text-right">
						<?php
						foreach ($year_registered_count as $key => $value) {
							echo $key=='' ? '<p>Not set</p>' : '<p>'.ucfirst($key).'</p>';
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
			<h3 id="materials">Materials collected <small>number of organizations</small></h3>
				<div class="row">
					<div class="col-md-5 col-sm-5 col-xs-5 text-right">
						<?php
						foreach ($material_type_count as $key => $value) {
							echo $key=='' ? '<p>Not set</p>' : '<p>'.ucfirst($key).'</p>';
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
				<div class="col-md-8">
					<h3 id="activities">Activities <small>number of organizations</small></h3>
						<div class="row">
							<div class="col-md-6 col-sm-6 col-xs-6 text-right">
								<?php
								foreach ($activities_count as $key => $value) {
									echo $key=='' ? '<p>Not set</p>' : '<p>'.ucfirst($key).'</p>';
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
				<div class="col-md-4">
					<h3 id="workplace">Workplace of Members <small>number of organizations</small></h3>
						<div class="row">
							<div class="col-md-5  col-sm-5 col-xs-5 text-right">
								<?php
								foreach ($workplace_count as $key => $value) {
									echo $key=='' ? '<p>Not set</p>' : '<p>'.ucfirst($key).'</p>';
								}
						?>
							</div>
							<div class="col-md-7 col-sm-7 col-xs-7">
								<?php
								$max_workplace = 0;
								foreach ($activities_count as $key => $value) {
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
				<div class="col-md-8">
					<h3 id="what-municipal">What kind of relationship exists with the municipality? <small>number of organizations</small></h3>
						<div class="row">
							<div class="col-md-9 col-sm-9 col-xs-9 text-right">
								<?php
								foreach ($municipality_what_count as $key => $value) {
									echo $key=='' ? '<p>Not set</p>' : '<p>'.ucfirst($key).'</p>';
								}
						?>
							</div>
							<div class="col-md-3 col-sm-3 col-xs-3">
								<?php
								$max_municipality_what = 0;
								foreach ($activities_count as $key => $value) {
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
					<h3 id="languages">Languages <small>number of organizations</small></h3>
						<div class="row">
							<div class="col-md-5 col-sm-5 col-xs-5 text-right">
								<?php
								foreach ($language_count as $key => $value) {
									echo $key=='' ? '<p>Not set</p>' : '<p>'.ucfirst($key).'</p>';
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
<?php get_footer(); ?>
