<?php get_header(); ?>

<div class="container">
	<div class="row">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div <?php post_class('') ?> id="post-<?php the_ID(); ?>">
			<div class="row">
				<div class="col-md-10">
					<ul class="breadcrumb">
						<li><a href="<?php echo get_permalink(icl_object_id(790,'page')) ?>"><?php _e('Law Reports','globalrec'); ?></a></li>
						<li><?php the_title(); ?> </li>
					</ul>
				</div>
				<div class="col-md-2">
					<?php if ( is_user_logged_in() ) { ?><div class="btn btn-xs btn-default pull-right"> <?php edit_post_link(__('Edit This')); ?></div> <?php } ?>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-7 content">
				<h1><?php _e('Law Report','globalrec');?>: <?php the_title(); ?></h1>
				<?php the_content(__('(more...)')); ?>
			</div>
			<div class="col-md-3">
			<?php 
			$downloads = get_post_meta( $post->ID, '_law_downloads', true );
			if ($downloads) { 
				echo "<h2>Downloads</h2>";
				echo $downloads;
			}
			?>
			<hr>
			<?php	
				$country_id = get_post_meta( $post->ID, '_law_countryselect', true );
				$country = get_post($country_id);
				$country_link = get_permalink($country->ID);
				$country_name = $country->post_title;
				echo '<a href="'.$country_link.'">'._e('Find more information about ','globalrec').$country_name.'</a>';
			?>
			</div>
		</div>
	</div>
	<?php include("share.php")?>

	<?php endwhile; else: ?>
	<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
	<?php endif; ?>

	</div>
	<?php get_footer(); ?>
	
</div>
