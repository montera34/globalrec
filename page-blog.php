<?php  /* Template Name: Page blog*/ 
get_header(); ?>

<div class="container">
	<div class="row-fluid">
		<div id="blog" class="span9">	
			<div class="row-fluid">
				<h2 id="post-<?php the_ID(); ?>" class="span6">
					<?php the_title();?>	
				</h2>		
				<div class="pull-right"><?php do_action('icl_language_selector'); ?></div>
			</div>	
			<ul class="thumbnails">	
			<?php
			global $more;    // Declare global $more (before the loop). "para que seguir leyendo funcione"
				//mirar codigo madre en http://www.hashbangcode.com/blog/create-page-posts-wordpress-417.html
				$args = array(
				 'caller_get_posts' => 1,
				'posts_per_page'=>	12
					);
				if ( $paged > 1 ) {
				 $args['paged'] = $paged;
					}

				$my_query = new WP_Query($args);
				?>

			<?php if ($my_query->have_posts() ) : 
			$count = 0;
			while ( $my_query->have_posts()) : $my_query->the_post(); 
			$count++;
			if ( $count == 1 ) { echo "<div class='row-fluid'>"; }
			?>
			<li id="post-<?php the_ID(); ?>" <?php post_class('span4'); ?>	>
				<?php include("loop.boxes.php")?>
			</li>
			<?php if ( $count == 3 ) { echo "</div><!-- .row --><hr>"; $count = 0; }?>

			<?php endwhile; else: ?>
			<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
			<?php endif; ?>
			</ul>
		</div>
	<div class="span3">
		<?php  dynamic_sidebar( 'blog-sidebar' ) ?>
	</div>
		<div class="row-fluid">
  			<div class="offset3 span9">
				<div class="pull-left">
				<?php if ( !$max_page ) {
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
					?>
				</div>
  				<div class="pull-right"><?php 
					if ( !is_single() && $paged > 1 ) {
  				$attr = apply_filters( 'previous_posts_link_attributes', '' );
  				echo '<a href="' . previous_posts( false ) . "\" $attr>". preg_replace( '/&([^#])(?![a-z]{1,8};)/', '&$1', 'Newer posts &raquo;' ) .'</a>';
					}
				?></div>
			</div>
		</div>
	<?php get_footer(); ?>
</div>

