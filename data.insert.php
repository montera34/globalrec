<?php
/*
Template Name: Insert data script
*/
$prefix_wpo = 'wpg-';

function print_r2($val){
        echo '<pre>';
        print_r($val);
        echo  '</pre>';
}

get_header();
		//$csv_filename = "http://localhost/globalrec/wp-content/themes/globalrec/insert/data.insert11-from-ods"; // name (no extension)
		$csv_filename = "http://globalrec.org/wp-content/themes/globalrec/insert/data.insert11-from-ods"; // name (no extension)
		//$csv_filename = get_stylesheet_directory(). "/dbimport/" .$filename; // relative path to data filename
		$line_length = "5024"; // max line lengh (increase in case you have longer lines than 1024 characters)
		$delimiter = ";"; // field delimiter character
		$enclosure = '"'; // field enclosure character

		// open the data file
		$fp = fopen($csv_filename.".csv",'r');
	
		// get data and store it in array
		if ( $fp !== FALSE ) { // if the file exists and is readable
	
			// data array generation
			$data = array();
			$line = 0;
			while ( ($fp_csv = fgetcsv($fp,$line_length,$delimiter,$enclosure)) !== FALSE ) { // begin main loop
				if ( $line == 0 ) {}
				else {
					// vars to do the inserts
					$tit = $fp_csv[0]; //title
					$org_email = $fp_csv[1]; // cf
					$website = $fp_csv[2]; // cf
					$physical_address = $fp_csv[3];// cf
					$postal_address = $fp_csv[4];// cf
					$city = $fp_csv[5]; // cf
					$region = $fp_csv[6]; // cf
					$country = $fp_csv[7]; // cf
					$ph_country_code = $fp_csv[8]; // cf
					$phone1 = $fp_csv[9]; // cf
					$phone2 = $fp_csv[10]; // cf
					$cell_phone = $fp_csv[11]; // cf
					$fax = $fp_csv[12]; // cf
					$skype = $fp_csv[13]; // cf
					$facebook = $fp_csv[14]; // cf
					$twitter = $fp_csv[15]; // cf
					$other_social_networks = $fp_csv[16]; // cf
					$language = explode(", ", strtolower($fp_csv[17])); // taxonomy
					$primary_contact_name = $fp_csv[18]; // cf
					$primary_contact_phone = $fp_csv[19]; // cf
					$primary_contact_position = $fp_csv[20]; // cf
					$primary_contact_email = $fp_csv[21]; // cf
					$secondary_contact_name = $fp_csv[22]; // cf
					$secondary_contact_phone = $fp_csv[23]; // cf
					$secondary_contact_email = $fp_csv[24]; // cf
					$members_type = explode(", ", strtolower($fp_csv[25])); //taxonomy
					$members_occupation = explode(", ", strtolower($fp_csv[26])); //taxonomy
					$organization_type = explode(", ", strtolower($fp_csv[27])); //taxonomy
					$organization_scope = explode(", ", strtolower($fp_csv[28])); //taxonomy
					$workplace_members = explode(", ", strtolower($fp_csv[29])); //taxonomy
					$membership = explode(", ", strtolower($fp_csv[30])); //taxonomy
					$number_groups = $fp_csv[31]; // cf
					$number_individuals = $fp_csv[32]; // cf
					$gender_women_composition = $fp_csv[33]; // cf
					$gender_women_comment = $fp_csv[34]; // cf
					$structure = $fp_csv[35]; // cf
					//$objectives = explode(", ", strtolower($fp_csv[36])); // cf
					$objectives = $fp_csv[36];
					$education_training = explode(", ", strtolower($fp_csv[37])); //taxonomy
					$formally_registered = $fp_csv[38]; // cf
					//$xxx = $fp_csv[39]; // cf
					$year_formed = $fp_csv[40]; // cf
					$registration_year = $fp_csv[41]; // cf
					$partnering_organizations = $fp_csv[42]; // cf
					$affiliations = explode(", ", strtolower($fp_csv[43])); //taxonomy TODO does it have to be taxonomy?
					$funding = explode(", ", strtolower($fp_csv[44])); //taxonomy
					$elections = $fp_csv[45]; // cf
					$member_benefits = explode(", ", strtolower($fp_csv[46])); // cf
					$credit_members = $fp_csv[47]; // cf
					$safety_technology = explode(", ", $fp_csv[48]); //taxonomy
					$relationship_municipality_how = explode(", ", strtolower($fp_csv[49])); //taxonomy
					$relationship_municipality_what = explode(", ", strtolower($fp_csv[50])); //taxonomy
					$types_of_materials = explode(", ", $fp_csv[51]); //taxonomy
					$middlemen = $fp_csv[52]; // cf
					$activities = explode(", ", strtolower($fp_csv[53])); //taxonomy
					$sorting_spaces = explode(", ", $fp_csv[54]); // cf
					$treatment_organic_materials = explode(", ", strtolower($fp_csv[55])); //taxonomy
					$challenges_access_waste = explode(", ", strtolower($fp_csv[56])); //taxonomy
					$content = $fp_csv[57]; // content
					$publications = $fp_csv[58]; // cf
					$information_source = $fp_csv[59]; // cf
					$date_data_entry = $fp_csv[60]; // cf
					$date_data_updated = $fp_csv[61]; // cf
					$status	 = $fp_csv[62]; // cf
						
						
					$fields = array(
						'_wpg_email' => $org_email,
						'_wpg_website' => $website,
						'_wpg_physical_address' => $physical_address,
						'_wpg_postal_address' => $postal_address,
						'city' => $city,
						'_wpg_region' => $region,
						'country' => $country,
						'_wpg_country_code_telephone' => $ph_country_code,
						'_wpg_phone1' => $phone1,
						'_wpg_phone2' => $phone2,
						'_wpg_cell_phone' => $cell_phone,
						'_wpg_fax' => $fax,
						'_wpg_skype' => $skype,
						'_wpg_facebook' => $facebook,
						'_wpg_twitter' => $twitter,
						'_wpg_other_social_networks' => $other_social_networks,
						'_wpg_primary_contact_name' => $primary_contact_name,
						'_wpg_primary_contact_phone' => $primary_contact_phone,
						'_wpg_primary_contact_position' => $primary_contact_position,
						'_wpg_primary_contact_email' => $primary_contact_email,
						'_wpg_secondary_contact_name' => $secondary_contact_name,
						'_wpg_secondary_contact_phone' => $secondary_contact_phone,
						'_wpg_secondary_contact_email' => $secondary_contact_email,
						//'_wpg_membership' => $membership,
						'_wpg_number_groups' => $number_groups,
						'_wpg_number_individuals' => $number_individuals,
						'_wpg_gender_women_composition' => $gender_women_composition,
						'_wpg_gender_women_comment' => $gender_women_comment,
						'_wpg_structure' => $structure,
						'_wpg_objectives' => $objectives,
						'_wpg_formally_registered' => $formally_registered,
						'_wpg_year_formed' => $year_formed,
						'_wpg_registration_year' => $registration_year,
						'_wpg_partnering_organizations' => $partnering_organizations,
						'_wpg_elections' => $elections,
						'_wpg_credit_members' => $credit_members,
						'_wpg_middlemen' => $middlemen,
						'_wpg_publications' => $publications,
						'_wpg_information_source' => $information_source,
						'_wpg_date_data_entry' => $date_data_entry,
						'_wpg_date_data_updated' => $date_data_updated,
						//'_wpg_status' => $status,
					);
					
					//when using multiple answer option
					/*$multicheck = array(
						'_wpg_language' => $language,
						'_wpg_members_type' => $members_type,
						'_wpg_members_occupation' => $members_occupation,
						'_wpg_organization_type' => $organization_type,
						'_wpg_organization_scope' => $organization_scope,
						'_wpg_workplace_members' => $workplace_members,
						'_wpg_education_training' => $education_training,
						'_wpg_affiliations' => $affiliations,
						'_wpg_funding' => $funding,
						'_wpg_member_benefits' => $member_benefits,
						'_wpg_safety_technology' => $safety_technology,
						'_wpg_relationship_municipality_how' => $relationship_municipality_how,
						'_wpg_relationship_municipality_what' => $relationship_municipality_what,
						'_wpg_types_of_materials' => $types_of_materials,
						'_wpg_activities' => $activities,
						'_wpg_sorting_spaces' => $sorting_spaces,
						'_wpg_treatment_organic_materials' => $treatment_organic_materials,
						'_wpg_challenges_access_waste' => $challenges_access_waste,
					);*/

					// prepare terms to insert if there are more than one
					$terms = array( //taxonomy => values
						$prefix_wpo . 'language' => $language,
						$prefix_wpo . 'member-type' => $members_type,
						$prefix_wpo . 'scope' => $organization_scope,
						$prefix_wpo . 'organization-type' => $organization_type,
						$prefix_wpo . 'member-occupation' => $members_occupation,
						$prefix_wpo . 'workplace-members' => $workplace_members,
						$prefix_wpo . 'membership' => $membership,
						$prefix_wpo . 'education-training' => $education_training,
						$prefix_wpo . 'affiliations' => $affiliations,
						$prefix_wpo . 'funding' => $funding,
						$prefix_wpo . 'member-benefits' => $member_benefits,
						$prefix_wpo . 'safety-technology' => $safety_technology,
						$prefix_wpo . 'municipality-how' => $relationship_municipality_how,
						$prefix_wpo . 'municipality-what' => $relationship_municipality_what,
						$prefix_wpo . 'material-type' => $types_of_materials,
						$prefix_wpo . 'activities' => $activities,
						$prefix_wpo . 'sorting-spaces' => $sorting_spaces,
						$prefix_wpo . 'treatment-organic-materials' => $treatment_organic_materials,
						$prefix_wpo . 'challenges-access-waste' => $challenges_access_waste,
						//$prefix_wpo . 'status' => $status, //TODO check if needed
					);

					// insert post
					$wpg = wp_insert_post(array(
						'post_type' => 'waste-picker-org',
						'post_status' => 'publish',
						'post_author' => 1,
						'post_title' => $tit,
						'post_content' => $content,
					));
					
					// get group id if already inserted
					$group = get_page_by_title( $tit, OBJECT, 'waste-picker-org' );
					$group_id = $group->ID;

					if ( $wpg != 0 ) {

						// insert custom fields
						reset($fields);
						// while ( $field = current($fields) ) {
						foreach ( $fields as $key => $value ) {
							if ($value != '') {
								add_post_meta($wpg, $key, $value, TRUE);
							}
						//	next($fields);
						}
						
						//insert multickech as array
						/*foreach ( $multicheck as $key => $value ) {
   							update_post_meta($wpg, $key, $value);
						}*/

						echo "
							<div>
								<h3>Waste Picker Organization " .$wpg. " is " .$tit. "</h3>
								<p>Group Insert ok</p>
							</div>
						";
												
						// insert terms in taxonomies
						foreach ( $terms as $taxonomy => $values ) { //$values might be string or array
							echo "0. Starting.<br/>";
							print_r2($terms);
							print_r2($values);
							foreach ( $values as $value ) {
								if ( $value == '' ) {
									echo "1. Empty value.<br/>";
								}	else if ( $value != '' ) {
									echo '1. Inserting value <strong>' .$value.'</strong><br/>';
									$term = term_exists( $value, $taxonomy ); // return the term ID or 0 if doesn't exist
									echo "The term_exists array: ";
									print_r2($term);
									$term_id = $term['term_id'];
									$term_taxonomy_id = $term['term_taxonomy_id'];
									echo "2. The term_id is <strong>" .$term_id. "</strong>; tax_id: ".$term_taxonomy_id.".  <br/>";
									if ( $term['term_id'] == 0 || $term['term_id'] == null ) { // if the term doesn't exist, then create it
										echo "3. Taxonomy term id didn't exist before<br/>";
										echo "value: ". $value ."; taxonomy: " .$taxonomy."<br/>";
										$new_term = wp_insert_term( $value, $taxonomy );
										//$term_id = $new_term['term_id'];
										//echo "4. Taxonomy term id inserted is " .$term_id."<br/>";
										echo "5. Taxonomy term inserted is " .$value."<br/>";
									}
								}
							}
	
							wp_set_object_terms( $group_id, $values, $taxonomy );
	
							echo  "	<p>Final. Terms inserted ok: ID = " .$term_id. "; value:";
							print_r2($values);
							echo ".</p>";
							echo "<hr>";
	
							next($terms);
						}
						
						/*
						while ( $term = current($terms) ) {
							if ( $term != '' ) { // if is not an empty value
								$term_id = term_exists( $term ); // return the term ID or 0 if doesn't exist
								if ( $term_id == 0 ) { // if the term doesn't exist, then create it
									$new_term = wp_insert_term( $term, key($terms) );
									$term_id = $new_term['term_id'];
								}
								wp_set_post_terms( $project_id, $term_id, key($terms) );
							}
							next($terms);
						}*/

					} // if project has been inserted

				} // end if not line 0
				$line++;
			}
			fclose($fp);

		} else {
			echo "<h2>Error</h2>
				<p>File with contents not found or not accesible.</p>
				<p>Check the path: " .$csv_filename. ". Maybe it has to be absolute...</p>";
		} // end if file exist and is readable

?>

<?php get_footer() ;?>
