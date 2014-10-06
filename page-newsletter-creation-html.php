<?php  /* Template Name: Newsletter Creation HTML */
get_header(); 
$asian_posts = -1;
$asian_offset = 0;
$latinamerican_posts = -1;
$latinamerican_offset = 0;
$african_posts= -1;
$african_offset= 0;
$newsletter_number = icl_object_id(1675, 'post-newsletter');
?>
<div id="page-word-post-count"  <?php post_class(''); ?> id="post-<?php the_ID(); ?>">
	<?php if (have_posts()) : while (have_posts()) : the_post();?>
	<div class="row">
		<h2 id="post-<?php the_ID(); ?>" class="col-md-8">
			<?php the_title();?>
		</h2>
		<div class="pull-right"><?php do_action('icl_language_selector'); ?></div>
	</div>
	<div class="row">
		<div class="col-md-8 content">
			<div style="font-size: 10pt; font-family: verdana,helvetica,sans-serif;">
			<?php the_content(); ?>
			</div>
			<?php endwhile; endif; ?>
			<table border="0" cellpadding="10" bgcolor="#fe7c11" style="background-color:#fe7c11">
				<tbody>
					<tr>
						<td>
							<p><font style="font-size: 14px;" color="#fff"><?php echo _e('The updates we publish in this newsletter are by waste pickers and allies. Sometimes we re-post directly from what individuals or groups have shared via social media, websites or emails; sometimes we edit, organize and translate. The goal is to disseminate information from waste pickers across borders. As usual, we invite waste pickers&rsquo; organizations and allies to keep sending updates of their struggles and victories. We want to make this information-sharing platform more inclusive and participatory! This process is supported by Women in Informal Employment: Globalizing and Organizing. <br><strong>If you want to be part of the editorial committee or learn how to post your own updates on <a href="http://globalrec.org"><font color="#fff">globalrec.org</font></a> please write an email to info@globalrec.org.</strong>','globalrec');?></font></p>
						</td>
					</tr>
				</tbody>
			</table>
			<br>
			<p><strong><?php echo _e('Table of Contents','globalrec');?></strong><br>
				<a href="#asia"><?php echo _e('Asia','globalrec');?></a><br>
				<a href="#latinamerica"><?php echo _e('Latin America','globalrec');?></a><br>
				<a href="#africa"><?php echo _e('Africa','globalrec');?></a><br>
				<a href="#europe"><?php echo _e('Europe','globalrec');?></a>
			</p>
			
			<!-----------------Asia ------------------------->
			<a name="asia"></a>
			<h2><strong><?php echo _e('Asia','globalrec');?></strong></h2>
			<?php
				$args = array(
					'post_status' => array( 'publish', 'future' ),
					'posts_per_page' => $asian_posts,
					'ignore_sticky_posts' => 1,
					'offset' => $asian_offset,
					'taxonomy' => 'post-region',
					'term' => 'asia',
					'tax_query' => array(
							array(
								'taxonomy' => 'post-newsletter',
								'field'    => 'term_id',
								'terms'    => $newsletter_number,
							),
						),
					);
				$my_query = new WP_Query($args);
			?>

			<?php if ( $my_query->have_posts() ) : while ( $my_query->have_posts() ) :  $my_query->the_post(); ?>
			<?php
			global $wp_query;
			$wp_query->in_the_loop = true;
			?>
			<h3>
				<a style="font-size: 18px;" href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
					<?php
					the_title();
					$country_ID = get_post_meta( $post->ID, '_post_country', true );
					$country = get_post( $country_ID );
					$countrytitle = $country->post_title;
					echo " (".$countrytitle;
					//echo the_time('m/d/Y');
					echo ")";
					?>
				</a>
				<small>
					<?php echo _e('by','globalrec');?> <?php //author
					$written_by = get_post_meta( $post->ID, '_gr_written-by', true );
				 	if ($written_by != '')  { //if the text is written by a journalist the field "written" by will be filled
						echo $written_by;
					}
					else {
						the_author_posts_link();
					} ?>
				</small>
			</h3>
			<div class="size-thumbnail" style="width:300px;margin:0 0 10px 0;">
				<a href="<?php the_permalink() ?>" rel="bookmark" title="Go to <?php the_title_attribute(); ?>">
				<?php	//the thumbnail 
				the_post_thumbnail( 'medium', array('class' => 'img-responsive', 'width' => '300') );?>
				</a>
			</div>
			<div style="font-size: 10pt; font-family: verdana,helvetica,sans-serif;">
				<?php //the summary
				$summary = get_post_meta( $post->ID, '_gr_post-summary', true );
				echo $summary;
				?>
			</div>
			<?php endwhile; else: ?>
			<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
			<?php endif; ?>
			
			<!-----------------Latin America ------------------------->
			<a name="latinamerica"></a>
			<h2><strong><?php echo _e('Latin America','globalrec');?></strong></h2>
			<?php
				$args = array(
					'post_status' => array( 'publish', 'future' ),
					//'post_type' => 'post',
					'posts_per_page' => $latinamerican_posts,
					'ignore_sticky_posts' => 1,
					'offset' => $latinamerican_offset,
					'taxonomy' => 'post-region',
					'term' => 'latin-america',
					'tax_query' => array(
							array(
								'taxonomy' => 'post-newsletter',
								'field'    => 'term_id',
								'terms'    => $newsletter_number,
							),
						),
					);
				$my_query = new WP_Query($args);
			?>

			<?php if ( $my_query->have_posts() ) : while ( $my_query->have_posts() ) :  $my_query->the_post(); ?>
			<?php
			global $wp_query;
			$wp_query->in_the_loop = true;
			?>
			<h3>
				<a style="font-size: 18px;" href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
					<?php
					the_title();
					$country_ID = get_post_meta( $post->ID, '_post_country', true );
					$country = get_post( $country_ID );
					$countrytitle = $country->post_title;
					echo " (".$countrytitle;
					//echo the_time('m/d/Y');
					echo ")";
					?>
				</a>
				<small>
					<?php echo _e('by','globalrec');?> <?php //author
					$written_by = get_post_meta( $post->ID, '_gr_written-by', true );
				 	if ($written_by != '')  { //if the text is written by a journalist the field "written" by will be filled
						echo $written_by;
					}
					else {
						the_author_posts_link();
					} ?>
				</small>
			</h3>
			<div class="size-thumbnail" style="width:300px;margin:0 0 10px 0;">
				<a href="<?php the_permalink() ?>" rel="bookmark" title="Go to <?php the_title_attribute(); ?>">
				<?php	//the thumbnail 
				the_post_thumbnail( 'medium', array('class' => 'img-responsive','width' => '300') );?>
				</a>
			</div>
			<div style="font-size: 10pt; font-family: verdana,helvetica,sans-serif;">
				<?php //the summary
				$summary = get_post_meta( $post->ID, '_gr_post-summary', true );
				echo $summary;
				?>
			</div>
			<?php endwhile; else: ?>
			<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
			<?php endif; ?>
			
			<!-----------------Africa------------------------->
			<a name="africa"></a>
			<h2><strong><?php echo _e('Africa','globalrec');?></strong></h2>
			<?php
				$args = array(
					'post_status' => array( 'publish', 'future' ),
					//'post_type' => 'post',
					'posts_per_page' => $african_posts,
					'ignore_sticky_posts' => 1,
					'offset' => $african_offset,
					'taxonomy' => 'post-region',
					'term' => 'africa',
					'tax_query' => array(
							array(
								'taxonomy' => 'post-newsletter',
								'field'    => 'term_id',
								'terms'    => $newsletter_number,
							),
						),
					);
				$my_query = new WP_Query($args);
			?>

			<?php if ( $my_query->have_posts() ) : while ( $my_query->have_posts() ) :  $my_query->the_post(); ?>
			<?php
			global $wp_query;
			$wp_query->in_the_loop = true;
			?>
			<h3>
				<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
					<?php
					the_title();
					$country_ID = get_post_meta( $post->ID, '_post_country', true );
					$country = get_post( $country_ID );
					$countrytitle = $country->post_title;
					echo " (".$countrytitle;
					//echo the_time('m/d/Y');
					echo ")";
					?>
				</a>
				<small>
					<?php echo _e('by','globalrec');?> <?php //author
					$written_by = get_post_meta( $post->ID, '_gr_written-by', true );
				 	if ($written_by != '')  { //if the text is written by a journalist the field "written" by will be filled
						echo $written_by;
					}
					else {
						the_author_posts_link();
					} ?>
				</small>
			</h3>
			<div class="size-thumbnail" style="width:300px;margin:0 0 10px 0;">
				<a href="<?php the_permalink() ?>" rel="bookmark" title="Go to <?php the_title_attribute(); ?>">
				<?php	//the thumbnail 
				the_post_thumbnail( 'medium', array('class' => 'img-responsive','width' => '300') );?>
				</a>
			</div>
			<div style="font-size: 10pt; font-family: verdana,helvetica,sans-serif;">
				<?php //the summary
				$summary = get_post_meta( $post->ID, '_gr_post-summary', true );
				echo $summary;
				?>
			</div>
			<?php endwhile; else: ?>
			<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
			<?php endif; ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>
