<?php  /* Template Name: Page Biographies*/ 
get_header(); ?>

<div id="page">
	<div class="container">
		<div class="row-fluid">
			<?php if (have_posts()) : while (have_posts()) : the_post();?>
			<h2 id="post-<?php the_ID(); ?>" class="span10">
				<?php the_title();?>
			</h2>
			<div class="pull-right"><?php do_action('icl_language_selector'); ?></div>
		</div>		
		<div class="row-fluid">
			<?php the_content();  
			endwhile; endif; 

			global $more;    // Declare global $more (before the loop). "para que seguir leyendo funcione"
				//mirar codigo madre en http://www.hashbangcode.com/blog/create-page-posts-wordpress-417.html
				$args = array(
				'caller_get_posts' => 1,
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
		
				$more = 0;       // Set (inside the loop) to display content above the more "seguir leyendo" tag. ?>
				<?php $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), thumbnail, false, '' ); ?>
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

		<div class="navigation">
  			<div class="alignleft"><?php 
				if ( !$max_page ) {
 					 $max_page = $my_query->max_num_pages;
					}
 
				if ( !$paged ) {
 					 $paged = 1;
					}
					$nextpage = intval($paged) + 1;
 
				if ( !is_single() && ( empty($paged) || $nextpage <= $max_page) ) {
  					$attr = apply_filters( 'next_posts_link_attributes', '' );
 					 echo '<a href="' . next_posts( $max_page, false ) . "\" $attr>". preg_replace('/&([^#])(?![a-z]{1,8};)/', '&$1', ' &laquo; Previous posts') .'</a>';
					}
					?></div>
  					<div class="alignright"><?php 
					if ( !is_single() && $paged > 1 ) {
  				$attr = apply_filters( 'previous_posts_link_attributes', '' );
  				echo '<a href="' . previous_posts( false ) . "\" $attr>". preg_replace( '/&([^#])(?![a-z]{1,8};)/', '&$1', 'Newer posts &raquo;' ) .'</a>';
					}
				?></div>
			</div>
	</div>
</div>
<?php get_footer(); ?>

