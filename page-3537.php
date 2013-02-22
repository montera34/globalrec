<?php  /* Template Name: Page Newsround up*/ 
get_header(); ?>

		<div id="content">
			<?php get_sidebar(); ?>
		
			
			<?php if (have_posts()) : while (have_posts()) : the_post();?>
				<div id="main">
				<h2 id="post-<?php the_ID(); ?>"><?php the_title();?></h2>
				
				<?php the_content(); ?>
				<?php if ( ! dynamic_sidebar( 'newsroundup' ) ) : ?><?php endif; // end primary widget area ?>
								
				</div>	<!-- #main -->
			<?php endwhile; endif; ?>
			
			<?php get_footer(); ?>
		</div><!-- #content -->
		</div><!-- #primary -->

