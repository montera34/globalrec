<?php  /* Template Name: Page Biographies*/ 
get_header(); ?>

<div class="container">
	<div class="row">
		<?php if (have_posts()) : while (have_posts()) : the_post();?>
		<div class="pull-right"><?php do_action('icl_language_selector'); ?></div>
		<h2 id="post-<?php the_ID(); ?>" class="col-md-8">
			<?php the_title();?>
		</h2>
	</div>		
	<div class="row">
		<div class="col-md-8 content">
			<?php the_content(); 
			endwhile; endif; ?>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
		<?php 
			global $more;    // Declare global $more (before the loop). "para que seguir leyendo funcione"
			//mirar codigo madre en http://www.hashbangcode.com/blog/create-page-posts-wordpress-417.html
			$args = array(
			'ignore_sticky_posts' => 1,
			'post_type' => 'bio', 
			'posts_per_page' => -1, 
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
			?>
			<?php $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'thumbnail', false); ?>
			<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?> bio">
				<div class="size-thumbnail wp-image-2864 alignleft" style="float:left;margin:0 15px 15px 0;position: relative;width:150px;height:150px;background-image:url('<?php echo $src[0]; ?>');">
				<?php //the_post_thumbnail( 'thumbnail' ); ?>
					<div class='box-bottom'>
					<span><?php the_title_attribute(); ?></span>
					</div><!-- .box-bottom -->
				</div>
			</a>

		<?php endwhile; else: ?>
		<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
		<?php endif; ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>

