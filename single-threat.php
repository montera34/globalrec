<?php get_header(); ?>

<div class="container">
	<div class="row">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div <?php post_class('col-md-12') ?> id="post-<?php the_ID(); ?>">
			<div class="row">
				<div class="col-md-10">
					<ul class="breadcrumb">
						<li><a href="/threats">Threats</a></li>
						<li><?php the_title(); ?> </li>
					</ul>
				</div>
				<div class="btn btn-default btn-sm pull-right"><?php edit_post_link(__('Edit This')); ?></div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-3">
				<?php the_post_thumbnail( 'medium',array('class'=> "img-rounded img-responsive",'alt'=> ''.get_the_title().'','title'	=> ''.get_the_title().'') ); ?> <br>
			</div>
			<div class="col-md-7">
			<h1><?php the_title(); ?></h1>
			<?php the_content(__('(more...)')); ?>
			</div>
		</div>
	</div>
	<?php include("share.php")?>
	<?php // comments_template();  Get wp-comments.php template ?>

	<?php endwhile; else: ?>
	<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
	<?php endif; ?>

	<?php posts_nav_link(' &#8212; ', __('&laquo; Newer Posts'), __('Older Posts &raquo;')); ?>
	</div>
	<?php get_footer(); ?>
	
</div>
