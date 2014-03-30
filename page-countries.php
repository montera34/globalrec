<?php  /* Template Name: Country List*/ 
get_header(); ?>
<div id="page-law-reports"  <?php post_class(''); ?> id="post-<?php the_ID(); ?>">
	<?php if (have_posts()) : while (have_posts()) : the_post();?>
		<div class="row">
			<h2 id="post-<?php the_ID(); ?>" class="col-md-10">
				<?php the_title();?>	
			</h2>		
			<div class="pull-right"><?php do_action('icl_language_selector'); ?></div>
		</div>
		<?php the_content(); ?>	
		<?php endwhile; endif; ?>
		<?php
			$args = array(
			 'post_type' => 'country',
			 'posts_per_page' => -1,
			 'orderby' => 'title',
			 'order' => 'ASC',
				);
			$my_query = new WP_Query($args);
			?>

  <table class="table table-hover table-condensed">
	<thead>
		<tr>
			<th><?php _e('Countries','globalrec'); ?></th>
			<th><?php _e('Law Report Overview','globalrec'); ?></th>
			<th><?php _e('Law Report Attachments','globalrec'); ?></th>
			<th><?php _e('City reports (Waste Picker interview)','globalrec'); ?></th>
		</tr>
	</thead>
    <tbody>
	<?php if ( $my_query->have_posts() ) : while ( $my_query->have_posts() ) :  $my_query->the_post(); ?>
	<?php
		global $wp_query;
		$wp_query->in_the_loop = true;
		?>

			<tr>
				<td>
					<a href="<?php the_permalink() ?>" rel="bookmark" title="Go to <?php the_title_attribute(); ?>">
					<?php the_title(); ?></a>
					<?php if ( is_user_logged_in() ) { ?><div class="btn btn-xs btn-default"> <?php edit_post_link(__('Edit This')); ?></div> <?php } ?>
				</td>
				<td>
				<?php
						$law_reports = get_posts( array(
							'post_type' => 'law-report',
							'meta_key' => '_law_countryselect',
							'meta_value' => $post->ID
					));
					foreach($law_reports as $law_report) {
						$content = get_post_field( 'post_content', $law_report->ID);
						if ($content !='') {echo '<a href="'.get_permalink($law_report->ID).'"><span class="glyphicon glyphicon-ok"></span></a>';}
					}
					?>
				</td>
				<td>
					<?php foreach($law_reports as $law_report) {
						$downloads = get_post_meta( $law_report->ID, '_law_downloads', true );
						if ($downloads) {echo '<a href="'.get_permalink($law_report->ID).'"><span class="glyphicon glyphicon-ok"></span></a>';}
					}
					?>
				</td>
				<td>
				<?php $city_reports = get_posts( array(
						'post_type' => 'city',
						'meta_key' => '_city_countryselect',
						'meta_value' => $post->ID
				));
				foreach($city_reports as $city_report) {
					$content = get_post_field( 'post_content', $city_report->ID);
					//only displays "check" if there is content, that means> there is a Interview city report
					if ($content !='') {echo '<a href="'.get_permalink($city_report->ID).'" title="'.get_the_title($city_report->ID).'"><span class="glyphicon glyphicon-ok"></span></a>';}
				}?>
				</td>
			</tr>

	<?php endwhile; else: ?>
	<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
	<?php endif; ?>
    </tbody>
  </table>
</div>
<?php get_footer(); ?>
