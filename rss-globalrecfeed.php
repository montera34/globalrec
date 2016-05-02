<?php
/**
 * Template Name: Custom RSS Template - Feedname
 */
$postCount = 2; // The number of posts to show in the feed
$posts = query_posts('showposts=' . $postCount);
header('Content-Type: '.feed_content_type('rss-http').'; charset='.get_option('blog_charset'), true);
echo '<?xml version="1.0" encoding="'.get_option('blog_charset').'"?'.'>';
?>
<rss version="2.0"
        xmlns:content="http://purl.org/rss/1.0/modules/content/"
        xmlns:wfw="http://wellformedweb.org/CommentAPI/"
        xmlns:dc="http://purl.org/dc/elements/1.1/"
        xmlns:atom="http://www.w3.org/2005/Atom"
        xmlns:sy="http://purl.org/rss/1.0/modules/syndication/"
        xmlns:slash="http://purl.org/rss/1.0/modules/slash/"
        <?php do_action('rss2_ns'); ?>>
<channel>
        <title><?php bloginfo_rss('name'); ?> - Feed</title>
        <atom:link href="<?php self_link(); ?>" rel="self" type="application/rss+xml" />
        <link><?php bloginfo_rss('url') ?></link>
        <description><?php bloginfo_rss('description') ?></description>
        <lastBuildDate><?php echo mysql2date('D, d M Y H:i:s +0000', get_lastpostmodified('GMT'), false); ?></lastBuildDate>
        <language><?php echo get_option('rss_language'); ?></language>
        <sy:updatePeriod><?php echo apply_filters( 'rss_update_period', 'hourly' ); ?></sy:updatePeriod>
        <sy:updateFrequency><?php echo apply_filters( 'rss_update_frequency', '1' ); ?></sy:updateFrequency>
        <?php do_action('rss2_head'); ?>
        <?php while(have_posts()) : the_post(); ?>
                <item>
                        <title><?php the_title_rss(); ?><?php echo " (".$country_name.")"; ?></title>
                        <link><?php the_permalink_rss(); ?></link>
                        <pubDate><?php echo mysql2date('D, d M Y H:i:s +0000', get_post_time('Y-m-d H:i:s', true), false); ?></pubDate>
                        <dc:creator><?php the_author(); ?></dc:creator>
                        <guid isPermaLink="false"><?php the_guid(); ?></guid>
                        <description><![CDATA[<?php the_excerpt_rss() ?>]]></description>
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
														echo _e('Written by','globalrec')."</small> ";
														echo $written_by;
													}
												} else {
													echo "<small>";
													echo _e('by','globalrec'). " </small>";
													the_author_posts_link();
												}
										 		?>
										 		
						 						<?php 
												$article_url = get_post_meta( $post_id, '_gr_article-url', true );
												$article_title = get_post_meta( $post_id, '_gr_article-title', true );
												$article_published_in = get_post_meta( $post_id, '_gr_published-in', true ); ?>
												<p>
													<?php if ($article_url != '') { //if url of reference article is not empty
															echo "<a href='".$article_url."'>".$article_title."</a>";
													} else {
															echo $article_title;
													}
													if ($written_by != '') {
														echo "<br>". __('Written by','globalrec') ." ". $written_by. ". ";
													}
													if ($article_published_in != '') {
														echo $article_published_in. ". ";
													}
													echo get_post_meta( $post_id, '_gr_article-date', true ); ?>
												</p>
										 		<content:encoded><![CDATA[<?php the_excerpt_rss() ?>]]></content:encoded>
                        <?php rss_enclosure(); ?>
                        <?php do_action('rss2_item'); ?>
                </item>
        <?php endwhile; ?>
</channel>
</rss>

