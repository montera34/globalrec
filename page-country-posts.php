<?php  /* Template Name: Country posts */
get_header(); ?>

<div id="page-wpg">
	<div class="row">
		<div class="col-md-8">
		<?php //Posts about this Country

		$countries = get_posts( array(
				'post_type' => 'country',
				'posts_per_page'   => -1,
				'suppress_filters'   => 0, //to force the use of current language
				'orderby' => 'title',
				'order' => 'ASC',
			));

		foreach($countries as $country) {
			$posts = get_posts( array(
				'post_type' => 'post',
				'meta_key' => '_post_country',
				'meta_value' => $country->ID,
				'posts_per_page'   => -1
			));
			$count = count($posts);

			if ($posts) {?>
				<div class="panel panel-default">
					<!-- Default panel contents -->
					<div class="panel-heading">
						<?php _e('Updates from','globalrec'); ?>
						<strong><?php echo $country->post_title; ?></strong>
						<span class="badge">
							<?php echo  $count; ?>
						</span>
					</div>
					<ul class="list-group">
						<?php
						for ($i = 0; $i <= 2; $i++) {
							if ( $i >= $count ) { } //to prevent crashing for countries with lesss than 2 posts
							else {
								$post = $posts[$i];
								$published_year = get_the_date('Y');
								$published_date = get_post_meta( $post->ID, '_gr_article-date', true );
								echo '<li class="list-group-item year-' .$published_year . '"><a href="'.get_permalink($post->ID).'">'. $post->post_title . get_the_date(' (m/Y)') .'</a></li>';
								//echo $published_date != ''? ' ('.$published_date.')</a>' : '</a>';
							}
						} ?>
					</ul>
				</div>
				<?php
				} else { ?>
				<h4 class="document-dashicon">
					<?php _e('No updates from','globalrec'); ?>
					<?php echo $country->post_title. " (0)"; ?>
				</h4>
		<?php }
			wp_reset_query();
		} ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>
