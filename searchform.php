<form class="navbar-form navbar-left form-search" role="search" action="/" method="get">
	<div class="form-group">
		<input type="text" name="s" id="search" value="<?php the_search_query(); ?>" class="search-query form-control input-sm" placeholder="<?php _e('Search'); ?>"/>
	</div>
	<button for="search"  type="submit" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-search"></span> <?php _e("Search"); ?></button>
</form>
