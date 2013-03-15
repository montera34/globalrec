<?php
/**
 * @package WordPress
 * @subpackage Classic_Theme
 */
?>
<!-- begin sidebar -->
<div id="menu">

<ul>
<?php do_action('icl_language_selector'); ?>
<?php //wp_nav_menu( array( 'theme_location' => 'side-menu' ) ); ?>
<?php 
	if ( is_page('blog') || is_category() || is_search()) { 
		echo '<li id="secondnav">Categories</li>';
		$args = array(//'exclude' => 568,
'title_li'     => __('')		);
		wp_list_categories( $args ); 
	} 
?>
  
 <li id="search" class="secondary-bar"> 
   <label for="s"><?php _e('Search:'); ?></label>
   <form id="searchform" method="get" action="<?php bloginfo('home'); ?>">
	<div>
		<input type="text" name="s" id="s" size="15" /><br />
		<input type="submit" value="<?php esc_attr_e('Search'); ?>" />
	</div>
	</form>
 </li>


</ul>

</div>
<!-- end sidebar -->
