<?php  /* Template Name: Country posts */
get_header(); ?>

<div id="page-wpg">
	<div class="row">
		<div class="col-md-8">
		<?php //Posts about this Country

		$countries = get_posts( array(
				'post_type' => 'country',
				'posts_per_page'   => -1,
				'suppress_filters'   => 0 //to force the use of current language
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
				<h6 class="document-dashicon">
					<?php _e('Last updates from','globalrec'); ?>
					<?php echo $country->post_title. " (" .$count. ")"; ?>
				</h6>
				<div class="list-group">
					<?php
					for ($i = 0; $i <= 2; $i++) {
						if ( $i >= $count ) { } //to prevent crashing for countries with lesss than 2 posts
						else {
							$post = $posts[$i];
							$published_date = get_post_meta( $post->ID, '_gr_article-date', true );
							echo '<a href="'.get_permalink($post->ID).'" class="list-group-item">'.$post->post_title;
							echo $published_date != ''? ' ('.$published_date.')</a>' : '</a>';
						}
					} ?>
				</div><?php
			}
			wp_reset_query();
		}
		?>
		</div>
	</div>
</div>
<?php get_footer(); ?>
