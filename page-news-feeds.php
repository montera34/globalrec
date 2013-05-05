<?php  /* Template Name: Page Newsfeeds */ 
get_header(); ?>
<div class="container">
	<?php if (have_posts()) : while (have_posts()) : the_post();?>
	<div class="row-fluid">
		<h2 id="post-<?php the_ID(); ?>" class="span10">
			<?php the_title();?>	
		</h2>		
		<div class="pull-right"><?php do_action('icl_language_selector'); ?></div>
	</div>
 
	<?php the_content(); ?>				
 	
	<?php endwhile; endif; ?>
	<div class="row-fluid">
	<?php  dynamic_sidebar( 'newsroundup' ) ?>
	</div>
	<?php get_footer(); ?>
</div>


