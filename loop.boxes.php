<?php
$categories = get_the_category();
$separator = ' ';
$output = '';

?>

<div class="thumbnail">
	<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">
	<?php if (has_post_thumbnail()) :
			echo "<div class=\"row-fluid\"><div class=\"size-thumbnail span10\" style=\"font-size:12px;margin:0 10px 10px 0;\">";
			the_post_thumbnail( 'medium' );
			echo "</div></div>";
		else:
			//echo '<img width="150" src="' . get_bloginfo( 'stylesheet_directory' ) . '/images/thumbnail-default.png" />';
		endif; ?>
	</a>
	<div class="">
		<h4>
			<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a>
		</h4>
		<div class="post-metadata">
			<small> 
			<?php if (get_post_type() == 'post') { 
				$written_by = get_post_meta( $post->ID, '_gr_written-by', true ); 
				 	if ($written_by != '')  { //if the text is written by a journalist the field "written" by will be filled
						echo $written_by;
					}
					else {
						the_author_posts_link();
					}
				}
			?> 
			<?php  
				if (get_the_term_list( $post->ID, 'post-region', '', ', ', '' ) != '')  : 
				echo "| Region ";	
				echo get_the_term_list( $post->ID, 'post-region', '', ', ', '' ); 
				echo " | ";
				echo the_time('M d, Y');
				endif;
		 	?></small>
		</div>
		<?php //related excerpt
			$post_excerpt = get_the_excerpt();
			$pattern = '/.{180}/i';
			preg_match($pattern, $post_excerpt, $matches);
			if ( $matches[0] != '' ) {
				$post_excerpt = $matches[0] . "...";
			} ?> 
		<?php if (get_post_type() != 'global-meeting') { //conditional if is global meeting custom post type, don-t show excerpt?>		
			<div class="excerpt">
				<small>
					<?php if($post->post_excerpt) : the_excerpt(); else: 
					echo "" .$post_excerpt; endif; ?> 
				</small>
			</div>
		<?php }?>
		 			<?php $text = get_post_meta( $post->ID, 'gm_location', true ); echo $text; ?>  
					<span class="label"><?php echo get_the_term_list( $post->ID, 'gb-year', ' ', ', ', '' ); ?></span> 
				 	<?php echo $op; ?>
		<div>
		<?php // the_time('F d, Y') ?>
		<?php
			if($categories){
				foreach($categories as $category) {
					$output .= '<a href="'.get_category_link( $category->term_id ).'" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) . '" class="label">'.$category->cat_name.'</a>'.$separator;
				}
			echo trim($output, $separator);
			}	
		?>			
		</div>
	</div>
</div>

