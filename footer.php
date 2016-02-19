</div><!-- close container-->
<!-- begin footer -->
<div id="footer" class="container">	
	<div class="row">	
		<div class="col-md-12"> 
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
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="//code.jquery.com/jquery.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="<?php bloginfo('template_url'); ?>/js/bootstrap.min.js"></script>
<?php
//Include stats javascript if user is not loged in
is_user_logged_in() ? "": include_once("stats.php");
?>
</body>
</html>
