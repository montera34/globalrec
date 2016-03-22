<?php  /* Template Name: Country posts */
get_header(); ?>

<div id="page-wpg">
	<?php if (have_posts()) : while (have_posts()) : the_post();?>
		<div class="row">
			<div class="col-md-8">
				<h1 id="post-<?php the_ID(); ?>">
					<?php the_title();?>
				</h1>
			</div>
			<div class="col-md-4">
				<div class="pull-right"><?php do_action('icl_language_selector'); ?></div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-8">
				<?php the_content(); ?>
				<h3>
					Legend: <span class="label year-2013">2012</span>  <span class="label year-2013">2013</span> <span class="label year-2014">2014</span> <span class="label year-2015" style="color:#000">2015</span> <span class="label year-2016">2016</span>
				</h3>
			</div>
		</div>
	<?php endwhile; endif; ?>

	<div class="row">
		<?php //Posts about this Country

		$countries = get_posts( array(
				'post_type' => 'country',
				'posts_per_page'   => -1,
				'suppress_filters'   => 0, //to force the use of current language
				'orderby' => 'title',
				'order' => 'ASC',
			));
		$countCountries = count($countries);
		foreach($countries as $country) {
			$posts = get_posts( array(
				'post_type' => 'post',
				'meta_key' => '_post_country',
				'meta_value' => $country->ID,
				'posts_per_page'   => -1
			));
			$count = count($posts);

			if ($posts) {?>
			<div class="col-md-4">
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
								echo '<li class="list-group-item year-' .$published_year . '"><a href="'.get_permalink($post->ID).'">'. $post->post_title .'<strong>'. get_the_date(' (m/Y)') .'</strong></a></li>';
								//echo $published_date != ''? ' ('.$published_date.')</a>' : '</a>';
							}
						} ?>
					</ul>
				</div>
			</div>
				<?php
				} else { ?>
			<div class="col-md-4">
				<div class="panel panel-default">
					<div class="panel-heading">
						<?php _e('No updates from','globalrec'); ?>
						<strong><?php echo $country->post_title; ?></strong>
						<span class="badge">0</span>
					</div>
				</div>
			</div>
		<?php }
			wp_reset_query();
		} ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>
