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


<?php if ($my_query->have_posts() ) : 
	$count = 0;
	while ( $my_query->have_posts()) : $my_query->the_post(); 
	$count++;
	if ( $count == 1 ) { echo "<div class='row'>"; }
	?>
<div class="portada-post archive-post post-<?php the_ID(); ?>">
	<div style="margin:0 10px 10px 0;">
	<?php 
	if ( has_post_thumbnail()) : ?>
		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
		<?php the_post_thumbnail('thumbnail'); ?>
		</a>
	<?php 
	else:
		echo '<img width="150" src="' . get_bloginfo( 'stylesheet_directory' ) . '/images/thumbnail-default.png" />';
	endif;
	 ?> 	</div>
	<h4 class="archive-header">
		<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">
			<?php the_title() ?>
		</a>
	</h4>
	<?php //related excerpt
	$post_excerpt = get_the_excerpt();
	$pattern = '/.{210}/i';
	preg_match($pattern, $post_excerpt, $matches);
	if ( $matches[0] != '' ) {
		$post_excerpt = $matches[0] . "...";
	} ?> 
	<div class="excerpt">
		<p><?php if($post->post_excerpt) : the_excerpt(); else: 
			echo "" .$post_excerpt; endif; ?> </p>
	</div>
	<div class="postmetadata">
		<?php the_time('F d, Y') ?>
		&nbsp;In category <?php the_category(', ') ?>
		&nbsp;by <?php the_author_posts_link(); ?>
		<?php if (get_the_term_list( $post->ID, 'post-region', '', ', ', '' ) != '')  : 
		echo " Region: ";	
		echo get_the_term_list( $post->ID, 'post-region', '', ', ', '' ); 
		endif;
	 	?> 	
	</div>
</div>

<?php //comments_template(); // Get wp-comments.php template  
	if ( $count == 2 ) { echo "</div><!-- .row -->"; $count = 0; }?>

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
