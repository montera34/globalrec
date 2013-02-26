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

					
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<div class="portada-post archive-post post-<?php the_ID(); ?>">
	<div style="margin:0 10px 10px 0;">
	<?php the_post_thumbnail( array(150,150) ); ?> 	</div>
	<h4 class="archive-header">
		<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">
			<?php the_title() ?>
		</a>
	</h4>
	<!--div class="postmetadata">
		<?php the_time('F d, Y') ?>										
	</div-->
	<div class="excerpt">
		<?php the_excerpt(); ?> 
	</div>
	<div class="postmetadata">
		<?php the_time('F d, Y') ?> &nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp; In category <?php the_category(', ') ?>&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp; by <?php the_author_posts_link(); ?>&nbsp;&nbsp;&nbsp;
		<!--&bull;&nbsp;&nbsp;Region <?php echo get_the_term_list( $post->ID, 'post-region', '', ', ', '' ); ?> -->					
	</div>
</div>

<?php comments_template(); // Get wp-comments.php template ?>

<?php endwhile; else: ?>
<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
<?php endif; ?>
</div>

<?php posts_nav_link(' &#8212; ', __('&laquo; Newer Posts'), __('Older Posts &raquo;')); ?>

<?php get_footer(); ?>
