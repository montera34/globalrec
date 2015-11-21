<?php  /* Template Name: Waste Picker Groups Candidates List */
get_header();

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
} else if ( $continent == 'latinamerica') {
	$active_continent = $latinamerica;
} else if ( $continent == 'africa') {
	$active_continent = $africa;
} else if ( $continent == 'northamerica') {
	$active_continent = $northamerica;
} else if ( $continent == 'europe') {
	$active_continent = $europe;
} else if ( $continent == 'all') {
	$active_continent = $all;
}

$meta_query = array(
	array(
		'key'     => 'country',
		'value'   => $active_continent,
		'compare' => 'IN',
	)
);

?>
<div id="page-wpg">
	<?php if (have_posts()) : while (have_posts()) : the_post();?>
		<?php get_template_part( 'nav', 'waw' ); ?>
		<div class="row">
			<div class="pull-right"><?php do_action('icl_language_selector'); ?></div>
			<h2 id="post-<?php the_ID(); ?>" class="col-md-10	">
				<?php the_title();?> &laquo; <?php _e('Waste pickers Around the World (WAW)','globalrec'); ?>
			</h2>		
		</div>
		<div class="row">
			<div class="col-md-10">
				<h3> <?php if (current_user_can( 'moderate_comments' )) { echo 'number of queries: '. get_num_queries(); }?> </h3>
				<ul class="nav nav-pills">
					<li role="presentation" class="disabled"><a href="?continent=all" title=""><?php _e('Filter by continent','globalrec'); ?>: </a></li>
					<li role="presentation"><a href="?continent=all" title="<?php _e('All','globalrec'); ?>"><?php _e('All','globalrec'); ?></a></li>
					<li role="presentation"><a href="?continent=asia" title="<?php _e('Asia','globalrec'); ?>"><?php _e('Asia','globalrec'); ?></a></li>
					<li role="presentation"><a href="?continent=latinamerica" title="<?php _e('Latin America','globalrec'); ?><"><?php _e('Latin America','globalrec'); ?></a></li>
					<li role="presentation"><a href="?continent=africa" title="<?php _e('Africa','globalrec'); ?>	"><?php _e('Africa','globalrec'); ?></a></li>
					<li role="presentation"><a href="?continent=northamerica" title="<?php _e('North America','globalrec'); ?>	"><?php _e('North America','globalrec'); ?></a></li>
					<li role="presentation"><a href="?continent=europe" title="<?php _e('Europe','globalrec'); ?>	"><?php _e('Europe','globalrec'); ?></a></li>
				</ul>
			</div>
		</div>
		<div class="row content">
			<div class="col-md-9">
			<?php the_content(); ?>
			</div>
			<?php endwhile; endif; ?>
		</div>
		<div class="row">
		<?php
			$args = array(
				'post_type' => 'waste-picker-org',
				'posts_per_page' => -1,
				'post_status' => array( 'pending', 'draft' ),
				'orderby' => 'title',
				'order' => 'ASC',
				'suppress_filters'=> true, //removes filter by language so the list can be displayed in all the pages regardless its language
			);
			$my_query = new WP_Query($args);
			?>
  <table class="table table-hover table-condensed" id="wpg-list">
	<thead>
		<tr>
			<th>#</th>
			<th><?php _e('Name','globalrec'); ?></th>
			<th><?php _e('Scope','globalrec'); ?></th>
			<th><?php _e('Type of Organization','globalrec'); ?></th>
			<th><?php _e('Type of Member','globalrec'); ?></th>
			<th><?php _e('Number of members','globalrec');
						echo "<br>(";
						_e('Number of groups','globalrec');
						echo ")"; ?></th>
			<th><?php _e('Location','globalrec'); ?></th>
			<th><?php _e('Year formed','globalrec'); ?> (<?php _e('registration year','globalrec'); ?>)</th>
			<th>Member occupation</th>
		</tr>
	</thead>
    <tbody>
  <?php $i = 1; ?>
	<?php if ( $my_query->have_posts() ) : while ( $my_query->have_posts() ) :  $my_query->the_post(); ?>
	<?php 	 //necessary to show the tags 
		global $wp_query;
		$wp_query->in_the_loop = true;
		$more = 0;       // Set (inside the loop) to display content above the more "seguir leyendo" tag. 
		$post_id = $post->ID;
		?>

			<tr <?php post_class(''); ?> id="post-<?php the_ID(); ?>">
				<td>
					<?php echo "<small>". $i ."</small>";
						$i++; ?>
				</td>
				<td> <a href="<?php the_permalink() ?>" rel="bookmark" title="Go to <?php the_title_attribute(); ?> page">
					<strong><?php the_title(); ?></strong></a> 
					<?php if ( is_user_logged_in() ) { ?><div class="btn btn-xs btn-default"> <?php edit_post_link(__('Edit This')); ?></div> <?php } ?>
				</td>
				<td>
					<?php echo get_the_term_list( $post_id, 'wpg-scope', ' ', ', ', '' ); ?>
				</td>
				<td>
					<?php
					$org_type = get_the_term_list( $post_id, 'wpg-organization-type', ' ', ', ', '' );
					echo $org_type == 'ngo' ? 'NGO' : $org_type;
					?>
				</td>
				<td>
					<?php 
					/*$member_type = get_post_meta( $post_id, '_wpg_members_type', true );
					if (gettype($member_type) == 'array') {
						echo list_of_items($post_id,'_wpg_members_type','');
					} else {
						echo get_post_meta( $post_id, '_wpg_members_type', true ); 
					} */?>
					<?php echo get_the_term_list( $post_id, 'wpg-member-type', ' ', ', ', '' ); ?>
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
				<td>
				 <?php echo get_the_term_list( $post_id, 'wpg-member-occupation', ' ', ', ', '' ); ?>
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
