<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head>
<link rel="profile" href="http://gmpg.org/xfn/11" />
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
<meta name="viewport" content="width=device-width, initial-scale=1.0">
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

<div id="main-container" class="container">
	<header>
		<div class="row">
			<div id="imagotipo" class="col-xs-12 col-sm-6 col-md-5 col-lg-4">
				<a title="Home" href="<?php bloginfo('url'); ?>/" class="pull-left" style="margin-right:5px;">
					<img src="<?php bloginfo('template_url'); ?>/images/logo_<?php $random = rand(3,8); echo $random; ?>.png" 
					alt="<?php _e( 'GLOBAL ALLIANCE OF', 'domain' ); ?> <?php _e( 'WASTE PICKERS', 'domain' ); ?>" />
				</a>
				<div id="logotype">
					<span style="font-size:22px;line-height: 22px;color: #999;font-weight:400;"><?php _e( 'GLOBAL ALLIANCE OF', 'domain' ); ?></span>
					<br><span class="globalreccolor" style="font-weight:700; font-size:32px;line-height: 36px;"><?php _e( 'WASTE PICKERS', 'domain' ); ?></span>
				</div>
			</div>
			<div id="tagline" class="col-xs-12 col-md-7 col-lg-8">
				<div class="row">
					<div class="col-xs-12 col-md-7">
						<div class="pull-right">
							<?php if( function_exists ( 'languages_list' ) ) {
									languages_list();
								} ?>
						</div>
					</div>
		    	<div class="pull-right">
						<?php get_search_form(); ?>
					</div>
				</div>	
				<div class="row">
					<div class="col-xs-12 col-md-8">
						<small><?php echo get_bloginfo( 'description' ) ?></small>
					</div>
					<div class="col-md-4">
						<div style="font-size:10px;margin-top: 10px;" class="pull-right ">
							<?php _e('Supported by','globalrec'); ?> <a href="http://wiego.org" title="WIEGO">
							<img title="WIEGO" src="<?php bloginfo('template_url'); ?>/images/wiego-logo.png" alt="Logo WIEGO"/></a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="pull-right">
					<div id="social-networking-sites" class="btn-group" style="margin: 2px 3px 0 0;">
						<div class="btn btn-xs"><a href="http://www.twitter.com/global_rec" title="Twitter @global_rec"><img class="alignnone size-full wp-image-18" title="tw" src="<?php bloginfo('template_url'); ?>/images/icons/tw.gif" alt="" width="16" height="16" /> Twitter </a></div>
						<div class="btn btn-xs"><a href="https://www.facebook.com/GlobalRec" title="Facebook Global Alliance of Waste Pickers"><img class="alignnone size-full wp-image-15" style="text-align: -webkit-auto;" title="fb" src="<?php bloginfo('template_url'); ?>/images/icons/fb.gif" alt="" width="16" height="16" /> Facebook</a></div>
					</div>
				</div>
			</div>
		</div>
		<nav id="main-menu">
			<div class="navbar">
				<?php $defaults = array(
					'theme_location'  => 'main-menu',
					'menu_id' => 'pre-menu',
					'menu_class' => 'nav nav-pills'
					);
				wp_nav_menu( $defaults );?>	
			</div>
		</nav>
	</header>
<!-- end header -->
