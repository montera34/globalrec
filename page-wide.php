<?php  /* Template Name: Page Wide*/
get_header(); ?>
<div id="page-wide">
	<?php if (have_posts()) : while (have_posts()) : the_post();?>
		<div class="row">
			<div class="pull-right"><?php do_action('icl_language_selector'); ?></div>
			<h2 id="post-<?php the_ID(); ?>" class="col-md-10">
				<?php the_title();?>
			</h2>
		</div>
		<ul class="nav nav-tabs" role="tablist">
			<li role="presentation"><a href="../">Home</a></li>
			<li role="presentation"><a href="../about">About</a></li>
			<li role="presentation"><a href="../">Map by Members' Occupation</a></li>
			<li role="presentation"><a href="../oganizations-type">Map by Oganizations' type</a></li>
			<li role="presentation"><a href="../scope">Map by Scope</a></li>
			<li role="presentation"><a href="../#wpg-list">List of Waste picker groups</a></li>
			<li role="presentation"><a href="../supporters">Supporters</a></li>
		</ul>
		<div class="row">
			<div class="col-md-3 legend-map">
			<h3><a href="../"><span class="glyphicon glyphicon-user"></span> Members' occupation</a></h3>
			<ul>
				<li><span class="label" style="background-color: #428bca;">Waste Pickers</span></li>
				<li><span class="label" style="background-color: #777;">Waste Collectors</span></li>
				<li><span class="label" style="background-color: #5cb85c;">Scrap dealers</span></li>
				<li><span class="label" style="background-color: #f0ad4e;">Itinerant buyers</span></li>
			</ul>
			<h3><a href="../oganizations-type"><span class="glyphicon glyphicon-tag"></span> Organizations' type</a></h3>
			<ul>
				<li><span class="label" style="background-color: #003366">Trade Union</span></li>
				<li><span class="label" style="background-color: #339999">Cooperative federation</span></li>
				<li><span class="label" style="background-color: #99EEEE">Cooperative</span></li>
				<li><span class="label" style="background-color: #99CC33">Association</span></li>
				<li><span class="label" style="background-color: #660099">NGO</span></li>
				<li><span class="label" style="background-color: #FFFF99;color:black">CBO</span></li>
				<li><span class="label" style="background-color: #996600">Self-help group</span></li>
			</ul>
			<h3><a href="../scope"><span class="glyphicon glyphicon-globe"></span> Scope</a></h3>
			<ul>
				<li><span class="label" style="background-color: #ff3399;">Local</span></li>
				<li><span class="label" style="background-color: #ff3333;">Regional</span></li>
				<li><span class="label" style="background-color: #ff9933;">National</span></li>
				<li><span class="label" style="background-color: #ffff66; color: black;">International</span></li>
			</ul>
			</div>
			<div class="col-md-9">
			<?php the_content(); ?>
			</div>
		</div>
		<?php endwhile; endif; ?>
</div>
<?php get_footer(); ?>
