<?php get_header(); ?>
<div class="container">
		<?php 
		if ( have_posts() ) :
			while ( have_posts() ) : the_post();
				include("loop.page.php");
			endwhile;
		else :
		endif;?>
</div><!-- #page -->

<?php get_footer(); ?>
