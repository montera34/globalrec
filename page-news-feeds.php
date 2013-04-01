<?php  /* Template Name: Page Newsfeeds */ 
get_header(); ?>
<div class="container">
	<?php if (have_posts()) : while (have_posts()) : the_post();?>
		<div id="main">
		<h2 id="post-<?php the_ID(); ?>"><?php the_title();?></h2>
		
		<?php the_content(); ?>
		
						
		</div>	<!-- #main -->
	<?php endwhile; endif; ?>
	<?php  dynamic_sidebar( 'newsroundup' ) ?>
	<?php get_footer(); ?>
</div>


