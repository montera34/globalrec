<?php  /* Template Name: Word post count */
get_header(); ?>
<div id="page-word-post-count"  <?php post_class(''); ?> id="post-<?php the_ID(); ?>">
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
				//'author' => '4',
				'post_status' => array( 'publish', 'future' ),
				'post_type' => 'post',
				'posts_per_page' => 100,
				'ignore_sticky_posts' => 1,
				'suppress_filters' => false //wpml suppress filters false
				);
			$my_query = new WP_Query($args);
			?>

  <table class="table table-hover table-condensed">
	<thead>
		<tr>
			<th><?php _e('Posts','globalrec'); ?></th>
			<!--<th><?php _e('Translations','globalrec'); ?></th>-->
			<th><?php _e('Date','globalrec'); ?></th>
			<th><?php _e('Author','globalrec'); ?></th>
			<th><?php _e('Country','globalrec'); ?></th>
			<th><?php _e('Region','globalrec'); ?></th>
			<th><?php _e('# of words title','globalrec'); ?></th>
			<th><?php _e('# of words Article (without html)','globalrec'); ?></th>
			<th><?php _e('# of words Summary (without html)','globalrec'); ?></th>
			<th><?php _e('# of words Summary + title','globalrec'); ?></th>
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
					<?php the_title();?></a>
					<?php if ( is_user_logged_in() ) { ?><div class="btn btn-xs btn-default"> <?php edit_post_link(__('Edit This')); ?></div> <?php } ?>
				</td>
				<!--<td>
					<?php //languages_list_available(); ?>
					<?php //wp_reset_query(); ?>
				</td>-->
				<td>
					<?php the_time('m/d/Y') ?>
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
				<?php
					$country_ID = get_post_meta( $post->ID, '_post_country', true );
					$country = get_post( $country_ID );
					$countrytitle = $country->post_title;
					echo $countrytitle;
				?>
				</td>
				<td>
				<?php echo get_the_term_list( $post->ID, 'post-region', '', ', ', '' ); ?>
				</td>
				<td>
					<?php
						$thetitle = get_the_title();
						echo str_word_count($thetitle);
					?>
				</td>
				<td>
					<?php
						$str = get_the_content();
						echo str_word_count($str);
						echo ' ('. str_word_count(strip_tags($str)).')'; 
					?>
				</td>
				<td>
					<?php
						$summary = get_post_meta( $post->ID, '_gr_post-summary', true );
						$stripped_summary = strip_tags($summary);
						echo str_word_count($summary);
						echo ' ('. str_word_count($stripped_summary).')'; 
					?>
				</td>
				<td>
					<?php
						$summaryAndTitle = $thetitle.' '.$stripped_summary;
						echo str_word_count($summaryAndTitle);
						if (!empty($summary)) {
							echo ' <span class="glyphicon glyphicon-ok"></span>';
						} ?>
				</td>
			</tr>

	<?php endwhile; else: ?>
	<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
	<?php endif; ?>
    </tbody>
  </table>
</div>
<?php get_footer(); ?>
