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
	<!-- Bootstrap responsive-->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="<?php bloginfo('template_url'); ?>/css/bootstrap-responsive.css" rel="stylesheet">
<!-- /Bootstrap -->

<style type="text/css" media="screen">
	@import url( <?php bloginfo('stylesheet_url'); ?> );
</style>

<link href='http://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Sintony:400,700' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700' rel='stylesheet' type='text/css'>

<!-- Less -->
<link rel="stylesheet/less" type="text/css" href="<?php bloginfo('template_url'); ?>/less/magic-bootstrap.less" />
<script src="<?php bloginfo('template_url'); ?>/less/less-1.3.3.min.js" type="text/javascript"></script>
<!-- /Less -->

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

<div class="container">
	<div class="row-fluid" style="margin:10px 0 0px;">
		<div id="imagotipo" class="span2">
			<a alt="Home" title="Home" href="<?php bloginfo('url'); ?>/" >
				<!--img src="<?php bloginfo('template_url'); ?>/images/logo_3.png"-->
				<img src="<?php bloginfo('template_url'); ?>/images/logo_<?php $random = rand(3,8); echo $random; ?>.png" alt="Global Alliance Of Wste Pickers Imagotype" />
			</a>
		</div>
		<div id="logotipo" class="span4">
			<h1><span style="font-family: 'Roboto Condensed', sans-serif;"><small><?php _e( 'GLOBAL ALLIANCE OF', 'domain' ); ?></small><br><span class="globalreccolor"><?php _e( 'WASTE PICKERS', 'domain' ); ?></span></span> </h1>
		</div>
		<div id="tagline" class="span6">
			<div class="row-fluid">
				<div class="span7">
					<?php if ( is_home() ) {
						echo '<a href="/globalrec/?lang=en">English</a> | <a href="/globalrec/?lang=es">Español</a> | <a href="/globalrec/?lang=pt-br">Portugués</a> | <a href="/?lang=fr">French</a>';
					} else {
						// echo do_action('icl_language_selector');
						echo '<a href="/globalrec/?lang=en">English</a> | <a href="/globalrec/?lang=es">Español</a> | <a href="/globalrec/?lang=pt-br">Portugués</a> | <a href="/?lang=fr">French</a>';
						}
						?>
				</div>
      				<div id="search" class="pull-right">
					<?php get_search_form(); ?>
				</div>
			</div>	
			<div class="row-fluid">
				<div class="span9">
					<small><?php echo get_bloginfo( 'description' ) ?></small>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="container" id="main-menu">	
	<div class="navbar">
		<!--<div class="navbar-inner">-->
		<div class="container">	
			<?php $defaults = array(
				'theme_location'  => 'main-menu',
				'container' => 'false',
				'menu_id' => 'pre-menu',
				'menu_class' => 'nav nav-pills'
				);
			wp_nav_menu( $defaults );?>
			<div class="pull-right">
				<div class="btn-group">
					<button class="btn  btn-small">
			    		<a href="http://www.twitter.com/global_rec" title="Twitter @global_rec"><img class="alignnone size-full wp-image-18" title="tw" src="http://www.globalrec.org/wp-content/uploads/2011/11/tw.gif" alt="" width="16" height="16" /> Twitter </a>
			  		</button>
			  		<button class="btn  btn-small">
					<a href="http://www.facebook.com/pages/GlobalRec/207415605997716" title="Facebook GLobal Alliance of Waste Pickers">
					<img class="alignnone size-full wp-image-15" style="text-align: -webkit-auto;" title="fb" src="http://www.globalrec.org/wp-content/uploads/2011/11/fb.gif" alt="" width="16" height="16" /> Facebook</a>
					</button>
				</div>
			</div>	
		</div>
	</div>
</div>



<!-- end header -->
