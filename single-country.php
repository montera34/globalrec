<?php get_header(); ?>

<div class="container">
	<div class="row">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div <?php post_class('col-md-12') ?> id="post-<?php the_ID(); ?>">
			<div class="row">
				<div class="col-md-10">
					<ul class="breadcrumb">
						<li><a href="/countries">Countries</a></li>
						<li><?php the_title(); ?> </li>
					</ul>
					<h1><?php the_title(); ?></h1>
				</div>
				<?php if ( is_user_logged_in() ) { ?><div class="btn btn-xs btn-default pull-right"> <?php edit_post_link(__('Edit This')); ?></div> <?php } ?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				<h3>Waste Picker Groups in <?php the_title(); ?></h3>
				<?php 
					//List of Waste Picker Groups that belong to the City
					$waste_picker_groups = get_posts( array(
						'post_type' => 'waste-picker-group',
						'meta_key' => '_wpg_countryselect', //city2 because city is used as open field
						'meta_value' => $post->ID
				));
				foreach($waste_picker_groups as $waste_picker_group) {
					echo '<a href="'.get_permalink($waste_picker_group->ID).'">'.$waste_picker_group->post_title.'</a><br>' ;
				}
					?>
			</div>
			<div class="col-md-4">
			<h3>Law reports in <?php the_title(); ?></h3>
				<?php 
					//List of Waste Picker Groups that belong to the City
					$law_reports = get_posts( array(
						'post_type' => 'law-report',
						'meta_key' => '_law_countryselect', //city2 because city is used as open field
						'meta_value' => $post->ID
				));
				foreach($law_reports as $law_report) {
					echo '<a href="'.get_permalink($law_report->ID).'">'.$law_report->post_title.'</a><br>' ;
				}
					?>
			</div>
			<div class="col-md-4">
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
