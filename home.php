<?php  /* Template Name: Page Home*/ get_header(); 
$categories = get_the_category();
$separator = ' ';
$output = '';
?>
<div class="container">
	<div class="row-fluid">
		<div class="span9">
			<!-- Carousel starts -->
<script type="text/javascript">
$(document).ready(function () {
    $('.carousel').carousel({
        interval: 3000
    });

    $('.carousel').carousel('cycle');
});
</script>
			<!-- div class="row-fluid"> <!-- space for banners -->
				<!-- <div class="span12">
					<?php dynamic_sidebar( 'front-page-widget-area-main' ) ?>
				</div>
			</div>-->

			<div class="row-fluid" id="home-boxes"> 
				<div class="span4">
					<a href="/life-and-voices/">
						<img src="<?php bloginfo('template_url'); ?>/images/wastepicker-faces_p.png" alt=">Life and Voices of Waste pickers" />
						<h3 style="clear: left;">Life and Voices of Waste pickers</h3>
						<p>Get to know waste picker leaders who have actively participated in the Global Alliance of Waste Pickers process.
					</a>
				</div>
				<!-- box for Where we are? ----------------------------------------------------------->
				<div class="span4">
						<?php icl_link_to_element(7618,'page',__('<img src="http://globalrec.org/wp-content/themes/globalrec/images/map-waste-pickers-groups_p.png" >')); ?>
						<h3><?php icl_link_to_element(7618,'page'); ?></h3>
						<p>Provisional list of hundreds of waste pickers’ groups around the globe.</p>
				</div>
				<!-- box for the Last newsletter ----------------------------------------------------------->
				<div class="span4">
					<?php global $more;   
					$args = array(		//arguments for showing newsletters custom post type
						'post_type' => 'newsletter', 
						'posts_per_page' => 1, 
						'post_parent' => 0
						//'order' =>  'ASC',
						
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
							<!--div class="size-thumbnail wp-image-2864 alignleft" style="margin:0 15px 15px 0;position: 
							relative;width:200px;height:130px;background-image:url('<?php echo $src[0]; ?>');"-->
							<?php the_post_thumbnail( 'medium' ); ?> 
							<!--/div-->
								<h4><?php the_title();?></h4>
						</a> 	
						<p>Check out the latest GlobalRec newsletter. You can also <a href="/subscription/">subscribe to receive it by email</a>.</p>
						<?php endwhile; else: ?>
						<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
						<?php endif; ?>
					<h3></h3>
				</div>
			</div> 
			<hr>
			<div class="row-fluid">
				<div class="span4">
					<h3><a href="/category/organizing/" title="Go to Organizing Articles">Organizing</a></h3>
					<?php global $more; 
					$args = array(
					 'caller_get_posts' => 	1,
					 'posts_per_page'=>	4,
					 'cat'=>		858, //change to category "organizing" and internationalize
					 //'post__not_in' => 	get_option( 'sticky_posts' )					 
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
					<h3><a href="category/threats/" title="Go to Threats Articles">Threats</a></h3>
					<?php // montamos otro loop para llamar a los no sticky
					global $more;    // Declare global $more (before the loop). "para que seguir leyendo funcione"
					//mirar codigo madre en http://www.hashbangcode.com/blog/create-page-posts-wordpress-417.html
					$args = array(
					 'caller_get_posts' => 	1,
					 'posts_per_page'=>	4,
					 'cat'=>		964, //change to category "threats" and internationalize				 
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
					<h3><a href="/category/publications/" title="Go to Publications Articles">Publications</a></h3>
					<?php // montamos otro loop para llamar a los no sticky
					global $more;    // Declare global $more (before the loop). "para que seguir leyendo funcione"
					//mirar codigo madre en http://www.hashbangcode.com/blog/create-page-posts-wordpress-417.html
					$args = array(
					 'caller_get_posts' => 	1,
					 'posts_per_page'=>	4,
					 'cat'=>		970, //change to category "publications" and internationalize					 
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
			<a href="blog" title="Go to blog" alt="Go to blog" class="btn btn-large pull-right">Read more blog Posts</a>
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

