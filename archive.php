<?php get_header(); ?>
<?php
$termname = $wp_query->queried_object->name;
$termdesc = $wp_query->queried_object->description;
?>
		
<div id="content">
<?php get_sidebar(); ?>
<div id="main">
<h3><strong>

<?php if ( is_tag('pune2012') ) { ?>
	<h2>Pune 2012 posts</h2>
<?php } elseif ( is_category() ) { ?>
	<h4><?php _e('Category:', 'cp'); ?> <span><?php single_cat_title(); ?></span></h4>
<?php } elseif ( get_post_type() == 'global-meeting' && is_archive()) { ?>
	<h4><?php _e('Global meeting type:', 'cp'); ?> <span><?php echo $termname ?></span></h4>
<?php } elseif ( is_tag() ) { ?>
	<h4><?php _e('Tag:', 'cp'); ?> <span><?php single_tag_title(); ?></span></h4>
<?php } elseif ( is_day() ) { ?>
	<h4><?php _e('Archive:', 'cp'); ?> <span><?php the_time( __('F jS, Y', 'cp') ); ?></span></h4>
<?php } elseif ( is_month() ) { ?>
	<h4><?php _e('Archive:', 'cp'); ?> <span><?php the_time( __('F, Y', 'cp') ); ?></span></h4>
<?php } elseif ( is_year() ) { ?>
	<h4><?php _e('Archive:', 'cp'); ?> <span><?php the_time( __('Y', 'cp') ); ?></span></h4>
<?php } elseif ( is_author() ) { ?>	
	<h4><?php _e('Author Archive', 'cp'); ?> </h4>
<?php } elseif ( isset($_GET['paged']) && !empty($_GET['paged']) ) { ?>
	<h4><?php __('Blog Archives', 'cp'); ?></h4>
<?php } ?>
</strong></h3>
<span class"postmetadata alt"> <?php echo category_description(); ?></span>	

					
<?php if (have_posts()) : 
	$count = 0;
	while (have_posts()) : the_post(); 
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
	$pattern = '/.{180}/i';
	preg_match($pattern, $post_excerpt, $matches);
	if ( $matches[0] != '' ) {
		$post_excerpt = $matches[0] . "...";
	} ?> 
	<div class="excerpt">
		<p><?php echo "" .$post_excerpt; ?> </p>
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
</div>

<?php posts_nav_link(' &#8212; ', __('&laquo; Newer Posts'), __('Older Posts &raquo;')); ?>

<?php get_footer(); ?>
