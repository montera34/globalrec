<?php
/*
Template Name: Insert data script
*/
get_header();

		//$csv_filename = "insert/data.insert"; // name (no extension)
		$csv_filename = get_stylesheet_directory(). "/insert/data.insert"; // relative path to data filename
		$line_length = "4096"; // max line lengh (increase in case you have longer lines than 1024 characters)
		$delimiter = ","; // field delimiter character
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
					$tit = $fp_csv[0];
					$excerpt = $fp_csv[1];
					$type = $fp_csv[2]; //term
					$subtype = $fp_csv[3];
					$content = $fp_csv[4];
					$date_ini = $fp_csv[5]; // cf
					$date_end = $fp_csv[6]; // cf
					$status = $fp_csv[7]; // cf
					$project_url = $fp_csv[8]; // cf
					$repo_url = $fp_csv[9]; // cf
					$money = $fp_csv[10]; // cf
					$colabora = $fp_csv[11]; // cf
					$client = $fp_csv[12]; // cf

					if ( $excerpt == '' ) { $excerpt == $content; }
					$fields = array(
						'_montera34_project_card_date_ini' => $date_ini,
						'_montera34_project_card_date_end' => $date_end,
						'_montera34_project_card_status' => $status,
						'_montera34_project_card_project_url' => $project_url,
						'_montera34_project_card_repo_url' => $repo_url,
						'_montera34_project_card_money' => $money,
						'_montera34_project_card_colabora' => $colabora,
						'_montera34_project_card_client' => $client,
					);
					$terms = array(
						'montera34_type' => $type
					);

					// insert post
					$project_id = wp_insert_post(array(
						'post_type' => 'montera34_project',
						'post_status' => 'draft',
						'post_author' => 1,
						'post_title' => $tit,
						'post_content' => $content,
						'post_excerpt' => $excerpt,
					));

					if ( $project_id != 0 ) {

						// insert custom fields
						reset($fields);
						// while ( $field = current($fields) ) {
						foreach ( $fields as $key => $value ) {
							add_post_meta($project_id, $key, $value, TRUE);
						//	next($fields);
						}

						// insert terms
						reset($terms);
						// while ( $term = current($terms) ) {
						foreach ( $terms as $key => $value ) {
							if ( $term != '' ) { // if is not an empty value
								$term_id = term_exists( $term ); // return the term ID or 0 if doesn't exist
								if ( $term_id == 0 ) { // if the term doesn't exist, then create it
									$new_term = wp_insert_term( $term, key($terms) );
									$term_id = $new_term['term_id'];
								}
								wp_set_post_terms( $project_id, $term_id, key($terms) );
							}
						//	next($terms);

							echo "
								<div>
									<h2>Project " .$project_id. "</h2>
									<p>Insert ok</p>
								</div>
							";
						} // end if project has been inserted

					} // if project has been inserted

				} // end if not line 0
				$line++;
			}
			fclose($csv_filename);

		} else {
			echo "<h2>Error</h2>
				<p>File with contents not found or not accesible.</p>
				<p>Check the path: " .$csv_filename. ". Maybe it has to be absolute...</p>";
		} // end if file exist and is readable
?>

<?php get_footer() ;?>
