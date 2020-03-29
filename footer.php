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
			<div class="pull-right">
				<ul id="social-networking-sites" class="list-inline">
					<li><a href="https://www.twitter.com/global_rec" title="Twitter @global_rec" target="_blank"><span class="dashicons dashicons-twitter"></span></a></li>
					<li><a href="https://www.facebook.com/GlobalRec" title="Facebook Global Alliance of Waste Pickers" target="_blank"><span class="dashicons dashicons-facebook-alt"></span></a></li>
					<li><a href="https://instagram.com/globalrec_" title="Instagram Global Alliance of Waste Pickers" target="_blank"><span class="dashicons dashicons-instagram"></span></a></li>
				</ul>
			</div>
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
