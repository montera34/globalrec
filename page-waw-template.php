<?php  /* Template Name: WAW template page*/
get_header(); ?>
<div id="page-wide">
	<?php if (have_posts()) : while (have_posts()) : the_post();?>
		<?php get_template_part( 'nav', 'waw' ); ?>
		<div class="row">
			<div class="spacetop col-md-2 col-md-push-10"><?php do_action('icl_language_selector'); ?></div>
			<h2 id="post-<?php the_ID(); ?>" class="col-md-10 col-md-pull-2">
				<?php the_title();?>
			</h2>
		</div>
		<div class="row">
			<div class="col-md-3 legend-map">
				<h3><a href="<?php echo get_permalink( icl_object_id( 23274 , 'page' , false)); ?>"><span class="glyphicon glyphicon-user"></span> <?php _e("Waste Pickers' Organizations","globalrec"); ?></a></h3>
				<ul>
					<li><span class="label" style="background-color: #FE7C11;"><?php _e("Waste Pickers' Organizations","globalrec"); ?></span></li>
				</ul>
				<h3><a href="<?php echo get_permalink( icl_object_id( 20848 , 'page' , false)); ?>"><span class="glyphicon glyphicon-tag"></span> <?php _e("Type of Organization","globalrec"); ?></a></h3>
				<ul>
					<li><span class="label" style="background-color: #99EEEE"> <?php _e("Cooperative","globalrec"); ?></span></li>
					<li><span class="label" style="background-color: #99CC33"> <?php _e("Association","globalrec"); ?></span></li>
					<li><span class="label" style="background-color: #003366"> <?php _e("Trade Union","globalrec"); ?></span></li>
					<li><span class="label" style="background-color: #ff33ff"> <?php _e("Network of cooperatives","globalrec"); ?></span></li>
					<li><span class="label" style="background-color: #0000ff"> <?php _e("Movement","globalrec"); ?></span></li>
					<li><span class="label" style="background-color: #00ff00"> <?php _e("Federation","globalrec"); ?></span></li>
					<li><span class="label" style="background-color: #339999"> <?php _e("Federation of cooperatives","globalrec"); ?></span></li>
					<li><span class="label" style="background-color: #FF0000"> <?php _e("Self-help group","globalrec"); ?></span></li>
				</ul>
				<h3><a href="<?php echo get_permalink( icl_object_id( 20830 , 'page' , false)); ?>"><span class="glyphicon glyphicon-globe"></span> <?php _e("Scope","globalrec"); ?></a></h3>
				<ul>
					<li><span class="label" style="background-color: #ff3399;"><?php _e("Local","globalrec"); ?></span></li>
					<li><span class="label" style="background-color: #ff3333;"><?php _e("Regional","globalrec"); ?></span></li>
					<li><span class="label" style="background-color: #ff9933;"><?php _e("National","globalrec"); ?></span></li>
					<li><span class="label" style="background-color: #ffff66; color: black;"><?php _e("International","globalrec"); ?></span></li>
				</ul>
				<h3><a href="<?php echo get_permalink( icl_object_id( 21900 , 'page' , false)); ?>"><?php _e("Supporters","globalrec"); ?></a></h3>
				<ul>
					<li><span class="label" style="background-color: #FFaaaa"><?php _e("Waste picker support organization","globalrec"); ?></span></li>
					<li><span class="label" style="background-color: #77FF77"><?php _e("Potential supporter","globalrec"); ?></span></li>
				</ul>
			</div>
			<div class="col-md-9 content">
			<?php the_content(); ?>
			</div>
		</div>
		<?php endwhile; endif; ?>
<?php get_footer(); ?>
