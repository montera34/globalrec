<?php
global $wp_query;
$wp_query->in_the_loop = true;
?>
<h3>
	<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
		<?php
		the_title();
		$country_ID = get_post_meta( $post->ID, '_post_country', true );
		$id = icl_object_id($country_ID, 'country', true);
		$country = get_post( $id );
		$countrytitle = $country->post_title;
		echo " (".$countrytitle. ")";
		?></a>
	<small>
		<?php echo _e('by','globalrec');?> <?php //author
		$written_by = get_post_meta( $post->ID, '_gr_written-by', true );
		$published_date = get_post_meta( $post->ID, '_gr_article-date', true );
	 	if ($written_by != '')  { //if the text is written by a journalist the field "written" by will be filled
			echo $written_by;
		}
		else {
			the_author_posts_link();
		}
		echo  ' (';
		echo $published_date != ''? $published_date : the_time('m/d/Y');
		echo ')';
		?>
	</small>
</h3>
<div class="size-thumbnail" style="width:300px;margin:0 0 10px 0;">
	<a href="<?php the_permalink() ?>" rel="bookmark" title="Go to <?php the_title_attribute(); ?>">
	<?php	//the thumbnail 
	the_post_thumbnail( 'medium', array('class' => 'img-responsive','width' => '300') );?>
	</a>
</div>
<?php //the summary
$summary = get_post_meta( $post->ID, '_gr_post-summary', true );
echo $summary;
?>
