<?php
/**
 * @package WordPress
 * @subpackage Classic_Theme
 */

if ( post_password_required() ) : ?>
<p><?php _e('Enter your password to view comments.'); ?></p>
<?php return; endif; ?>

<h4 id="comments"> 
<?php if ( comments_open() ) : ?>
	<?php comments_number(__(''), __('1 Comment'), __('% Comments')); ?>
<?php endif; ?>
</h4>

<?php if ( have_comments() ) : ?>
	<ol id="commentlist">

	<?php foreach ($comments as $comment) : ?>
		<li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
		<?php echo get_avatar( $comment, 32 ); ?>
		<?php comment_text() ?>
		<p><cite><?php comment_type(_x('Comment', 'noun'), __('Trackback'), __('Pingback')); ?> <?php _e('by'); ?> <?php comment_author_link() ?> &#8212; <?php comment_date() ?> @ <a href="#comment-<?php comment_ID() ?>"><?php comment_time() ?></a></cite> <?php edit_comment_link(__("Edit This"), ' |'); ?></p>
		</li>

	<?php endforeach; ?>

	</ol>

<?php else : // If there are no comments yet ?>
	<!--p><?php _e('No comments yet.'); ?></p-->
<?php endif; ?>

<?php if ( comments_open() ) : ?>
<h4 id="postcomment"><?php _e('Leave a comment'); ?></h4>

<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
<p><?php printf(__('You must be <a href="%s">logged in</a> to post a comment.'), wp_login_url( get_permalink() ) );?></p>
<?php else : ?>

<form action="<?php echo get_option('siteurl'); ?>/wp-my-comments-post-globalrec.php" method="post" id="commentform" role="form">
	<div class="form-group">
		<label for="comment"><?php _e('Comment'); ?></label>
		<textarea name="comment" id="comment"  class="form-control" rows="3"></textarea>
	</div>
<?php if ( is_user_logged_in() ) : ?>
	<p><?php printf(__('Logged in as %s.'), '<a href="'.get_option('siteurl').'/wp-admin/profile.php">'.$user_identity.'</a>'); ?> <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="<?php _e('Log out of this account') ?>"><?php _e('Log out &raquo;'); ?></a></p>
<?php else : ?>
	<div class="form-group">
		<label for="author"><?php _e('Name'); ?> <?php if ($req) _e('(required)'); ?></label>
		<input type="text" class="form-control" id="author" placeholder="Enter email" type="text" name="author" value="<?php echo esc_attr($comment_author); ?>" >
	</div>
	<div class="form-group">
		<label for="email"><?php _e('Mail (will not be published)');?> <?php if ($req) _e('(required)'); ?></label>
		<input type="email" class="form-control" id="email" placeholder="Enter email" type="text" name="email" value="<?php echo esc_attr($comment_author_email); ?>" >
	</div>
	<div class="form-group">
		<label for="url"><?php _e('Website'); ?></label>
		<input type="text" class="form-control" id="url" placeholder="Enter email" type="text" name="url" value="<?php echo esc_attr($comment_author_url); ?>" >
	</div>
<?php endif; ?>
	<!--<p><small><strong>XHTML:</strong> <?php printf(__('You can use these tags: %s'), allowed_tags()); ?></small></p>-->
	<input name="submit" type="submit" id="submit" tabindex="5" value="<?php esc_attr_e('Submit Comment'); ?>" class="btn btn-default">
	<input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>">
<?php do_action('comment_form', $post->ID); ?>
</form>

<?php endif; // If registration required and not logged in ?>

<?php else : // Comments are closed ?>
<p><!--?php _e('Sorry, the comment form is closed at this time.'); ?--></p>
<?php endif; ?>

<div class="pull-right">
	<small><?php post_comments_feed_link(__('Comments <abbr title="Really Simple Syndication">RSS</abbr> feed for this post.')); ?>
		<?php if ( pings_open() ) : ?>
			<a href="<?php trackback_url() ?>" rel="trackback"><?php _e('TrackBack <abbr title="Universal Resource Locator">URL</abbr>'); ?></a>
		<?php endif; ?>
	</small>
</div>
