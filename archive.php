<?php get_header(); ?>
<?php
$termname = $wp_query->queried_object->name;
$termdesc = $wp_query->queried_object->description;
?>
		
<div id="archive">
	<div class="row">
		<div class="col-md-10">
			<strong>
			<?php if ( is_tag('pune2012') ) { ?>
				<h2>Pune 2012 posts</h2>
			<?php } elseif ( is_category() ) { ?>
				<h2><?php _e('Category:', 'cp'); ?> <span><?php single_cat_title(); ?></span></h2>
			<?php } elseif ( get_post_type() == 'global-meeting' && is_archive()) { ?>
				<h2><?php _e('Global meeting type:', 'cp'); ?> <span><?php echo $termname ?></span></h2>
			<?php } elseif ( get_post_type() == 'post' && is_archive()) { ?>
				<h2><?php _e('', 'cp'); ?> <span><?php echo $termname ?></span></h2>
			<?php } elseif ( is_tag() ) { ?>
				<h2><?php _e('Tag:', 'cp'); ?> <span><?php single_tag_title(); ?></span></h2>
			<?php } elseif ( is_day() ) { ?>
				<h2><?php _e('Archive:', 'cp'); ?> <span><?php the_time( __('F jS, Y', 'cp') ); ?></span></h2>
			<?php } elseif ( is_month() ) { ?>
				<h2><?php _e('Archive:', 'cp'); ?> <span><?php the_time( __('F, Y', 'cp') ); ?></span></h2>
			<?php } elseif ( is_year() ) { ?>
				<h2><?php _e('Archive:', 'cp'); ?> <span><?php the_time( __('Y', 'cp') ); ?></span></h2>
			<?php } elseif ( is_author() ) { ?>	
				<h2><?php _e('Author Archive', 'cp'); ?> </h2>
			<?php } elseif ( isset($_GET['paged']) && !empty($_GET['paged']) ) { ?>
				<h2><?php __('Blog Archives', 'cp'); ?></h2>
			<?php } ?>
			</strong>
		</div>
		<div class="pull-right"><?php do_action('icl_language_selector'); ?></div>
	</div>
	<div class="row">
		<span> <?php echo category_description(); ?></span>	
		<ul>	
			<?php if (have_posts()) : $count = 0;
				while (have_posts()) : the_post();
				$count++;
				if ( $count == 1 ) { echo "<div class='row'>"; } ?>
				<li id="post-<?php the_ID(); ?>" <?php post_class('col-md-3'); ?>	>
					<?php include("loop.boxes.php")?>
				</li>

			<?php if ( $count == 4 ) { echo "</div><!-- .row --><hr>"; $count = 0; }?>
			<?php endwhile; else: ?>
		</ul>
		<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
		<?php endif; ?>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="pull-right btn btm-default btn-lg">
				<?php posts_nav_link(' &#8212; ', __('&laquo; Newer Posts'), __('Older Posts &raquo;')); ?>
			</div>
		</div>
	</div>
</div>
<?php get_footer(); ?>
