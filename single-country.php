<?php get_header(); ?>

<div class="container">
	<div class="row">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div <?php post_class('') ?> id="post-<?php the_ID(); ?>">
			<div class="row">
				<div class="col-md-11">
					<ul class="breadcrumb">
						<li><a href="/countries">Countries</a></li>
						<li><?php the_title(); ?></li>
					</ul>
					<h1><?php the_title(); ?></h1>
				</div>
				<div class="col-md-1">
					<?php if ( is_user_logged_in() ) { ?><div class="btn btn-xs btn-default pull-right"> <?php edit_post_link(__('Edit This')); ?></div> <?php } ?>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-3">
				<h3>Waste Picker Groups</h3>
				<?php 
					//List of Waste Picker Groups that belong to the Country
					$waste_picker_groups = get_posts( array(
						'post_type' => 'waste-picker-group',
						'meta_key' => '_wpg_countryselect',
						'meta_value' => $post->ID
				));
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
						'meta_value' => $post->ID
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
							'meta_value' => $post->ID
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
						'meta_value' => $post->ID
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