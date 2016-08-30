<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>
<meta name="description" content="
	<?php if ( is_single() || is_page() ) {
		single_post_title('', true);
	} else {
		bloginfo('description');
	}
	?>"
/>
<meta name="keywords" content="waste picker, reciclador, waste pickers, trash, waste, recycling, basura, reciclaje, residuos, globalrec.org, globalrec, lixo" />
<meta content="Global Alliance of Waste Pickers" name="organization" />

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
		$metaimage = "http://globalrec.org/wp-content/uploads/2012/04/logo_globalrec_shari.png";
		} else {
  	$metaimage = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large'); }
} else {
  $metadesc = get_bloginfo('description');
  $metadesc_tw = $metadesc;
  $metadesc_fb = $metadesc;
  $metatit = get_bloginfo('name');
  $metatype = "blog";
  $metaimage = "http://globalrec.org/wp-content/uploads/2012/04/logo_globalrec_shari.png";
}
  $metaperma = get_permalink();
?>

<!-- generic meta -->
<meta content="global_rec" name="author" />
<meta name="title" content="<?php echo $metatit ?>" />
<meta content="<?php echo $metadesc ?>" name="description" />
<!-- facebook meta -->
<meta property="og:title" content="<?php echo $metatit ?>" />
<meta property="og:type" content="<?php echo $metatype ?>" />
<meta property="og:description" content="<?php echo $metadesc_fb ?>" />
<meta property="og:url" content="<?php echo $metaperma ?>" />
<!-- twitter meta -->
<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:site" content="@global_rec">
<meta name="twitter:title" content="<?php echo $metatit ?>" />
<meta name="twitter:description" content="<?php echo $metadesc_tw ?>" />
<meta name="twitter:creator" content="@global_rec">
<meta name="twitter:image:src" content="<?php if (is_home()) {echo $metaimage;} else {echo $metaimage[0];} ?>">
<meta property="twitter:account_id" content="121067923" />
	
<!-- Bootstrap -->
<link href="<?php bloginfo('template_url'); ?>/css/bootstrap.css" rel="stylesheet" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- /Bootstrap -->

<style type="text/css" media="screen">
	@import url( <?php bloginfo('stylesheet_url'); ?> );
</style>

<link href='http://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Sintony:400,700' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700' rel='stylesheet' type='text/css'>

<!-- Less -->
<!--<link rel="stylesheet/less" type="text/css" href="<?php bloginfo('template_url'); ?>/less/magic-bootstrap.less" />
<script src="<?php bloginfo('template_url'); ?>/less/less-1.3.3.min.js" type="text/javascript"></script>-->
<!-- /Less -->

<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

	<?php //wp_get_archives('type=monthly&format=link'); ?>
	
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
					<div class="col-xs-12 col-md-5">
						<div class="pull-right">
							<?php if( function_exists ( 'languages_list' ) ) {
									languages_list();
								} ?>
						</div>
					</div>
					<div class="col-xs-12 col-md-2">
					<?php if ( is_user_logged_in() ) { ?>
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
					<?php } ?>
					</div>
		    	<div class="pull-right">
						<?php get_search_form(); ?>
					</div>
				</div>	
				<div class="row">
					<div class="col-xs-12 col-md-8">
						<small><?php echo get_bloginfo( 'description' ) ?>
						<?php if (current_user_can( 'moderate_comments' )) { echo ' '. get_num_queries() .' queries'; echo ' in '; timer_stop(1); }?></small>
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
