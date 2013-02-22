<?php  /* Template Name: Inicio 2*/ ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Global Alliance of Waste Pickers | globalrec.org</title>
<style type="text/css">
<!--
body {font-family: Arial, Helvetica, sans-serif; background-image:url(fondo.png); background-color:#c9c9c9; background-repeat:repeat-x;}
.Estilo1 {font-size: 80%;}
h1{display:none;}
a {text-decoration:none;color:#FF8800;}
-->
</style>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-26606134-1']);
  _gaq.push(['_setDomainName', 'globalrec.org']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</head>

<body>
<p align="center" >&nbsp;</p>
<p align="center" ><img src="logo.png" width="125" height="97"></p>
<?php get_template_part( 'content', 'page' ); ?>
<?php if (have_posts()) : while (have_posts()) : the_post();?>
				
				
				
				<?php the_content(); ?>
				</div>	<!-- #main -->
			<?php endwhile; endif; ?>
</body>

</html>
