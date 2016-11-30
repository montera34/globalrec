</div><!-- close container-->
<!-- begin footer -->
<div id="footer" class="row">
		<div class="col-md-10">
			<small>
				<?php  dynamic_sidebar( 'footer-sidebar' ) ?>
			</small>
		</div>
		<div class="col-md-2">
			<div class="pull-right">
				<ul id="social-networking-sites" class="list-inline">
					<li><a href="https://www.twitter.com/global_rec" title="Twitter @global_rec"><span class="dashicons dashicons-twitter"></span></a></li>
					<li><a href="https://www.facebook.com/GlobalRec" title="Facebook Global Alliance of Waste Pickers"><span class="dashicons dashicons-facebook-alt"></span></a></li>
					<li><a href="https://plus.google.com/u/3/103747913868560613139" title="Google Plus Global Alliance of Waste Pickers"><span class="dashicons dashicons-googleplus"></span></a></li>
				</ul>
			</div>
		</div>
</div>
<?php wp_footer(); ?>

<!-- GOOGLE PLUS
	Place this render call where appropriate -->
<script type="text/javascript">
  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/plusone.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>
<?php
//Include stats javascript if user is not loged in
if ( !is_user_logged_in() ) include_once("stats.php");
?>
</body>
</html>
