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
<?php 	/* Widgetized sidebar, if you have the plugin installed. */
		if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar() ) : ?>
	<?php /*
			$args = array(
			'depth'        => 0,
			'sort_column'  => 'menu_order, post_title',
			'title_li'     => __(''));
			wp_list_pages( $args ); */?> 

	<?php wp_nav_menu( array( 'theme_location' => 'side-menu' ) ); ?>

<?php 
	if ( is_page('blog') || is_single() || is_category() || is_search()) { 
		echo '<li id="secondnav">Categories</li>';
		$args = array(//'exclude' => 568,
'title_li'     => __('')		);
		wp_list_categories( $args ); 
	} 
?>
 
 <li class="secondary-bar"> 
		
	<a href="http://www.twitter.com/global_rec"><img class="alignnone size-full wp-image-18" title="tw" src="http://www.globalrec.org/wp-content/uploads/2011/11/tw.gif" alt="" width="16" height="16" />
		Twitter
	</a>
	
</li>
 <li class="secondary-bar"> <a href="http://www.facebook.com/pages/GlobalRec/207415605997716"><img class="alignnone size-full wp-image-15" style="text-align: -webkit-auto;" title="fb" src="http://www.globalrec.org/wp-content/uploads/2011/11/fb.gif" alt="" width="16" height="16" /> Facebook</a></li> 
 <li id="search" class="secondary-bar"> 
   <label for="s"><?php _e('Search:'); ?></label>
   <form id="searchform" method="get" action="<?php bloginfo('home'); ?>">
	<div>
		<input type="text" name="s" id="s" size="15" /><br />
		<input type="submit" value="<?php esc_attr_e('Search'); ?>" />
	</div>
	</form>
 </li>
 
 <!--li id="meta"><?php _e('Meta:'); ?>
	<ul>
		<?php wp_register(); ?>
		<li><?php wp_loginout(); ?></li>
		<li><a href="<?php bloginfo('rss2_url'); ?>" title="<?php _e('Syndicate this site using RSS'); ?>"><?php _e('<abbr title="Really Simple Syndication">RSS</abbr>'); ?></a></li>
		<li><a href="<?php bloginfo('comments_rss2_url'); ?>" title="<?php _e('The latest comments to all posts in RSS'); ?>"><?php _e('Comments <abbr title="Really Simple Syndication">RSS</abbr>'); ?></a></li>
	</ul>
 </li-->
<?php endif; ?>

</ul>

</div>
<!-- end sidebar -->
