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


<div id="wrap">
<div id="header">
	<div id="header-top">
		<h1>
		<a alt="Home" title="Home" href="<?php bloginfo('url'); ?>/"><img src="<?php bloginfo('template_url'); ?>/images/logo_3.png"></a>
		<a href="<?php bloginfo('url'); ?>/" style="display:none;"><?php bloginfo('name'); ?></a><span id="header-top-top" class="tagline" ><img alt="Global Alliance of Waste Pickers" src="<?php bloginfo('template_url'); ?>/images/logotipo_1.png"></span><span style="display:none;"><?php bloginfo('description'); ?></span>
		</h1>


	<?php if (is_page(78)){
	echo "";
	} else {
	//  echo "<div id=\"google_translate_element\"></div>";
	  /*echo "<script>
			function googleTranslateElementInit() {
				new google.translate.TranslateElement({
				pageLanguage:'auto',
				autoDisplay: false,
				includedLanguages: 'zh-CN,fr,pt,es,en',
				multilanguagePage: true,
				gaTrack: true,
				gaId: 'UA-26606134',
				layout: google.translate.TranslateElement.InlineLayout.SIMPLE
				}, 'google_translate_element');
			}
		</script>
		<script src='//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit'></script>";*/
	}?>

		
		
	</div>

</div>

<!-- end header -->
