<?php  /* Template Name: Waste Picker Groups Stats*/ 
get_header(); ?>
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
			global $wpdb;
			
			//Members' type
			$wp_waste_pickers = get_number_posts_in_taxonomy ('wpg-member-type','members are waste pickers');
			$wp_orgs = get_number_posts_in_taxonomy ('wpg-member-type','members are waste picker organizations');
			$wp_support = get_number_posts_in_taxonomy ('wpg-member-type','waste picker support organization');
			$wp_potential = get_number_posts_in_taxonomy ('wpg-member-type','potential supporters');
			
			//Members' occupation
			$wp_wp_occupation = get_number_posts_in_taxonomy ('wpg-member-occupation','waste pickers');
			$wp_swm_occupation = get_number_posts_in_taxonomy ('wpg-member-occupation','solid waste management');
			$wp_wc_occupation = get_number_posts_in_taxonomy ('wpg-member-occupation','waste collectors');
			$wp_sd_occupation = get_number_posts_in_taxonomy ('wpg-member-occupation','scrap dealers');
			
			//Scope
			$local_orgs = get_number_posts_in_taxonomy ('wpg-scope','local');
			$regional_orgs = get_number_posts_in_taxonomy ('wpg-scope','regional');
			$national_orgs = get_number_posts_in_taxonomy ('wpg-scope','national');
			$international_orgs = get_number_posts_in_taxonomy ('wpg-scope','international');
			
			//Organizations type
			$tradeunions_orgs = get_number_posts_in_taxonomy ('wpg-organization-type','trade Union');
			$wpg_orgs = get_number_posts_in_taxonomy ('wpg-organization-type','waste picker group');
			$ngo_orgs = get_number_posts_in_taxonomy ('wpg-organization-type','non governmental organization');
			$coop_orgs = get_number_posts_in_taxonomy ('wpg-organization-type','cooperative-2');
			$coopfed_orgs = get_number_posts_in_taxonomy ('wpg-organization-type','federation of cooperatives');
			$assoc_orgs = get_number_posts_in_taxonomy ('wpg-organization-type','association');
			$selfhelp_orgs = get_number_posts_in_taxonomy ('wpg-organization-type','self-help group');
			
			//Country
			$wp_india = get_number_posts_double ('country','India');
			$wp_bangladesh = get_number_posts_double ('country','Bangladesh');
			$wp_colombia = get_number_posts_double ('country','Colombia');
			$wp_brazil = get_number_posts_double ('country','Brazil');
			$wp_kenya = get_number_posts_double ('country','Kenya');
			$wp_south_africa = get_number_posts_double ('country','South Africa');
			$wp_ecuador = get_number_posts_double ('country','ecuador');
			$wp_venezuela = get_number_posts_double ('country','ecuador');
			$wp_peru = get_number_posts_double ('country','peru');
			$wp_dominican = get_number_posts_double ('country','dominican republic');
			
			//Year formed and Registered
			$years = range(1990, 2014);
			foreach ($years as $year) {
				$yearformed[$year] = get_number_posts_double ('_wpg_year_formed',$year);
				$yearregistered[$year] = get_number_posts_double ('_wpg_registration_year',$year);
			}
			
			//Type of materials
			$terms = get_terms( 'wpg-material-type', array(
				'orderby'    => 'count',
				'hide_empty' => 1,
				'order' => 'DESC'
				)
			);
			$max_count_material = 0;
			foreach ($terms as $term) {
				$materials[$term->name] = $term->count;
				$max_count_material = $term->count > $max_count_material ? $term->count : $max_count_material;
			}
			
			//Activities
			$terms = get_terms( 'wpg-activities', array(
				'orderby'    => 'count',
				'hide_empty' => 1,
				'order' => 'DESC'
				)
			);
			$max_count_activity = 0;
			foreach ($terms as $term) {
				$activities[$term->name] = $term->count;
				$max_count_activity = $term->count > $max_count_activity ? $term->count : $max_count_activity;
			}
			
			//Workplace of members
			$terms = get_terms( 'wpg-workplace-members', array(
				'orderby'    => 'count',
				'hide_empty' => 1,
				'order' => 'DESC'
				)
			);
			$max_count_workplace = 0;
			foreach ($terms as $term) {
				$workplaces[$term->name] = $term->count;
				$max_count_workplace = $term->count > $max_count_workplace ? $term->count : $max_count_workplace;
			}
			
			//What kind of relationship exists with the municipality?
			$terms = get_terms( 'wpg-municipality-what', array(
				'orderby'    => 'count',
				'hide_empty' => 1,
				'order' => 'DESC'
				)
			);
			$max_count_municipality_what = 0;
			foreach ($terms as $term) {
				$municipality_whats[$term->name] = $term->count;
				$max_count_municipality_what = $term->count > $max_count_municipality_what ? $term->count : $max_count_municipality_what;
			}

			echo '<p>Number of organizations in the data base: ' .$count_wpo. '.</p></div></div>';
			echo '<p>Number of organizations that are formed by waste pickers: ' .$wp_wp_occupation. ' (waste pickers selected as member occupation).</p>';
			
			echo '<div class="row">';
			echo '<div class="col-md-6"><h3>Scope <small>number of organizations (%)</small></h3>';
			echo '<div class="row"><div class="col-md-5 text-right"><p>Local: ' . $local_orgs. ' (' . round($local_orgs/$wp_wp_occupation*100,1) .'%).</p>';
			echo '<p>Regional: ' . $regional_orgs. ' (' . round($regional_orgs/$wp_wp_occupation*100,1) .'%).</p>';
			echo '<p>National: ' . $national_orgs. ' (' . round($national_orgs/$wp_wp_occupation*100,1) .'%).</p>';
			echo '<p>International: ' . $international_orgs. ' (' . round($international_orgs/$wp_wp_occupation*100,1) .'%).</p>';
			echo '<p><small>(total formed by waste pickers: ' . $wp_wp_occupation. ')</small></p>';
			echo '</div><div class="col-md-7">';?>
			<div class="progress">
				<div class="progress-bar" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo round($local_orgs/$wp_wp_occupation*100,1); ?>%;background-color:#ff3399;">
						<span title="<?php echo round($local_orgs/$wp_wp_occupation*100,1); ?>% local">
							<?php echo round($local_orgs/$wp_wp_occupation*100,1); ?>% local
						</span>
				</div>
			</div>
			<div class="progress">
				<div class="progress-bar progress-bar-warning progress-bar-striped" style="width:<?php echo round($regional_orgs/$wp_wp_occupation*100,1); ?>%;background-color:#ff3333">
						<span title="<?php echo round($regional_orgs/$wp_wp_occupation*100,1); ?>% regional">
							<?php echo round($regional_orgs/$wp_wp_occupation*100,1); ?>% regional
						</span>
					</div>
			</div>
			<div class="progress">
					<div class="progress-bar progress-bar-danger" style="width:<?php echo round($national_orgs/$wp_wp_occupation*100,1); ?>%;background-color:#ff9933">
						<span title="<?php echo round($national_orgs/$wp_wp_occupation*100,1); ?>% national">
							<?php echo round($national_orgs/$wp_wp_occupation*100,1); ?>% national
						</span>
					</div>
			</div>
			<?php echo '</div></div>';
			?>
				<div class="progress">
					<div class="progress-bar" style="width:<?php echo round($local_orgs/$wp_wp_occupation*100,1); ?>%;background-color:#ff3399;">
						<span title="<?php echo round($local_orgs/$wp_wp_occupation*100,1); ?>% local">
							<?php echo round($local_orgs/$wp_wp_occupation*100,1); ?>% local
						</span>
					</div>
					<div class="progress-bar progress-bar-warning progress-bar-striped" style="width:<?php echo round($regional_orgs/$wp_wp_occupation*100,1); ?>%;background-color:#ff3333">
						<span title="<?php echo round($regional_orgs/$wp_wp_occupation*100,1); ?>% regional">
							<?php echo round($regional_orgs/$wp_wp_occupation*100,1); ?>% regional
						</span>
					</div>
					<div class="progress-bar progress-bar-danger" style="width:<?php echo round($national_orgs/$wp_wp_occupation*100,1); ?>%;background-color:#ff9933">
						<span title="<?php echo round($national_orgs/$wp_wp_occupation*100,1); ?>% national">
							<?php echo round($national_orgs/$wp_wp_occupation*100,1); ?>% national
						</span>
					</div>
				</div>
			</div>
			
			<?php echo '<div class="col-md-6"><h3>Type of organization <small>number of organizations (%)</small></h3>';
			echo '<div class="row"><div class="col-md-6 text-right"><p>Cooperative: ' . $coop_orgs. ' (' . round($coop_orgs/$wp_wp_occupation*100,1) .'%).</p>';
			echo '<p>Association: ' . $assoc_orgs. ' (' . round($assoc_orgs/$wp_wp_occupation*100,1) .'%).</p>';
			echo '<p>Trade Unions: ' . $tradeunions_orgs. ' (' . round($tradeunions_orgs/$wp_wp_occupation*100,1) .'%).</p>';
			echo '<p>Cooperative Federation: ' . $coopfed_orgs. ' (' . round($coopfed_orgs/$wp_wp_occupation*100,1) .'%).</p>';
			echo '<p>Self-help group: ' . $selfhelp_orgs. ' (' . round($selfhelp_orgs/$wp_wp_occupation*100,1) .'%).</p>';
			echo '<p>Non Governmental Organization: ' . $ngo_orgs. ' (' . round($ngo_orgs/$wp_wp_occupation*100,1) .'%).</p>';
			echo '<p><small>(total formed by waste pickers: ' . $wp_wp_occupation. ')</small></p>';
			echo '</div><div class="col-md-6">';?>
				<div class="progress">
					<div class="progress-bar" style="width:<?php echo round($coop_orgs/$wp_wp_occupation*100,1); ?>%;background-color:#99eeee;color:black">
						<span title="<?php echo round($coop_orgs/$wp_wp_occupation*100,1); ?>% Cooperative">
							<?php echo round($coop_orgs/$wp_wp_occupation*100,1); ?>% Cooperative
						</span>
					</div>
				</div>
				<div class="progress">
					<div class="progress-bar progress-bar-warning progress-bar-striped" style="width:<?php echo round($assoc_orgs/$wp_wp_occupation*100,1); ?>%;background-color:#99cc33">
						<span title="<?php echo round($assoc_orgs/$wp_wp_occupation*100,1); ?>% Association">
							<?php echo round($assoc_orgs/$wp_wp_occupation*100,1); ?>% Association
						</span>
					</div>
				</div>
				<div class="progress">
					<div class="progress-bar progress-bar-danger" style="width:<?php echo round($tradeunions_orgs/$wp_wp_occupation*100,1); ?>%;background-color:#003366">
						<span title="<?php echo round($tradeunions_orgs/$wp_wp_occupation*100,1); ?>% Trade Union">
							<?php echo round($tradeunions_orgs/$wp_wp_occupation*100,1); ?>% Trade Unions
						</span>
					</div>
				</div>
				<div class="progress">
					<div class="progress-bar progress-bar-danger" style="width:<?php echo round($coopfed_orgs/$wp_wp_occupation*100,1); ?>%;background-color:#339999">
						<span title="<?php echo round($coopfed_orgs/$wp_wp_occupation*100,1); ?>% Cooperative Federation">
							<?php echo round($coopfed_orgs/$wp_wp_occupation*100,1); ?>% Cooperative Federation
						</span>
					</div>
				</div>
				<div class="progress">
					<div class="progress-bar progress-bar-danger" style="width:<?php echo round($selfhelp_orgs/$wp_wp_occupation*100,1); ?>%;background-color:#996600">
						<span title="<?php echo round($selfhelp_orgs/$wp_wp_occupation*100,1); ?>% Self/help group">
							<?php echo round($selfhelp_orgs/$wp_wp_occupation*100,1); ?>% Self/help group
						</span>
					</div>
				</div>
				<div class="progress">
					<div class="progress-bar progress-bar-danger" style="width:<?php echo round($ngo_orgs/$wp_wp_occupation*100,1); ?>%;background-color:#609">
						<span title="<?php echo round($ngo_orgs/$wp_wp_occupation*100,1); ?>% Self/help group">
							<?php echo round($ngo_orgs/$wp_wp_occupation*100,1); ?>% NGO
						</span>
					</div>
				</div>
			<?php echo '</div></div>';
			?>
				<div class="progress">
					<div class="progress-bar" style="width:<?php echo round($coop_orgs/$wp_wp_occupation*100,1); ?>%;background-color:#99eeee;color:black">
						<span title="<?php echo round($coop_orgs/$wp_wp_occupation*100,1); ?>% Cooperative">
							<?php echo round($coop_orgs/$wp_wp_occupation*100,1); ?>% Cooperative
						</span>
					</div>
					<div class="progress-bar progress-bar-warning progress-bar-striped" style="width:<?php echo round($assoc_orgs/$wp_wp_occupation*100,1); ?>%;background-color:#99cc33">
						<span title="<?php echo round($assoc_orgs/$wp_wp_occupation*100,1); ?>% Association">
							<?php echo round($assoc_orgs/$wp_wp_occupation*100); ?>% Association
						</span>
					</div>
					<div class="progress-bar progress-bar-danger" style="width:<?php echo round($tradeunions_orgs/$wp_wp_occupation*100,1); ?>%;background-color:#003366">
						<span title="<?php echo round($tradeunions_orgs/$wp_wp_occupation*100,1); ?>% Trade Union">
							<?php echo round($tradeunions_orgs/$wp_wp_occupation*100); ?>% Trade Unions
						</span>
					</div>
					<div class="progress-bar progress-bar-danger" style="width:<?php echo round($coopfed_orgs/$wp_wp_occupation*100,1); ?>%;background-color:#339999">
						<span title="<?php echo round($coopfed_orgs/$wp_wp_occupation*100,1); ?>% Cooperative Federation">
							<?php echo round($coopfed_orgs/$wp_wp_occupation*100); ?>% Cooperative Federation
						</span>
					</div>
					<div class="progress-bar progress-bar-danger" style="width:<?php echo round($selfhelp_orgs/$wp_wp_occupation*100,1); ?>%;background-color:#996600">
						<span title="<?php echo round($selfhelp_orgs/$wp_wp_occupation*100,1); ?>% Self/help group">
							<?php echo round($selfhelp_orgs/$wp_wp_occupation*100); ?>% Self/help group
						</span>
					</div>
				</div>
			</div>
						
			<?php
			echo '</div>';
			echo '<div class="row">';
			echo '<div class="col-md-3"><h3>Country <small>number (%)</small></h3>';
			echo '<p>Brazil: ' . $wp_brazil . '  (' . calulate_percentage($wp_brazil,$wp_wp_occupation) .'%).</p>';
			echo '<p>India: ' . $wp_india . '  (' . calulate_percentage($wp_india,$wp_wp_occupation) .'%).</p>';
			//echo '<p>Bangladesh: ' . $wp_bangladesh . '  (' . calulate_percentage($wp_bangladesh,$wp_wp_occupation) .'%).</p>';
			echo '<p>Colombia: ' . $wp_colombia . '  (' . calulate_percentage($wp_colombia,$wp_wp_occupation) .'%).</p>';
			echo '<p>Kenya: ' . $wp_kenya . '  (' . calulate_percentage($wp_kenya,$wp_wp_occupation) .'%).</p>';
			echo '<p>South Africa: ' . $wp_south_africa . '  (' . calulate_percentage($wp_south_africa,$wp_wp_occupation) .'%).</p>';
			echo '<p>Ecuador: ' . $wp_ecuador . '  (' . calulate_percentage($wp_ecuador,$wp_wp_occupation) .'%).</p>';
			echo '<p>Venezuela: ' . $wp_venezuela . '  (' . calulate_percentage($wp_venezuela,$wp_wp_occupation) .'%).</p>';
			echo '<p>Peru: ' . $wp_peru . '  (' . calulate_percentage($wp_peru,$wp_wp_occupation) .'%).</p>';
			echo '<p>Dominican Republic: ' . $wp_dominican . '  (' . calulate_percentage($wp_dominican,$wp_wp_occupation) .'%).</p>';
			echo '<p><small>(total formed by waste pickers: ' . $wp_wp_occupation. ')</small></p>';
			echo '</div>';
			
			echo '<div class="col-md-5">';
			echo '<h3>Type of members <small>number of organizations (%)</small></h3>';
			echo '<p>Organizations with waste pickers as members: ' . $wp_waste_pickers. ' (' . round($wp_waste_pickers/$wp_wp_occupation*100,1) .'%).</p>';
			echo '<p>Organizations that have waste picker organizations: ' . $wp_orgs . ' (' . round($wp_orgs/$wp_wp_occupation*100,1) .'%).</p>';
			echo '<p>Waste picker support organization: ' . $wp_support . ' (' . round($wp_support/$wp_wp_occupation*100,1) .'%).</p>';
			echo '<p>Potential supporter: ' . $wp_potential . ' (' . round($wp_potential/$wp_wp_occupation*100,1) .'%).</p>';
			echo '<p><small>(total formed by waste pickers: ' . $wp_wp_occupation. ')</small></p>';
			echo '</div>';
			
			echo '<div class="col-md-4"><h3>Occupation of members<small>number of orgs (%)</small></h3>';
			echo '<p>Members are waste pickers: ' . $wp_wp_occupation. ' (' . round($wp_wp_occupation/$wp_wp_occupation*100,1) .'%).</p>';
			echo '<p>Members are waste collectors: ' . $wp_wc_occupation. ' (' . round($wp_wc_occupation/$wp_wp_occupation*100,1) .'%).</p>';
			echo '<p>Members are solid waste management: ' . $wp_swm_occupation. ' (' . round($wp_swm_occupation/$wp_wp_occupation*100,1) .'%).</p>';
			echo '<p>Members are scrap dealers: ' . $wp_sd_occupation. ' (' . round($wp_sd_occupation/$wp_wp_occupation*100,1) .'%).</p>';
			echo '<p><small>(total formed by waste pickers: ' . $wp_wp_occupation. ')</small></p>';
			echo '</div></div>';
			?>
			
			<div class="row">
				<div class="col-md-3">
					<h3>Year Formed</h3>
						<div class="row">
							<div class="col-md-4 text-right">
								<?php
								foreach ($yearformed as $year => $value) {
									echo '<p>'.$year.': '.$value.'</p>';
								}
						?>
							</div>
							<div class="col-md-8">
								<?php
								$max=0;
								foreach ($yearformed as $year => $value) {
									$max = max( array( $max, $value) ); //calculates max value
								}
								foreach ($yearformed as $year => $value) {
									?>
								<div class="progress">
									<div class="progress-bar" style="width:<?php echo 100*$value/$max; ?>%;background-color:#999;color:black">
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
					<h3>Year Registered</h3>
						<div class="row">
							<div class="col-md-4 text-right">
								<?php
								foreach ($yearregistered as $year => $value) {
									echo '<p>'.$year.': '.$value.'</p>';
								}
						?>
							</div>
							<div class="col-md-8">
								<?php
								foreach ($yearregistered as $year => $value) {
									?>
								<div class="progress">
									<div class="progress-bar" style="width:<?php echo 100*$value/$max; ?>%;background-color:#999;color:black">
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
					<h3>Materials collected <small>number of organizations</small></h3>
						<div class="row">
							<div class="col-md-5 text-right">
								<?php
								foreach ($materials as $material => $value) {
									echo '<p>'.$material.': '.$value.'</p>';
								}
						?>
							</div>
							<div class="col-md-7">
								<?php
								foreach ($materials as $material => $value) {
									?>
								<div class="progress">
									<div class="progress-bar" style="width:<?php echo 100*$value/$max_count_material; ?>%;background-color:#999;color:black">
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
					<h3>Activities <small>number of organizations</small></h3>
						<div class="row">
							<div class="col-md-6 text-right">
								<?php
								foreach ($activities as $key => $value) {
									echo '<p>'.$key.': '.$value.'</p>';
								}
						?>
							</div>
							<div class="col-md-4">
								<?php
								foreach ($activities as $key => $value) {
									?>
								<div class="progress">
									<div class="progress-bar" style="width:<?php echo 100*$value/$max_count_activity; ?>%;background-color:#999;color:black">
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
					<h3>Workplace of Members <small>number of organizations</small></h3>
						<div class="row">
							<div class="col-md-5 text-right">
								<?php
								foreach ($workplaces as $key => $value) {
									echo '<p>'.$key.': '.$value.'</p>';
								}
						?>
							</div>
							<div class="col-md-7">
								<?php
								foreach ($workplaces as $key => $value) {
									?>
								<div class="progress">
									<div class="progress-bar" style="width:<?php echo 100*$value/$max_count_workplace; ?>%;background-color:#999;color:black">
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
					<h3>What kind of relationship exists with the municipality? <small>number of organizations</small></h3>
						<div class="row">
							<div class="col-md-9 text-right">
								<?php
								foreach ($municipality_whats as $key => $value) {
									echo '<p>'.$key.': '.$value.'</p>';
								}
						?>
							</div>
							<div class="col-md-3">
								<?php
								foreach ($municipality_whats as $key => $value) {
									?>
								<div class="progress">
									<div class="progress-bar" style="width:<?php echo 100*$value/$max_count_municipality_what; ?>%;background-color:#999;color:black">
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
			<?php
			// set the meta_key to the appropriate custom field meta key
			$meta_key = '_wpg_number_individuals';
			$allwp = $wpdb->get_var( $wpdb->prepare("SELECT sum(meta_value) FROM $wpdb->postmeta WHERE meta_key = %s",$meta_key) );
			echo "<p>There are " .number_format($allwp). " 	waste pickers in waste picker organizations.</p>";
			?> 
</div>
<?php get_footer(); ?>
