<?php  /* Template Name: Waste Picker Groups Stats*/ 
get_header(); ?>
<div id="page-wpg">
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
			$count_wpo = wp_count_posts( 'waste-picker-group' )->publish;
			global $wpdb;
			//$wastepickers = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->postmeta WHERE meta_value = 'Members are Waste Pickers';");
			//$wastepickers_orgs = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->postmeta WHERE meta_value = 'Members are Waste Picker Organisations';");
			//$orgs_india = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->postmeta WHERE meta_value = 'India';");//AND meta_key = 'country' ??
			
			$wp_waste_pickers = get_number_posts_in_taxonomy ('wpg-member-type','members are waste pickers');
			$wp_orgs = get_number_posts_in_taxonomy ('wpg-member-type','members are waste picker organizations');
			$wp_support = get_number_posts_in_taxonomy ('wpg-member-type','waste picker support organization');
			$wp_potential = get_number_posts_in_taxonomy ('wpg-member-type','potential supporters');
			
			$wp_wp_occupation = get_number_posts ('_wpg_members_occupation','waste pickers');
			$wp_swm_occupation = get_number_posts ('_wpg_members_occupation','solid waste management');
			$wp_wc_occupation = get_number_posts ('_wpg_members_occupation','waste collectors');
			$wp_sd_occupation = get_number_posts ('_wpg_members_occupation','scrap dealers');
			
			$local_orgs = get_number_posts_in_taxonomy ('wpg-scope','local');
			$regional_orgs = get_number_posts_in_taxonomy ('wpg-scope','regional');
			$national_orgs = get_number_posts_in_taxonomy ('wpg-scope','national');
			$international_orgs = get_number_posts_in_taxonomy ('wpg-scope','international');
			
			$tradeunions_orgs = get_number_posts_in_taxonomy ('wpg-organization-type','trade Union');
			$wpg_orgs = get_number_posts_in_taxonomy ('wpg-organization-type','waste picker group');
			$ngo_orgs = get_number_posts_in_taxonomy ('wpg-organization-type','non governmental organization');
			$coop_orgs = get_number_posts_in_taxonomy ('wpg-organization-type','cooperative-2');
			$coopfed_orgs = get_number_posts_in_taxonomy ('wpg-organization-type','federation of cooperatives');
			$assoc_orgs = get_number_posts_in_taxonomy ('wpg-organization-type','association');
			$selfhelp_orgs = get_number_posts_in_taxonomy ('wpg-organization-type','self-help group');
			
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
			
			echo '<p>Number of organizations in the data base: ' .$count_wpo. '.</p></div></div>';
			echo '<p>Number of organizations that are formed by waste pickers: ' .$wp_wp_occupation. ' (waste pickers selcted as member occupation)</p>.';
			
			echo '<div class="row" id="waw-stats">';
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
			echo '<p>Self/help group: ' . $selfhelp_orgs. ' (' . round($selfhelp_orgs/$wp_wp_occupation*100,1) .'%).</p>';
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
			echo '<p>Organizations with waste pickers as members: ' . $wp_waste_pickers. ' (' . round($wp_waste_pickers/$count_wpo*100,1) .'%).</p>';
			echo '<p>Organizations that have waste picker organizations: ' . $wp_orgs . ' (' . round($wp_orgs/$count_wpo*100,1) .'%).</p>';
			echo '<p>Waste picker support organization: ' . $wp_support . ' (' . round($wp_support/$count_wpo*100,1) .'%).</p>';
			echo '<p>Potential supporters organizations: ' . $wp_potential . ' (' . round($wp_potential/$count_wpo*100,1) .'%).</p>';
			echo '</div>';
			
			echo '<div class="col-md-4"><h3>Members\' occupation <small>number of orgs (%)</small></h3>';
			echo '<p>Members are waste pickers: ' . $wp_wp_occupation. ' (' . round($wp_wp_occupation/$count_wpo*100,1) .'%).</p>';
			echo '<p>Members are waste collectors: ' . $wp_wc_occupation. ' (' . round($wp_wc_occupation/$count_wpo*100,1) .'%).</p>';
			echo '<p>Members are solid waste management: ' . $wp_swm_occupation. ' (' . round($wp_swm_occupation/$count_wpo*100,1) .'%).</p>';
			echo '<p>Members are scrap dealers: ' . $wp_sd_occupation. ' (' . round($wp_sd_occupation/$count_wpo*100,1) .'%).</p>';
			echo '</div></div>';
			?>
			
			<?php
			// set the meta_key to the appropriate custom field meta key
			$meta_key = '_wpg_number_individuals';
			$allwp = $wpdb->get_var( $wpdb->prepare("SELECT sum(meta_value) FROM $wpdb->postmeta WHERE meta_key = %s",$meta_key) );
			echo "<p>There are " .number_format($allwp). " of waste pickers in waste picker organizations.</p>";
			?> 
</div>
<?php get_footer(); ?>
