<?php
/**
 * @package WordPress
 * @subpackage Classic_Theme
 */
get_header();
?>

<div id="content">
<?php get_sidebar(); ?>
<div id="main">
		<h3>Resultados de la b&uacute;squeda "<strong><?php the_search_query(); ?></strong>"</h3>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	

<div class="portada-post post-<?php the_ID(); ?>">
	
	<h4 class="archive-header"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">
		
			<?php the_title() ?>
		
	</a></h4>
	<div class="postmetadata">
									<?php the_time('d \d\e F \d\e Y') ?>&nbsp;&nbsp;&nbsp;&bull;&nbsp;&nbsp;&nbsp;<?php the_category(', ') ?>
									<!--
									<?the_tags('&nbsp;&nbsp;&nbsp;&bull;&nbsp;&nbsp;&nbsp;<span class="tags">tags:&nbsp;','  ','</span>' ); ?>
									&nbsp;&nbsp;&nbsp;&bull;&nbsp;&nbsp;<?php comments_popup_link('0&nbsp;comentarios', '1&nbsp;comentario', '%&nbsp;comentarios'); ?>-->	
									&nbsp;&nbsp;&nbsp;&bull;&nbsp;&nbsp;<?php the_author_posts_link(); ?>
									
			</div><?php the_excerpt(); ?> 

</div>

<?php comments_template(); // Get wp-comments.php template ?>

<?php endwhile; else: ?>
<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
<?php endif; ?>
</div>
<?php posts_nav_link(' &#8212; ', __('&laquo; Newer Posts'), __('Older Posts &raquo;')); ?>

<?php get_footer(); ?>
