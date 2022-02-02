<?php  /* Template Name: Newsletter Creation HTML */
get_header(); 
$asian_posts = -1;
$asian_offset = 0;
$latinamerican_posts = -1;
$latinamerican_offset = 0;
$african_posts= -1;
$african_offset= 0;
$european_posts= -1;
$european_offset= 0;
$northamerican_posts= -1;
$northamerican_offset= 0;
$global_posts= -1;
$global_offset= 0;
$newsletter_number_id = 5061;
$newsletter_number = icl_object_id(5061, 'post-newsletter');

$argsasia = array(
	'post_status' => array( 'publish', 'future','draft' ),
	'posts_per_page' => $asian_posts,
	'ignore_sticky_posts' => 1,
	'offset' => $asian_offset,
	'ignore_sticky_posts' => 1,
	/*'order' => 'ASC',
	'orderby' => 'meta_value_num',
	'meta_key'  => '_gr_article-date', //TODO Reorder is not working the reorder because it is stored as text_date https://github.com/WebDevStudios/CMB2/wiki/Field-Types#text_date and not as text_date_timestamp
	'meta_type' => 'DATE',*/
	'tax_query' => array(
			'relation' => 'AND',
			array(
				'taxonomy' => 'post-newsletter',
				'field'    => 'term_id',
				'terms'    => $newsletter_number,
			),
			array(
				'taxonomy' => 'post-region',
				'field'    => 'term_id',
				'terms'    => icl_object_id(12, 'post-region'), //id of the post-region (Asia) in English
			),
		),
	);
$my_query_asia = new WP_Query($argsasia);

$args_latinamerica = array(
	'post_status' => array( 'publish', 'future','draft' ),
	'posts_per_page' => $latinamerican_posts,
	'ignore_sticky_posts' => 1,
	'offset' => $latinamerican_offset,
	'tax_query' => array(
			'relation' => 'AND',
			array(
				'taxonomy' => 'post-newsletter',
				'field'    => 'term_id',
				'terms'    => $newsletter_number,
			),
			array(
				'taxonomy' => 'post-region',
				'field'    => 'term_id',
				'terms'    => icl_object_id(900, 'post-region'), //id of the post-region in English
			),
		),
	);
$my_query_latinamerica = new WP_Query($args_latinamerica);

$args_africa = array(
	'post_status' => array( 'publish', 'future','draft' ),
	'posts_per_page' => $african_posts,
	'ignore_sticky_posts' => 1,
	'offset' => $african_offset,
	'tax_query' => array(
			'relation' => 'AND',
			array(
				'taxonomy' => 'post-newsletter',
				'field'    => 'term_id',
				'terms'    => $newsletter_number,
			),
			array(
				'taxonomy' => 'post-region',
				'field'    => 'term_id',
				'terms'    => icl_object_id(36, 'post-region'), //id of the post-region in English
			),
		),
	);
$my_query_africa = new WP_Query($args_africa);

$args_europe = array(
	'post_status' => array( 'publish', 'future','draft' ),
	'posts_per_page' => $european_posts,
	'offset' => $european_offset,
	'ignore_sticky_posts' => 1,
	'tax_query' => array(
			'relation' => 'AND',
			array(
				'taxonomy' => 'post-newsletter',
				'field'    => 'term_id',
				'terms'    => $newsletter_number,
			),
			array(
				'taxonomy' => 'post-region',
				'field'    => 'term_id',
				'terms'    => icl_object_id(901, 'post-region'), //id of the post-region in English
			),
		),
	);
$my_query_europe = new WP_Query($args_europe);

$args_northamerica = array(
	'post_status' => array( 'publish', 'future','draft' ),
	'posts_per_page' => $northamerican_posts,
	'offset' => $northamerican_offset,
	'ignore_sticky_posts' => 1,
	'tax_query' => array(
			'relation' => 'AND',
			array(
				'taxonomy' => 'post-newsletter',
				'field'    => 'term_id',
				'terms'    => $newsletter_number,
			),
			array(
				'taxonomy' => 'post-region',
				'field'    => 'term_id',
				'terms'    => icl_object_id(955, 'post-region'), //id of the post-region in English
			),
		),
	);
$my_query_northamerica = new WP_Query($args_northamerica);

$args_global = array(
	'post_status' => array( 'publish', 'future','draft' ),
	'posts_per_page' => $global_posts,
	'offset' => $global_offset,
	'ignore_sticky_posts' => 1,
	'tax_query' => array(
			'relation' => 'AND',
			array(
				'taxonomy' => 'post-newsletter',
				'field'    => 'term_id',
				'terms'    => $newsletter_number,
			),
			array(
				'taxonomy' => 'post-region',
				'field'    => 'term_id',
				'terms'    => icl_object_id(954, 'post-region'), //id of the post-region in English
			),
		),
	);
$my_query_global = new WP_Query($args_global);


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
			<div style="font-size: 10pt; font-family: verdana,helvetica,sans-serif;line-height: 18pt;">
			<?php the_content(); ?>
			</div>
			<?php endwhile; endif; ?>
			<table border="0" cellpadding="10" bgcolor="#fe7c11" style="background-color:#fe7c11">
				<tbody>
					<tr>
						<td>
							<p style="margin: 10px;"><font style="font-size: 14px;" color="#fff"><?php echo _e('The updates we publish in this newsletter are by waste pickers and allies. Sometimes we re-post directly from what individuals or groups have shared via social media, websites or emails; sometimes we edit, organize and translate. The goal is to disseminate information from waste pickers across borders. As usual, we invite waste pickers&rsquo; organizations and allies to keep sending updates of their struggles and victories. We want to make this information-sharing platform more inclusive and participatory! This process is supported by Women in Informal Employment: Globalizing and Organizing. <br><strong>If you want to be part of the editorial committee or learn how to post your own updates on <a href="http://globalrec.org"><font color="#fff">globalrec.org</font></a> please write an email to info@globalrec.org.</strong>','globalrec');?></font></p>
						</td>
					</tr>
				</tbody>
			</table>
			<br>
			<p><strong><?php echo _e('Table of Contents','globalrec');?></strong><br>
				<a href="#global"><?php echo _e('Global','globalrec');?></a><br>
				<a href="#asia"><?php echo _e('Asia','globalrec');?></a><br>
				<a href="#latinamerica"><?php echo _e('Latin America','globalrec');?></a><br>
				<a href="#africa"><?php echo _e('Africa','globalrec');?></a><br>
				<a href="#europe"><?php echo _e('Europe','globalrec');?></a><br>
				<a href="#north-america"><?php echo _e('North America','globalrec');?></a>
			</p>
	<?php
		$my_query_asia_posts = $my_query_asia->posts; //accesses the object "posts" inside the my query asia object
		$my_query_latinamerica_posts = $my_query_latinamerica->posts; //accesses the object "posts" inside the my query asia object
		$my_query_africa_posts = $my_query_africa->posts; //accesses the object "posts" inside the my query asia object
		$my_query_europe_posts = $my_query_europe->posts; //accesses the object "posts" inside the my query asia object
		$my_query_northamerica_posts = $my_query_northamerica->posts; //accesses the object "posts" inside the my query asia object
	?>
			<!-- Global -->
			<a name="global"></a>
			<h2>
				<strong><?php echo _e('Global','globalrec');?></strong>
			</h2>
			<?php if ( $my_query_global->have_posts() ) : while ( $my_query_global->have_posts() ) : $my_query_global->the_post(); ?>
			<?php include('region-content-newsletter-html.php'); ?>
			<?php endwhile; else: ?>
			<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
			<?php endif; ?>
			<hr>
			
			<!-----------------Asia ------------------------->
			<a name="asia"></a>
			<h2>
				<img src="http://globalrec.org/wp-content/themes/globalrec/images/asia.png">
				<strong><?php echo _e('Asia','globalrec');?></strong>
			</h2>

			<?php if ( $my_query_asia->have_posts() ) : while ( $my_query_asia->have_posts() ) :  $my_query_asia->the_post(); ?>
			<?php include('region-content-newsletter-html.php'); ?>
			<?php endwhile; else: ?>
			<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
			<?php endif; ?>
			<hr>
			
			<!-----------------Latin America ------------------------->
			<a name="latinamerica"></a>
			<h2>
				<img src="http://globalrec.org/wp-content/themes/globalrec/images/latinamerica.png">
				<strong><?php echo _e('Latin America','globalrec');?></strong>
			</h2>
			<?php if ( $my_query_latinamerica->have_posts() ) : while ( $my_query_latinamerica->have_posts() ) :  $my_query_latinamerica->the_post(); ?>
			<?php include('region-content-newsletter-html.php'); ?>
			<?php endwhile; else: ?>
			<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
			<?php endif; ?>
			<hr>
			
			<!-----------------Africa------------------------->
			<a name="africa"></a>
			<h2>
				<img src="http://globalrec.org/wp-content/themes/globalrec/images/africa.png">
				<strong><?php echo _e('Africa','globalrec');?></strong>
			</h2>
			<?php if ( $my_query_africa->have_posts() ) : while ( $my_query_africa->have_posts() ) :  $my_query_africa->the_post(); ?>
			<?php include('region-content-newsletter-html.php'); ?>
			<?php endwhile; else: ?>
			<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
			<?php endif; ?>
			<hr>
			
			<!-- Europe -->
			<a name="europe"></a>
			<h2>
				<img src="http://globalrec.org/wp-content/themes/globalrec/images/europe.png">
				<strong><?php echo _e('Europe','globalrec');?></strong>
			</h2>
			<?php if ( $my_query_europe->have_posts() ) : while ( $my_query_europe->have_posts() ) :  $my_query_europe->the_post(); ?>
			<?php include('region-content-newsletter-html.php'); ?>
			<?php endwhile; else: ?>
			<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
			<?php endif; ?>
			<hr>
			
			<!-- North America -->
			<a name="north-america"></a>
			<h2>
				<img src="http://globalrec.org/wp-content/themes/globalrec/images/north-america.png">
				<strong><?php echo _e('North America','globalrec');?></strong>
			</h2>
			<?php if ( $my_query_northamerica->have_posts() ) : while ( $my_query_northamerica->have_posts() ) : $my_query_northamerica->the_post(); ?>
			<?php include('region-content-newsletter-html.php'); ?>
			<?php endwhile; else: ?>
			<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
			<?php endif; ?>

		</div>
	</div>
</div>
<?php get_footer(); ?>
