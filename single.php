<?php get_header();
$categories = get_the_category();
$separator = '&nbsp;';
$output = '';
$output2 = ''; ?>

<div class="container">
	<div class="row">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<article <?php post_class('col-md-8') ?> id="post-<?php the_ID(); ?>">
			<?php if (is_singular( 'newsletter' ) ) {?>
				<div class="row">
					<div class="col-md-10">
						<ul class="breadcrumb">
							<li><a href="<?php echo get_permalink(icl_object_id(6545,'page')) ?>#globlarec"><?php _e('Newsletters','globalrec'); ?></a></li>
							<li><?php the_title(); ?> </li>
						</ul>
					</div>
					<div class="col-md-2">
						<?php if ( is_user_logged_in() ) { ?><div class="btn btn-xs btn-default pull-right"> <?php edit_post_link(__('Edit This')); ?></div> <?php } ?>
					</div>
				</div>
			<?php    } ?>
			<div class="row">
			<?php
				if($categories){
					foreach($categories as $category) {
						$output .= '<a href="'.get_category_link( $category->term_id ).'" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) . '" class="label pull-right" style="margin-right:5px">'.$category->cat_name.' </a> '.$separator;
					}
				echo trim($output, $separator);
				}
			?>
			<?php if ( is_user_logged_in() && (get_post_type() == 'post')) { ?>Included in newsletter: <span class="label label-info"><?php echo get_the_term_list( $post->ID, 'post-newsletter', ' ', ', ', '' ); ?></span><?php } ?>
			</div>
			<header>
				<div class="row">
					<div class="col-md-12">
					<?php if ( is_user_logged_in() ) { echo '<div class="btn btn-sm btn-default pull-right">'; edit_post_link(__('Edit This')); echo "</div>";} ?>
					<h1>
						<a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a>
					</h1>
					</div>
				</div>
				<div class="row">
					<div class="col-md-5">
						<h4>
							<?php
								$post_id = get_the_ID();
								$author_url = get_author_posts_url( get_the_author_meta( 'ID' ) );
								$author = get_the_author();
								$written_by = get_post_meta( $post_id, '_gr_written-by', true );
								$translated_by = get_post_meta( $post_id, '_gr_translator', true );
								$region = get_the_term_list( $post_id, 'post-region', '', ', ', '' );
								$country_id = get_post_meta( $post_id, '_post_country', true ); //get id of country selected
								if ($country_id != '') {
									$country = get_post($country_id);
									$country_name = $country->post_title;
									$country_slug = strtolower(str_replace(" ","-",$country_name));
								}
								
							 	if ($written_by != '')  { //if the text is written by someone the field "written" by will be filled
							 		if ($written_by == $author) { //if the writer has a user
							 			//temporary hack while creating all the users. Displays author as link if the autor exists.
										//Author "Display name publicly as" must be the same as the name written at '_gr_written-by' custom field
							 			echo "<small>";
										echo _e('by','globalrec')."</small> ";
										echo "<a href='".$author_url."'>".$author."</a>";
									} else { //if the text is written by someone the field "written by" will be filled
										echo "<small>";
										echo _e('Posted by','globalrec'). " ";
										the_author_posts_link();
										echo "</small><br><small>";
										echo _e('Written by','globalrec')."</small> ";
										echo $written_by;
									}
								} else {
									echo "<small>";
									echo _e('by','globalrec'). " </small>";
									the_author_posts_link();
								}
						 	?>
						</h4>
					</div>
					<div class="col-md-4">
						<?php   
							if ( $region != '')  : 
								echo "<h4><small>";
								echo _e('Region','globalrec')."</small> ";
								echo $region;
								echo "</h4>";
							endif;
							if ( isset($country_name) ) {
								if ( $country_name == "-" ) {
								//do nothing
								} else {
									echo "<h4><small>";
									echo _e('Country','globalrec')."</small> ";
									echo "<a href='/country/".$country_slug."'>".$country_name."</a>";
									echo "</h4>";
								}
							}
						 	?>
					</div>
					<div class="col-md-3">
						<div class="row">
							<h4 class="pull-right">
								<small>
								<?php the_time('F d, Y') ?>
								</small>
							</h4>
						</div>
						<div class="row">
							<?php
								if (($translated_by == '-') || ($translated_by == '')) {
									//Do nothing. ($translated_by != '-') was not working
								} else {
									echo "<h4 class='text-right'><small>";
									_e('Translated by','globalrec');
									echo " ". $translated_by. "</small></h4>";
								}
							?>
						</div>
					</div>
				</div>
			</header>
			
		 	<?php if ( is_user_logged_in() && (get_post_type() == 'post')) {
		 		$summary = get_post_meta( $post_id, '_gr_post-summary', true ); ?>
		 		<div class="panel-group" id="summary">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<span class="glyphicon glyphicon-lock"> </span><a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
								  Summary of the article <span class="glyphicon glyphicon-chevron-up"></span>
								</a>
							</h4>
						</div>
						<div id="collapseOne" class="panel-collapse collapse in">
							<div class="panel-body content">
								<?php echo $summary; ?>
							</div>
						</div>
					</div>
				</div>
		 	<?php } else {?>
		 		<hr style="margin:3px 0 3px 0;">
		 	<?php } ?>

			<section>
				<div class="row">
					<div class="col-md-offset-6 col-md-3"><?php _e('Check translation','globalrec'); ?>:</div>
					<div class="col-md-2 ontop"><?php do_action('icl_language_selector'); ?></div>
				</div>
			</section>
			
			<?php if (is_singular( 'newsletter' ) ) {?>
				<div class="row">
					<div class="col-md-12">
						<p class="bg-warning"><?php _e('The updates we publish in this newsletter are by waste pickers and allies. Sometimes we re-post directly from what individuals or groups have shared via social media, websites or emails; sometimes we edit, organize and translate. The goal is to disseminate information from waste pickers across borders. As usual, we invite waste pickers&rsquo; organizations and allies to keep sending updates of their struggles and victories. We want to make this information-sharing platform more inclusive and participatory! This process is supported by Women in Informal Employment: Globalizing and Organizing. <br><strong>If you want to be part of the editorial committee or learn how to post your own updates on <a href="http://globalrec.org"><font color="#fff">globalrec.org</font></a> please write an email to info@globalrec.org.</strong>','globalrec');?></p>
					</div>
				</div>
			<?php    } ?>
			
			<div id="post-content">
				<?php 
				$article_url = get_post_meta( $post_id, '_gr_article-url', true );
				$article_title = get_post_meta( $post_id, '_gr_article-title', true );
				$article_published_in = get_post_meta( $post_id, '_gr_published-in', true ); ?>
				<div class='row news-reference'>
					<div class='col-md-1 text-right'>
						<?php if (is_single() && $article_url != '') { 
							echo '<span class="glyphicon glyphicon-link" aria-hidden="true"></span>';
						} ?>
					</div>
					<div class='col-md-11'>
					<?php if ($article_url != '') { //if url of reference article is not empty
							echo "<a href='".$article_url."'>".$article_title."</a>";
					} else {
							echo $article_title;
					}
					if (($written_by != '') && ($article_title != '')){
						echo "<br>". __('Written by','globalrec') ." ". $written_by. ". ";
					}
					if ($article_published_in != '') {
						echo " " .$article_published_in. ". ";
					}
					echo get_post_meta( $post_id, '_gr_article-date', true ); ?>
					</div>
				</div>
				<?php the_content(__('(more...)')); ?>
			</div>

			<?php include("share.php")?>

			<div class="post-metadata">
				<?php if(function_exists('pf_show_link')){echo pf_show_link();} ?> | 
				<?php
					if($categories){
						foreach($categories as $category) {
							$output2 .= '<a href="'.get_category_link( $category->term_id ).'" title="' 
							. esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) 
							. '" class="label">'.$category->cat_name.'</a>'.$separator;
						}
					echo trim($output2, $separator);
					} 
					?> | 
				<?php the_tags( ); ?>
			</div>
			<div class="feedback">
				<?php wp_link_pages(); ?>
				<?php comments_popup_link(__(' '), __('Comments (1)'), __('Comments (%)')); ?>
			</div>
			<div id="comments-container">
				<?php comments_template(); // Get wp-comments.php template ?>
			</div>
		<?php endwhile; else: ?>
		<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
		<?php endif; ?>
	
		<?php posts_nav_link(' &#8212; ', __('&laquo; Newer Posts'), __('Older Posts &raquo;')); ?>
		</article>
		<!-- begin sidebar -->
		<aside>
			<div id="menu" class="col-md-offset-1 col-md-3">
				<?php  dynamic_sidebar( 'blog-sidebar' ) ?>
			</div>
		</aside>
		<!-- end sidebar -->
	</div>
	<?php get_footer(); ?>
</div>
