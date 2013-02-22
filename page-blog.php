<?php  /* Template Name: Page blog*/ 
get_header(); ?>

<div id="content">
<?php get_sidebar(); ?>
<div id="main">
	<div id="blog">	
	<?php
			global $more;    // Declare global $more (before the loop). "para que seguir leyendo funcione"
				//mirar codigo madre en http://www.hashbangcode.com/blog/create-page-posts-wordpress-417.html
				$args = array(
				 'caller_get_posts' => 1
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
						$more = 0; // Set (inside the loop) to display content above the more "seguir leyendo" tag. ?>


			<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
			
				<h3 class="post-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a><div class="edit-button"><?php edit_post_link(__('Edit This')); ?></div></h3>
				<div class="postmetadata">
										<?php the_time('F d Y') ?>&nbsp;&nbsp;&nbsp;&bull;&nbsp;&nbsp;&nbsp;<?php the_category(', ') ?>
										<!--
										<?the_tags('&nbsp;&nbsp;&nbsp;&bull;&nbsp;&nbsp;&nbsp;<span class="tags">tags:&nbsp;','  ','</span>' ); ?>
										&nbsp;&nbsp;&nbsp;&bull;&nbsp;&nbsp;<?php comments_popup_link('0&nbsp;comentarios', '1&nbsp;comentario', '%&nbsp;comentarios'); ?>-->	
										&nbsp;&nbsp;&nbsp;&bull;&nbsp;&nbsp;<?php the_author_posts_link(); ?>
										
				</div>
				<div class="storycontent">
					<?php //the_content(__('Read the rest of the post')); ?>
					<?php the_excerpt(); ?>
				</div>

				<div class="feedback">
					<?php wp_link_pages(); ?>
					<?php comments_popup_link(__(''), __('Comments (1)'), __('Comments (%)')); ?>
				</div>	
			</div>

	<?php endwhile; else: ?>
	<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
	<?php endif; ?>

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
	</div><!-- #blog -->
</div>	<!-- #main -->
</div><!-- #content -->
<?php get_footer(); ?>
