<?php  /* Template Name: Page Home*/ 
get_header(); ?>

		<div id="content">
			<?php get_sidebar(); ?>
			<div id="main-portada">
				<div id="front-0">
				<?php if ( ! dynamic_sidebar( 'front-page-widget-area-main' ) ) : ?><?php endif; // end primary widget area ?>
				</div>	<!-- #front-0-->
				<div id="menu-frontpage">
					<?php wp_nav_menu( array( 'theme_location' => 'main-menu' ) ); ?>		
				</div>
				<div id="front-1">
				<a href="blog" title="Go to blog" alt="Go to blog">Blog Posts</a>
				<?php
				
				
				global $more;    // Declare global $more (before the loop). "para que seguir leyendo funcione"
				
				/* Get all sticky posts */
				$sticky = get_option( 'sticky_posts' );
				/* Sort the stickies with the newest ones at the top */
				rsort( $sticky );
				/* Get the 5 newest stickies (change 5 for a different number) */
				$sticky = array_slice( $sticky, 0, 1 );
				
				
					//mirar codigo madre en http://www.hashbangcode.com/blog/create-page-posts-wordpress-417.html
					$args = array(
					 'caller_get_posts' => 1,
					 'post__in' => $sticky, /* Query sticky posts */
					 'posts_per_page'=>5	
						);
					if ( $paged > 1 ) {
					 $args['paged'] = $paged;
						}
		 
					$my_query = new WP_Query($args);
					?>
					
					<?php if ( $my_query->have_posts() ) : ?>
							<?php while ( $my_query->have_posts() ) : 
								 $my_query->the_post(); ?>
										 <?php 	 //necessary to show the tags 
										global $wp_query;
										$wp_query->in_the_loop = true;
										  ?>
										  <?php $more = 0;       // Set (inside the loop) to display content above the more "seguir leyendo" tag. ?>


					<div id="post-<?php the_ID(); ?>" <?php post_class('portada-home sticky'); ?>	>
						<h4 class="post-title"><a style="color:#000000;" href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>
						<div class="postmetadata">
									<?php the_time('F d, Y') ?>&nbsp;<?php the_category(', ') ?>					
						</div>
						<div class="storycontent">
							<?php the_excerpt(); ?>
						</div>
					</div>

					<?php endwhile; else: ?>
					<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
					<?php endif; ?>
					
					
					<?php // montamos otro loop para llamar a los no sticky
				global $more;    // Declare global $more (before the loop). "para que seguir leyendo funcione"
			
				
					//mirar codigo madre en http://www.hashbangcode.com/blog/create-page-posts-wordpress-417.html
					$args = array(
					 'caller_get_posts' => 1,
					 'posts_per_page'=>8,
					 'post__not_in' => get_option( 'sticky_posts' )					 
						);
					if ( $paged > 1 ) {
					 $args['paged'] = $paged;
						}
		 
					$my_query = new WP_Query($args);
					?>
					
					<?php if ( $my_query->have_posts() ) : ?>
							<?php while ( $my_query->have_posts() ) : 
								 $my_query->the_post(); ?>
										 <?php 	 //necessary to show the tags 
										global $wp_query;
										$wp_query->in_the_loop = true;
										  ?>
										  <?php $more = 0;       // Set (inside the loop) to display content above the more "seguir leyendo" tag. ?>


					<div id="post-<?php the_ID(); ?>" <?php post_class('portada-home'); ?>	>
						<h4 class="post-title"><a style="color:#000000;" href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>
						<div class="postmetadata">
									<?php the_time('F d, Y') ?>&nbsp;<?php the_category(', ') ?>					
						</div>
						<div class="storycontent">
							<?php if (has_post_thumbnail()) {
							echo "<div class=\"size-thumbnail wp-image-2864 alignleft\" style=\"float:left;font-size:12px;margin:0 10px 10px 0;\">";
							the_post_thumbnail( 'thumbnail' );
							echo "</div>";
							} ?>
							<?php the_excerpt(); ?>
						</div>
					</div>

					<?php endwhile; else: ?>
					<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
					<?php endif; ?>
				
				
					
					
					<a href="blog" title="Go to blog" alt="Go to blog">Read more blog Posts</a>
				</div>	<!-- #front-1-->
				<div id="front-2">
				<?php if ( ! dynamic_sidebar( 'front-page-widget-area' ) ) : ?><?php endif; // end primary widget area ?>
				</div>	<!-- #front-2-->
			</div>	<!-- #main-portada-->
			<?php get_footer(); ?>
		</div><!-- #content -->
		</div><!-- #primary -->

