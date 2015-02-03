<?php get_header(); ?>
<?php
$title = get_the_title();
$post_id = $post->ID;
?>

<div class="container">
	<div class="row">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div <?php post_class('') ?> id="post-<?php the_ID(); ?>">
			<div class="row">
				<div class="col-md-11">
					<ul class="breadcrumb">
						<li><a href="<?php echo get_permalink(icl_object_id(11179,'page')) ?>"><?php _e('Countries','globalrec'); ?></a></li>
						<li><?php echo $title; ?></li>
					</ul>
					<h1><?php echo $title; ?></h1>
				</div>
				<div class="col-md-1">
					<?php if ( is_user_logged_in() ) { ?><div class="btn btn-xs btn-default pull-right"> <?php edit_post_link(__('Edit This')); ?></div> <?php } ?>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-3">
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
				<h3>Waste Picker Groups (<?php echo $result; ?>)</h3>
				<?php
				foreach($waste_picker_groups as $waste_picker_group) {
					echo '<a href="'.get_permalink($waste_picker_group->ID).'">'.$waste_picker_group->post_title.'</a><br>' ;
				}
					?>
			</div>
			<div class="col-md-3">
				<?php //Law Reports list about this Country
					$law_reports = get_posts( array(
						'post_type' => 'law-report',
						'meta_key' => '_law_countryselect',
						'meta_value' => $post_id
				));
				if ($law_reports) {?>
					<h3><?php _e('Law reports overview','globalrec'); ?></h3>
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
			</div>
			<div class="col-md-2">
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
			<div class="col-md-3">
				<?php //Posts about this Country
					$posts = get_posts( array(
						'post_type' => 'post',
						'meta_key' => '_post_country',
						'meta_value' => $post_id,
						'posts_per_page'   => 15,
				)); 
				if ($posts) {?>
					<h3><?php _e('Related posts','globalrec'); ?></h3>
					<?php foreach($posts as $post) {
					echo '<a href="'.get_permalink($post->ID).'">'.$post->post_title.'</a><br>' ;
					}
				}
				wp_reset_query();?>
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
