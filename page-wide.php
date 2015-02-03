<?php  /* Template Name: WAW template page*/
get_header(); ?>
<div id="page-wide">
	<?php if (have_posts()) : while (have_posts()) : the_post();?>
		<?php get_template_part( 'nav', 'waw' ); ?>
		<div class="row">
			<div class="pull-right"><?php do_action('icl_language_selector'); ?></div>
			<h2 id="post-<?php the_ID(); ?>" class="col-md-10">
				<?php the_title();?>
			</h2>
		</div>
		<div class="row">
			<div class="col-md-3 legend-map">
			<h3><a href="/waste-picker-organizations/waste-picker-organizations-map"><span class="glyphicon glyphicon-user"></span> Waste Pickers' Organizations</a></h3>
			<ul>
				<li><span class="label" style="background-color: #428bca;">Waste Picker Organizations</span></li>
			</ul>
			<h3><a href="/waste-picker-organizations/oganizations-type"><span class="glyphicon glyphicon-tag"></span> Type of Organization</a></h3>
			<ul>
				<li><span class="label" style="background-color: #003366">Trade Union</span></li>
				<li><span class="label" style="background-color: #339999">Cooperative federation</span></li>
				<li><span class="label" style="background-color: #99EEEE">Cooperative</span></li>
				<li><span class="label" style="background-color: #99CC33">Association</span></li>
				<li><span class="label" style="background-color: #660099">Non Governmental Organization</span></li>
				<li><span class="label" style="background-color: #FFFF99;color:black">Community Based Organization</span></li>
				<li><span class="label" style="background-color: #996600">Self-help group</span></li>
			</ul>
			<h3><a href="/waste-picker-organizations/scope"><span class="glyphicon glyphicon-globe"></span> Scope</a></h3>
			<ul>
				<li><span class="label" style="background-color: #ff3399;">Local</span></li>
				<li><span class="label" style="background-color: #ff3333;">Regional</span></li>
				<li><span class="label" style="background-color: #ff9933;">National</span></li>
				<li><span class="label" style="background-color: #ffff66; color: black;">International</span></li>
			</ul>
			<h3><a href="/waste-picker-organizations/supporters">Supporters</a></h3>
			<ul>
				<li><span class="label" style="background-color: #FFaaaa">Waste picker support organization</span></li>
				<li><span class="label" style="background-color: #77FF77">Potential supporter</span></li>
			</div>
			<div class="col-md-9 content">
			<?php the_content(); ?>
			</div>
		</div>
		<?php endwhile; endif; ?>
</div>
<?php get_footer(); ?>
