<ul class="nav nav-tabs" role="tablist">
	<li role="presentation"><a href="<?php echo get_permalink( icl_object_id( 10909 , 'page' , false)); ?>" title="Home WAW"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a></li>
	<li role="presentation"><a href="<?php echo get_permalink( icl_object_id( 20914 , 'page' , false)); ?>"><?php _e('About WAW','globalrec'); ?></a></li>
	<li role="presentation"><a href="<?php echo get_permalink( icl_object_id( 23270 , 'page' , false)); ?>"><span class="glyphicon glyphicon-stats" aria-hidden="true"></span> <?php _e('Statistics','globalrec'); ?></a></li>
	<li role="presentation"><a href="<?php echo get_permalink( icl_object_id( 30757 , 'page' , false)); ?>">
		<span class="glyphicon glyphicon-list" aria-hidden="true"></span> <?php _e('List of Waste Picker Organizations','globalrec'); ?></a>
	</li>
	<li><a href="<?php echo get_permalink( icl_object_id( 23274 , 'page' , false)); ?>"><?php _e("Waste Pickers' Organizations Map","globalrec"); ?></a></li>
	<li role="presentation" class="dropdown">
		<a class="dropdown-toggle" data-toggle="dropdown" href="/waw/" role="button" aria-expanded="false">
		  <span class="glyphicon glyphicon-globe"></span> <?php _e('Maps','globalrec'); ?> <span class="caret"></span>
		</a>
		<ul class="dropdown-menu" role="menu">
			<li role="presentation"><a href="<?php echo get_permalink( icl_object_id( 23274 , 'page' , false)); ?>"><?php _e("Waste Pickers' Organizations","globalrec"); ?></a></li>
			<li role="presentation"><a href="<?php echo get_permalink( icl_object_id( 20848 , 'page' , false)); ?>"><?php _e('Type of Oganizations','globalrec'); ?></a></li>
			<li role="presentation"><a href="<?php echo get_permalink( icl_object_id( 20830 , 'page' , false)); ?>"><?php _e('Scope','globalrec'); ?></a></li>
				<?php if ( is_user_logged_in() ) { ?><li role="presentation"><a href="<?php echo get_permalink( icl_object_id( 21900 , 'page' , false)); ?>"><?php _e('Supporters','globalrec'); ?> <span class="glyphicon glyphicon-lock"></span></a></li><?php } // hides supporters page for not logged in users?>
		</ul>
	</li>
	<li role="presentation"><a href="<?php echo get_permalink( icl_object_id( 30746 , 'page' , false)); ?>"><?php _e('Add your organization','globalrec'); ?></a></li>
	<?php if ( is_user_logged_in() ) { ?>
	<li role="presentation" class="dropdown">
		<a class="dropdown-toggle" data-toggle="dropdown" href="" role="button" aria-expanded="false">
		  <span class="glyphicon glyphicon-lock"></span> <?php _e('Internal','globalrec'); ?> <span class="caret"></span>
		</a>
		<ul class="dropdown-menu" role="menu">
			<li role="presentation"><a href="<?php echo get_permalink( icl_object_id( 33027 , 'page' , false)); ?>"><?php _e("Last updated Organizations","globalrec"); ?></a></li>
			<li role="presentation"><a href="<?php echo get_permalink( icl_object_id( 33025 , 'page' , false)); ?>"><?php _e('Candidate organizations','globalrec'); ?></a></li>
			<li role="presentation"><a href="<?php echo get_permalink( icl_object_id( 34607 , 'page' , false)); ?>"><?php _e("Contact list","globalrec"); ?></a></li>
		</ul>
	</li>
	<?php } ?>
</ul>
