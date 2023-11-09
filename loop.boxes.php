<?php
$categories = get_the_category();
$separator = '&nbsp;';
$output = '';
$region = get_the_term_list( $post->ID, 'post-region', '', ', ', '' );
$post_id = $post->ID;
$postType = get_post_type();
$postTypeTitle = '';
$postTypeIcon = '';

//Titles for custom post types
if ( $postType == 'country' ) {
	$postTypeTitle = __('Country','globalrec');
} else if ( $postType == 'city' ) {
	$postTypeTitle = __('City','globalrec');
} else if ( $postType == 'law-report' ) {
	$postTypeTitle = __('Law Report','globalrec');
} else if ( $postType == 'newsletter' ) {
	$postTypeTitle = __('Newsletter','globalrec');
} else if ( $postType == 'global-meeting' ) {
	$postTypeTitle = __('Global Meeting','globalrec');
} else if ( $postType == 'waste-picker-org' ) {
} else if ( $postType == 'document' ) {
	$postTypeTitle = __('Document','globalrec');
}
else {
}

//icons for custom post types
if ( $postType == 'country' ) {
	$postTypeIcon = 'dashicons-media-default';
} else if ( $postType == 'city' ) {
	$postTypeIcon = 'dashicons-building';
} else if ( $postType == 'law-report' ) {
	$postTypeIcon = 'book-dashicon';
} else if ( $postType == 'newsletter' ) {
	$postTypeIcon = 'dashicons-media-document';
} else if ( $postType == 'global-meeting' ) {
	$postTypeIcon = 'dashicons-admin-site';
} else if ( $postType == 'waste-picker-org' ) {
	$postTypeIcon = 'groups-dashicon';
} else if ( $postType == 'document' ) {
	$postTypeIcon = 'dashicons-portfolio';
} else if ( $postType == 'page' ) {
	$postTypeIcon = 'dashicons-media-document';
} else if ( $postType == 'post' ) {
	$postTypeIcon = 'dashicons-format-aside';
} else {
}

// document fields
$dc_fs_out = '';
if ( $postType == 'document' ) {
	$dc = pods('document',$post->ID);
	$dc_y = $dc->display('_dc_year');
	$dc_y_out = ( !empty($dc_y) ) ? '<small>'.__('Publication year: ','globalrec').$dc_y.'</small>' : '';
	$dc_f = $dc->field('_dc_file');
	$dc_f_out = '';
	if ( !empty($dc_f) ) {
		$f_perma = $dc->display('_dc_file');
		$f_size = size_format( filesize( get_attached_file( $dc_f['ID'] ) ) );
		$f_mime = $dc_f['post_mime_type'];
		if ( strpos( $f_mime, 'pdf' ) !== false ) {
			$dc_f_l = __('Download: ','globalrec').'<span class="dashicons dashicons-pdf"></span> ('.$f_size.')';
		}
		elseif ( strpos( $f_mime, 'image' ) !== false ) {
			$dc_f_l = __('Download: ','globalrec').'<span class="dashicons dashicons-format-image"></span> ('.$f_size.')';
		}
		else {
			$dc_f_l = __('Download file','globalrec').' ('.$f_size.')';
		}
		$dc_f_out = '<div><small><a href="'.$f_perma.'">'.$dc_f_l.'</a></small></div>';
	}
	$dc_fs_out = '
	<div class="dc-meta">'.
		$dc_y_out.$dc_f_out
	.'</div>
	';
}
?>

<div class="thumbnail">
	<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">
	<?php if (has_post_thumbnail()) :
			echo '<div class="size-thumbnail" style="margin:0 0 10px 0;">';
			//the_post_thumbnail( 'medium', array('class' => 'img-responsive') );
			
			if (get_the_post_thumbnail($post->ID,'medium') != '' ) {
				the_post_thumbnail( 'medium', array('class' => 'img-responsive') );
				} else {
				the_post_thumbnail( 'full', array('class' => 'img-responsive') );
				}
			echo "</div>";
		else:
			//echo '<img width="150" src="' . get_bloginfo( 'stylesheet_directory' ) . '/images/thumbnail-default.png" />';
		endif; ?>
	</a>
	<h4>
		<span class="dashicons <?php echo !empty($postTypeIcon) ? $postTypeIcon : ''; ?>"></span>
		<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">
			<?php echo !empty($postTypeTitle) ? $postTypeTitle. ': ' : ''; ?>
			<?php the_title(); ?>
		</a>
	</h4>
	<div class="post-metadata">
		<small> 
		<?php if ( $postType == 'post') {
			$author_url = get_author_posts_url( get_the_author_meta( 'ID' ) );
			$author = get_the_author_meta('display_name');
			$written_by = get_post_meta( $post->ID, '_gr_written-by', true );
				if (!empty($written_by)) {
					if ($written_by == $author) {
						//temporary hack while creating all the users. Displays author as link if the autor exists.
						//Author "Display name publicly as" must be the same as the name written at '_gr_written-by' custom field
						echo "<a href='".$author_url."'>".$author."</a>";
				 	} else { //if the text is written by someone the field "written by" will be filled
						echo $written_by;
					}
				}
				else {
					the_author_posts_link();
				}
			}
		?>
		<?php
			if ($region != '')  {
				echo "| ";
				echo _e('Region','globalrec');
				echo " ".$region;
				echo " | ";
			}
			if ($postType == 'global-meeting' || $postType == 'document' ) {
				//do nothing
			} else if ($postType == 'waste-picker-org') {
				echo get_post_meta( $post_id, 'city', true ). ", ";
				echo get_post_meta( $post_id, 'country', true );
				echo '<br>';
				echo get_the_term_list( $post_id, 'wpg-scope', ' ', ', ', '' ). " | ";
				echo get_the_term_list( $post_id, 'wpg-organization-type', ' ', ', ', '' ). " | ";
				echo get_the_term_list( $post_id, 'wpg-member-type', ' ', ', ', '' );
			} else {
				the_time('M d, Y');
			}
	 	?></small>
	</div>
	<?php //related excerpt
		$post_excerpt = get_the_excerpt();
		$pattern = '/.{180}/i';
		preg_match($pattern, $post_excerpt, $matches);
		if (!empty($matches)){
			if ( $matches[0] != '' ) {
				$post_excerpt = $matches[0] . "...";
			}
		}
		?>
	<?php if ($postType != 'global-meeting') { //conditional if is global meeting custom post type, don't show excerpt ?>		
		<div class="excerpt">
			<small>
				<?php
				if ($postType == 'waste-picker-org') {
					} else {
						if($post->post_excerpt) : the_excerpt(); else:
						echo $post_excerpt; endif;
					}
				?>
			</small>
		</div>
	<?php }?>

	<?php echo $dc_fs_out; ?>

		<?php $text = get_post_meta( $post->ID, 'gm_location', true ); echo $text; ?> 
		<div class="pull-right"> 
			<span class="label "><?php echo get_the_term_list( $post->ID, 'gb-year', ' ', ', ', '' ); ?></span> 
		 </div>
	<div class="row">
			<div class="col-md-12">
			<?php
				if($categories){
					foreach($categories as $category) {
						$output .= '<a href="'.get_category_link( $category->term_id ).'"title="' . esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) . '" ><span class="label">'.$category->cat_name.'</span></a>'.$separator; //removed the ".$separator"
					}
				echo trim($output, $separator);
				}	
			?>
		</div>
	</div>
</div>
