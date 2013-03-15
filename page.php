<?php get_header(); ?>
<div id="page">
	<div class="container">
		<div class="row-fluid">
		<?php get_sidebar(); ?>
			<?php 
			if ( have_posts() ) :
				while ( have_posts() ) : the_post();
					include("loop.page.php");
				endwhile;
			else :
			endif;?>
		</div><!-- #content -->
	</div><!-- #primary -->
</div><!-- #page -->

<?php get_footer(); ?>
