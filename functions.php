<?php
$prefix_wpo = 'wpg-';
$prefixwpg = '_wpg_';

// add menu para pune2012
function register_my_menus() {
  register_nav_menus(
    array(
		'main-menu' => 'Main Menu',
		'home-menu' => 'Home Menu',
		'foot_menu' => 'Footer Menu'
	)
  );
}

add_action( 'init', 'register_my_menus' );


// Custom post types
add_action( 'init', 'create_post_type', 0 );

function create_post_type() {
register_post_type( 'global-meeting', array( // global meetings
	'labels' => array(
		'name' => __( 'Global Meetings' ),
		'singular_name' => __( 'Global Meeting' ),
		'add_new_item' => __( 'Add Global Meeting +' ),
		'edit' => __( 'Edit' ),
		'edit_item' => __( 'Edit this item' ),
		'new_item' => __( 'New Global Meeting' ),
		'view' => __( 'View Global Meeting' ),
		'view_item' => __( 'View Global Meeting' ),
		'search_items' => __( 'Search Global Meeting' ),
		'not_found' => __( 'We didnt found any Global Meeting' ),
		'not_found_in_trash' => __( 'No Global Meeting in the trash bin' ),
		'parent' => __( 'Parent Global Meeting' )
		),
	'hierarchical' => true,
	'public' => true,
	'menu_position' => 5,
	'supports' => array('title', 'editor','custom-fields','author','comments','revisions','page-attributes','thumbnail','excerpt'),
	'rewrite' => array('slug'=>'global-meeting','with_front'=>false),
	'menu_icon' => 'dashicons-admin-site',
	)
);
register_post_type( 'bio', array( // Defining Biography custom post type
	'labels' => array(
		'name' => __( 'Biographies' ),
		'singular_name' => __( 'Biography' ),
		'add_new_item' => __( 'Add Biography +' ),
		'edit' => __( 'Edit' ),
		'edit_item' => __( 'Edit this item' ),
		'new_item' => __( 'New Biography' ),
		'view' => __( 'View Biography' ),
		'view_item' => __( 'View Biography' ),
		'search_items' => __( 'Search Biography' ),
		'not_found' => __( 'We didnt found any Biography' ),
		'not_found_in_trash' => __( 'No Biography in the trash bin' ),
		'parent' => __( 'Parent Biography' )
		),
	'hierarchical' => false,
	'public' => true,
	'menu_position' => 5,
	'supports' => array('title', 'editor','custom-fields','author','comments','revisions','page-attributes','thumbnail','excerpt'),
	'rewrite' => array('slug'=>'bio','with_front'=>false),
	'menu_icon' => 'dashicons-id',
	)
);

register_post_type( 'newsletter', array( // Defining Newsletter custom post type
	'labels' => array(
		'name' => __( 'Newsletters' ),
		'singular_name' => __( 'Newsletter' ),
		'add_new_item' => __( 'Add Newsletter' ),
		'edit' => __( 'Edit' ),
		'edit_item' => __( 'Edit this item' ),
		'new_item' => __( 'New Newsletter' ),
		'view' => __( 'View Newsletter' ),
		'view_item' => __( 'View Newsletter' ),
		'search_items' => __( 'Search Newsletter' ),
		'not_found' => __( 'We didnt found any Newsletter' ),
		'not_found_in_trash' => __( 'No Newsletter in the trash bin' ),
		'parent' => __( 'Parent Newsletter' )
		),
	'hierarchical' => false,
	'public' => true,
	'menu_position' => 5,
	'supports' => array('title', 'editor','custom-fields','author','comments','revisions','page-attributes','thumbnail','excerpt'),
	'rewrite' => array('slug'=>'newsletter','with_front'=>false),
	'menu_icon' => 'dashicons-email-alt',
	)
);

register_post_type( 'waste-picker-org', array( // Defining Waste Picker Group custom post type
	'labels' => array(
		'name' => __( 'Waste Picker Organizations' ),
		'singular_name' => __( 'Waste Picker Organization' ),
		'add_new_item' => __( 'Add Waste Picker Organization' ),
		'edit' => __( 'Edit' ),
		'edit_item' => __( 'Edit this item' ),
		'new_item' => __( 'New Waste Picker Organization' ),
		'view' => __( 'View Waste Picker Organization' ),
		'view_item' => __( 'View Waste Picker Organization' ),
		'search_items' => __( 'Search Waste Picker Organization' ),
		'not_found' => __( 'We didn\'t found any Waste Picker Organization' ),
		'not_found_in_trash' => __( 'No Waste Picker Organization in the trash bin' ),
		),
	'hierarchical' => false,
	'public' => true,
	'menu_position' => 5,
	'supports' => array('title', 'editor','custom-fields','author','comments','revisions','thumbnail','excerpt'),
	'rewrite' => array('slug'=>'organization','with_front'=>false),
	'menu_icon' => 'dashicons-groups',
	)
);

register_post_type( 'threat', array( // Defining Threat custom post type
	'labels' => array(
		'name' => __( 'Threats' ),
		'singular_name' => __( 'Threat' ),
		'add_new_item' => __( 'Add Threat' ),
		'edit' => __( 'Edit' ),
		'edit_item' => __( 'Edit this item' ),
		'new_item' => __( 'New Threat' ),
		'view' => __( 'View Threat' ),
		'view_item' => __( 'View Threat' ),
		'search_items' => __( 'Search Threat' ),
		'not_found' => __( 'We didn\'t found any Threat' ),
		'not_found_in_trash' => __( 'No Threat in the trash bin' ),
		),
	'hierarchical' => false,
	'public' => true,
	'menu_position' => 5,
	'supports' => array('title', 'editor','custom-fields','author','revisions','thumbnail','excerpt'),
	'menu_icon' => 'dashicons-hammer',
	)
);

register_post_type( 'inclusive-model', array( // Defining Inclusive Model custom post type
	'labels' => array(
		'name' => __( 'Inclusive Models' ),
		'singular_name' => __( 'Inclusive Model' ),
		'add_new_item' => __( 'Add Inclusive Model' ),
		'edit' => __( 'Edit' ),
		'edit_item' => __( 'Edit this item' ),
		'new_item' => __( 'New Inclusive Model' ),
		'view' => __( 'View Inclusive Model' ),
		'view_item' => __( 'View Inclusive Model' ),
		'search_items' => __( 'Search Inclusive Model' ),
		'not_found' => __( 'We didn\'t found any Inclusive Model' ),
		'not_found_in_trash' => __( 'No Inclusive Model in the trash bin' ),
		),
	'hierarchical' => false,
	'public' => true,
	'menu_position' => 5,
	'supports' => array('title', 'editor','custom-fields','author','revisions','thumbnail','excerpt'),
	'menu_icon' => 'dashicons-awards',
	)
);

register_post_type( 'law-report', array( // Defining Law report custom post type
	'labels' => array(
		'name' => __( 'Law Reports' ),
		'singular_name' => __( 'Law Report' ),
		'add_new_item' => __( 'Add Law Report' ),
		'edit' => __( 'Edit' ),
		'edit_item' => __( 'Edit this item' ),
		'new_item' => __( 'New Law Report' ),
		'view' => __( 'View Law Report' ),
		'view_item' => __( 'View Law Report' ),
		'search_items' => __( 'Search Law Report' ),
		'not_found' => __( 'We didn\'t found any Law Report' ),
		'not_found_in_trash' => __( 'No Law Report in the trash bin' ),
		),
	'hierarchical' => true,
	'public' => true,
	'menu_position' => 5,
	'supports' => array('title','editor','author','revisions'),
	'menu_icon' => 'dashicons-book-alt',
	)
);

register_post_type( 'city', array( // Defining City custom post type
	'labels' => array(
		'name' => __( 'City' ),
		'singular_name' => __( 'City' ),
		'add_new_item' => __( 'Add City' ),
		'edit' => __( 'Edit' ),
		'edit_item' => __( 'Edit this item' ),
		'new_item' => __( 'New City' ),
		'view' => __( 'View City' ),
		'view_item' => __( 'View City' ),
		'search_items' => __( 'Search City' ),
		'not_found' => __( 'We didn\'t found any City' ),
		'not_found_in_trash' => __( 'No City in the trash bin' ),
		),
	'hierarchical' => false,
	'public' => true,
	'menu_position' => 5,
	'supports' => array('title','editor','author','revisions'),
	'menu_icon' => 'dashicons-minus',
	)
);

register_post_type( 'country', array( // Defining Country custom post type
	'labels' => array(
		'name' => __( 'Countries' ),
		'singular_name' => __( 'Country' ),
		'add_new_item' => __( 'Add Country' ),
		'edit' => __( 'Edit' ),
		'edit_item' => __( 'Edit this item' ),
		'new_item' => __( 'New Country' ),
		'view' => __( 'View Country' ),
		'view_item' => __( 'View Country' ),
		'search_items' => __( 'Search Country' ),
		'not_found' => __( 'We didn\'t found any Country' ),
		'not_found_in_trash' => __( 'No Country in the trash bin' ),
		),
	'hierarchical' => false,
	'public' => true,
	'menu_position' => 5,
	'supports' => array('title','author','revisions'),
	//'rewrite' => array('slug'=>'group','with_front'=>false),
	'menu_icon' => 'dashicons-minus',
	)
);
}


// Custom Taxonomies
add_action( 'init', 'build_taxonomies', 0 );

function build_taxonomies() {
register_taxonomy( 'gb-type', 'global-meeting', array(
	'hierarchical' => true,
	'label' => 'Type',
	'query_var' => true,
	'rewrite' => true ) );
register_taxonomy( 'gb-year', 'global-meeting', array(
	'label' => 'Year',
	'query_var' => true,
	'rewrite' => true ) );
register_taxonomy( 'gb-selected', 'global-meeting', array( //select if it appears in a prominent way in the global meetings page
	'hierarchical' => true,
	'label' => 'Selected for Global Meetings boxes',
	'query_var' => true,
	'rewrite' => true ) );
register_taxonomy( 'post-region', 'post', array(
	'hierarchical' => true,
	'label' => 'Regions',
	'query_var' => true,
	'rewrite' => true ) );
register_taxonomy( 'post-newsletter', 'post', array(
	'hierarchical' => true,
	'label' => 'Newsletters',
	'query_var' => true,
	'rewrite' => array( 'slug' => 'post-belongs-to-newsletter' ) ) );
}

//create multiple taxonomies for waste picker organizations
add_action( 'init', 'build_wpo_taxonomies', 0 );

function build_wpo_taxonomies() {

global $prefix_wpo;

$wpoTaxonomies = array(
	$prefix_wpo . 'language' => 'Language',
	$prefix_wpo . 'member-type' => 'Waste Picker Member type',
	$prefix_wpo . 'scope' => 'Waste Picker Organization scope',
	$prefix_wpo . 'organization-type' => 'Waste Picker Organization Type',
	$prefix_wpo . 'member-occupation' => 'Occupation of Members',
	$prefix_wpo . 'workplace-members' => 'Workplace of Members',
	$prefix_wpo . 'membership' => 'Membership',
	$prefix_wpo . 'education-training' => 'Education and training',
	$prefix_wpo . 'affiliations' => 'Affiliations',
	$prefix_wpo . 'funding' => 'How are  activities funded?',
	$prefix_wpo . 'member-benefits' => 'Member benefits',
	$prefix_wpo . 'safety-technology' => 'Safety & Technology',
	$prefix_wpo . 'municipality-how' => 'How is the relationship with the municipality?',
	$prefix_wpo . 'municipality-what' => 'What kind of relationship exists with the municipality?',
	$prefix_wpo . 'material-type' => 'Types of materials collected',
	$prefix_wpo . 'activities' => 'Activities',
	$prefix_wpo . 'sorting-spaces' => 'Sorting spaces',
	$prefix_wpo . 'treatment-organic-materials' => 'Treatment of organic materials',
	$prefix_wpo . 'challenges-access-waste' => 'Challenges to access waste',
	$prefix_wpo . 'status' => 'Status of the organization',
);

	foreach ($wpoTaxonomies as $key => $value) {
		register_taxonomy( $key, 'waste-picker-org', array(
			'hierarchical' => true,
			'label' => $value,
			'query_var' => true,
			'rewrite' => array( 'slug' => $key ) )
		);
	}
}

add_action('init', 'my_custom_init');

function my_custom_init() {
		add_post_type_support( 'global-meeting', 'excerpt' ); //adds excerpt to global meeting post type
}

/*
 * Register widgetized areas,
 */
function globalrec_widgets_init() {
	// Area 1, located at the front-page.
	register_sidebar( array(
		'name' => __( 'Banner Home page widget area', 'globalrec' ),
		'id' => 'front-page-widget-area-main',
		'description' => __( 'Front page widget area main', 'globalrec' ),
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => '',
	) );
	// Area 2, located at the front-page.
	register_sidebar( array(
		'name' => __( 'Home page side bar', 'globalrec' ),
		'id' => 'main-sidebar-widget',
		'description' => __( 'Main sidebar', 'globalrec' ),
		'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	) );
	// Area 3, located at the Newsletter page
	register_sidebar( array(
		'name' => __( 'Newsletter suscribe', 'globalrec' ),
		'id' => 'newsletter',
		'description' => __( 'Newsletter', 'globalrec' ),
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => '',
	) );
	// Area 4, located at the Newsround up page
	register_sidebar( array(
		'name' => __( 'News Feeds', 'globalrec' ),
		'id' => 'newsroundup',
		'description' => __( 'Newslround up feeds', 'globalrec' ),
		'before_widget' => '<div id="%1$s" class="widget-container-feed %2$s span2">',
		'after_widget' => '</div>',
		'before_title' => '<strong>',
		'after_title' => '</strong>',
	) );
	// Area 5, located at the blog page
	register_sidebar( array(
		'name' => __( 'Blog side bar', 'globalrec' ),
		'id' => 'blog-sidebar',
		'description' => __( 'The side bar of the blog', 'globalrec' ),
		'before_widget' => '<div id="%1$s" class="widget-container-feed %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	) );
	// Area 6, located at the footer
	register_sidebar( array(
		'name' => __( 'Footer bar', 'globalrec' ),
		'id' => 'footer-sidebar',
		'description' => __( 'The footer bar', 'globalrec' ),
		'before_widget' => ' ',
		'after_widget' => '',
		'before_title' => ' ',
		'after_title' => ' ',
	) );
	// Area 7, located at the footer
	register_sidebar( array(
		'name' => __( 'Footer Home bar', 'globalrec' ),
		'id' => 'footer-home-bar',
		'description' => __( 'Footer Home bar', 'globalrec' ),
		'before_widget' => ' ',
		'after_widget' => '',
		'before_title' => ' ',
		'after_title' => ' ',
	) );
}
/** Register sidebars by running twentyten_widgets_init() on the widgets_init hook. */
add_action( 'widgets_init', 'globalrec_widgets_init' );

// sustituye el [...] del excerpt por un link al post. more info at http://codex.wordpress.org/Function_Reference/the_excerpt
function new_excerpt_more($more) {
       global $post;
	return '<a href="'. get_permalink($post->ID) . '"> &raquo; read the post </a>';
}
add_filter('excerpt_more', 'new_excerpt_more');

//--------------------------------------------------------------------------------//

if ( function_exists('register_sidebar') )
	register_sidebar(array(
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => '</li>',
		'before_title' => '',
		'after_title' => '',
	));

/* Translation: To make categories id work via http://wpml.org/es/documentation-2/soporte/crear-temas-multilingues-en-wordpress/numeros-id-dependientes-del-idioma/*/
/*Si está escribiendo un Tema que necesita ser utilizado con WPML, pero también desea que se ejecute adecuadamente sin WPML, debería realizar esas llamadas por medio de la función function_exists(). Por ejemplo: puede crear esta función en su archivo functions.php:*/

function lang_category_id($id){
  if(function_exists('icl_object_id')) {
    return icl_object_id($id,'category',true);
  } else {
    return $id;
  }
}
add_action('init', 'lang_category_id');

//allow iframe
function add_iframe($initArray) {
$initArray['extended_valid_elements'] = "iframe[id|class|title|style|align|frameborder|height|longdesc|marginheight|marginwidth|name|scrolling|src|width]";
return $initArray;
}
add_filter('tiny_mce_before_init', 'add_iframe');

// Post Attachment image function. Image URL for CSS Background. 
function the_post_image_url($size=large) {
	
	global $post;
	$linkedimgurl = get_post_meta ($post->ID, 'image_url', true);

	if ( $images = get_children(array(
		'post_parent' => get_the_ID(),
		'post_type' => 'attachment',
		'numberposts' => 1,
		'post_mime_type' => 'image',)))
	{
		foreach( $images as $image ) {
			$attachmenturl=wp_get_attachment_image_src($image->ID, $size);
			$attachmenturl=$attachmenturl[0];
			$attachmentimage=wp_get_attachment_image( $image->ID, $size );

			echo ''.$attachmenturl.'';
		}
		
	} elseif ( $linkedimgurl ) {

		echo $linkedimgurl;

	} elseif ( $linkedimgurl && $images = get_children(array(
		'post_parent' => get_the_ID(),
		'post_type' => 'attachment',
		'numberposts' => 1,
		'post_mime_type' => 'image',)))
	{
		foreach( $images as $image ) {
			$attachmenturl=wp_get_attachment_image_src($image->ID, $size);
			$attachmenturl=$attachmenturl[0];
			$attachmentimage=wp_get_attachment_image( $image->ID, $size );

			echo ''.$attachmenturl.'';
		}
		
	} else {
		echo '' . get_bloginfo ( 'stylesheet_directory' ) . '/img/no-attachment.gif';
	}
}

@ini_set( 'upload_max_size' , '64M' );
@ini_set( 'post_max_size', '64M');
@ini_set( 'max_execution_time', '300' );

//adds featured image to 'post', 'page','bio','global-meeting','waste-picker-org'
add_theme_support( 'post-thumbnails', array( 'post', 'page','bio','global-meeting','waste-picker-org' ) );

//add posts formats
add_theme_support( 'post-formats', array( 'aside', 'gallery', 'video', 'audio', 'image' ) );


//----- Adds metabox. Via https://github.com/jaredatch/Custom-Metaboxes-and-Fields-for-WordPress/wiki/Basic-Usage

function sample_metaboxes( $meta_boxes ) {
	$prefixbio = 'bio_'; // Prefix for all fields
	$meta_boxes[] = array(
		'id' => 'email',
		'title' => 'Email',
		'pages' => array('bio'), // post type
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(
			array(
				'name' => 'Email',
				'desc' => 'Enter the contact email',
				'id' => $prefixbio . 'email',
				'type' => 'text_medium'
			),
			array(
				'name' => 'Telephone',
				'desc' => 'with country prefix',
				'id' => $prefixbio . 'telephone',
				'type' => 'text_medium'
			),
		),
	);
	//Custom field to select a Waste Picker group
	//we need to create the array of Waste Picker Groups
	$posts = query_posts( array(
		'posts_per_page' => -1,
		'post_type' => 'waste-picker-org'
		));
	$groups = '';
	foreach ($posts as $post) {
		$groups[] = array(
			'name' => $post->post_title,
			'value' => $post->ID
		);
	}
	$meta_boxes[] = array(
		'id' => 'bio-waste-picker-group',
		'title' => 'Waste Picker Organization',
		'pages' => array('bio'), // post type
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(
			array(
				'name' => 'Waste Picker Group',
				'desc' => 'Select the main waste picker organization where the person belongs',
				'id' => $prefixbio . 'group',
				'type' => 'select',
				'options' =>  $groups //one to many relationship. One waste picker group contains multiple members (bios)
			),
		),
	);
	wp_reset_query();
	//Custom field to select a Country for a Waste Picker (bio)
	$posts = query_posts( array(
		'posts_per_page' => -1,
		'post_type' => 'country'
		));
	foreach ($posts as $post) {
		$countries[] = array(
			'name' => $post->post_title,
			'value' => $post->ID
		);
	}
	$meta_boxes[] = array(
		'id' => 'bio-waste-picker-country',
		'title' => 'Waste Picker Country',
		'pages' => array('bio'), // post type
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(
			array(
				'name' => 'Waste Picker Group',
				'desc' => 'Select the country of the waste picker',
				'id' => $prefixbio . 'country',
				'type' => 'select',
				'options' =>  $countries //one to many relationship. One waste picker group contains multiple members (bios)
			),
		),
	);
	wp_reset_query();

	return $meta_boxes;
}
add_filter( 'cmb_meta_boxes', 'sample_metaboxes' );

function global_meeting_sample_metaboxes( $meta_boxes ) {

	//Custom fields for global meetings
	$prefix2 = 'gm_'; // Prefix for all fields
	$prefix = '_gr_';
	$meta_boxes[] = array(
		'id' => 'global-meeting',
		'title' => 'Global Meeting Details',
		'pages' => array('global-meeting'), // post type
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(
			array(
				'name' => 'Date',
				'desc' => 'Date of the global meeting',
				'id' => $prefix2 . 'date',
				'type' => 'text_medium'
			),
			array(
				'name' => 'Location',
				'desc' => 'City and country',
				'id' => $prefix2 . 'location',
				'type' => 'text_medium'
			),
			array(
				'name' => 'Tag',
				'desc' => 'Related tag from the blog',
				'id' => $prefix2 . 'tag',
				'type' => 'text_medium'
			),
			array(
				'name' => 'Downloads',
				'desc' => 'List here all the documents to download',
				'id' => $prefix2 . 'downloads',
				'type' => 'wysiwyg',
					'options' => array(
						    'wpautop' => true, // use wpautop?
						    'textarea_rows' => get_option('default_post_edit_rows', 2), // rows="..."
						    'teeny' => false, // output the minimal editor config used in Press This
						    'tinymce' => true, // load TinyMCE, can be used to pass settings directly to TinyMCE using an array()
						),
			),
		),
	);
	
	//Custom fields for articles (posts)
	$meta_boxes[] = array(
		'id' => 'post-extra-fields',
		'title' => 'Post in category Press',
		'pages' => array('post'), // post type
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(
			array(
				'name' => 'Published in',
				'desc' => 'Media/newspaper/web that published this article. Ex: "New York Times"',
				'id' => $prefix . 'published-in',
				'type' => 'text_medium'
			),
			array(
				'name' => 'Written by',
				'desc' => 'This article was written by. Ex: "Juanito Valderrama"',
				'id' => $prefix . 'written-by',
				'type' => 'text_medium'
			),
			array(
				'name' => 'Date',
				'desc' => 'when was this article/text published. Stored in m/d/Y format (ex: 09/01/2011)',
				'id' => $prefix . 'article-date',
				'type' => 'text_date'
			),
			array(
				'name' => 'Link to original article',
				'desc' => 'Provide the url. ex: "http://www.radiosantafe.com/2012/03/01/dos-marchas-afectan-la-movilidad-por-la-carrera-septima/"',
				'id' => $prefix . 'article-url',
				'type' => 'text_medium'
			),
			array(
				'name' => 'Article title',
				'desc' => 'The original title of the article',
				'id' => $prefix . 'article-title',
				'type' => 'wysiwyg',
				'options' => array(),
			),
		),
	);
	//Summary for posts (it is different from the excerpt, that is shown in loop.boxes)
	$meta_boxes[] = array(
		'id' => 'post-summary',
		'title' => 'Summary of post (for translation). It\'s different from Excerpt!',
		'pages' => array('post'), // post type
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(
			array(
				'name' => 'Post Summary',
				'desc' => 'This is a summary of the article to send to translators. Do not mistake with the excerpt!',
				'id' => $prefix . 'post-summary',
				'type' => 'wysiwyg',
				'options' => array(),
			),
			array(
				'name' => 'Translator',
				'desc' => 'Type "-" if you are not the translator. Ej: -',
				'default' => '-',
				'id' => $prefix . 'translator',
				'type' => 'text_small'
			),
		),
	);
	//Summary for newsletter (it is different from the excerpt, that is shown in loop.boxes)
	$meta_boxes[] = array(
		'id' => 'newsletter-summary',
		'title' => 'Summary of post (for translation). It\'s different from Excerpt!',
		'pages' => array('newsletter'), // post type
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(
			array(
				'name' => 'Newsletter Summary',
				'desc' => 'This is a summary of the article to send to translators. Do not mistake with the excerpt!',
				'id' => $prefix . 'post-summary',
				'type' => 'wysiwyg',
				'options' => array(),
			),
		),
	);
	//Custom field to select a Country for a post
	$prefixpost = "_post_";
	$posts = query_posts( array(
		'posts_per_page' => -1,
		'post_type' => 'country',
		'orderby' => 'title',
		'order' => 'ASC',
		));
		
	foreach ($posts as $post) {
		$countries[] = array(
			'name' => $post->post_title,
			'value' => $post->ID
		);
	}
	$meta_boxes[] = array(
		'id' => 'post-in-country',
		'title' => 'Post in Country',
		'pages' => array('post'), // post type
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(
			array(
				'name' => 'Post in Country',
				'desc' => 'Select the country in a post',
				'id' => $prefixpost . 'country',
				'type' => 'select',
				'options' =>  $countries,
				'default' => '-',
			),
		),
	);
	wp_reset_query();
	
	//Custom Fields for Waste Picker Groups
	global $prefix_wpo,$prefixwpg; //global prefix variable for waste picker organizations
	
	//Custom field to select a City for a Waste Picker Group
	$posts = query_posts( array(
		'posts_per_page' => -1,
		'post_type' => 'city'
		));
	foreach ($posts as $post) {
		$cities[] = array(
			'name' => $post->post_title,
			'value' => $post->ID
		);
	}
	$meta_boxes[] = array(
		'id' => 'waste-picker-city',
		'title' => 'Waste Picker Group City',
		'pages' => array('waste-picker-org'), // post type
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(
			array(
				'name' => 'Waste Picker Group City',
				'desc' => 'Select the city of the Waste Picker Group',
				'id' => $prefixwpg . 'cityselect', //"cityselect" because "city" is alread used
				'type' => 'select',
				'options' =>  $cities //one to many relationship. One waste picker group contains multiple members (bios)
			),
		),
	);
	wp_reset_query();
	//Custom field to select a Country for a Waste Picker Group
	$posts = query_posts( array(
		'posts_per_page' => -1,
		'post_type' => 'country'
		));
	foreach ($posts as $post) {
		$countries[] = array(
			'name' => $post->post_title,
			'value' => $post->ID
		);
	}
	$meta_boxes[] = array(
		'id' => 'waste-picker-country',
		'title' => 'Waste Picker Group Country',
		'pages' => array('waste-picker-org'), // post type
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(
			array(
				'name' => 'Waste Picker Group Country',
				'desc' => 'Select the country of the Waste Picker Group',
				'id' => $prefixwpg . 'countryselect', //"countryselect" beacuse "country" is alread used
				'type' => 'select',
				'options' =>  $countries //one to many relationship. One waste picker group contains multiple members (bios)
			),
		),
	);
	wp_reset_query();
	
	$meta_boxes[] = array(
		'id' => 'wpg-contact-info',
		'title' => 'Contact Information',
		'pages' => array('waste-picker-org'), // post type
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(
			array(
				'name' => 'Email of Organization',
				'desc' => 'ex: info@globalrec.org',
				'id' => $prefixwpg . 'email',
				'type' => 'text_medium',
			),
			array(
				'name' => 'Website of Organization',
				'desc' => 'ex: http://globalrec.org',
				'id' => $prefixwpg . 'website',
				'type' => 'text_url',
				'protocols' => array( 'http', 'https')
			),
			array(
				'name' => 'Physical Address',
				'desc' => 'ex: ',
				'id' => $prefixwpg . 'physical_address',
				'type' => 'text_medium',
			),
			array(
				'name' => 'Postal Address',
				'desc' => 'ex: ',
				'id' => $prefixwpg . 'postal_address',
				'type' => 'text_medium',
			),
			array(
				'name' => 'City',
				'desc' => '',
				'id' => 'city',
				'type' => 'text_small',
			),
			array(
				'name' => 'Region / State',
				'desc' => 'Indicate region or state within the country. Ex: Florida',
				'id' => $prefixwpg . 'region',
				'type' => 'text_small',
			),
			array(
				'name' => 'Country',
				'desc' => '',
				'id' => 'country',
				'type' => 'text_small',
			),
			array(
				'name' => 'Country Code Telephone',
				'desc' => 'Ex: +1',
				'id' => $prefixwpg . 'country_code_telephone',
				'type' => 'text_small',
			),
			array(
				'name' => 'Phone 1',
				'desc' => '',
				'id' => $prefixwpg . 'phone1',
				'type' => 'text_small',
			),
			array(
				'name' => 'Phone 2',
				'desc' => '',
				'id' => $prefixwpg . 'phone2',
				'type' => 'text_small',
			),
			array(
				'name' => 'Cell Phone',
				'desc' => '',
				'id' => $prefixwpg . 'cell_phone',
				'type' => 'text_small',
			),
			array(
				'name' => 'Fax',
				'desc' => '',
				'id' => $prefixwpg . 'fax',
				'type' => 'text_small',
			),
			array(
				'name' => 'Skype',
				'desc' => 'Skype user name.',
				'id' => $prefixwpg . 'skype',
				'type' => 'text_small',
			),
			array(
				'name' => 'Facebook',
				'desc' => 'Full url. Ex: http://facebook.com/globalrec',
				'id' => $prefixwpg . 'facebook',
				'type' => 'text_medium',
			),
			array(
				'name' => 'Twitter',
				'desc' => 'User name. Ex: global_rec',
				'id' => $prefixwpg . 'twitter',
				'type' => 'text_medium',
			),
			array(
				'name' => 'Other social networks',
				'desc' => 'Add url',
				'id' => $prefixwpg . 'other_social_networks',
				'type' => 'text_medium',
			),
			array(
				'name' => 'Language',
				'desc' => '',
				'id' => $prefix_wpo. 'language',
				'taxonomy' => $prefix_wpo. 'language',
				'type' => 'taxonomy_multicheck',
			),
			array(
				'name' => 'Primary Contact name',
				'desc' => 'Name',
				'id' => $prefixwpg . 'primary_contact_name',
				'type' => 'text_medium',
			),
			array(
				'name' => 'Primary Contact phone',
				'desc' => '',
				'id' => $prefixwpg . 'primary_contact_phone',
				'type' => 'text_medium',
			),
			array(
				'name' => 'Primary Contact position',
				'desc' => '',
				'id' => $prefixwpg . 'primary_contact_position',
				'type' => 'text_medium',
			),
						array(
				'name' => 'Primary Contact email',
				'desc' => '',
				'id' => $prefixwpg . 'primary_contact_email',
				'type' => 'text_medium',
			),
			array(
				'name' => 'Secondary Contact name',
				'desc' => 'Name',
				'id' => $prefixwpg . 'secondary_contact_name',
				'type' => 'text_medium',
			),
			array(
				'name' => 'Secondary Contact phone',
				'desc' => 'Name',
				'id' => $prefixwpg . 'secondary_contact_phone',
				'type' => 'text_medium',
			),
			array(
				'name' => 'Secondary Contact position',
				'desc' => 'Name',
				'id' => $prefixwpg . 'secondary_contact_position',
				'type' => 'text_medium',
			),
			array(
				'name' => 'Secondary Contact email',
				'desc' => 'Name',
				'id' => $prefixwpg . 'secondary_contact_email',
				'type' => 'text_medium',
			),
		),
	);
	//Waste Picker Primary Information
	$meta_boxes[] = array(
		'id' => 'wpg-primary-info',
		'title' => 'Primary Information',
		'pages' => array('waste-picker-org'), // post type
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(
			array(
				'name' => 'Type of members',
				'desc' => 'Select if the organization is Waste Pickers based, Waste Picker Organization based or just supports Waste Pickers',
				'id' => $prefix_wpo . 'member-type',
				'taxonomy' => $prefix_wpo . 'member-type',
				'type' => 'taxonomy_multicheck',
			),
			array(
				'name' => 'Occupation of Members',
				'desc' => '',
				'id' => $prefix_wpo . 'member-occupation',
				'taxonomy' => $prefix_wpo . 'member-occupation',
				'type' => 'taxonomy_multicheck',
			),
			array(
				'name' => __('Organization Type'),
				'desc' => '',
				'id' => $prefix_wpo . 'organization-type',
				'taxonomy' => $prefix_wpo . 'organization-type',
				'type' => 'taxonomy_multicheck',
			),
			array(
				'name' => __('Organization Scope'),
				'desc' => '',
				'id' => $prefix_wpo . 'scope',
				'taxonomy' => $prefix_wpo . 'scope',
				'type' => 'taxonomy_multicheck',
			),
			array(
				'name' => 'Workplace of Members',
				'desc' => '',
				'id' => $prefix_wpo . 'workplace-members',
				'taxonomy' => $prefix_wpo . 'workplace-members',
				'type' => 'taxonomy_multicheck',
			),
			array(
				'name' => 'Membership',
				'desc' => 'Select yes if they are paying or non paying members.',
				'id' => $prefix_wpo . 'membership',
				'taxonomy' => $prefix_wpo . 'membership',
				'type' => 'taxonomy_radio',
			),
			array(
				'name' => 'Number of groups that are members',
				'desc' => 'Input the number of groups that belong to the organization. Ex: 7',
				'id' => $prefixwpg . 'number_groups',
				'type' => 'text_small',
			),
			array(
				'name' => 'Number of individuals that are members',
				'desc' => 'input the number of individuals that belong to the organization> Ex: 134',
				'id' => $prefixwpg . 'number_individuals',
				'type' => 'text_small',
			),
			array(
				'name' => 'Gender Composition Women (Number)',
				'desc' => 'Indicate the percentage of women. If there are 60% of women input "60"',
				'id' => $prefixwpg . 'gender_women_composition',
				'type' => 'text_small',
			),
			array(
				'name' => 'Gender Composition Women (Comment)',
				'desc' => 'If no number is provided indicate here thins like "majority of women"',
				'id' => $prefixwpg . 'gender_women_comment',
				'type' => 'text_small',
			),
			array(
				'name' => 'Organization Structure',
				'desc' => ' ',
				'id' => $prefixwpg . 'structure',
				'type' => 'text_small',
			),
			array(
				'name' => 'Objectives',
				'desc' => '',
				'id' => $prefixwpg . 'objectives',
				'type' => 'textarea',
			),
			array(
				'name' => 'Education and training',
				'desc' => '',
				'id' => $prefixwpg . 'education_training',
				'taxonomy' => $prefix_wpo . 'education-training',
				'type' => 'taxonomy_multicheck',
			),
			array(
				'name' => 'Formally registered',
				'desc' => '',
				'id' => $prefixwpg . 'formally_registered',
				'type' => 'checkbox',
			),
			array(
				'name' => 'Year Formed',
				'desc' => 'Year the organization was formed',
				'id' => $prefixwpg . 'year_formed',
				'type' => 'text_small',
			),
			array(
				'name' => 'Registration Year',
				'desc' => 'Year the organization was registered',
				'id' => $prefixwpg . 'registration_year',
				'type' => 'text_small',
			),
			array(
				'name' => 'Partnering Organizations',
				'desc' => '',
				'id' => $prefixwpg . 'partnering_organizations',
				'type' => 'text_small',
			),
			array(
				'name' => 'Affiliations',
				'desc' => '',
				'id' => $prefix_wpo . 'affiliations',
				'taxonomy' => $prefix_wpo . 'affiliations',
				'type' => 'taxonomy_multicheck',
			),
			array(
				'name' => 'How activities are funded?',
				'desc' => '',
				'id' => $prefix_wpo . 'funding',
				'taxonomy' => $prefix_wpo . 'funding',
				'type' => 'taxonomy_multicheck',
			),
			array(
				'name' => 'Internal Elections: how often?',
				'desc' => '',
				'id' => $prefixwpg . 'elections',
				'type' => 'radio_inline',
				'options' => array(
				    array('name' => 'no', 'value' => 'no'),
				    array('name' => 'Quarterly', 'value' => 'quarterly'),
				    array('name' => 'annually', 'value' => 'annually'),
				    array('name' => 'every 2 years', 'value' => 'every 2 years'),
				    array('name' => 'every 3 years', 'value' => 'every 3 years'),
				    array('name' => 'every 4 years', 'value' => 'every 4 years'),
				    array('name' => 'every 5 years', 'value' => 'every 5 years'),
				    array('name' => 'other', 'value' => 'other'),
				)
			),
		),
	);
	//Benefits custom fields
	$meta_boxes[] = array(
		'id' => 'wpg-benefits',
		'title' => 'Benefits information',
		'pages' => array('waste-picker-org'), // post type
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(
			array(
				'name' => 'Member benefits',
				'desc' => '',
				'id' => $prefix_wpo . 'member-benefits',
				'taxonomy' => $prefix_wpo . 'member-benefits',
				'type' => 'taxonomy_multicheck',
			),
			array(
				'name' => 'Number of credit / saving members?',
				'desc' => 'Ex: "125"',
				'id' => $prefixwpg . 'credit_members',
				'type' => 'text_small',
			),
			array(
				'name' => 'Safety & Technology',
				'desc' => '',
				'id' => $prefix_wpo . 'safety-technology',
				'taxonomy' => $prefix_wpo . 'safety-technology',
				'type' => 'taxonomy_multicheck',
			),
		),
	);
	//Services Custom fields
	$meta_boxes[] = array(
		'id' => 'wpg-services',
		'title' => 'Services provided by the organization',
		'pages' => array('waste-picker-org'), // post type
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(
			array(
				'name' => 'How is the relationship with the municipality?',
				'desc' => '',
				'id' => $prefix_wpo . 'municipality-how',
				'taxonomy' => $prefix_wpo . 'municipality-how',
				'type' => 'taxonomy_multicheck',
			),
			array(
				'name' => 'What kind of relationship exists with the municipality?',
				'desc' => '',
				'id' => $prefix_wpo . 'municipality-what',
				'taxonomy' => $prefix_wpo . 'municipality-what',
				'type' => 'taxonomy_multicheck'
			),
			array(
				'name' => 'Types of materials collected',
				'desc' => '',
				'id' => $prefix_wpo . 'material-type',
				'taxonomy' => $prefix_wpo . 'material-type',
				'type' => 'taxonomy_multicheck',
			),
			array(
				'name' => 'Do you sell to middlemen?',
				'desc' => '',
				'id' => $prefixwpg . 'middlemen',
				'type' => 'radio_inline',
				'options' => array(
					  array('name' => 'Yes', 'value' => 'yes'),
					  array('name' => 'No', 'value' => 'no'),
				)
			),
			array(
				'name' => 'Activities', 
				'desc' => '',
				'id' => $prefix_wpo . 'activities',
				'taxonomy' => $prefix_wpo . 'activities',
				'type' => 'taxonomy_multicheck',
			),
			array(
				'name' => 'Sorting spaces',
				'desc' => 'Where waste is sored or broken down, for example,electrical household items are taken to a sorting workshop where the same types of goods are picked apart by someone and all the reusable components extracted and sorted.',
				'id' => $prefix_wpo  . 'sorting-spaces',
				'taxonomy' => $prefix_wpo . 'sorting-spaces',
				'type' => 'taxonomy_multicheck',
			),
			array(
				'name' => 'Treatment of organic materials',
				'desc' => '',
				'id' => $prefix_wpo . 'treatment-organic-materials',
				'taxonomy' => $prefix_wpo . 'treatment-organic-materials',
				'type' => 'taxonomy_multicheck',
			),
			array(
				'name' => 'Challenges to access waste',
				'desc' => '',
				'id' => $prefix_wpo . 'challenges-access-waste',
				'taxonomy' => $prefix_wpo . 'challenges-access-waste',
				'type' => 'taxonomy_multicheck',
			),
		),
	);
	//Complementary Info Custom fields for Waste Picker Groups
	$meta_boxes[] = array(
		'id' => 'wpg-complementary-info',
		'title' => 'Complementary Info',
		'pages' => array('waste-picker-org'), // post type
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(
			array(
				'name' => 'Publications (details)',
				'desc' => 'Other publications or documents where to find information about this organization.',
				'id' => $prefixwpg . 'publications',
				'type' => 'textarea_small',
			),
			array(
				'name' => 'Source of Information',
				'desc' => 'Where is the information coming from.',
				'id' => $prefixwpg . 'information_source',
				'type' => 'textarea_small',
			),
			array(
					'name' => 'Date of Data Entry',
					'desc' => '',
					'id' => $prefixwpg . 'date_data_entry',
					'type' => 'text_date_timestamp' 
			),
			array(
					'name' => 'Date Data Updated',
					'desc' => '',
					'id' => $prefixwpg . 'date_data_updated',
					'type' => 'text_date_timestamp' //TODO, if this is a multiple data entry, we can not use this type of metabox
			),
			/*array(
				'name' => 'Status of the organization',
				'desc' => 'Indicate if the organization is active',
				'id' => $prefix_wpo . 'status',
				'taxonomy' => $prefix_wpo . 'status',
				'type' => 'taxonomy_radio',
			),*/
			array( //TODO study how to better output relatedposts. Tag or author?
				'name' => 'Type the tag to show related posts in the right column to this Waste piker group',
				'desc' => 'Ex: "MNCR"',
				'id' => 'gm_tag',
				'type' => 'text_small',
			),
		),
	);
		
	//Custom Fields for Law Reports
	$prefixlaw = '_law_';
	//Custom field to select a City for a Waste Picker Group
	$posts = query_posts( array(
		'posts_per_page' => -1,
		'post_type' => 'country',
		'orderby' => 'title',
		'order' => 'ASC',
		));
	foreach ($posts as $post) {
		$countries[] = array(
			'name' => $post->post_title,
			'value' => $post->ID
		);
	}
	$meta_boxes[] = array(
		'id' => 'law-report-country',
		'title' => 'Law Report Country',
		'pages' => array('law-report'), // post type
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(
			array(
				'name' => 'Law Repor in country',
				'desc' => 'Select the country of the Law',
				'id' => $prefixlaw . 'countryselect',
				'type' => 'select',
				'options' =>  $countries,
			)
		),
	);
	wp_reset_query();
	
	$meta_boxes[] = array(
		'id' => 'law-downloads',
		'title' => 'Law Report Downloads',
		'pages' => array('law-report'), // post type
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(
			array(
				'name' => 'Downloads',
				'desc' => 'List here all the documents to download',
				'id' => $prefixlaw . 'downloads',
				'type' => 'wysiwyg',
					'options' => array(
				    'wpautop' => true, // use wpautop?
				    'textarea_rows' => get_option('default_post_edit_rows', 12), // rows="..."
				    'teeny' => false, // output the minimal editor config used in Press This
				    'tinymce' => true, // load TinyMCE, can be used to pass settings directly to TinyMCE using an array()
				),
			),
			array(
				'name' => 'Country for the map',
				'desc' => '',
				'id' => 'country',
				'type' => 'text_small',
			),
		),
	);
	//Custom Fields for Cities
	$prefixcity = '_city_';
	//Custom field to select a Country for City
	$posts = query_posts( array(
		'posts_per_page' => -1,
		'post_type' => 'country',
		'orderby' => 'title',
		'order' => 'ASC',
		));
	foreach ($posts as $post) {
		$countries[] = array(
			'name' => $post->post_title,
			'value' => $post->ID
		);
	}
	$meta_boxes[] = array(
		'id' => 'city-in-country',
		'title' => 'City belons to Country',
		'pages' => array('city'), // post type
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(
			array(
				'name' => 'City belons to Country',
				'desc' => 'Select the country of the city',
				'id' => $prefixcity . 'countryselect',
				'type' => 'select',
				'options' =>  $countries
			),
		),
	);
	wp_reset_query();
		$meta_boxes[] = array(
		'id' => 'city-hidden-field',
		'title' => 'City hidden fields',
		'pages' => array('city'), // post type
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(
			array(
				'name' => 'Content here will only be displayed to logged in users',
				'desc' => 'Contact of interviewee',
				'id' => $prefixcity . 'hidden',
				'type' => 'text',
			),
		),
	);
	
	return $meta_boxes;
}
add_filter( 'cmb_meta_boxes', 'global_meeting_sample_metaboxes' );

// Initialize the metabox class
add_action( 'init', 'initialize_cmb_meta_boxes', 9999 );
function initialize_cmb_meta_boxes() {
	if ( !class_exists( 'cmb_Meta_Box' ) ) {
		require_once( 'lib/metabox/init.php' );
	}
}
//--------------------------finishes metaboxes--------------------------//

add_theme_support( 'post-thumbnails' ); //to make http://codex.wordpress.org/Function_Reference/has_post_thumbnail work

function languages_list(){
    $languages = icl_get_languages('skip_missing=0&orderby=code');
    if(!empty($languages)){
        echo '<div id="language_list"><ul class="nav nav-pills">';
        foreach($languages as $l){
            if($l['active']) {echo '<li class="active">';} else {echo '<li>';};
            if(!$l['active']) {echo '<a href="'.$l['url'].'">';} else {echo '<a href="#">';};
            echo $l['native_name'];
           	echo '</a>';
            echo '</li>';
        }
        echo '</ul></div>';
    }
}

// Function to list values of custom metaboxes with multiple values (multicheck). Used in Waste Picker Group list and single
function list_of_items($postid=1,$value=1,$name=1){
	$items = get_post_meta($postid,$value,true);
	if ($items!='') {
		echo "<dt>".$name."</dt>";
		echo "<dd>";
		foreach($items as $item) {
			echo  $item == 'ngo' ? 'NGO' : ucfirst ($item);
			echo "<br>";
		}
		echo "</dd>";
	}
}
add_action( 'wp', 'list_of_items' );

// Function to list taxonomy terms of Waste Picker Organization in dt-dd format
function list_taxonomy_terms($post_id='',$slug='',$name=''){
	$term_list = get_the_term_list( $post_id, $slug , ' ', ', ', '' );
	if (!empty($term_list)) {
		echo "<dt>" .$name. "</dt>";
		echo "<dd>" .$term_list. "</dd>";
	}
}
add_action( 'wp', 'list_taxonomy_terms' );

//Function to list single values and uppercase firt letter. Used in Waste Picker Group single

function display_item($postid=1,$value=1,$name=1){
	$item = get_post_meta($postid,$value,true);
	if ($item!='') {
		echo "<dt>".$name."</dt><dd>".$item."</dd>";
	}
}
add_action( 'wp', 'display_item' );

//Function to get the number of waste picker groups that have certain custom fields
function get_number_posts ($meta_key,$meta_value) {
	$args = array(
				'posts_per_page' => -1,
				'post_type' => 'waste-picker-org',
				'meta_query' => array(
						 array(
								'key'     => $meta_key,
								'value'   => $meta_value,
								'compare' => 'LIKE',
						 ),
					 ),
				);
	$posts_array = get_posts( $args );
	$result = count($posts_array);
	return $result;
}

//Function to get the number of waste picker groups that have certain custom fields and are 'waste pickers'
function get_number_posts_double ($meta_key,$meta_value) {
	$args = array(
				'posts_per_page' => -1,
				'post_type' => 'waste-picker-org',
				'tax_query' => array(
					array(
						'taxonomy' => 'wpg-member-occupation',
						'field'    => 'slug',
						'terms'    => 'waste-pickers',
					),
				),
				'meta_query' => array(
					 array(
						'key'     => $meta_key,
						'value'   => $meta_value,
						'compare' => 'LIKE',
						),
					),
				);
	$posts_array = get_posts( $args );
	$result = count($posts_array);
	return $result;
}

//Funcion to get number of waste picker groups that are in a certain category and are 'waste pickers'
function get_number_posts_in_taxonomy ($tax,$term) {
	$args = array(
				'posts_per_page' => -1,
				'post_type' => 'waste-picker-org',
				$tax => $term,
				);
	$posts_array = get_posts( $args );
	$result = count($posts_array);
	return $result;
}

function calulate_percentage ($wp_item,$total) {
	$result = round($wp_item/$total*100,1);
	return $result;
}

//formated pagination for bootstrap from http://www.ordinarycoder.com/paginate_links-class-ul-li-bootstrap/
function custom_pagination() {
    global $wp_query;
    $big = 999999999; // need an unlikely integer
    $pages = paginate_links( array(
            'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
            'format' => '?paged=%#%',
            'current' => max( 1, get_query_var('paged') ),
            'total' => $wp_query->max_num_pages,
            'prev_next' => false,
            'type'  => 'array',
            'prev_next'   => TRUE,
						'prev_text'    => __('« Prev'),
						'next_text'    => __('Next »'),
        ) );
        if( is_array( $pages ) ) {
            $paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');
            echo '<h5>'._e('Pagination', 'globalrec').'</h5>';
            echo '<ul class="pagination pagination-lg">';
            foreach ( $pages as $page ) {
                    echo "<li>$page</li>";
            }
           echo '</ul>';
        }
}

//Adds other custom post types to the feed
function myfeed_request($qv) {
	if (isset($qv['feed']) && !isset($qv['post_type']))
		$qv['post_type'] = array('post', 'newsletter');
	return $qv;
}
add_filter('request', 'myfeed_request');

// Waste Pickers Around the World submit form
//Code based in https://github.com/skotperez/15muebles/blob/master/functions.php
// get all posts from a post type to be used in select or multicheck forms
function globalrec_get_list($post_type) {
	$posts = get_posts(array(
	'posts_per_page' => -1,
	'post_type' => $post_type,
	'order'=>'ASC'
	));
	if ( count($posts) > 0 ) {
		foreach ( $posts as $post ) {
		$list[$post->ID] = $post->post_title;
	}
		return $list;
	}
}

// submit WPG form
function globalrec_waw_form() {

	$action = get_permalink();

	// which badge
	if ( array_key_exists('badge_id', $_GET) ) {
		$badge_from = sanitize_text_field( $_GET['badge_id']);
	} else { $badge_from = ""; }

	$badges = globalrec_get_list("waste-picker-org"); //list waste picker groups
	$options_badges = "<option></option>";
	while ( $badge = current($badges) ) {
		if ( $badge_from == key($badges) ) {
			$options_badges .= "<option value='" .key($badges). "' selected>" .$badge. "</option>";
		} else {
			$options_badges .= "<option value='" .key($badges). "'>" .$badge. "</option>";
		}
		next($badges);
	}
	
	$languages = array(
					'spanish' => 'spanish',
					'portuguese' => 'portuguese',
					'english' => 'english',
					'french' => 'french',
					'bamanankan' => 'bamanankan',
					'bambaro' => 'bambaro',
					'bomu' => 'bomu',
					'hindi' => 'hindi',
					'igbo' => 'igbo',
					'kikongo' => 'kikongo',
					'lingala' => 'lingala',
					'malagasy' => 'malagasy',
					'mandingue' => 'mandingue',
					'marathi' => 'marathi',
					'peulh' => 'peulh',
					'serere' => 'serere',
					'swaili' => 'swaili',
					'tieyako bozo' => 'tieyako Bozo',
					'toucouleur / yoruba' => 'toucouleur / yoruba',
					'tshiluba' => 'tshiluba',
					'walot' => 'walot',
					'yoruba' => 'yoruba'
				);
		$options_languages = "<option></option>";
		while ( $language = current($languages) ) {
			$options_languages .= "<option value='" .key($languages). "'>" .ucfirst($language). "</option>";
			next($languages);
		}
			
		
	$form_out = "
	<h2>Submit information about your organization</h2>
<form id='globalrec-form-content' method='post' action='" .$action. "' enctype='multipart/form-data'>
<div class='row'>
	<div class='form-horizontal col-md-10'>
		<legend>Contact information</legend>
		<div class='form-group'>
			<label for='globalrec-form-waw-name' class='col-sm-4 control-label'>Name</label>
			<div class='col-sm-6'>
				<input class='form-control req' type='text' value='' name='globalrec-form-waw-name' />
			</div>
		</div>
		<div class='form-group'>
			<label for='globalrec-form-waw-mail' class='col-sm-4 control-label'>Email</label>
			<div class='col-sm-6'>
	 			<input class='form-control req' type='text' value='' name='globalrec-form-waw-mail' />
				<p class='help-block'><small></small></p>
			</div>
		</div>
		<div class='form-group'>
			<label for='globalrec-form-waw-city' class='col-sm-4 control-label'>City</label>
			<div class='col-sm-6'>
	 			<input class='form-control req' type='text' value='' name='globalrec-form-waw-city' />
				<p class='help-block'><small>City were the organization belongs to</small></p>
			</div>
		</div>
		<div class='form-group'>
			<label for='globalrec-form-waw-country' class='col-sm-4 control-label'>Country</label>
			<div class='col-sm-6'>
	 			<input class='form-control req' type='text' value='' name='globalrec-form-waw-country' />
				<p class='help-block'><small>Country were the organization belongs to</small></p>
			</div>
		</div>
		<div class='form-group'>
			<label for='globalrec-form-waw-website' class='col-sm-4 control-label'>Website</label>
			<div class='col-sm-6'>
				<input class='form-control req' type='text' value='' name='globalrec-form-waw-website' />
				<p class='help-block'><small>URL of the organizations website. Ex: http://globalrec.org</small></p>
			</div>
		</div>
		<div class='form-group'>
			<label for='globalrec-form-waw-language' class='col-sm-4 control-label'>Language</label>
			<div class='col-sm-6'>
				<select class='form-control req' name='globalrec-form-waw-language' maxlenght='11' >
					" .$options_languages. "
				</select>
			</div>
		</div>
		<!--<div class='form-group'>
			<label for='globalrec-form-waw-avatar' class='col-sm-4 control-label'>Image or Logo</label>
			<div class='col-sm-6'>
				<input type='file' name='globalrec-form-waw-avatar' />
				<input type='hidden' name='MAX_FILE_SIZE' value='4000000' />
			<p class='help-block'><small>Image or logotype of the organization. Not bigger than<strong> 4MB</strong> and <strong>must be JPG, PNG or GIF</strong>.</small></p>
			</div>
		</div>-->

		<legend>Primary Information</legend>
		<div class='form-group'>
			<label class='col-sm-4 control-label'>Type of members</label>
			<div class='col-sm-6'>
				<div class='checkbox'>
					<label>
						<input type='checkbox' name='members_list[]' value='members are waste pickers'>
						members are waste pickers
					</label>
				</div>
				<div class='checkbox'>
					<label>
						<input type='checkbox' name='members_list[]' value='members are waste picker organizations'>
						members are waste picker organizations
					</label>
				</div>
				<div class='checkbox'>
					<label>
						<input type='checkbox' name='members_list[]' value='waste picker support organization'>
						waste picker support organization
					</label>
				</div>
				<div class='checkbox'>
					<label>
						<input type='checkbox' name='members_list[]' value='members are multi sector'>
						members are multi sector
					</label>
				</div>
				<div class='checkbox'>
					<label>
						<input type='checkbox' name='members_list[]' value='members employ waste pickers'>
						members employ waste pickers
					</label>
				</div>
				<div class='checkbox'>
					<label'>
						<input type='checkbox' name='members_list[]' value='potential supporters'>
						potential supporters
					</label>
				</div>
			</div>
		</div>
		<div class='form-group'>
			<label class='col-sm-4 control-label'>Organization's scope</label>
			<div class='col-sm-6'>
				<div class='checkbox'>
					<label>
						<input type='checkbox' name='scope_list[]' value='local'>
						Local
					</label>
				</div>
				<div class='checkbox'>
					<label>
						<input type='checkbox' name='scope_list[]' value='regional'>
						Regional
					</label>
				</div>
				<div class='checkbox'>
					<label>
						<input type='checkbox' name='scope_list[]' value='national'>
						National
					</label>
				</div>
				<div class='checkbox'>
					<label>
						<input type='checkbox' name='scope_list[]' value='international'>
						International
					</label>
				</div>
			</div>
		</div>
		<div class='form-group'>
		  <div class='col-sm-offset-4 col-sm-6'>
		  	<input class='btn btn-default' type='submit' value='Send' name='globalrec-form-waw-submit' />
				<span class='help-block'><small><strong>Al fields are required except the image</strong>.</small></span>
		  </div>
  	</div>
	</div>
</div>
</form>
";
	echo $form_out;

} // end add WPG

// insert wpg data in database
function globalrec_insert_wpg() {

	// messages and locations for redirection
	$perma = get_permalink();
	$location = $perma."?form=success";
	$error = "<div class='alert alert-danger'>
		<p>Uno o varios campos están vacíos o no tienen un formato válido.</p>
		<p>Si has rellenado el campo de imagen comprueba que no pesa más de 4MB y que está en un formato adecuado (JPG, PNG, GIF).</p>
		<p>En cualquier caso el formulario no se envió correctamente. Por favor, inténtalo de nuevo.</p>
	</div>";
	$success = "<div class='alert alert-success'>El formulario ha sido enviado correctamente: hemos recibido tus datos. Vamos a revisarlos y si todo está correcto recibirás el badge en unos cuantos días.</div><p><strong>¿Quieres solicitar otro badge?</strong>: <a href='" .$perma. "'>vuelve al formulario</a>.</p>";

	if ( array_key_exists('form', $_GET) ) {
		if ( sanitize_text_field( $_GET['form']) == 'success' ){
			echo "<strong>" .$success. "</strong>";
			return;
		}
	}

	if ( !array_key_exists('globalrec-form-waw-submit', $_POST) ) {
		globalrec_waw_form();
		return;

	} elseif ( sanitize_text_field( $_POST['globalrec-form-waw-submit'] ) != 'Send' ) {
		globalrec_waw_form();
		echo "har";
		return;
	}

	// check if all fields have been filled
	// sanitize them all
	$wpg_name = sanitize_text_field( $_POST['globalrec-form-waw-name'] );
	$wpg_mail = sanitize_email( $_POST['globalrec-form-waw-mail'] );
	$wpg_material = sanitize_text_field( $_POST['globalrec-form-waw-website'] );
	$wpg_badge = sanitize_text_field( $_POST['globalrec-form-waw-language'] );
	$city = sanitize_text_field( $_POST['globalrec-form-waw-city'] );
	$country = sanitize_text_field( $_POST['globalrec-form-waw-country'] );
	$wpg_members_type = $_POST['members_list'];
	$wpg_scope = $_POST['scope_list'];
	
	echo 'wpg_members_type array is: ';
	print_r($wpg_members_type);
	print_r($wpg_scope);
	echo ' .<br>';
	
	// check that all required fields were filled
	$fields = array(
		//'title' => $wpg_name, TODO how to chack name exists and not include it in this array (used for custom field inserts)
		'_wpg_email' => $wpg_mail,
		'_wpg_members_type' => $wpg_members_type[0],//TODO be able to check more than one option
		'_wpg_organization_scope' => $wpg_scope[0],//TODO be able to check more than one option
		'city' => $city,
		'country' => $country,
		'_wpg_language' => $wpg_badge,
		'_wpg_website' => $wpg_material,
	);
	
	foreach ( $fields as $name => $field ) {
		echo $name.' is: '. $field. '<br>';
		if ( $field == '' ) {
			echo $error;
			echo 'alguno vacio'. $field;
			globalrec_waw_form();
			return;
		}
	}
	// checking if image file have the right format and size
	if ( array_key_exists('globalrec-form-waw-avatar', $_FILES) ) {
		$file = $_FILES['globalrec-form-waw-avatar'];
		if ( $file['name'] != '' ) {
			$finfo = new finfo(FILEINFO_MIME_TYPE);
			$mime = $finfo->file($file['tmp_name']);
			if ( $mime == 'image/png' || $mime == 'image/jpg' || $mime == 'image/jpeg' || $mime == 'image/gif' ) {}
			else {
				echo $error;
				globalrec_waw_form();
				return;
			}
			if ( $file['size'] > '4000000' ) {
				echo $error;
				globalrec_waw_form();
				return;
			}
		} // if filename is not empty
	} // if file has been uploaded

	// end checking

	// if everything ok, do insert

	// insert waste picker group
	$wpg_id = wp_insert_post(array(
		'post_type' => 'waste-picker-org',
		'post_status' => 'draft',
		'post_author' => 1,
		'post_title' => $wpg_name,
	));

	if ( $wpg_id == 0 ) {
		echo $error;
		globalrec_waw_form();
		return;
	}

	// insert custom fields
	reset($fields);
	while ( $field = current($fields) ) {//do not use current, becasue it is the title, and it is not a custom field
		add_post_meta($wpg_id, key($fields), $field, TRUE);
		next($fields);
	}

	wp_redirect( $location );

} // end insert wpg data in database

//Translate title in header
function wpml_custom_wp_title( $title, $sep ) {
  global $paged, $page;

  if( function_exists( 'icl_translate') ) {
      $title = icl_translate('wpml_custom', 'wpml_custom_' . sanitize_key($title), $title);
  }
  return $title;
}
add_filter( 'wp_title', 'wpml_custom_wp_title', 10, 2 );

//Removes duplicated custom taxonomy metaboxes  from side column (they are already included as custom meta boxes in the main column) in waste-picker-org admin edit panel
add_action('admin_menu', 'edit_meta_box');

function edit_meta_box(){
	$values = array(
		'wpg-languagediv',
		'wpg-member-typediv',
		'wpg-scopediv',
		'wpg-organization-typediv',
		'wpg-member-occupationdiv',
		'wpg-workplace-membersdiv',
		'wpg-membershipdiv',
		'wpg-education-trainingdiv',
		'wpg-affiliationsdiv',
		'wpg-fundingdiv',
		'wpg-member-benefitsdiv',
		'wpg-safety-technologydiv',
		'wpg-municipality-howdiv',
		'wpg-municipality-whatdiv',
		'wpg-material-typediv',
		'wpg-activitiesdiv',
		'wpg-sorting-spacesdiv',
		'wpg-treatment-organic-materialsdiv',
		'wpg-challenges-access-wastediv',
		'wpg-statusdiv',
	);
	foreach ( $values as $value) {
		remove_meta_box( $value, 'waste-picker-org', 'side' );
	}
	//removes more unnecesary metaboxes in admin panel
	remove_meta_box( 'postexcerpt', 'waste-picker-org', 'main' );
	remove_meta_box( 'postcustom', 'waste-picker-org', 'main' );
   // add_meta_box('postimagediv', __('Featured Image'), 'post_thumbnail_meta_box', 'waste-picker-org', 'normal', 'high');
}
