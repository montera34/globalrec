<?php  /* Template Name: Page Home*/ get_header(); 
$categories = get_the_category();
$separator = ' ';
$output = '';
?>
<div class="container">
	<div class="row-fluid">
		<div class="span9">
			<div class="row-fluid"> <!-- space for banners -->
				<div class="span12">
					<?php dynamic_sidebar( 'front-page-widget-area-main' ) ?>
				</div>
			</div>
			<div class="row-fluid"> <!-- sub menu for front page -->
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
			<div id="front-1" class="row-fluid"> <!-- sticky posts -->
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
				<div id="post-<?php the_ID(); ?>" <?php post_class('well span12'); ?>	>
					<div class="row-fluid">
							<div class="span5">
							<?php if ( has_post_thumbnail()) : ?>
							<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
							<?php the_post_thumbnail(array(300,300)); ?>
							</a>
						</div>
						<?php endif; ?> 
						<div class="span7">
							<h4 class="post-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>
							<div>
							<small>
							<?php the_author_posts_link(); ?> | 
							<?php  
								if (get_the_term_list( $post->ID, 'post-region', '', ', ', '' ) != '')  : 
								echo "Region ";	
								echo get_the_term_list( $post->ID, 'post-region', '', ', ', '' ); 
								endif;
						 	?>
							| <?php the_time('F d, Y') ?>
							</small>				
							</div>
							<div>
							<?php the_excerpt(); ?>
							</div>	
							<?php if($categories){
							foreach($categories as $category) {
								$output .= '<a href="'.get_category_link( $category->term_id ).'" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) . '" class="label  pull-right">'.$category->cat_name.'</a>'.$separator;
								}
								echo trim($output, $separator);
								}	
								?>
						</div>
					</div>
					<?php endwhile; else: ?>
					<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
					<?php endif; ?>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span12">
					<!--<h3><a href="blog" title="Go to blog" alt="Go to blog">Blog</a></h3>-->
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
						<?php if ( $my_query->have_posts() ) : $count = 0; 
							while ( $my_query->have_posts() ) : $my_query->the_post(); 
							$count++; 
							if ( $count == 1 ) { echo "<div class='row-fluid'>"; } ?>
						<?php global $wp_query;	 //necessary to show the tags 
							$wp_query->in_the_loop = true; 
							$more = 0;       // Set (inside the loop) to display content above the more "seguir leyendo" tag. ?>
							<?php include("loop.boxes.php")?>
							<?php if ( $count == 3 ) { echo "</div><!-- .row --><hr>"; $count = 0; }?>
						<?php endwhile; else: ?>
					</ul>
					<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
					<?php endif; ?>
					<a href="blog" title="Go to blog" alt="Go to blog">Read more blog Posts</a>
				</div>
			</div>	
		</div>
		
		<!-- begin sidebar -->
		<div id="menu" class="span3">
			<?php get_sidebar(); ?>
		</div>
		<!-- end sidebar -->
	</div>
	
	
	<div id="front-2" class="row">
	<?php dynamic_sidebar( 'front-page-widget-area' ) ?>
	</div>	 
	<?php get_footer(); ?>
</div><!-- #content -->
</div><!-- #primary -->

