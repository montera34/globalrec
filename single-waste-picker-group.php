<?php get_header(); 
$post_id = $post->ID;
$website = get_post_meta( $post_id, '_wpg_website', true );
$city_id = get_post_meta( $post_id, '_wpg_cityselect', true );
?>

<div class="container">
	<div class="row">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div <?php post_class("col-md-10") ?> id="post-<?php the_ID(); ?>">
			<ul class="breadcrumb">
			  <li><a href="/waste-picker-groups/">Waste Picker Groups</a></li>
			  <li><?php the_title(); ?> </li>
			</ul>
			<div class="row">
				<div class="col-md-3">
					<?php the_post_thumbnail( 'medium', array('class' => 'img-responsive'));?>
						<?php
						echo "<a href='".get_post_meta( $post_id, '_wpg_facebook', true ). "'>Facebook</a> ";
						echo "<a href='http://twitter.com/".get_post_meta( $post_id, '_wpg_twitter', true )."' title='Twitter user @".get_post_meta( $post_id, '_wpg_twitter', true )."'>Twitter</a><br>";
						echo get_post_meta( $post_id, '_wpg_other-social-networks', true ). "<br>"; ?>
						<?php if ( is_user_logged_in() ) { //Only display this information if user is logged in?>
						<h4> Contact information</h4>
						<dl>
						<?php 
							echo "<dt>Skype</dt><dd>".get_post_meta( $post_id, '_wpg_skype', true ). "</dd>";
							echo "<dt>Email</dt><dd>".get_post_meta( $post_id, '_wpg_email', true ). "</dd>";
							echo "<dt>Physycal Adress</dt><dd>".get_post_meta( $post_id, '_wpg_physical-address', true ). "</dd>";
							echo "<dt>Postal Adress</dt><dd>".get_post_meta( $post_id, '_wpg_postal-adress', true ). "</dd>";
							echo get_post_meta( $post_id, '_wpg_country-code-telephone', true ). "</dd>";
							echo "<dt>Phone 1</dt><dd>". get_post_meta( $post_id, '_wpg_phone1', true ). "</dd>";
							echo "<dt>Phone 2</dt><dd>".get_post_meta( $post_id, '_wpg_phone2', true ). "</dd>";
							echo "<dt>Cellphone</dt><dd>".get_post_meta( $post_id, '_wpg_cell-phone', true ). "</dd>";
							echo "<dt>Fax</dt><dd>".get_post_meta( $post_id, '_wpg_fax', true ). "</dd>";
							echo "<dt>Primary contact</dt><dd>".get_post_meta( $post_id, '_wpg_primary-contact', true ). "</dd>";
							echo "<dt>Secondary contact</dt><dd>".get_post_meta( $post_id, '_wpg_secondary-contact', true ). "</dd>";
						?>
							</dl>
						<?php	} ?>
				</div>
				<div class="col-md-9">
					<h1> 
						<a href="<?php echo $website; ?>" rel="bookmark" title="<?php the_title_attribute( array( 'before' => 'Go to ', 'after' => ' Website' ) ); ?>">
							<?php the_title_attribute(); ?>
						</a>	
					</h1>
					<?php if ( is_user_logged_in() ) { 
						echo '<div class="btn btn-sm btn-default pull-right">';
						edit_post_link(__('Edit This')); 
						echo "</div>";
						} ?>
					<h4>
						<?php	//location
						$city = get_post($city_id);
						$city_link = get_permalink($city->ID);
						$city_name = $city->post_title;
						if ($city_name != 'Not specified' || city == '') { //displays the city from the selection list '_wpg_cityselect', if it has been selected, if not it displays the city from the open field '_wpg_city'
						echo '<a href="'.$city_link.'">'.$city_name.'</a>, ';
						} else {
							echo get_post_meta( $post_id, '_wpg_city', true ). ", ";
						}
						
						echo get_post_meta( $post_id, '_wpg_region', true ). ", "
						. get_post_meta( $post_id, '_wpg_country', true ); ?>
					</h4>	
						<?php echo "<a href='".$website. "'>Website</a><br>"; ?>
					<div class="row">
						<div class="col-md-6">
							<h4>Primary information</h4>
							<dl class="dl-horizontal">
								<?php //Primary information
								echo "<dt>Year formed</dt><dd>".get_post_meta( $post_id, '_wpg_year-formed', true )
								. " (registered in: ".get_post_meta( $post_id, '_wpg_registration-year', true ).")"
								. " ". get_post_meta( $post_id, '_wpg_formally-registred', true )."</dd>";
								echo "<dt>Language</dt>"; echo list_of_items($post_id,'_wpg_language');
								echo "<dt>Type of members</dt><dd>".get_post_meta( $post_id, '_wpg_members-type', true ). "</dd>";
								echo "<dt>Members' occupation</dt>"; echo list_of_items($post_id,'_wpg_members-occupation');
								echo "<dt>Organization type</dt><dd>". get_post_meta( $post_id, '_wpg_organization-type', true ). "</dd>";
								echo "<dt>Organization scope</dt><dd>". get_post_meta( $post_id, '_wpg_organization-scope', true ). "</dd>";
								echo "<dt>Workplace of members</dt>"; echo list_of_items($post_id,'_wpg_workplace-members');
								echo "<dt>Membership</dt><dd>".get_post_meta( $post_id, '_wpg_membership', true )."</dd>";
								echo "<dt>Organization Structure</dt><dd>".get_post_meta( $post_id, '_wpg_structure', true )."</dd>";
								echo "<dt>Objectives</dt>"; echo list_of_items($post_id,'_wpg_objectives');
								echo "<dt>Education and training</dt>"; echo list_of_items($post_id,'_wpg_education-training');
								echo "<dt>Partnering organizations</dt><dd>".get_post_meta( $post_id, '_wpg_partnering-organizations', true ). "</dd>";
								echo "<dt>Affiliations</dt><dd>".get_post_meta( $post_id, '_wpg_affiliations', true ). "</dd>";
								echo "<dt>Funding</dt><dd>".get_post_meta( $post_id, '_wpg_funding', true ). "</dd>";
								echo "<dt>Internal elections</dt><dd>".get_post_meta( $post_id, '_wpg_elections', true ). "</dd>";
								echo "<dt>Number of groups</dt><dd>".get_post_meta( $post_id, '_wpg_number-groups', true ). "</dd>";
								echo "<dt>Number of members</dt><dd>".get_post_meta( $post_id, '_wpg_number-individuals', true ). "</dd>";
								echo "<dt>Women composition</dt><dd>".get_post_meta( $post_id, '_wpg_gender-women-composition', true )."%"
										.get_post_meta( $post_id, '_wpg_gender-women-comment', true ). "</dd>"; //used when no % data are available
									
									?> 
							</dl>
						</div>
						<div class="col-md-6">
							<h4>Benefits</h4>
							<dl>
								<?php //Benefits 
								echo "<dt>Member benefits</dt>"; echo list_of_items($post_id,'_wpg_member-benefits');
								echo "<dt>Number of credit / saving members?</dt><dd>".get_post_meta( $post_id, '_wpg_credit-members', true ). "</dd>";
								echo "<dt><dt>Safety & Technology</dt><dd>".get_post_meta( $post_id, '_wpg_safety-technology', true ). "</dd>";
								?> 
							</dl>
							<h4>Services</h4>
							<dl>
								<?php	//Services
								echo "<dt>Relationship with the Municipality</dt><dd>".get_post_meta( $post_id, '_wpg_relationship-municipality', true ). "</dd>";
								echo "<dt>Types of materials</dt>"; echo list_of_items($post_id,'_wpg_types-of-materials');
								echo "<dt>Are they selling to middlemen</dt><dd>".get_post_meta( $post_id, '_wpg_middlemen', true ). "</dd>";
								echo "<dt>Activities</dt>"; echo list_of_items($post_id,'_wpg_activities');
								echo "<dt>Sorting Spaces</dt>"; echo list_of_items($post_id,'_wpg_sorting-spaces');
								echo "<dt>Treatmet of orgnanic materials</dt>"; echo list_of_items($post_id,'_wpg_treatment-organic-materials');
								echo "<dt>Challenges to access waste</dt>"; echo list_of_items($post_id,'_wpg_challenges-access-waste');
								?> 
							</dl>
						</div>
					</div>				
					<hr>
					<h4>Complementary Information</h4>
						<dl>
							<?php	//Complementary information
							echo "<dt>Other publications</dt><dd>".get_post_meta( $post_id, '_wpg_publications', true ). "</dd>";
							echo "<dt>Information Source</dt><dd>".get_post_meta( $post_id, '_wpg_information-source', true ). "</dd>";
							echo "<dt>Date of data entry</dt><dd>". get_post_meta( $post_id, '_wpg_date-data-entry', true ). "</dd>";
							echo "<dt>Date of data update</dt><dd>". get_post_meta( $post_id, '_wpg_date-data-updated', true ). "</dd>";
							echo "<dt>Active</dt><dd>".get_post_meta( $post_id, '_wpg_status', true );
							?>
						</dl>
					<h4>Comments / Narrative</h4>
					<?php the_content(__('(more...)')); ?>
				</div>
			</div>		
		</div>
		<!--right column -->
		<div class="col-md-2"> 
			<h4>News related to <?php the_title_attribute(); ?></h4>
			<?php if (get_post_meta($post_id, 'gm_tag', true)) { echo '<h4>Related posts</h4>';} ?>
			<?php 
			//includes the loop with the related post according to the custom field gm-tag
			echo  get_template_part( 'related', 'postbytag'); //includes the file related-postbytag.php ?>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12"> 
			<?php include("share.php")?>
		</div>
		<?php endwhile; else: ?>
		<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
		<?php endif; ?>
 		</div>
	</div>	
		
	
	<?php get_footer(); ?>
</div><!-- #container -->
