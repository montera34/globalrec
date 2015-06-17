<?php  /* Template Name: Page blog*/ get_header(); ?>

<div class="row">
	<div id="blog" class="col-md-9">	
		<header class="row">
			<div class="pull-right"><?php do_action('icl_language_selector'); ?></div>
			<h2 id="post-<?php the_ID(); ?>" class="col-md-6">
				<?php the_title();?>	
			</h2>		
		</header>
		<?php
		global $more;    // Declare global $more (before the loop). "para que seguir leyendo funcione"
			//mirar codigo madre en http://www.hashbangcode.com/blog/create-page-posts-wordpress-417.html
			$args = array(
				'ignore_sticky_posts' => 1,
				'posts_per_page'=>	15
				);
			if ( $paged > 1 ) {
			 $args['paged'] = $paged;
				}
			$wp_query = new WP_Query($args);
			$wp_count = $wp_query->post_count; //The number of posts being displayed
			?>

		<?php if ($wp_query->have_posts() ) :
			$count = 0;
			while ( $wp_query->have_posts()) : $wp_query->the_post();
				$count++;
				if ( $count == 1 || $count % 3 == 1) { echo "<div class='row'>"; }
				?>
				<article id="post-<?php the_ID(); ?>" <?php post_class('col-md-4'); ?> >
					<?php include("loop.boxes.php")?>
				</article>
				<?php if ( $count % 3 == 0 || $count == $wp_count){ echo "</div><!-- .row --><hr>";} ?>

			<?php endwhile; else: ?>
			<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
		<?php endif; ?>
		<div class="row">
			<div class="col-md-12">
				<div class="pull-right">
					<?php echo custom_pagination(); ?>
				</div>
			</div>
		</div>
	</div>
	<aside class="col-md-3">
	<div classs="widget-container-feed">
		<h4 class="widget-title"><?php _e('News by Region'); ?></h4>
		<?php
			$terms = get_terms( 'post-region' );
			echo '<ul style="list-style:none;margin:0;padding:0;">';
			foreach ( $terms as $term ) { //TODO remove India from the list

					// The $term is an object, so we don't need to specify the $taxonomy.
					$term_link = get_term_link( $term );
				 
					// If there was an error, continue to the next term.
					if ( is_wp_error( $term_link ) ) {
						  continue;
					}

					// We successfully got a link. Print it out.
					echo '<li style="font-size:14px;font-weight:bold;padding:0 0 10px;"><a href="' . esc_url( $term_link ) . '">' . $term->name . '</a><li>';
			}

			echo '</ul>';
		?>
			<!-- original widget with images for each region
		<a href="/post-region/latin-america/"><img src="http://globalrec.org/wp-content/themes/globalrec/images/latinamerica.png">Latin America</a><br>
		<a href="/post-region/africa/"><img src="http://globalrec.org/wp-content/themes/globalrec/images/africa.png">Africa</a><br>
		<a href="/post-region/asia/"><img src="http://globalrec.org/wp-content/themes/globalrec/images/asia.png">Asia</a><br>
		<a href="/post-region/europe/"><img src="http://globalrec.org/wp-content/themes/globalrec/images/europe.png">Europe</a><br>
		<a href="/post-region/north-america/"><img src="http://globalrec.org/wp-content/themes/globalrec/images/north-america.png">North America</a>-->
	</div>
		<?php  dynamic_sidebar( 'blog-sidebar' ) ?>
	</aside>
</div>
<?php get_footer(); ?>
