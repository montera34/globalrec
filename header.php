<?php
/**
 * @package WordPress
 * @subpackage Classic_Theme
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11">
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>
		<meta name="description" content="<?php if ( is_single() || is_page() ) {
        single_post_title('', true); 
    } else {
        bloginfo('description');
    }
    ?>" />
		<meta name="keywords" content="waste picker, reciclador, waste pickers, trash, waste, recycling, basura, reciclaje, residuos, globalrec.org, globalrec, lixo" />
	<meta content="Global Alliance of Waste Pickers" name="organization" />
	
	
<!-- Bootstrap -->
<link href="<?php bloginfo('template_url'); ?>/css/bootstrap.min.css" rel="stylesheet" />
<!-- /Bootstrap -->
<link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700' rel='stylesheet' type='text/css'>

	 <style type="text/css" media="screen">
		@import url( <?php bloginfo('stylesheet_url'); ?> );
	</style>
<link href='http://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet' type='text/css'>
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	
	<?php wp_get_archives('type=monthly&format=link'); ?>
	
	<?php //comments_popup_script(); // off by default ?>
	<script type="text/javascript">
  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/plusone.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) {return;}
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div class="navbar navbar-inverse navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container">	
			<div class="span12">
				<?php $defaults = array(
					'theme_location'  => 'main-menu',
					'container' => 'false',
					'menu_id' => 'pre-menu',
					'menu_class' => 'nav menu_class navbar inline-menu'
					);
				wp_nav_menu( $defaults );?>
				<?php do_action('icl_language_selector'); ?>
			</div>
		</div>
	</div>
</div>
<!--span id="header-top-top" class="tagline" ><img alt="Global Alliance of Waste Pickers" src="<?php bloginfo('template_url'); ?>/images/logotipo_1.png" style="display:none;"></span-->
<div class="container">
	<div class="row-fluid" style="padding-top: 60px;">
		<div id="logo" class="span8">
			<h2 class="textfuera"><a alt="Home" title="Home" href="<?php bloginfo('url'); ?>/" ><img src="<?php bloginfo('template_url'); ?>/images/logo_3.png" ></a><span syle="font-family: 'Roboto Condensed', sans-serif;">Global Alliance of Waste Pickers</span> </h2>
			<h2 class="textfuera"><?php echo $genvars['blogdesc']; ?></h2>
		</div><!-- #logo -->
		<div id="search" class="span4">
			<?php get_search_form(); ?>
		</div>
		<li class=""> 	
			<a href="http://www.twitter.com/global_rec"><img class="alignnone size-full wp-image-18" title="tw" src="http://www.globalrec.org/wp-content/uploads/2011/11/tw.gif" alt="" width="16" height="16" /> 
			</a>
		</li>
		<li class=" "> <a href="http://www.facebook.com/pages/GlobalRec/207415605997716">
			<img class="alignnone size-full wp-image-15" style="text-align: -webkit-auto;" title="fb" src="http://www.globalrec.org/wp-content/uploads/2011/11/fb.gif" alt="" width="16" height="16" />  </a>
		</li>
	</div>
</div>
<!-- end header -->
