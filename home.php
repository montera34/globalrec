<?php  /* Template Name: Page Home*/ get_header(); 
$categories = get_the_category();
$separator = ' ';
$output = '';
?>
<div id="home">
	<div class="row">
		<div class="col-md-9">
			<div class="row"> <!-- space for banners X -->
				 <div class="col-md-12">
					<?php dynamic_sidebar( 'front-page-widget-area-main' ); ?>
				</div>
			</div>
			<div class="row" id="home-boxes">
				<!-- box for Life and Voices -->
				<div class="col-xs-12 col-sm-6 col-md-4">
					<a href="<?php echo get_permalink(icl_object_id_check(2856,'page')); ?>">
						<img src="<?php bloginfo('template_url'); ?>/images/wastepicker-faces_p.png" alt="Life and Voices of Waste pickers" class="img-responsive"/>
						<h3><?php icl_link_to_element_check(2856,'page'); ?></h3>
					</a>
					<p><?php _e('Get to know waste picker leaders who have actively participated in the Global Alliance of Waste Pickers process.','globalrec'); ?></p>
				</div>
				<!-- box for Where we are? -->
				<div class="col-xs-12 col-sm-6 col-md-4">
						<a href="<?php echo get_permalink(icl_object_id_check(7618,'page')); ?>">
							<img src="<?php bloginfo('template_url'); ?>/images/map-waste-pickers-groups_p.png" class="img-responsive"/>
							<h3><?php icl_link_to_element_check(7618,'page'); ?></h3>
						</a>
						<p><?php _e('Provisional list of hundreds of waste pickers’ groups around the globe.','globalrec'); ?></p>
				</div>
				<!-- box for the Last newsletter -->
				<div class="col-xs-12 col-sm-6 col-md-4">
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
						<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
							<?php // the_post_thumbnail( 'medium', array('class' => 'img-responsive') ); //inserts the medium size image ?> 
							<?php $image_attributes = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID), 'medium', false, '' ); ?>
							<div style="background-size:100% auto;background-image:url('<?php echo $image_attributes[0] ;?>');height:130px;margin-bottom: 4px;max-width:300px;background-repeat:no-repeat;background-position: center;"></div>
								<h3><?php _e('Recent newsletter','globalrec'); ?></h3>
						</a> 	
						<p><?php _e('Check out the latest GlobalRec newsletter.','globalrec'); ?> <a href="<?php echo get_permalink(icl_object_id_check(4491,'page')) ?>"><?php _e('You can also subscribe to receive it by email','globalrec'); ?></a>. <a href="<?php echo get_permalink(icl_object_id_check(4491,'page')) ?>"><button class="btn btn-xs btn-default"> <?php _e('Subscribe to newsletter','globalrec'); ?></button></a></p>
						<?php endwhile; else: ?>
						<p><?php _e('Sorry, no posts matched your criteria.','globalrec'); ?></p>
						<?php endif; ?>
						
				</div>
			</div> 
			<hr style="margin-top:5px;margin-bottom:0px;">
			<div class="row" >
				<div class="col-md-12">
				<h2><?php _e('News','globalrec'); ?><small> <?php _e('from Waste Pickers around the world','globalrec'); ?></small></h2>
				</div>			
			</div>
			<div class="row" id="home-boxes-2">
				<div class="col-md-4">
					<!-- Organizing post column -->
					<h3><img src="<?php bloginfo('template_url'); ?>/images/icon-hand-in-hand.png"/><br><?php icl_link_to_element_check(858, 'category'); ?></h3>
					<?php global $more;
					$args = array(
					 'ignore_sticky_posts' => 	0,
					 'posts_per_page'=>	5,
					 'cat'=> icl_object_id_check(858, 'category')
						);
					$my_query = new WP_Query($args); ?>
						<?php if ( $my_query->have_posts() ) : 	while ( $my_query->have_posts() ) : $my_query->the_post();
						$do_not_duplicate[] = $post->ID; //stores posts of this query in array
						
						global $wp_query;	 //necessary to show the tags 
							$wp_query->in_the_loop = true; 
							$more = 0;       // Set (inside the loop) to display content above the more "seguir leyendo" tag. ?>
							<div id="post-<?php the_ID(); ?>" <?php post_class(''); ?>	>
								<?php include("loop.boxes.php")?>
							</div>
						<?php endwhile; else: ?>
					<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
					<?php endif; ?>
				</div>
				<div class="col-md-4">
					<!-- Threats posts column-->
					<h3><img src="<?php bloginfo('template_url'); ?>/images/icon-march.png"/><br><?php icl_link_to_element_check(964, 'category'); ?></h3>
					<?php global $more;    // Declare global $more (before the loop). "para que seguir leyendo funcione"
					//mirar codigo madre en http://www.hashbangcode.com/blog/create-page-posts-wordpress-417.html
					$args = array(
					 'ignore_sticky_posts' => 	0,
					 'posts_per_page' =>	5,
					 'cat' =>	icl_object_id_check(964, 'category'),
					 'post__not_in' => $do_not_duplicate,
						);
		 
					$my_query = new WP_Query($args); ?>
						<?php if ( $my_query->have_posts()  ) : 	while ( $my_query->have_posts() ) : $my_query->the_post();
							$do_not_duplicate[] = $post->ID; //stores posts of this query in array
							
						global $wp_query;	 //necessary to show the tags 
							$wp_query->in_the_loop = true; 
							$more = 0;       // Set (inside the loop) to display content above the more "seguir leyendo" tag. ?>
							<div id="post-<?php the_ID(); ?>" <?php post_class(''); ?>	>
								<?php include("loop.boxes.php")?>
							</div>
						<?php endwhile; else: ?>
					<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
					<?php endif; ?>
				</div>	
				<div class="col-md-4">
					<!-- Publications posts column-->
					<h3><img src="<?php bloginfo('template_url'); ?>/images/icon-publication.png"/><br><?php icl_link_to_element_check(970, 'category'); ?></h3>
					<?php global $more;    // Declare global $more (before the loop). "para que seguir leyendo funcione"
					//mirar codigo madre en http://www.hashbangcode.com/blog/create-page-posts-wordpress-417.html
					$args = array(
					 'ignore_sticky_posts' => 	0,
					 'posts_per_page'=>	5,
					 'cat'=> icl_object_id_check(970, 'category'),
					 'post__not_in' => $do_not_duplicate,
						);
		 
					$my_query = new WP_Query($args); ?>
						<?php if ( $my_query->have_posts() ) : 	while ( $my_query->have_posts() ) : $my_query->the_post(); 
							
						global $wp_query;	 //necessary to show the tags 
							$wp_query->in_the_loop = true; 
							$more = 0;       // Set (inside the loop) to display content above the more "seguir leyendo" tag. ?>
							<div id="post-<?php the_ID(); ?>" <?php post_class(''); ?>	>
								<?php include("loop.boxes.php")?>
							</div>
						<?php endwhile; else: ?>
					<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
					<?php endif; ?>
				</div>	
			</div>	
			<div class="row">
				<a href="blog" title="Go to blog" alt="Go to blog" class="btn btn-primary btn-lg pull-right"><?php _e('Read more Blog Posts','globalrec'); ?></a>
		 	</div>
		</div>

		<!-- begin sidebar -->
		<div id="menu" class="col-md-3">
			<div classs="widget-container-feed">
				<h4 class="widget-title" style="font-weight: bold;"><?php _e('News by Region'); ?></h4>
				<?php
					$terms = get_terms( 'post-region' );
					echo '<ul style="list-style:none;margin:0;padding:0;">';
					foreach ( $terms as $term ) {

							// The $term is an object, so we don't need to specify the $taxonomy.
							$term_link = get_term_link( $term );
						 
							// If there was an error, continue to the next term.
							if ( is_wp_error( $term_link ) ) {
									continue;
							}

							$region_name = $term->name;
							
							if ( $region_name == 'India' || $region_name == 'Inde' || $region_name == 'Índia' ) {
								//Do not display India
							} else {
								// We successfully got a link. Print it out.
								echo '<li><a href="' . esc_url( $term_link ) . '"><h4>' . $region_name . '</h4></a><li>';
							}
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
			<?php get_sidebar(); ?>
		</div>
		<!-- end sidebar -->
	</div>
	<div id="footer-home-bar" class="row" 	style="border-top:5px solid #fe7c11;	margin:10px 0 0 0;">
	<h5><?php _e('Waste Picker Groups','globalrec'); ?></h5>
	<?php dynamic_sidebar( 'footer-home-bar' ) ?>
	</div>	 
	<?php get_footer(); ?>
</div><!-- #content -->
</div><!-- #primary -->

