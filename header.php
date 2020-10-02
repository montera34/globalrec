<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
<meta charset="<?php bloginfo('charset'); ?>" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="profile" href="http://gmpg.org/xfn/11" />

<?php // metatags generation
if ( is_single() || is_page() ) {
  $metadesc = $post->post_excerpt;
  if ( $metadesc == '' ) { $metadesc = $post->post_content; }
  $metadesc = wp_strip_all_tags($metadesc);
  $metadesc = strip_shortcodes( $metadesc );
  $metadesc_fb = substr( $metadesc, 0, 297 );
  if (is_home()){
		$metadesc_tw = bloginfo('description');
		} else {
  	$metadesc_tw = substr( $metadesc, 0, 200 ); }
  $metadesc = substr( $metadesc, 0, 154 );
  $metatit = $post->post_title;
  $metatype = "article";
  if (is_home()){
		$metaimage = "https://globalrec.org/wp-content/uploads/2012/04/logo_globalrec_shari.png";
		} else {
  	$metaimage = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large'); }
} else {
  $metadesc = get_bloginfo('description');
  $metadesc_tw = $metadesc;
  $metadesc_fb = $metadesc;
  $metatit = get_bloginfo('name');
  $metatype = "blog";
  $metaimage = "https://globalrec.org/wp-content/uploads/2012/04/logo_globalrec_shari.png";
}
  $metaperma = get_permalink();
?>

<!-- generic meta -->
<meta content="global_rec" name="author" />
<meta content="<?php echo $metadesc ?>" name="description" />
<meta name="keywords" content="waste picker, reciclador, waste pickers, trash, waste, recycling, basura, reciclaje, residuos, globalrec.org, globalrec, lixo" />
<meta content="Global Alliance of Waste Pickers" name="organization" />
<!-- twitter meta -->
<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:site" content="@global_rec">
<meta name="twitter:title" content="<?php echo $metatit ?>" />
<meta name="twitter:description" content="<?php echo $metadesc_tw ?>" />
<meta name="twitter:creator" content="@global_rec">
<meta name="twitter:image:src" content="<?php if (is_home()) {echo $metaimage;} else {echo $metaimage[0];} ?>">
<meta property="twitter:account_id" content="121067923" />
	
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

<div id="main-container" class="container">
	<header role="banner">
		<div class="row">
			<div id="imagotipo" class="col-xs-12 col-sm-6 col-md-5 col-lg-4">
				<a title="Home" href="<?php bloginfo('url'); ?>/" class="pull-left" style="margin-right:5px;">
					<img src="<?php bloginfo('template_url'); ?>/images/logo_<?php $random = rand(3,8); echo $random; ?>.png" 
					alt="<?php _e( 'GLOBAL ALLIANCE OF', 'globalrec' ); ?> <?php _e( 'WASTE PICKERS', 'globalrec' ); ?>" />
				</a>
				<div id="logotype">
					<span style="font-size:22px;line-height: 22px;color: #999;font-weight:400;"><?php _e( 'GLOBAL ALLIANCE OF', 'globalrec' ); ?></span>
					<br><span class="globalreccolor" style="font-weight:700; font-size:32px;line-height: 36px;"><?php _e( 'WASTE PICKERS', 'globalrec' ); ?></span>
				</div>
			</div>
			<div id="tagline" class="col-xs-12 col-md-7 col-lg-8">
				<div class="row">
					<div class="col-xs-12 col-md-5">
						<div class="pull-right">
							<?php if( function_exists ( 'languages_list' ) ) {
									languages_list();
								} ?>
						</div>
					</div>

					<?php if ( is_user_logged_in() ) { ?>
					<div class="col-xs-12 col-md-2">
						<small>
						<ul class="nav nav-pills">
							<li role="presentation" class="dropdown">
								<a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
									<span class="glyphicon glyphicon-lock"></span> Admin pages <span class="caret"></span>
								</a>
								<ul class="dropdown-menu">
									<li role="presentation"><a href="<?php echo get_permalink( icl_object_id( 16170 , 'page' , false)); ?>"><?php _e("Post word count list","globalrec"); ?></a></li>
									<li role="presentation"><a href="<?php echo get_permalink( icl_object_id( 33589 , 'page' , false)); ?>"><?php _e("Posts in countries","globalrec"); ?></a></li>
									<li role="presentation"><a href="<?php echo get_permalink( icl_object_id( 16667 , 'page' , false)); ?>"><?php _e("Creating newsletter","globalrec"); ?></a></li>
									<li role="presentation"><a href="<?php echo get_permalink( icl_object_id( 16727 , 'page' , false)); ?>"><?php _e("Creating newsletter html","globalrec"); ?></a></li>
								</ul>
							</li>
						</ul>
						</small>
					</div>
					<?php } ?>
		    			<div class="pull-right">
						<?php get_search_form(); ?>
					</div>
				</div>	
				<div class="row">
					<div class="col-xs-12 col-md-8">
						<small>
							<?php _e("The Global Alliance of Waste Pickers is a networking process supported by WIEGO, among thousands of waste picker organizations with groups in more than 28 countries covering mainly Latin America, Asia and Africa.",'globalrec'); ?>
						</small>
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
					<ul id="social-networking-sites" class="list-inline">
						<li><a href="https://www.twitter.com/global_rec" title="Twitter @global_rec" target="_blank"><span class="dashicons dashicons-twitter"></span> Twitter</a></li>
						<li><a href="https://www.facebook.com/GlobalRec" title="Facebook Global Alliance of Waste Pickers" target="_blank"><span class="dashicons dashicons-facebook-alt"></span> Facebook</a></li>
						<li><a href="https://instagram.com/globalrec_" title="Instagram Global Alliance of Waste Pickers" target="_blank"><span class="dashicons dashicons-instagram"></span> Instagram</a></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="row">
		<nav id="main-menu" class="navbar navbar-default">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#top-navbar-collapse" aria-expanded="false">
				<span class="sr-only">Show/hide menu</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<div class="collapse navbar-collapse" id="top-navbar-collapse">

				<?php $defaults = array(
					'theme_location'  => 'main-menu',
					'menu_id' => 'pre-menu',
					'menu_class' => 'nav navbar-nav'
					);
				wp_nav_menu( $defaults );?>	
			</div>
		</nav>
		</div>
	</header>
<!-- end header -->
