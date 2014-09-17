<?php
/*
Template Name: Insert data script
*/
get_header();
		$csv_filename = "http://localhost/globalrec/wp-content/themes/globalrec/insert/data.insert5-from-ods"; // name (no extension)
		//$csv_filename = "http://globalrec.org/wp-content/themes/globalrec/insert/data.insert4"; // name (no extension)
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
					$language = explode(", ", $fp_csv[17]); // cf
					$primary_contact_name = $fp_csv[18]; // cf
					$primary_contact_phone = $fp_csv[19]; // cf
					$primary_contact_position = $fp_csv[20]; // cf
					$primary_contact_email = $fp_csv[21]; // cf
					$secondary_contact_name = $fp_csv[22]; // cf
					$secondary_contact_phone = $fp_csv[23]; // cf
					$secondary_contact_email = $fp_csv[24]; // cf
					$members_type = explode(", ", $fp_csv[25]);
					$members_occupation = explode(", ", $fp_csv[26]); // cf
					$organization_type = explode(", ", $fp_csv[27]); // cf
					$organization_scope = explode(", ", $fp_csv[28]); // cf
					$workplace_members = explode(", ", $fp_csv[29]); // cf
					$membership = $fp_csv[30]; // cf
					$number_groups = $fp_csv[31]; // cf
					$number_individuals = $fp_csv[32]; // cf
					$gender_women_composition = $fp_csv[33]; // cf
					$gender_women_comment = $fp_csv[34]; // cf
					$structure = $fp_csv[35]; // cf
					$objectives = explode(", ", $fp_csv[36]); // cf
					$education_training = explode(", ", $fp_csv[37]); // cf
					$formally_registered = $fp_csv[38]; // cf
					//$xxx = $fp_csv[39]; // cf
					$year_formed = $fp_csv[40]; // cf
					$registration_year = $fp_csv[41]; // cf
					$partnering_organizations = $fp_csv[42]; // cf
					$affiliations = explode(", ", $fp_csv[43]); // cf
					$funding = explode(", ", $fp_csv[44]); // cf
					$elections = $fp_csv[45]; // cf
					$member_benefits = explode(", ", $fp_csv[46]); // cf
					$credit_members = $fp_csv[47]; // cf
					$safety_technology = explode(", ", $fp_csv[48]); // cf
					$relationship_municipality = explode(", ", $fp_csv[49]); // cf
					$types_of_materials = explode(", ", $fp_csv[50]); // cf
					$middlemen = $fp_csv[51]; // cf
					$activities = explode(", ", $fp_csv[52]); // cf
					$sorting_spaces = explode(", ", $fp_csv[53]); // cf
					$treatment_organic_materials = explode(", ", $fp_csv[54]); // cf
					$challenges_access_waste = explode(", ", $fp_csv[55]); // cf
					$content = $fp_csv[56]; // content
					$publications = $fp_csv[57]; // cf
					$information_source = $fp_csv[58]; // cf
					$date_data_entry = $fp_csv[59]; // cf
					$date_data_updated = $fp_csv[60]; // cf
					$status	 = $fp_csv[61]; // cf
					/*if ( $excerpt == '' ) { 
						$excerpt == $content; 
						}*/
						
						
				//$members_type = explode(", ", $fp_csv[25]);

				$multicheck = array(
					 '_wpg_language' => $language,
					 '_wpg_members_type' => $members_type,
					 '_wpg_members_occupation' => $members_occupation,
				);

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
						'_wpg_twitter' => $twitter,
						'_wpg_other_social_networks' => $other_social_networks,
						//'_wpg_language' => $language,
						'_wpg_primary_contact_name' => $primary_contact_name,
						'_wpg_primary_contact_phone' => $primary_contact_phone,
						'_wpg_primary_contact_position' => $primary_contact_position,
						'_wpg_primary_contact_email' => $primary_contact_email,
						'_wpg_secondary_contact_name' => $secondary_contact_name,
						'_wpg_secondary_contact_phone' => $secondary_contact_phone,
						'_wpg_secondary_contact_email' => $secondary_contact_email,
						//'_wpg_members_type' => $members_type,
						//'_wpg_members_occupation' => $members_occupation,
						//'_wpg_organization_type' => $organization_type,
						//'_wpg_organization_scope' => $organization_scope,
						//'_wpg_workplace_members' => $workplace_members,
						'_wpg_membership' => $membership,
						'_wpg_number_groups' => $number_groups,
						'_wpg_number_individuals' => $number_individuals,
						'_wpg_gender_women_composition' => $gender_women_composition,
						'_wpg_gender_women_comment' => $gender_women_comment,
						'_wpg_structure' => $structure,
						//'_wpg_objectives' => $objectives,
						//'_wpg_education_training' => $education_training,
						'_wpg_formally_registered' => $formally_registered,
						'_wpg_year_formed' => $year_formed,
						'_wpg_registration_year' => $registration_year,
						'_wpg_partnering_organizations' => $partnering_organizations,
						//'_wpg_affiliations' => $affiliations,
						//'_wpg_funding' => $funding,
						'_wpg_elections' => $elections,
						//'_wpg_member_benefits' => $member_benefits,
						'_wpg_credit_members' => $credit_members,
						//'_wpg_safety_technology' => $safety_technology,
						//'_wpg_relationship_municipality' => $relationship_municipality,
						//'_wpg_types_of_materials' => $types_of_materials,
						'_wpg_middlemen' => $middlemen,
						//'_wpg_activities' => $activities,
						//'_wpg_sorting_spaces' => $sorting_spaces,
						//'_wpg_treatment_organic_materials' => $treatment_organic_materials,
						//'_wpg_challenges_access_waste' => $challenges_access_waste,
						'_wpg_publications' => $publications,
						'_wpg_information_source' => $information_source,
						'_wpg_date_data_entry' => $date_data_entry,
						'_wpg_date_data_updated' => $date_data_updated,
						'_wpg_status' => $status,
					);
					
					//when using multiple answer option
					$multicheck = array(
						'_wpg_language' => $language,
						'_wpg_members_type' => $members_type,
						'_wpg_members_occupation' => $members_occupation,
						'_wpg_organization_type' => $organization_type,
						'_wpg_organization_scope' => $organization_scope,
						'_wpg_workplace_members' => $workplace_members,
						'_wpg_objectives' => $objectives,
						'_wpg_education_training' => $education_training,
						'_wpg_affiliations' => $affiliations,
						'_wpg_funding' => $funding,
						'_wpg_member_benefits' => $member_benefits,
						'_wpg_safety_technology' => $safety_technology,
						'_wpg_relationship_municipality' => $relationship_municipality,
						'_wpg_types_of_materials' => $types_of_materials,
						'_wpg_activities' => $activities,
						'_wpg_sorting_spaces' => $sorting_spaces,
						'_wpg_treatment_organic_materials' => $treatment_organic_materials,
						'_wpg_challenges_access_waste' => $challenges_access_waste,
					);

					// insert post
					$wpg = wp_insert_post(array(
						'post_type' => 'waste-picker-group',
						'post_status' => 'publish',
						'post_author' => 1,
						'post_title' => $tit,
						'post_content' => $content,
					));

					if ( $wpg != 0 ) {

						// insert custom fields
						reset($fields);
						// while ( $field = current($fields) ) {
						foreach ( $fields as $key => $value ) {
							add_post_meta($wpg, $key, $value, TRUE);
						//	next($fields);
						}
						
						foreach ( $multicheck as $key => $value ) {
							update_post_meta($wpg, $key, $value);
						}
					} // if project has been inserted
					echo "
							<div>
								<h2>Waste Picker Group " .$wpg. "</h2>
								<p>Insert ok</p>
							</div>
						";
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
