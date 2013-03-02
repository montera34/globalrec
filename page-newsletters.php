<?php  /* Template Name: Page Newsletters */ 
get_header(); ?>

<div id="content">
	<?php get_sidebar(); ?>
<div id="main">
	<?php if (have_posts()) : while (have_posts()) : the_post();?>
	<h2 id="post-<?php the_ID(); ?>">
		<?php the_title();?>
	</h2>
	<?php the_content(); ?>
 	<h3>Struggles and victories Newsletters (globalrec.org)</h3>
	<?php //  _e('(struggles-and-victories-newsletters)', 'wpml_theme'); ?>
	<?php endwhile; endif; 
	global $more;    // Declare global $more (before the loop). "para que seguir leyendo funcione"
		//mirar codigo madre en http://www.hashbangcode.com/blog/create-page-posts-wordpress-417.html
		$args = array(		//arguments for showing newsletters custom post type
			'post_type' => 'newsletter', 
			'posts_per_page' => 1, 
			'post_parent' => 0,
			'order' =>  'ASC',
			'orderby' =>  'title'
	
			);


	if ( $paged > 1 ) {
	 $args['paged'] = $paged;
		}

	$my_query = new WP_Query($args);
		
	if ( $my_query->have_posts() ) :  while ( $my_query->have_posts() ) :  $my_query->the_post();  
		//necessary to show the tags 
		global $wp_query;
		$wp_query->in_the_loop = true;
		
		$more = 0;       // Set (inside the loop) to display content above the more "seguir leyendo" tag. ?>

	
		<div class="size-thumbnail">
			<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?> bio">
				<?php //the_post_thumbnail( 'thumbnail' ); 
				the_title();?>
								
			</a> 
		</div><br>
	
	<?php endwhile; else: ?>
	<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
	<?php endif; 

	global $more;    // Declare global $more (before the loop). "para que seguir leyendo funcione"
		//mirar codigo madre en http://www.hashbangcode.com/blog/create-page-posts-wordpress-417.html
		/* $args = array( //arguments for showing newsletters custom post type
		'caller_get_posts' => 1,
		'post_type' => 'newsletter', 
		'posts_per_page' => -1, 
		'post_parent' => 0,
		'order' =>  'ASC',
		'orderby' =>  'title'
		);*/
		$args = array(	/* 	
				'relation' => 'OR',
				array( *///arguments for showing newsletters cagtegory
					'post_type' => 'post',
					'posts_per_page' => -1, 
					'post_parent' => 0,
					'order' =>  'DESC',
					'category_name' => 'global-alliance-newsletter'
					/*),
				array( //arguments for showing newsletters custom post type
					'post_type' => 'newsletter', 
					'posts_per_page' => -1, 
					'post_parent' => 0,
					'order' =>  'ASC',
					'orderby' =>  'title'
					)*/	
			);


	if ( $paged > 1 ) {
	 $args['paged'] = $paged;
		}

	$my_query = new WP_Query($args);
		
	if ( $my_query->have_posts() ) :  while ( $my_query->have_posts() ) :  $my_query->the_post();  
		//necessary to show the tags 
		global $wp_query;
		$wp_query->in_the_loop = true;
		
		$more = 0;       // Set (inside the loop) to display content above the more "seguir leyendo" tag. ?>

	
		<div class="size-thumbnail">
			<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?> bio">
				<?php //the_post_thumbnail( 'thumbnail' ); 
				the_title();?>
								
			</a> 
		</div><br>
	
	<?php endwhile; else: ?>
	<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
	<?php endif; ?>
	<h3>African newsletters </h3>
	<?php

	global $more;    // Declare global $more (before the loop). "para que seguir leyendo funcione"
		$args = array( //arguments for showing newsletters custom post type
		'caller_get_posts' => 1, 
		'posts_per_page' => 2, 
		'post_parent' => 0,
		'order' =>  'DESC',
		'category_name' => 'wastepicking-in-africa'
		);

	if ( $paged > 1 ) {
	 $args['paged'] = $paged;
		}

	$my_query = new WP_Query($args);
		
	if ( $my_query->have_posts() ) :  while ( $my_query->have_posts() ) :  $my_query->the_post();  
		//necessary to show the tags 
		global $wp_query;
		$wp_query->in_the_loop = true;
		
		$more = 0;       // Set (inside the loop) to display content above the more "seguir leyendo" tag. ?>

	
		<div class="size-thumbnail">
			<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?> bio">
				<?php //the_post_thumbnail( 'thumbnail' ); 
				the_title();?>
								
			</a> 
		</div><br>
	
	<?php endwhile; else: ?>
	<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
	<?php endif; ?>

	<h3>India (AIW) Newsletters</h3>
	<?php

	global $more;    // Declare global $more (before the loop). "para que seguir leyendo funcione"
		$args = array( //arguments for showing newsletters custom post type
		'caller_get_posts' => 1, 
		'posts_per_page' => -1, 
		'post_parent' => 0,
		'order' =>  'DESC',
		'category_name' => 'wastepicking-in-india-newsletters'
		);

	if ( $paged > 1 ) {
	 $args['paged'] = $paged;
		}

	$my_query = new WP_Query($args);
		
	if ( $my_query->have_posts() ) :  while ( $my_query->have_posts() ) :  $my_query->the_post();  
		//necessary to show the tags 
		global $wp_query;
		$wp_query->in_the_loop = true;
		
		$more = 0;       // Set (inside the loop) to display content above the more "seguir leyendo" tag. ?>

	
		<div class="size-thumbnail">
			<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?> bio">
				<?php //the_post_thumbnail( 'thumbnail' ); 
				the_title();?>
								
			</a> 
		</div><br>
	
	<?php endwhile; else: ?>
	<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
	<?php endif; ?>

	<h3>Latin America Newsletters</h3>
	<?php

	global $more;    // Declare global $more (before the loop). "para que seguir leyendo funcione"
		$args = array( //arguments for showing newsletters custom post type
		'caller_get_posts' => 1, 
		'posts_per_page' => -1, 
		'post_parent' => 0,
		'order' =>  'DESC',
		'category_name' => 'wastepicking-in-latin-america-newsletters'
		);

	if ( $paged > 1 ) {
	 $args['paged'] = $paged;
		}

	$my_query = new WP_Query($args);
		
	if ( $my_query->have_posts() ) :  while ( $my_query->have_posts() ) :  $my_query->the_post();  
		//necessary to show the tags 
		global $wp_query;
		$wp_query->in_the_loop = true;
		
		$more = 0;       // Set (inside the loop) to display content above the more "seguir leyendo" tag. ?>

	
		<div class="size-thumbnail">
			<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?> bio">
				<?php //the_post_thumbnail( 'thumbnail' ); 
				the_title();?>
								
			</a> 
		</div><br>
	
	<?php endwhile; else: ?>
	<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
	<?php endif; ?>

</div>
	

	<div class="navigation">
  			<div class="alignleft"><?php 
				if ( !$max_page ) {
 					 $max_page = $my_query->max_num_pages;
					}
 
				if ( !$paged ) {
 					 $paged = 1;
					}
					$nextpage = intval($paged) + 1;
 
				if ( !is_single() && ( empty($paged) || $nextpage <= $max_page) ) {
  					$attr = apply_filters( 'next_posts_link_attributes', '' );
 					 echo '<a href="' . next_posts( $max_page, false ) . "\" $attr>". preg_replace('/&([^#])(?![a-z]{1,8};)/', '&$1', ' &laquo; Previous posts') .'</a>';
					}
					?></div>
  					<div class="alignright"><?php 
					if ( !is_single() && $paged > 1 ) {
  				$attr = apply_filters( 'previous_posts_link_attributes', '' );
  				echo '<a href="' . previous_posts( false ) . "\" $attr>". preg_replace( '/&([^#])(?![a-z]{1,8};)/', '&$1', 'Newer posts &raquo;' ) .'</a>';
					}
				?></div>
				</div>
</div>	<!-- #main -->
</div><!-- #content -->
<?php get_footer(); ?>
