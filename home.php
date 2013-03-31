<?php  /* Template Name: Page Home*/ get_header(); ?>
<div class="container">
	<div id="main-portada">
		<div class="row-fluid">
			<div id="" class="span9">
				<div class="row-fluid">
						<div class="span12">
							<?php dynamic_sidebar( 'front-page-widget-area-main' ) ?>
						</div>
						<div id="menu-frontpage" class="span12">
							<div class="container">	
	 							<div class="span12">
										<?php $defaults = array(
											'theme_location'  => 'home-menu',
											'container' => 'false',
											'menu_id' => 'pre-menu',
											'menu_class' => 'nav nav-pills'
											);
										wp_nav_menu( $defaults );?>
								</div>
							</div>
						</div>
				</div>
				<div id="front-1" class="row-fluid">
					<div class="span12">
						<?php global $more;    // Declare global $more (before the loop). "para que seguir leyendo funcione"
		
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
			
						<?php if ( $my_query->have_posts() ) : ?><?php while ( $my_query->have_posts() ) : $my_query->the_post(); ?>
						<?php 	 global $wp_query; //necessary to show the tags 
							$wp_query->in_the_loop = true; ?>
						<?php $more = 0;       // Set (inside the loop) to display content above the more "seguir leyendo" tag. ?>
						<div id="post-<?php the_ID(); ?>" <?php post_class('portada-home sticky'); ?>	>
						<?php if ( has_post_thumbnail()) : ?>
							<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
							<?php the_post_thumbnail(array(300,300)); ?>
							</a>
						<?php endif; ?> 
							<h4 class="post-title"><a style="color:#000000;" href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>
							<div class="postmetadata">
							<?php the_time('F d, Y') ?>&nbsp;<?php the_category(', ') ?>					
							</div>
							<div>
							<?php the_excerpt(); ?>
							</div>
						</div>							

						<?php endwhile; else: ?>
						<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
						<?php endif; ?>
					</div>

					<div class="row-fluid">
						<div class="span12">
							<h3><a href="blog" title="Go to blog" alt="Go to blog">Blog</a></h3>
							<?php // montamos otro loop para llamar a los no sticky
							global $more;    // Declare global $more (before the loop). "para que seguir leyendo funcione"
							//mirar codigo madre en http://www.hashbangcode.com/blog/create-page-posts-wordpress-417.html
							$args = array(
							 'caller_get_posts' => 	1,
							 'posts_per_page'=>	9,
							 'post__not_in' => 	get_option( 'sticky_posts' )					 
								);
							if ( $paged > 1 ) {
							 $args['paged'] = $paged;
								}
				 
							$my_query = new WP_Query($args); ?>
							<ul class="thumbnails">
								<?php if ( $my_query->have_posts() ) : while ( $my_query->have_posts() ) : $my_query->the_post(); ?>
								<?php global $wp_query;	 //necessary to show the tags 
									$wp_query->in_the_loop = true; 
									$more = 0;       // Set (inside the loop) to display content above the more "seguir leyendo" tag. ?>
									<?php include("loop.boxes.php")?>

								<?php endwhile; else: ?>
							</ul>
							<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
							<?php endif; ?>
							<a href="blog" title="Go to blog" alt="Go to blog">Read more blog Posts</a>
						</div>
					</div>
				
				</div>	<!-- end front1--> 


			</div>
			
			<!-- begin sidebar -->
			<div id="menu" class="span3">
				<?php get_sidebar(); ?>
			</div>
			<!-- end sidebar -->
		</div>
		
		
		<div id="front-2" class="row">
		<?php if ( ! dynamic_sidebar( 'front-page-widget-area' ) ) : ?><?php endif; // end primary widget area ?>
		</div>	 
	</div>	<!-- #main-portada-->
	<?php get_footer(); ?>
</div><!-- #content -->
</div><!-- #primary -->

