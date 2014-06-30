<?php  /* Template Name: Posts List*/ 
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
				'post_type' => 'post', 
				'posts_per_page' => 100,
				'ignore_sticky_posts' => 1,
				);
			$my_query = new WP_Query($args);
			?>

  <table class="table table-hover table-condensed">
	<thead>
		<tr>
			<th><?php _e('Posts','globalrec'); ?></th>
			<th><?php _e('Author','globalrec'); ?></th>
			<th><?php _e('Social Networking sites','globalrec'); ?></th>
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
					<?php if (get_post_type() == 'post') {
						$written_by = get_post_meta( $post->ID, '_gr_written-by', true );
						 	if ($written_by != '')  { //if the text is written by a journalist the field "written" by will be filled
								echo $written_by;
							}
							else {
								the_author_posts_link();
							}
						}
					?>
				</td>
				<td>
					<?php  include("share.php")?>
				</td>
			</tr>

	<?php endwhile; else: ?>
	<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
	<?php endif; ?>
    </tbody>
  </table>
</div>
<?php get_footer(); ?>
