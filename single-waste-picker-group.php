<?php get_header(); ?>

<div class="container">
	<div class="row">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div <?php post_class("col-md-8") ?> id="post-<?php the_ID(); ?>">
			<ul class="breadcrumb">
			  <li><a href="/waste-picker-groups/">Waste Picker Groups</a></li>
			  <li><?php the_title(); ?> </li>
			</ul>
			<div class="row">
				<div class="col-md-3">
					<?php the_post_thumbnail( 'medium', array('class' => 'img-responsive')); 
						echo "<a href='".get_post_meta( $post->ID, '_wpg_facebook', true ). "'>Facebook</a> ";
						echo "<a href='".get_post_meta( $post->ID, '_wpg_twitter', true ). "'>Twitter</a><br>";
						echo get_post_meta( $post->ID, '_wpg_other-social-networks', true ). "<br>";?>
						<h4> Contact information</h4>
						<?php //Contact information TODO private!
						echo get_post_meta( $post->ID, '_wpg_skype', true ). "<br>";
						echo get_post_meta( $post->ID, '_wpg_email', true ). "<br>";
						echo get_post_meta( $post->ID, '_wpg_physical-address', true ). "<br>";
						echo get_post_meta( $post->ID, '_wpg_postal-adress', true ). "<br>";

						echo get_post_meta( $post->ID, '_wpg_country-code-telephone', true ). "<br>";
						echo get_post_meta( $post->ID, '_wpg_phone1', true ). "<br>";
						echo get_post_meta( $post->ID, '_wpg_phone2', true ). "<br>";
						echo get_post_meta( $post->ID, '_wpg_cell-phone', true ). "<br>";
						echo get_post_meta( $post->ID, '_wpg_fax', true ). "<br>";
						echo get_post_meta( $post->ID, '_wpg_primary-contact', true ). "<br>";
						echo get_post_meta( $post->ID, '_wpg_secondary-contact', true ). "<br>";
				?>				
				</div>
				<div class="col-md-9">
					<h1> 
						<a href="<?php the_permalink() ?>" rel="bookmark">
							<?php the_title(); ?>
						</a>	
					</h1>
					<?php if ( is_user_logged_in() ) { 
						echo '<div class="btn btn-sm btn-default pull-right">';
						edit_post_link(__('Edit This')); 
						echo "</div>";
						} ?>
					<h4>
						<?php	//location
						echo get_post_meta( $post->ID, '_wpg_city', true ). ", ". get_post_meta( $post->ID, '_wpg_region', true ). ", "	. get_post_meta( $post->ID, '_wpg_country', true ); ?>
					</h4>	
						<?php echo "<a href='".get_post_meta( $post->ID, '_wpg_website', true ). "'>Website</a><br>"; ?>
					<p>
						<h4>Primary information</h4>
						<?php //Primary information
						echo "Year formed: ".get_post_meta( $post->ID, '_wpg_year-formed', true )
						. " (registered in: ".get_post_meta( $post->ID, '_wpg_registration-year', true ).")"
						. "<br> ". get_post_meta( $post->ID, '_wpg_formally-registred', true );;
						echo "Language: ".get_post_meta( $post->ID, '_wpg_language', true ). "<br>"; //TODO output multiple values
						echo get_post_meta( $post->ID, '_wpg_members-type', true ). "<br>";
						echo get_post_meta( $post->ID, '_wpg_members-occupation', true ). "<br>";
						echo get_post_meta( $post->ID, '_wpg_organization-type', true ). "<br>";
						echo get_post_meta( $post->ID, '_wpg_organization-scope', true ). "<br>";
						echo get_post_meta( $post->ID, '_wpg_workplace-members', true ). "<br>";
						echo get_post_meta( $post->ID, '_wpg_membership', true ). "<br>";
						echo get_post_meta( $post->ID, '_wpg_structure', true ). "<br>";
						echo get_post_meta( $post->ID, '_wpg_objectives', true ). "<br>";
						echo get_post_meta( $post->ID, '_wpg_education-training', true ). "<br>";
						echo get_post_meta( $post->ID, '_wpg_partnering-organizations', true ). "<br>";
						echo get_post_meta( $post->ID, '_wpg_affiliations', true ). "<br>";
						echo get_post_meta( $post->ID, '_wpg_funding', true ). "<br>";
						echo get_post_meta( $post->ID, '_wpg_elections', true ). "<br>";
						?> 
						<h4>Benefits</h4>
						<?php //Benefits 
						echo get_post_meta( $post->ID, '_wpg_member-benefits', true ). "<br>";
						echo get_post_meta( $post->ID, '_wpg_credit-members', true ). "<br>";
						echo get_post_meta( $post->ID, '_wpg_safety-technology', true ). "<br>";
						?> 
						<h4>Services</h4>
						<?php	//Services
						echo get_post_meta( $post->ID, '_wpg_relationship-municipality', true ). "<br>";
						echo get_post_meta( $post->ID, '_wpg_types-of-materials', true ). "<br>";
						echo get_post_meta( $post->ID, '_wpg_middlemen', true ). "<br>";
						echo get_post_meta( $post->ID, '_wpg_activities', true ). "<br>";
						echo get_post_meta( $post->ID, '_wpg_sorting-spaces', true ). "<br>";
						echo get_post_meta( $post->ID, '_wpg_treatment-organic-materials', true ). "<br>";
						echo get_post_meta( $post->ID, '_wpg_challenges-access-waste', true ). "<br>";
						?> 
						<h4>Complementary Information</h4>
						<?php	//Complementary information
						echo get_post_meta( $post->ID, '_wpg_publications', true ). "<br>";
						echo get_post_meta( $post->ID, '_wpg_information-source', true ). "<br>";
						echo get_post_meta( $post->ID, '_wpg_date-data-entry', true ). "<br>";
						echo get_post_meta( $post->ID, '_wpg_date-data-updated', true ). "<br>";
						echo "Active: ".get_post_meta( $post->ID, '_wpg_status', true );
						?>
					</p>				
					<hr>
					<strong>Comments / Narrative</strong>
					<?php the_content(__('(more...)')); ?>
				</div>
			</div>		
		</div>
		<!--right column -->
		<div class="col-md-3"> 
		<?php 
		echo "Number of groups:".get_post_meta( $post->ID, '_wpg_number-groups', true ). "<br>";
		echo "Number of members:".get_post_meta( $post->ID, '_wpg_number-individuals', true ). "<br>";
		echo "Gender composition:".get_post_meta( $post->ID, '_wpg_gender-women-composition', true )."%". "<br>";
		echo get_post_meta( $post->ID, '_wpg_gender-women-comment', true );
		?>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12"> 
			<?php include("share.php")?>
		</div>
		<?php endwhile; else: ?>
		<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
		<?php endif; ?>
 		</div>
	</div>	
		
	
	<?php get_footer(); ?>
</div><!-- #container -->
