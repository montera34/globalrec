<?php get_header(); 
$post_id = $post->ID;
$website = get_post_meta( $post_id, '_wpg_website', true );
$city_id = get_post_meta( $post_id, '_wpg_cityselect', true );
$reltag = get_post_meta($post_id, 'gm_tag', true);
$reltit = '<h4>'.__('At','globalrec').' GlobalRec.org</h4>';
$relposts = ( $reltag == '' ) ? '' : $reltit.globalrec_related_posts($reltag,$post_id,'post',10);
?>

<div>
	<?php get_template_part( 'nav', 'waw' ); ?>
	<div class="row">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div <?php post_class("col-md-9") ?> id="post-<?php the_ID(); ?>">
			<ul class="breadcrumb">
			  <li><a href="<?php echo get_permalink(icl_object_id( 10909 ,'page')) ?>"><?php _e('Waste pickers Around the World (WAW)','globalrec'); ?></a></li>
			  <li><a href="<?php echo get_permalink(icl_object_id( 30757 ,'page')) ?>"><?php _e('Organizations','globalrec'); ?></a></li>
			  <li><?php the_title(); ?> </li>
			</ul>
			<div class="row">
				<div class="col-md-12">
					<?php the_post_thumbnail( 'medium', array('class' => 'img-responsive'));?>
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
						//City
						$city_id = get_post_meta( $post_id, '_wpg_cityselect', true );
						$city = get_post($city_id);
						$city2 = get_post_meta( $post_id, 'city', true );
						$city2_slug = strtolower (str_replace(" ","-",$city2));
						$city_link = get_permalink($city->ID);
						$city_name = $city->post_title;
						
						if (!empty($city2)) {
								echo '<a href="/city/'.$city2_slug.'">'.$city2.'</a>, ';
							}
						//Region
						$region = get_post_meta( $post_id, '_wpg_region', true );
						if ($region != '') {echo $region. ", ";}
						
						//Country
						$country_id = get_post_meta( $post_id, '_wpg_countryselect', true ); // gets id of country, from the selected dropdown menu
						$country = get_post($country_id); // gets country
						$country2 =get_post_meta( $post_id, 'country', true ); // gets country name from custom field
						$country2_slug = strtolower (str_replace(" ","-",$country2)); // replaces space in name with "-"
						$country_link = get_permalink($post_id); // gets permalink of country, is it used??
						$country_name = $country->post_title; // gets name of country from dropdown menu
						if ($country != '') { //displays the country from the selection list '_wpg_countryselect', if it has been selected, if not it displays the country from the open field '_wpg_city'
							if (($country_name == 'Not specified') || ($country_name == '-')) {//if the "not specified" option is selected. The default option is "-"
								echo $country2;
							} else {//if a country has been selected
								echo '<a href="/country/'.$country2_slug.'">'.$country2.'</a>';
							}
						} else {
						echo get_post_meta( $post_id, 'country', true );
						} ?>
					</h4>
						<?php
							$remove_this = array("http://","https://","www.");
							$mainurl_stripped = str_replace($remove_this, "", $website);
							$max_length = 40;
							if ( strlen($mainurl_stripped) > $max_length ) {
								$mainurl_stripped = substr($mainurl_stripped,0,$max_length).'...';
							}
					 		echo ($website != '') ? "<a href='" .$website. "'>Website: " .$mainurl_stripped. " <span class='glyphicon glyphicon-new-window'></span></a>" : '';?>
							<h3><span class="glyphicon glyphicon-list-alt"></span> <?php _e('Primary information','globalrec'); ?></h3>
							<dl class="dl-horizontal">
								<?php //Primary information
								echo display_item($post_id,'_wpg_year_formed','Year formed');
								echo display_item($post_id,'_wpg_registration_year','Registered in');
								echo display_item($post_id,'_wpg_formally_registered','Formally registered');
								echo list_taxonomy_terms($post_id,'wpg-language','Language');
								echo display_item($post_id,'_wpg_number_groups','Number of groups');
								echo display_item_number($post_id,'_wpg_number_individuals','Number of members'); 
								echo list_taxonomy_terms($post_id,'wpg-member-type','Type of members');
								echo list_taxonomy_terms($post_id,'wpg-member-occupation','Occupation of members');
								echo list_taxonomy_terms($post_id,'wpg-organization-type','Type of Organization');
								echo list_taxonomy_terms($post_id,'wpg-scope','Organizational Reach');
								echo list_of_items($post_id,'_wpg_workplace_members','Workplace of members');
								echo list_taxonomy_terms($post_id,'wpg-workplace-members','Workplace of members');
								echo list_taxonomy_terms($post_id,'wpg-membership','Membership');
								echo display_item($post_id,'_wpg_structure','Organization Structure');
								echo display_item($post_id,'_wpg_objectives','Objectives');
								echo list_taxonomy_terms($post_id,'wpg-education-training','Education and training');
								echo display_item($post_id,'_wpg_partnering_organizations','Partnering organizations');
								echo list_taxonomy_terms($post_id,'wpg-affiliations','Affiliations');
								echo list_taxonomy_terms($post_id,'wpg-funding','Funding');
								echo display_item($post_id,'_wpg_elections','Internal elections');
								
								$number_individuals = get_post_meta( $post_id, '_wpg_number_individuals', true );
								$women_composition = get_post_meta( $post_id, '_wpg_gender_women_composition', true );
								$women_composition_comment =	get_post_meta( $post_id, '_wpg_gender_women_comment', true );
								
								if (($women_composition != '') && ($number_individuals != '')) {
									echo "<dt>". __('Women composition','globalrec')."</dt><dd>".number_format(100*$women_composition/$number_individuals, 1, ',', '.')."% ";
									echo $women_composition_comment =! '' ? "<small>" .$women_composition_comment. "</small>" : "";
									echo "</dd>";
								} else {
								 	echo "<dt>". __('Women composition','globalrec'). "</dt><dd><small>" .$women_composition_comment. "</small></dd>";
								}
								?>
							</dl>
							<hr>
							<h3><span class="glyphicon glyphicon-bullhorn"></span> <?php _e('Social networking sites','globalrec'); ?></h3>
								<p>
								<?php //contact information
								$facebook = get_post_meta( $post_id, '_wpg_facebook', true );
								$twitter = get_post_meta( $post_id, '_wpg_twitter', true );
								echo $facebook ? "<a href='".$facebook. "'><span class='dashicons dashicons-facebook-alt'></span> Facebook</a><br>" : '';
								echo $twitter ? "<a href='http://twitter.com/".$twitter."' title='Twitter user @".$twitter."'><span class='dashicons dashicons-twitter'></span> Twitter</a><br>" : '';
								echo get_post_meta( $post_id, '_wpg_other-social-networks', true ); ?>
								</p>
							<hr>
							<h3><span class="glyphicon glyphicon-heart"></span> <?php _e('Benefits','globalrec'); ?></h3>
							<dl>
								<?php //Benefits
								echo list_taxonomy_terms($post_id,'wpg-member-benefits','Member benefits');
								echo display_item($post_id,'_wpg_credit_members','Number of credit / saving members?');
								echo list_taxonomy_terms($post_id,'wpg-safety-technology','Safety & Technology');
								?>
							</dl>
							<hr>
							<h3><span class="glyphicon glyphicon-wrench"></span> <?php _e('Services','globalrec'); ?></h3>
							<dl>
								<?php	//Services
								echo list_taxonomy_terms($post_id,'wpg-municipality-what','What kind of relationship exists with the municipality?');
								echo list_taxonomy_terms($post_id,'wpg-municipality-how','How is the relationship with the municipality?');
								echo list_taxonomy_terms($post_id,'wpg-material-type','Types of materials');
								echo display_item($post_id,'_wpg_middlemen','Are they selling to middlemen?');
								echo list_taxonomy_terms($post_id,'wpg-activities','Activities');
								echo list_taxonomy_terms($post_id,'wpg-sorting-spaces','Sorting Spaces');
								echo list_taxonomy_terms($post_id,'wpg-treatment-organic-materials','Treatmet of organic materials');
								echo list_taxonomy_terms($post_id,'wpg-challenges-access-waste','Challenges to access waste');
								?>
							</dl>
						</div>
				</div>
				<div class="row">
					<hr>
					<div class="col-md-9">
						<h3><span class="glyphicon glyphicon-file"></span> <?php _e('Complementary Information','globalrec'); ?></h3>
							<dl>
								<?php	//Complementary information
								echo display_item($post_id,'_wpg_publications','Other publications');
								echo "<dt>". __('Information source','globalrec')."</dt><dd>".get_post_meta( $post_id, '_wpg_information_source', true ). "</dd>";
								//echo "<dt>Date of data entry</dt><dd>". get_post_meta( $post_id, '_wpg_date_data-entry', true ). "</dd>";
								//echo "<dt>Date of data update</dt><dd>". get_post_meta( $post_id, '_wpg_date_data_updated', true ). "</dd>";
								echo display_item($post_id,'_wpg_status','Active');
								?>
							</dl>
						<hr>
						<h3><?php _e('Comments / Narrative','globalrec'); ?></h3>
						<?php the_content(__('(more...)')); ?>
						<hr>
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4><span class="glyphicon glyphicon-lock"></span> <span class="glyphicon glyphicon-envelope"></span> <?php _e('Contact information','globalrec'); ?></h4>
							</div>
							<div class="panel-body">
							
							<?php if ( is_user_logged_in() ) { //Only display this information if user is logged in ?>
								<dl class="dl-horizontal">
								<?php
									echo "<dt>Skype</dt><dd>".get_post_meta( $post_id, '_wpg_skype', true ). "</dd>";
									echo "<dt>Email</dt><dd>".get_post_meta( $post_id, '_wpg_email', true ). "</dd>";
									echo "<dt>Physical Adress</dt><dd>".get_post_meta( $post_id, '_wpg_physical_address', true ). "</dd>";
									echo "<dt>Postal Adress</dt><dd>".get_post_meta( $post_id, '_wpg_postal_address', true ). "</dd>";
									// echo get_post_meta( $post_id, '_wpg_country-code-telephone', true ). "</dd>";
									echo "<dt>Phone 1</dt><dd>". get_post_meta( $post_id, '_wpg_phone1', true ). "</dd>";
									echo "<dt>Phone 2</dt><dd>".get_post_meta( $post_id, '_wpg_phone2', true ). "</dd>";
									echo "<dt>Cellphone</dt><dd>".get_post_meta( $post_id, '_wpg_cell_phone', true ). "</dd>";
									echo "<dt>Fax</dt><dd>".get_post_meta( $post_id, '_wpg_fax', true ). "</dd>";
									echo "<dt>Primary contact</dt><dd>".get_post_meta( $post_id, '_wpg_primary_contact_name', true ). "</dd>";
									echo "<dt>position</dt><dd>".get_post_meta( $post_id, '_wpg_primary_contact_position', true ). "</dd>";
									echo "<dt>phone</dt><dd>".get_post_meta( $post_id, '_wpg_primary_contact_phone', true ). "</dd>";
									echo "<dt>email</dt><dd>".get_post_meta( $post_id, '_wpg_primary_contact_email', true ). "</dd>";
									echo "<dt>Secondary contact</dt><dd>".get_post_meta( $post_id, '_wpg_secondary_contact_name', true ). "</dd>";
									echo "<dt>phone </dt><dd>".get_post_meta( $post_id, '_wpg_secondary_contact_phone', true ). "</dd>";
									echo "<dt>email</dt><dd>".get_post_meta( $post_id, '_wpg_secondary_contact_email', true ). "</dd>";
								?>
								</dl>
								<?php	} else {
									echo '<a href="/contact">';
									_e('Available information upon request','globalrec');
									echo '.</a>';
								} ?>
							</div>
						</div> <!-- close panel -->
					</div>
				</div><!-- close col-md-9 complementary info -->
			</div><!-- close col-md-9 left column -->
		<!--right column -->
		<div class="col-md-3">
			<h3 class="document-dashicon">
				<?php _e('Last updates from','globalrec'); ?> <?php the_title_attribute(); ?>
			</h3>
			<?php // related posts
			echo  $relposts;  ?>
					<?php $web_feed = get_post_meta( $post_id, '_wpg_rss', true );
					if ( !empty($web_feed) ) { //if a feed/rss is indicated	?>
					<h4>
						<?php _e('At','globalrec'); ?> <?php _e("organization's website","globalrec"); ?>
					</h4>
					<?php // Get RSS Feed(s). Code retrieved from http://codex.wordpress.org/Function_Reference/fetch_feed
					include_once( ABSPATH . WPINC . '/feed.php' );
						// Get a SimplePie feed object from the specified feed source
						$rss = fetch_feed( $web_feed );
						$maxitems = 0;
						if ( ! is_wp_error( $rss ) ) : // Checks that the object is created correctly
							// Figure out how many total items there are, but limit it to 5.
							$maxitems = $rss->get_item_quantity( 5 );
							// Build an array of all the items, starting with element 0 (first element).
							$rss_items = $rss->get_items( 0, $maxitems );
					endif;
					?>
					<div class="list-group">
						<?php if ( $maxitems == 0 ) : ?>
							<?php _e( 'No items', 'globlarec' ); ?>
						<?php else : ?>
							<?php // Loop through each feed item and display each item as a hyperlink. ?>
							<?php foreach ( $rss_items as $item ) : ?>
								<a href="<?php echo esc_url( $item->get_permalink() ); ?>" class="list-group-item"
								title="<?php printf( __( 'Posted %s', 'voragine.net' ), $item->get_date('j F Y | g:i a') ); ?>">
								<?php echo esc_html( $item->get_title() ); ?>
								</a>
							<?php endforeach; ?>
						<?php endif; ?>
					</div>
			<?php } ?>
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
