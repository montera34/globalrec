<li id="post-<?php the_ID(); ?>" <?php post_class('span3'); ?>	>
	<div class="thumbnail">
		<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">
		<?php if (has_post_thumbnail()) :
				echo "<div class=\"size-thumbnail wp-image-2864 alignleft\" style=\"font-size:12px;margin:0 10px 10px 0;\">";
				the_post_thumbnail( 'thumbnail' );
				echo "</div>";
			else:
				echo '<img width="150" src="' . get_bloginfo( 'stylesheet_directory' ) . '/images/thumbnail-default.png" />';
			endif; ?>
		</a>
		<div class="caption">
			<h4 class="post-title">
				<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a>
			</h4>
			<div class="postmetadata">
			<?php the_time('F d, Y') ?>&nbsp;<?php the_category(', ') ?>					
			</div>
			<div class="storycontent">
	`			<p>
 				 <small><?php the_excerpt(); ?></small>
				</p>		
			</div>
		</div>
	</div>
</li>
