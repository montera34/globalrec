<?php  /* Template Name: Law Report List*/ 
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
			 'post_type' => 'law-report', 
			 'posts_per_page' => -1, 
			 'orderby' => 'title',
			 'order' => 'ASC',
				);
			$my_query = new WP_Query($args);
			?>

  <table class="table table-hover table-condensed">
	<thead>
		<tr>
			<th><?php _e('Law','globalrec'); ?></th>
			<th><?php _e('Law overview','globalrec'); ?></th>
			<th><?php _e('Attachments','globalrec'); ?></th>
			<th><?php _e('Country','globalrec'); ?></th>
		</tr>
	</thead>
    <tbody>
	<?php if ( $my_query->have_posts() ) : while ( $my_query->have_posts() ) :  $my_query->the_post(); ?>
	<?php
		global $wp_query;
		$wp_query->in_the_loop = true;
		$more = 0;       // Set (inside the loop) to display content above the more "seguir leyendo" tag. 
		?>

			<tr>
				<td> <a href="<?php the_permalink() ?>" rel="bookmark" title="Go to <?php the_title_attribute(); ?> <?php _e('Law Report','globalrec'); ?>">
					<?php the_title(); ?></a> 
					<?php if ( is_user_logged_in() ) { ?><div class="btn btn-xs btn-default"> <?php edit_post_link(__('Edit This')); ?></div> <?php } ?>
				</td>
				<td>
						<?php
						$content = get_post_field( 'post_content', $post->ID);
						if ($content !='') {echo '<a href="'.get_permalink($post->ID).'"><span class="glyphicon glyphicon-ok"></span></a>';}
					?>
				</td>
				<td>
					<?php 
					$downloads = get_post_meta( $post->ID, '_law_downloads', true );
					if ($downloads) {
					echo '<span class="glyphicon glyphicon-ok"></span>'; 
					}
					?>
				</td>
				<td>
					<?php 
					$country_id = get_post_meta( $post->ID, '_law_countryselect', true );
					$country = get_post($country_id);
					$country_link = get_permalink($country->ID);
					$country_name = $country->post_title;
					echo '<a href="'.$country_link.'" title="Go to '.$country_name.'">'.$country_name.'</a>'; 
					?>
				</td>
			</tr>

	<?php endwhile; else: ?>
	<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
	<?php endif; ?>
    </tbody>
  </table>
</div>
<?php get_footer(); ?>
