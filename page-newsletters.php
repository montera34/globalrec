<?php  /* Template Name: Page Newsletters */ 
get_header(); ?>

<div class="container">
	<div class="row">
		<div id="blog" class="col-md-9">	
			<div class="row">
				<div class="pull-right"><?php do_action('icl_language_selector'); ?></div>
				<h2 id="post-<?php the_ID(); ?>" class="col-md-6">
					<?php the_title();?>	
				</h2>		
			</div>	
			<?php if (have_posts()) : while (have_posts()) : the_post();?>
			<div class="content">
				<?php the_content(); ?>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">	
		<a name="globalrec"></a>
	 	<h3><?php _e('Struggles and victories Newsletters (globalrec.org)', 'wpml_theme'); ?></h3>
		<?php endwhile; endif; 
		global $more;    // Declare global $more (before the loop). "para que seguir leyendo funcione"
			$args = array(		//arguments for showing newsletters custom post type
				'post_type' => 'newsletter', 
				'posts_per_page' => -1, 
				'post_parent' => 0
				);

		$wp_query = new WP_Query($args);
		$wp_count = $wp_query->post_count; //The number of posts being displayed
	
		if ($wp_query->have_posts() ) :
		$count = 0;
		while ( $wp_query->have_posts()) : $wp_query->the_post();
		$count++;
		if ( $count == 1 || $count % 4 == 1) { echo "<div class='row'>"; }
		?>
		<article id="post-<?php the_ID(); ?>" <?php post_class('col-md-3'); ?> >
			<?php include("loop.boxes.php")?>
		</article>
		<?php if ( $count % 4 == 0 || $count == $wp_count){ echo "</div><!-- .row --><hr>";} ?>

		<?php endwhile; else: ?>
		<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
		<?php endif; 

		global $more;    
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

		$my_query = new WP_Query($args); ?>
		<h4> <?php _e('Previous GlobalRec Newsletters'); ?></h4>
		<?php if ( $my_query->have_posts() ) :  while ( $my_query->have_posts() ) :  $my_query->the_post();  
			//necessary to show the tags
			global $wp_query;
			$wp_query->in_the_loop = true;?>
	
			<div class="size-thumbnail">
				<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?> bio">
					<?php the_title();?>
				</a> 
			</div><br>

		<?php endwhile; else: ?>
		<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
		<?php endif; ?>
		<a name="africa"></a>
		<h3><?php  _e('African newsletters', 'wpml_theme'); ?></h3>
		<?php 
		global $more;    // Declare global $more (before the loop). "para que seguir leyendo funcione"
			$args = array( //arguments for showing newsletters custom post type
			'ignore_sticky_posts' => 1, 
			'posts_per_page' => 2, 
			'post_parent' => 0,
			'order' =>  'DESC',
			'category_name' => 'wastepicking-in-africa'
			);

		$my_query = new WP_Query($args);
	
		if ( $my_query->have_posts() ) :  while ( $my_query->have_posts() ) :  $my_query->the_post();  
			//necessary to show the tags 
			global $wp_query;
			$wp_query->in_the_loop = true;?>

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
		<h3><?php  _e('India (AIW) Newsletters', 'wpml_theme'); ?></h3>
		<?php

		global $more;    // Declare global $more (before the loop). "para que seguir leyendo funcione"
			$args = array( //arguments for showing newsletters custom post type
			'ignore_sticky_posts' => 1, 
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
					<?php the_title();?>
				</a> 
			</div><br>

		<?php endwhile; else: ?>
		<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
		<?php endif; ?>
		<a name="america"></a>
		<h3><?php  _e('Latin America Newsletters', 'wpml_theme'); ?></h3>
		<?php
		global $more;    // Declare global $more (before the loop). "para que seguir leyendo funcione"
			$args = array( //arguments for showing newsletters custom post type
			'posts_per_page' => -1, 
			'post_parent' => 0,
			'order' =>  'DESC',
			'category_name' => 'wastepicking-in-latin-america-newsletters'
			);

		$my_query = new WP_Query($args);
	
		if ( $my_query->have_posts() ) :  while ( $my_query->have_posts() ) :  $my_query->the_post();  
			//necessary to show the tags 
			global $wp_query;
			$wp_query->in_the_loop = true;?>

			<div class="size-thumbnail">
				<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?> bio">
					<?php the_title();?>
				</a> 
			</div><br>

		<?php endwhile; else: ?>
		<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
		<?php endif; ?>
		</div>
		</div>
	</div>
</div><!-- #content -->
<?php get_footer(); ?>
