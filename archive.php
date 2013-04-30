<?php get_header(); ?>
<?php
$termname = $wp_query->queried_object->name;
$termdesc = $wp_query->queried_object->description;
?>
		
<div class="container">
	<h3>
		<strong>
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
		</strong>
	</h3>
	<div class="row-fluid">
		<span> <?php echo category_description(); ?></span>	
		<ul class="thumbnails">	
			<?php if (have_posts()) : $count = 0;
				while (have_posts()) : the_post();
				$count++;
				if ( $count == 1 ) { echo "<div class='row-fluid'>"; } ?>
				<li id="post-<?php the_ID(); ?>" <?php post_class('span3'); ?>	>
					<?php include("loop.boxes.php")?>
				</li>

			<?php if ( $count == 4 ) { echo "</div><!-- .row --><hr>"; $count = 0; }?>
			<?php endwhile; else: ?>
		</ul>
		<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
		<?php endif; ?>
	</div>
</div>

<?php posts_nav_link(' &#8212; ', __('&laquo; Newer Posts'), __('Older Posts &raquo;')); ?>

<?php get_footer(); ?>
