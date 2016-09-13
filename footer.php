</div><!-- close container-->
<!-- begin footer -->
<div id="footer" class="container">
	<div class="row">
		<div class="col-md-10">
			<small>
				<?php  dynamic_sidebar( 'footer-sidebar' ) ?>
			</small>
		</div>
		<div class="col-md-2">
			<div class="btn btn-xs"><a href="http://www.twitter.com/global_rec" title="Twitter @global_rec"><img class="alignnone size-full wp-image-18" title="tw" src="<?php bloginfo('template_url'); ?>/images/icons/twitter.png" alt="" width="15" height="15" /></a> </div>
			<div class="btn btn-xs"><a href="https://www.facebook.com/GlobalRec" title="Facebook Global Alliance of Waste Pickers"><img class="alignnone size-full wp-image-15" style="text-align: -webkit-auto;" title="fb" src="<?php bloginfo('template_url'); ?>/images/icons/facebook.png" alt="" width="15" height="15" /></a></div>
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
