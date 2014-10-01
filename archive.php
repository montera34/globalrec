<?php get_header(); ?>
<?php
$termname = $wp_query->queried_object->name;
$termdesc = $wp_query->queried_object->description;
$author = get_userdata( get_query_var('author') );
?>
		
<div id="archive">
	<div class="row">
		<header class="col-md-10">
			<strong>
			<?php if ( is_tag('pune2012') ) { ?>
				<h2>Pune 2012 posts</h2>
			<?php } elseif ( is_category() ) { ?>
				<h2><?php _e('Category:', 'cp'); ?> <?php single_cat_title(); ?></h2>
			<?php } elseif ( is_author() ) { ?>	
				<h2><?php _e('Posts by', 'globalrec'); ?> <strong><?php echo $author->display_name;?></strong> </h2>
			<?php } elseif ( get_post_type() == 'global-meeting' && is_archive()) { ?>
				<h2><?php _e('Global meeting type:', 'cp'); ?> <?php echo $termname ?></h2>
			<?php } elseif ( get_post_type() == 'post' && is_archive()) { ?>
				<h2><?php _e('', 'cp'); ?> <?php echo $termname ?></h2>
			<?php } elseif ( is_tag() ) { ?>
				<h2><?php _e('Tag:', 'cp'); ?> <span><?php single_tag_title(); ?></span></h2>
			<?php } elseif ( is_day() ) { ?>
				<h2><?php _e('Archive:', 'cp'); ?> <span><?php the_time( __('F jS, Y', 'cp') ); ?></span></h2>
			<?php } elseif ( is_month() ) { ?>
				<h2><?php _e('Archive:', 'cp'); ?> <span><?php the_time( __('F, Y', 'cp') ); ?></span></h2>
			<?php } elseif ( is_year() ) { ?>
				<h2><?php _e('Archive:', 'cp'); ?> <span><?php the_time( __('Y', 'cp') ); ?></span></h2>
			<?php } elseif ( isset($_GET['paged']) && !empty($_GET['paged']) ) { ?>
				<h2><?php __('Blog Archives', 'cp'); ?></h2>
			<?php } ?>
			</strong>
		</header>
		<div class="pull-right"><?php do_action('icl_language_selector'); ?></div>
	</div>
	<?php $cat_desc = category_description();
		if ($cat_desc != '') {echo '<span>'.$cat_desc.'</span>';} ?>
		<?php $my_count = $wp_query->post_count; //The number of posts being displayed ?>
		<?php if (have_posts()) : $count = 0;
			while (have_posts()) : the_post();
			$count++;
			if ( $count == 1 || $count % 4 == 1) { echo "<div class='row'>"; } ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class('col-md-3'); ?>	>
				<?php include("loop.boxes.php")?>
			</article>
		<?php if ( $count % 4 == 0 || $count == $my_count) { echo "</div><!-- .row --><hr>";} 	?>
		<?php endwhile; else: ?>
	<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
	<?php endif; ?>
	<div class="row">
		<div class="col-md-12">
			<div class="pull-right">
				<?php echo custom_pagination(); ?>
			</div>
		</div>
	</div>
</div>
<?php get_footer(); ?>
