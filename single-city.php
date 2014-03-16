<?php get_header(); 
$post_id = $post->ID;?>

<div class="container">
	<div class="row">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div <?php post_class('col-md-12') ?> id="post-<?php the_ID(); ?>">
			<div class="row">
				<div class="col-md-10">
					<ul class="breadcrumb">
						<li><a href="/cities">Cities</a></li>
						<li><?php the_title(); ?></li>
					</ul>
				</div>
				<?php if ( is_user_logged_in() ) { echo '<div class="btn btn-sm btn-default pull-right">'; edit_post_link(__('Edit This')); echo "</div>";} ?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-3">
				<?php the_post_thumbnail( 'medium',array('class'=> "img-rounded img-responsive",'alt'=> ''.get_the_title().'','title'	=> ''.get_the_title().'') ); ?> <br>
				<?php if ( is_user_logged_in() ) { ?>
					<div class="panel panel-default">
						<div class="panel-heading"><?php _e('Hidden field','globalrec');?></div>
						<div class="panel-body">
							<?php
								echo get_post_meta( $post_id, '_city_hidden', true ); 
								?>
						</div>
					</div>
				<?php } ?>
				<h3>List of Waste Picker Groups in the City</h3>
				<?php 
					//List of Waste Picker Groups that belong to the City
					$waste_picker_groups = get_posts( array(
						'post_type' => 'waste-picker-group',
						'meta_key' => '_wpg_cityselect', //city2 because city is used as open field
						'meta_value' => $post->ID
				));
				foreach($waste_picker_groups as $waste_picker_group) {
					echo '<a href="'.get_permalink($waste_picker_group->ID).'">'.$waste_picker_group->post_title.'</a><br>' ;
				}?>
			</div>
			<div class="col-md-7">
			<h1><?php _e('City Report:','globalrec'); ?> <?php the_title(); ?>
			<?php //Country
				$country_id = get_post_meta( $post_id, '_city_countryselect', true );
				$country = get_post($country_id);
				$country_link = get_permalink($country->ID);
				$country_name = $country->post_title;
				echo '<small><a href="'.$country_link.'">'.$country_name.'</a></small>';
				?>
			</h1>
			<?php the_content(__('(more...)')); ?>
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
