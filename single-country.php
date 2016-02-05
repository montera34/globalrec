<?php get_header(); ?>
<?php
$title = get_the_title();
$post_id = $post->ID;
?>

<div <?php post_class('container') ?>  id="post-<?php the_ID(); ?>">
	<div class="row">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div class="row">
			<div class="col-md-9">
				<ul class="breadcrumb">
					<li><a href="<?php echo get_permalink(icl_object_id(11179,'page')) ?>"><?php _e('Countries','globalrec'); ?></a></li>
					<li><?php echo $title; ?></li>
				</ul>
				<h1><?php echo $title; ?></h1>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				<?php 
					//List of Waste Picker Groups that belong to the Country
					$waste_picker_groups = get_posts( array(
						'post_type' => 'waste-picker-org',
						//'meta_key' => '_wpg_countryselect',
						//'meta_value' => $post_id,
						'meta_key' => 'country',
						'meta_value' => $title,
						'posts_per_page' => -1,
						'order' => 'ASC',
						'orderby' => 'title',
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
					));
					$result = count($waste_picker_groups);
					?>
				<h3 class="groups-dashicon">Waste Picker Groups</h3>
				<table class="table table-condensed table-hover ">
					<thead><tr><th>Waste Picker Groups (<?php echo $result; ?>)</th></tr></thead>
					<tbody>
						<?php
						foreach($waste_picker_groups as $waste_picker_group) {
						echo '<tr><td><a href="'.get_permalink($waste_picker_group->ID).'">'.$waste_picker_group->post_title.'</a></td></tr>' ;
						}
						?>
					</tbody>
				</table>
			</div>
			<div class="col-md-4">
				<?php //Posts about this Country
					$posts = get_posts( array(
						'post_type' => 'post',
						'meta_key' => '_post_country',
						'meta_value' => $post_id,
						'posts_per_page'   => 15,
				)); 
				if ($posts) {?>
					<h3 class="document-dashicon"><?php _e('Last updates from','globalrec'); ?> <?php echo $title; ?></h3>
					<div class="list-group">
						<?php foreach($posts as $post) {
							$published_date = get_post_meta( $post->ID, '_gr_article-date', true );
							echo '<a href="'.get_permalink($post->ID).'" class="list-group-item">'.$post->post_title;
							echo $published_date != ''? ' ('.$published_date.')</a>' : '</a>';
						} ?>
					</div><?php 
				}
				wp_reset_query(); ?>
			</div>
			<div class="col-md-4">
				<?php //Law Reports list about this Country
					$law_reports = get_posts( array(
						'post_type' => 'law-report',
						'meta_key' => '_law_countryselect',
						'meta_value' => $post_id
				));
				if ($law_reports) {?>
					<h3 class="book-dashicon"><?php _e('Law reports overview','globalrec'); ?></h3>
					<?php foreach($law_reports as $law_report) {
						echo '<a href="'.get_permalink($law_report->ID).'">'.$law_report->post_title.'</a><br>';
					}
					$downloads = get_post_meta( $law_report->ID, '_law_downloads', true );
					if ($downloads) {
						echo '<hr><h4>';
						echo _e('Laws','globalrec');
						echo '</h4>';
						echo $downloads;
					}
				}?>
			<hr>
				<?php //City Reports list about this Country
					$city_reports = get_posts( array(
						'post_type' => 'city',
						'meta_key' => '_city_countryselect',
						'meta_value' => $post_id
				));
				if ($city_reports) {?>
					<h3><?php _e('City reports','globalrec'); ?></h3>
					<?php foreach($city_reports as $city_report) {
						echo '<a href="'.get_permalink($city_report->ID).'">'.$city_report->post_title.'</a><br>' ;
					}
				}?>
			</div>
		</div>
	</div>
	<?php include("share.php")?>

	<?php endwhile; else: ?>
	<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
	<?php endif; ?>

	<?php posts_nav_link(' &#8212; ', __('&laquo; Newer Posts'), __('Older Posts &raquo;')); ?>
	</div>
	<?php get_footer(); ?>
	
</div>
