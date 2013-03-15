<?php
/**
 * @package WordPress
 * @subpackage Classic_Theme
 */
?>
<!-- begin sidebar -->
<div id="menu" class="span3">
	<ul>
	<?php wp_nav_menu( array( 'theme_location' => 'side-menu' ) ); ?>
	<?php 
		if ( is_page('blog') || is_category() || is_search()) { 
			echo '<li id="secondnav">Categories</li>';
			$args = array(//'exclude' => 568,
	'title_li'     => __('')		);
			wp_list_categories( $args ); 
		} 
	?>
	</ul>
</div>
<!-- end sidebar -->
