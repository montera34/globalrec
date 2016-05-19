<?php  /* Template Name: Waste Picker Groups List contacts */
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
				'orderby' => 'title',
				'order' => 'ASC',
				'suppress_filters'=> true, //removes filter by language so the list can be displayed in all the pages regardless its language
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
			$my_query = new WP_Query($args);
			?>
  <table class="table table-hover table-condensed" id="wpg-list">
	<thead>
		<tr>
			<th>#</th>
			<th><?php _e('Name','globalrec'); ?></th>
			<th>Skype</th>
			<th>Email</th>
			<th>Physical Adress</th>
			<th>Postal Adress</th>
			<th>Phone 1</th>
			<th>Phone 2</th>
			<th>Cellphone</th>
			<th>Fax</th>
			<th>Primary contact</th>
			<th>position</th>
			<th>phone</th>
			<th>email</th>
			<th>Secondary contact</th>
			<th>phone</th>
			<th>email</th>
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
<?php if ( is_user_logged_in() ) { ?>
				<td> <a href="<?php the_permalink() ?>" rel="bookmark" title="Go to <?php the_title_attribute(); ?> page">
					<strong><?php the_title(); ?></strong></a> 
				</td>
				<td>
				 <?php echo get_post_meta( $post_id, '_wpg_skype', true ); ?>
				</td>
				<td><?php echo get_post_meta( $post_id, '_wpg_email', true ); ?></td>
				<td><?php echo get_post_meta( $post_id, '_wpg_physical_address', true ); ?></td>
				<td><?php echo get_post_meta( $post_id, '_wpg_postal_address', true ); ?></td>
				<td><?php echo get_post_meta( $post_id, '_wpg_phone1', true ); ?></td>
				<td><?php echo get_post_meta( $post_id, '_wpg_phone2', true ); ?></td>
				<td><?php echo get_post_meta( $post_id, '_wpg_cell_phone', true ); ?></td>
				<td><?php echo get_post_meta( $post_id, '_wpg_fax', true ); ?></td>
				<td><?php echo get_post_meta( $post_id, '_wpg_primary_contact_name', true ); ?></td>
				<td><?php echo get_post_meta( $post_id, '_wpg_primary_contact_position', true ); ?></td>
				<td><?php echo get_post_meta( $post_id, '_wpg_primary_contact_phone', true ); ?></td>
				<td><?php echo get_post_meta( $post_id, '_wpg_primary_contact_email', true ); ?></td>
				<td><?php echo get_post_meta( $post_id, '_wpg_secondary_contact_name', true ); ?></td>
				<td><?php echo get_post_meta( $post_id, '_wpg_secondary_contact_phone', true ); ?></td>
				<td><?php echo get_post_meta( $post_id, '_wpg_secondary_contact_email', true ); ?></td>
<?php } ?>
			</tr>
		</div>
	<?php endwhile; else: ?>
	<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
	<?php endif; ?>
    </tbody>
  </table>
</div>
<?php get_footer(); ?>
