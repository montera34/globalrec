<?php  /* Template Name: Page Home*/ get_header(); 
$categories = get_the_category();
$separator = ' ';
$output = '';
?>
<div class="container">
	<div class="row-fluid">
		<div class="span9">
			<!-- div class="row-fluid"> <!-- space for banners -->
				<!-- <div class="span12">
					<?php dynamic_sidebar( 'front-page-widget-area-main' ) ?>
				</div>
			</div>-->
			<div class="row-fluid" id="home-boxes"> 
				<!-- box for Life and Voices ----------------------------------------------------------->
				<div class="span4">
					<a href="<?php echo get_permalink(icl_object_id(2856,'page')) ?>">
						<img src="<?php bloginfo('template_url'); ?>/images/wastepicker-faces_p.png" alt="Life and Voices of Waste pickers" />
						<h3><?php icl_link_to_element(2856,'page'); ?></h3>
					</a>
					<p>Get to know waste picker leaders who have actively participated in the Global Alliance of Waste Pickers process.
				</div>
				<!-- box for Where we are? ----------------------------------------------------------->
				<div class="span4">
						<a href="<?php echo get_permalink(icl_object_id(7618,'page')) ?>">
							<img src="<?php bloginfo('template_url'); ?>/images/map-waste-pickers-groups_p.png"/>
							<h3><?php icl_link_to_element(7618,'page'); ?></h3>
						</a>
						<p>Provisional list of hundreds of waste pickers’ groups around the globe.</p>
				</div>
				<!-- box for the Last newsletter ----------------------------------------------------------->
				<div class="span4">
					<?php global $more;   
					$args = array(		//arguments for showing newsletters custom post type
						'post_type' => 'newsletter', 
						'posts_per_page' => 1, 
						'post_parent' => 0
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
							<?php the_post_thumbnail( 'medium' ); ?> 
								<h4>Newsletter: <?php the_title();?></h4>
						</a> 	
						<p>Check out the latest GlobalRec newsletter. You can also <a href="/subscription/">subscribe to receive it by email</a>. <a href="<?php echo get_permalink(icl_object_id(4491,'page')) ?>" class="btn btn-mini">Subscribe to newsletter</a></p>
						<?php endwhile; else: ?>
						<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
						<?php endif; ?>
						
				</div>
			</div> 
			<hr>
			<div class="row-fluid">
				<div class="span4">
					<!-- Organizing post column -->
					<h3><?php icl_link_to_element(858, 'category'); ?></h3>
					<?php global $more; 
					$args = array(
					 'caller_get_posts' => 	1,
					 'posts_per_page'=>	4,
					 'cat'=> 858
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
					<!-- Threats posts column -->
					<h3><?php icl_link_to_element(964, 'category'); ?></h3>
					<?php global $more;    // Declare global $more (before the loop). "para que seguir leyendo funcione"
					//mirar codigo madre en http://www.hashbangcode.com/blog/create-page-posts-wordpress-417.html
					$args = array(
					 'caller_get_posts' => 	1,
					 'posts_per_page'=>	4,
					 'cat'=>	icl_object_id(964, 'category')		 
						);
					if ( $paged > 1 ) {
					 $args['paged'] = $paged;
						}
		 
					$my_query = new 	WP_Query($args); ?>
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
					<!-- Publications posts column -->
					<h3><?php icl_link_to_element(970, 'category'); ?></h3>
					<?php global $more;    // Declare global $more (before the loop). "para que seguir leyendo funcione"
					//mirar codigo madre en http://www.hashbangcode.com/blog/create-page-posts-wordpress-417.html
					$args = array(
					 'caller_get_posts' => 	1,
					 'posts_per_page'=>	4,
					 'cat'=> 970
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
			</div>	
			<div class="row-fluid">
			<a href="blog" title="Go to blog" alt="Go to blog" class="btn btn-large pull-right">Read more Blog Posts</a>
		 	</div>
		</div>

		<!-- begin sidebar -->
		<div id="menu" class="span3">
			<?php get_sidebar(); ?>
		</div>
		<!-- end sidebar -->
	</div>
	<div id="footer-home-bar" class="row-fluid" 	style="border-top:5px solid #fe7c11;	margin:10px 0 0 0;">
	<h5>Waste Picker Groups (websites)</h5>
	<?php dynamic_sidebar( 'footer-home-bar' ) ?>
	</div>	 
	<?php get_footer(); ?>
</div><!-- #content -->
</div><!-- #primary -->

