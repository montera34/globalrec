<?php  /* Template Name: Page Newsletter previsualization*/ 
get_header(); ?>
<div id="page">
	<div>
		<div class="row">
			<?php 
			if ( have_posts() ) :
				while ( have_posts() ) : the_post(); ?>
					<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?>> 
							<h2 id="post-<?php the_ID(); ?>" class="col-md-10">
								<?php the_title();?>	
							</h2>		
							<div class="pull-right"><?php do_action('icl_language_selector'); ?></div>
						</div>
						<div class="row-fluid">
							<div class="col-md-8">
							<?php the_content(); ?>
							<?php  dynamic_sidebar( 'newsletter' ) ?>
							</div>
						</div>
					</article>
				<?php endwhile;
			else :
			endif;?>
		</div><!-- #content -->
	</div><!-- #primary -->
</div><!-- #page -->

<?php get_footer(); ?>

