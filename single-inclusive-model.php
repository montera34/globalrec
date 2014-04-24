<?php get_header(); ?>

<div class="container">
	<div class="row">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div <?php post_class('') ?> id="post-<?php the_ID(); ?>">
			<div class="row">
				<div class="col-md-10">
					<ul class="breadcrumb">
						<li><a href="<?php echo get_permalink(icl_object_id(10950,'page')) ?>"><?php _e('Inclusive Models','globalrec'); ?></a></li>
						<li><?php the_title(); ?> </li>
					</ul>
				</div>
				<?php if ( is_user_logged_in() ) { echo '<div class="btn btn-sm btn-default pull-right">'; edit_post_link(__('Edit This')); echo "</div>";} ?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-7 content">
				<h1><?php the_title(); ?></h1>
				<?php the_content(__('(more...)')); ?>
			</div>
		</div>
	</div>
	<?php include("share.php")?>

	<?php endwhile; else: ?>
	<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
	<?php endif; ?>

<?php get_footer(); ?>
</div>
