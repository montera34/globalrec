<?php get_header(); ?>

<div class="container">
	<div class="row">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div <?php post_class('') ?> id="post-<?php the_ID(); ?>">
			<div class="row">
				<div class="col-md-10">
					<ul class="breadcrumb">
						<li><a href="<?php echo get_permalink(icl_object_id(2856,'page')) ?>"><?php _e('Who we are','globalrec'); ?></a></li>
						<li><?php the_title(); ?> </li>
					</ul>
				</div>
				<div class="col-md-2">
					<?php if ( is_user_logged_in() ) { ?><div class="btn btn-xs btn-default pull-right"> <?php edit_post_link(__('Edit This')); ?></div> <?php } ?>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-3">
				<?php the_post_thumbnail( 'medium',array('class'=> "img-rounded img-responsive",'alt'=> ''.get_the_title().'','title'	=> ''.get_the_title().'') ); ?> <br>
				<dl>
					<?php
						global $post;
						$postid = $post->ID;
						if ( is_user_logged_in() ) { ?>
					 		<dt>email</dt>
							<?php
								echo "<dd>".get_post_meta( $postid, 'bio_email', true )."</dd>";
								echo "<dt>Telephone</dt>";
								echo "<dd>".get_post_meta( $postid, 'bio_telephone', true )."</dd>";
						}
						//retrieve Country
						$country_id = get_post_meta( $postid, 'bio_country', true );
						$country = get_post($country_id);
						$country_link = get_permalink($country->ID);
						$country_name = $country->post_title;
						//retrieve Waste Picker group
						$group_id = get_post_meta( $postid, 'bio_group', true );
						$group = get_post($group_id);
						$group_link = get_permalink($postid);
						if ( $group != "" ) {
							$group_name = $group->post_title;
						} else {
							$group_name = "no group assigned";
						}
						if ($group == "" ){
							//do nothing
						} else if ( $group_name != get_the_title() ) {
							echo '<dt><span class="dashicons groups-dashicon"></span>'. __('Waste Picker Group','globalrec') . '</dt>';
							echo '<dd><a href="'.$group_link.'">'.$group_name.'</a></dd>';
						}
						echo '<dt>Country</dt><dd><a href="'.$country_link.'">'.$country_name.'</a></dd>';
					?>
				</dl>
			</div>
			<div class="col-md-7 content">
			<h2><?php the_title(); ?></h2>
			<?php the_content(__('(more...)')); ?>
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
