<!-- begin footer -->
<div class="container">	
<div id="footer" class="row-fluid">	
	<div class="span12"> 
		<small>
			<?php  dynamic_sidebar( 'footer-sidebar' ) ?>
		</small>
	</div>
</div>
</div>
<?php wp_footer(); ?>

<!-- Place this render call where appropriate -->
<script type="text/javascript">
  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/plusone.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>
<script src="http://code.jquery.com/jquery.js"></script>
<!-- Bootstrap -->
<script src="<?php bloginfo('template_url'); ?>/js/bootstrap.min.js"></script>
<!-- /Bootstrap -->
</body>
</html>
