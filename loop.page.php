<article id="post-<?php the_ID(); ?>" <?php post_class('container'); ?>> 
	<div class="row-fluid">
		<h2 id="post-<?php the_ID(); ?>" class="span10">
			<?php the_title();?>	
		</h2>		
		<div class="pull-right"><?php do_action('icl_language_selector'); ?></div>
	</div>
	<div class="row-fluid">
		<div class="span8">
		<?php the_content(); ?>
		</div>
	</div>
</article>
