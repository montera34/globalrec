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
			<hr>
			<div class="row-fluid" id="home-boxes"> 
				<!-- box for Life and voices link. It loads a random photo of a waste picker everytime.--------------------- -->
				<div class="span4">
					<a href="http://localhost/globalrec/?page_id=9">
					<?php 	global $more;    // Declare global $more (before the loop). "para que seguir leyendo funcione"
						//mirar codigo madre en http://www.hashbangcode.com/blog/create-page-posts-wordpress-417.html
						$args = array(
						'caller_get_posts' => 1,
						'post_type' => 'bio', 
						'posts_per_page' => 1, 
						'post_parent' => 0,
						'order' =>  'ASC',
						'orderby' =>  'title'
						//'orderby' =>  'rand' change to random in production
					);

					if ( $paged > 1 ) {
					 $args['paged'] = $paged;
						}

					$my_query = new WP_Query($args);
		
					if ( $my_query->have_posts() ) :  while ( $my_query->have_posts() ) :  $my_query->the_post();  
						//necessary to show the tags 
						global $wp_query;
						$wp_query->in_the_loop = true;
		
						$more = 0;       // Set (inside the loop) to display content above the more "seguir leyendo" tag. ?>
						<?php $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), medium, false, '' ); ?>
						
							<div class="size-thumbnail wp-image-2864 alignleft" style="float:left;margin:0 15px 15px 0;position: relative;width:200px;height:130px;background-image:url('<?php echo $src[0]; ?>');">
							<?php //the_post_thumbnail( 'thumbnail' ); ?>
								<div class='box-bottom'>
								
								<span><?php the_title_attribute(); ?></span>
								</div><!-- .box-bottom -->
							</div><h4>Who? Life and Voices of Waste pickers</h4>
						
					<?php endwhile; else: ?>
					<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
					<?php endif; ?>
					
					</a>
				</div>
				<!-- box for Where we are? ----------------------------------------------------------->
				<div class="span4">
					<a href="http://localhost/globalrec/?page_id=7512">
						<img src="<?php bloginfo('template_url'); ?>/images/map-waste-pickers-groups_p.png" >
						<h3>Where are we?</h3></a>
						<p></p>
				</div>
				<!-- box for the Last newsletter ----------------------------------------------------------->
				<div class="span4">
					<?php global $more;   
					$args = array(		//arguments for showing newsletters custom post type
						'post_type' => 'newsletter', 
						'posts_per_page' => 1, 
						'post_parent' => 0,
						'order' =>  'ASC',
						'orderby' =>  'title'
						);


						if ( $paged > 1 ) {
						 $args['paged'] = $paged;
							}

						$my_query = new WP_Query($args);
	
						if ( $my_query->have_posts() ) :  while ( $my_query->have_posts() ) :  $my_query->the_post();  
							//necessary to show the tags 
							global $wp_query;
							$wp_query->in_the_loop = true;
	
						$more = 0;       // Set (inside the loop) to display content above the more "seguir leyendo" tag. ?>
						<?php $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), medium, false, '' ); ?>
						<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
							<div class="size-thumbnail wp-image-2864 alignleft" style="float:left;margin:0 15px 15px 0;position: 
							relative;width:200px;height:130px;background-image:url('<?php echo $src[0]; ?>');">
							<?php //the_post_thumbnail( 'thumbnail' ); ?> 
							</div>
								<h4><?php the_title();?></h4>
						</a> 
						<?php endwhile; else: ?>
						<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
						<?php endif; ?>
					<h3></h3>
				</div>
			</div> 
			<hr>
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
							<?php the_post_thumbnail('medium'); ?>
							</a>
						</div>
						<?php endif; ?> 
						<div class="span7">
							<h4 class="post-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>
							<div class="post-metadata">
							<small>
							by <?php the_author_posts_link(); ?> | 
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
				<div class="span4">
					<h3><a href="blog" title="Go to blog" alt="Go to blog">Organizing</a></h3>
					<?php // montamos otro loop para llamar a los no sticky
					global $more;    // Declare global $more (before the loop). "para que seguir leyendo funcione"
					//mirar codigo madre en http://www.hashbangcode.com/blog/create-page-posts-wordpress-417.html
					$args = array(
					 'caller_get_posts' => 	1,
					 'posts_per_page'=>	4,
					 'cat'=>		159, //change to category "organizing" and internationalize
					 'post__not_in' => 	get_option( 'sticky_posts' )					 
						);
					if ( $paged > 1 ) {
					 $args['paged'] = $paged;
						}
		 
					$my_query = new WP_Query($args); ?>
					<ul class="thumbnails">
						<?php if ( $my_query->have_posts() ) : 	while ( $my_query->have_posts() ) : $my_query->the_post(); 
							
						global $wp_query;	 //necessary to show the tags 
							$wp_query->in_the_loop = true; 
							$more = 0;       // Set (inside the loop) to display content above the more "seguir leyendo" tag. ?>
							<li id="post-<?php the_ID(); ?>" <?php post_class('span12'); ?>	>
								<?php include("loop.boxes.php")?>
							</li>
						<?php endwhile; else: ?>
					</ul>
					<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
					<?php endif; ?>
				</div>
				<div class="span4">
					<h3><a href="blog" title="Go to blog" alt="Go to blog">Threats</a></h3>
					<?php // montamos otro loop para llamar a los no sticky
					global $more;    // Declare global $more (before the loop). "para que seguir leyendo funcione"
					//mirar codigo madre en http://www.hashbangcode.com/blog/create-page-posts-wordpress-417.html
					$args = array(
					 'caller_get_posts' => 	1,
					 'posts_per_page'=>	4,
					 'cat'=>		35, //change to category "threats" and internationalize
					 'post__not_in' => 	get_option( 'sticky_posts' )					 
						);
					if ( $paged > 1 ) {
					 $args['paged'] = $paged;
						}
		 
					$my_query = new WP_Query($args); ?>
					<ul class="thumbnails">
						<?php if ( $my_query->have_posts() ) : 	while ( $my_query->have_posts() ) : $my_query->the_post(); 
							
						global $wp_query;	 //necessary to show the tags 
							$wp_query->in_the_loop = true; 
							$more = 0;       // Set (inside the loop) to display content above the more "seguir leyendo" tag. ?>
							<li id="post-<?php the_ID(); ?>" <?php post_class('span12'); ?>	>
								<?php include("loop.boxes.php")?>
							</li>
						<?php endwhile; else: ?>
					</ul>
					<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
					<?php endif; ?>
				</div>	
				<div class="span4">
					<h3><a href="blog" title="Go to blog" alt="Go to blog">Publications</a></h3>
					<?php // montamos otro loop para llamar a los no sticky
					global $more;    // Declare global $more (before the loop). "para que seguir leyendo funcione"
					//mirar codigo madre en http://www.hashbangcode.com/blog/create-page-posts-wordpress-417.html
					$args = array(
					 'caller_get_posts' => 	1,
					 'posts_per_page'=>	4,
					 'cat'=>		26, //change to category "publications" and internationalize
					 'post__not_in' => 	get_option( 'sticky_posts' )					 
						);
					if ( $paged > 1 ) {
					 $args['paged'] = $paged;
						}
		 
					$my_query = new WP_Query($args); ?>
					<ul class="thumbnails">
						<?php if ( $my_query->have_posts() ) : 	while ( $my_query->have_posts() ) : $my_query->the_post(); 
							
						global $wp_query;	 //necessary to show the tags 
							$wp_query->in_the_loop = true; 
							$more = 0;       // Set (inside the loop) to display content above the more "seguir leyendo" tag. ?>
							<li id="post-<?php the_ID(); ?>" <?php post_class('span12'); ?>	>
								<?php include("loop.boxes.php")?>
							</li>
						<?php endwhile; else: ?>
					</ul>
					<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
					<?php endif; ?>
				</div>	
				<a href="blog" title="Go to blog" alt="Go to blog">Read more blog Posts</a>
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

