<?php
$categories = get_the_category();
$separator = ' ';
$output = '';

?>
<li id="post-<?php the_ID(); ?>" <?php post_class('span4'); ?>	>
	<div class="thumbnail">
		<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">
		<?php if (has_post_thumbnail()) :
				echo "<div class=\"size-thumbnail \" style=\"font-size:12px;margin:0 10px 10px 0;\">";
				the_post_thumbnail( 'thumbnail' );
				echo "</div>";
			else:
				//echo '<img width="150" src="' . get_bloginfo( 'stylesheet_directory' ) . '/images/thumbnail-default.png" />';
			endif; ?>
		</a>
		<div class="caption">
			<h4 class="post-title">
				<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a>
			</h4>

			<div>
 				 <small>
				  <?php the_author_posts_link(); ?>  <br>
				<?php the_excerpt(); ?></small>		
			</div>
			<div id="postmetadata">
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
</li>
