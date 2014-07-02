<?php  /* Template Name: Page Global Meetings*/ 
get_header(); ?>
<div id="page-gb">
	<?php if (have_posts()) : while (have_posts()) : the_post();?>
		<div class="row">
			<h2 id="post-<?php the_ID(); ?>" class="col-md-10">
				<?php the_title();?>	
			</h2>		
			<div class="pull-right"><?php do_action('icl_language_selector'); ?></div>
		</div>
		<div class="content">
			<?php the_content(); ?>	
		</div>
		<?php endwhile; endif; ?>
		<?php global $more;    //select global meeting to build the highlited boxes. They should be marked with the taxonomy selected in "highlighted"
			$args = array(
			 'ignore_sticky_posts' => 1,
			 'post_type' => 'global-meeting', 
			 'posts_per_page' => 3, 
			 'post_parent' => 0,
			 'gb-selected' => 'highlighted'
				);
			if ( $paged > 1 ) {
			 $args['paged'] = $paged;
				}
 
			$my_query = new WP_Query($args);
			?>
		<?php if ($my_query->have_posts() ) : 
			$count = 0;
			while ( $my_query->have_posts()) : $my_query->the_post(); 
			$count++;
			if ( $count == 1 ) { echo "<div class='row'>"; } ?>
		<?php 	 //necessary to show the tags 
			global $wp_query;
			$wp_query->in_the_loop = true;
			?>		
				<div id="post-<?php the_ID(); ?>" <?php post_class('col-md-4'); ?>	>
					<?php include("loop.boxes.php")?>
				</div>
		<?php if ( $count == 3 ) { echo "</div><!-- .row --><hr>"; $count = 0; }?>
		<?php endwhile; else: ?>
		<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
		<?php endif; ?>
		<?php	global $more;    // Declare global $more (before the loop). "para que seguir leyendo funcione"
			//mirar codigo madre en http://www.hashbangcode.com/blog/create-page-posts-wordpress-417.html
			$args = array(
			 'ignore_sticky_posts' => 1,
			 'post_type' => 'global-meeting', 
			 'posts_per_page' => 35, 
			 'post_parent' => 0
			 
				);
			if ( $paged > 1 ) {
			 $args['paged'] = $paged;
				}
 
			$my_query = new WP_Query($args);
			?>

  <table class="table table-hover table-condensed">
	<thead>
		<tr>
			<th><?php _e('Name','globalrec'); ?></th>
			<th><?php _e('Location','globalrec'); ?></th>
			<th><?php _e('Year','globalrec'); ?></th>
			<th><?php _e('Type','globalrec'); ?></th>
		</tr>
	</thead>
    <tbody>
	<?php if ( $my_query->have_posts() ) : while ( $my_query->have_posts() ) :  $my_query->the_post(); ?>
	<?php global $wp_query;
		$wp_query->in_the_loop = true;

		//intento de añadir la class 'label' a los bg-type
		$id = $post->ID;
		$tax = 'gb-type';
		$op = '';
		$list = get_the_term_list($id,$tax,'','|','');
		if ($list) {
		   $terms = explode('|',$list);
		   $op = '';
		   foreach ($terms as $term) {
		      $item = "<span class=\"label\">$term</span>";
		      $op .= $item;
		   }
		}
		?>
			<tr <?php post_class('global-meeting-list'); ?> id="post-<?php the_ID(); ?>">
				<td> <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">
					<?php the_title(); ?></a>
			 		<?php if ( is_user_logged_in() ) { echo '<div class="btn btn-sm btn-default pull-right">'; edit_post_link(__('Edit This')); echo "</div>";} ?>
				</td>
				<td>
					<?php $text = get_post_meta( $post->ID, 'gm_location', true ); echo $text; ?>
				</td>
				<td>
					<span class="label"><?php echo get_the_term_list( $post->ID, 'gb-year', ' ', ', ', '' ); ?></span> 
				</td>
				<td>
					<?php echo $op; ?>
				</td>
			</tr>

	<?php endwhile; else: ?>
	<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
	<?php endif; ?>
    </tbody>
  </table>
</div>
<?php get_footer(); ?>
