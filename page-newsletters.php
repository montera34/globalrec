<?php  /* Template Name: Page Newsletters */ 
get_header(); ?>

<div class="container">
	<div class="row-fluid">
		<div id="blog" class="span9">	
			<div class="row-fluid">
				<h2 id="post-<?php the_ID(); ?>" class="span6">
					<?php the_title();?>	
				</h2>		
				<div class="pull-right"><?php do_action('icl_language_selector'); ?></div>
			</div>	
		<?php if (have_posts()) : while (have_posts()) : the_post();?>
		<?php the_content(); ?>
		<a name="globalrec"></a>
	 	<h3>Struggles and victories Newsletters (globalrec.org)</h3>
		<?php //  _e('(struggles-and-victories-newsletters)', 'wpml_theme'); ?>
		<?php endwhile; endif; 
		global $more;    // Declare global $more (before the loop). "para que seguir leyendo funcione"
			//mirar codigo madre en http://www.hashbangcode.com/blog/create-page-posts-wordpress-417.html
			$args = array(		//arguments for showing newsletters custom post type
				'post_type' => 'newsletter', 
				'posts_per_page' => -1, 
				'post_parent' => 0
				//'order' =>  'ASC',
				//'orderby' =>  'title'
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
		<a name="africa"></a>
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
		
		<a name="india"></a>
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
		<a name="america"></a>
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
</div><!-- #content -->
<?php get_footer(); ?>
