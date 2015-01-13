<?php  /* Template Name: City List*/ 
get_header(); ?>
<div id="page-city-reports" <?php post_class(''); ?>>
	<?php if (have_posts()) : while (have_posts()) : the_post();?>
		<div class="row">
			<h2 id="post-<?php the_ID(); ?>" class="col-md-10">
				<?php the_title();?>	
			</h2>		
			<div class="pull-right"><?php do_action('icl_language_selector'); ?></div>
		</div>
		<div class="row content">
			<div class="col-md-8">
				<?php the_content(); ?>
			</div>
		</div>
		<?php endwhile; endif;?>
		
		<?php
			$args = array(
			 'post_type' => 'city', 
			 'posts_per_page' => -1, 
			 'orderby' => 'title', 
			 'order' => 'ASC' 
				);
			$my_query = new WP_Query($args);
			?>

  <table class="table table-hover table-condensed">
	<thead>
		<tr>
			<th><?php _e('Cities','globalrec'); ?></th>
			<th><?php _e('City Report: Interview with a local Waste Picker','globalrec'); ?></th>
			<th><?php _e('Countries','globalrec'); ?></th>
		</tr>
	</thead>
    <tbody>
	<?php if ( $my_query->have_posts() ) : while ( $my_query->have_posts() ) :  $my_query->the_post(); ?>
	<?php
		global $wp_query;
		$wp_query->in_the_loop = true;
		?>

			<tr>
				<td> <a href="<?php the_permalink() ?>" rel="bookmark" title="Go to <?php the_title_attribute(); ?>">
					<?php the_title(); ?></a> 
					<?php if ( is_user_logged_in() ) { ?><div class="btn btn-xs btn-default"> <?php edit_post_link(__('Edit This')); ?></div> <?php } ?>
				</td>
				<td>
				<?php $content = get_the_content();
					//only displays "check" if there is content, that means> there is a Interview city report
					if ($content !='') {?>
					 <a href="<?php the_permalink() ?>" rel="bookmark" title="Go to <?php the_title_attribute(); ?>">	<span class="glyphicon glyphicon-ok"></span></a>
					<?php } ?>
				</td>
				<td>
				<?php //Country
				$post_id = $post->ID;
				$country_id = get_post_meta( $post_id, '_city_countryselect', true );
				$country = get_post($country_id);
				$country_link = get_permalink($country->ID);
				$country_name = $country->post_title;
				echo '<a href="'.$country_link.'">'.$country_name.'</a>';
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
