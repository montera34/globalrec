<article id="post-<?php the_ID(); ?>"> 
	<div class="row">
		<div class="col-md-2 pull-right"><?php do_action('icl_language_selector'); ?></div>
		<h2 id="post-<?php the_ID(); ?>" class="col-md-10">
			<?php the_title();?>	
		</h2>		
	</div>
	<div class="row">
		<div class="col-md-8 content">
		<?php the_content(); ?>
		</div>
	</div>
</article>
