<?php
// theme global vars
if (!defined('GLOBALREC_VER'))
    define('GLOBALREC_VER', '0.1'); // must be updated in style.css header to

$prefix_wpo = 'wpg-';
$prefixwpg = '_wpg_';

//setup globalrec theme
if ( ! function_exists( 'globalrec_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 * @since Twenty Fifteen 1.0
 */
function globalrec_setup() {

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	//adds excerpt to global meeting post type
	add_post_type_support( 'global-meeting', 'excerpt' );

	//adds featured image to 'post', 'page','bio','global-meeting','waste-picker-org'
//	add_theme_support( 'post-thumbnails' ); //to make http://codex.wordpress.org/Function_Reference/has_post_thumbnail work
	add_theme_support( 'post-thumbnails', array( 'post', 'page','bio','global-meeting','waste-picker-org' ) );

	//add posts formats
	add_theme_support( 'post-formats', array( 'aside', 'gallery', 'video', 'audio', 'image' ) );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	register_nav_menus( array(
		'main-menu' => 'Main Menu',
		'home-menu' => 'Home Menu',
		'foot_menu' => 'Footer Menu'
	) );

}
endif; // globlalrec_setup

add_action( 'after_setup_theme', 'globalrec_setup' );

//Translate title in header
function wpml_custom_wp_title( $title, $sep ) {
	global $paged, $page;

	if( function_exists( 'icl_translate') ) {
		$title = icl_translate('wpml_custom', 'wpml_custom_' . sanitize_key($title), $title);
	}
	return $title;
}
add_filter( 'wp_title', 'wpml_custom_wp_title', 10, 2 );

/**
 * Enqueue scripts and styles.
 */
function globalrec_scripts() {
	wp_enqueue_style( 'globalrec-fonts', get_template_directory_uri().'/fonts/style.css',false,GLOBALREC_VER );
	wp_enqueue_style( 'bootstrap-css', get_template_directory_uri().'/css/bootstrap.min.css',array('dashicons'),'3.3.6' );
	wp_enqueue_style( 'globalrec-css', get_stylesheet_uri(),array('bootstrap-css'),GLOBALREC_VER );

	wp_dequeue_script('jquery');
	wp_dequeue_script('jquery-core');
	wp_dequeue_script('jquery-migrate');
	wp_enqueue_script('jquery', false, array(), false, true);
	wp_enqueue_script('jquery-core', false, array(), false, true);
	wp_enqueue_script('jquery-migrate', false, array(), false, true);
	wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '3.3.6', true );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'globalrec_scripts' );

// load scripts for IE compatibility
function globalrec_extra_scripts_styles() {
	echo "
	<meta name='viewport' content='width=device-width, initial-scale=1'>
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src='https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js'></script>
	<script src='https://oss.maxcdn.com/respond/1.4.2/respond.min.js'></script>
	<![endif]-->
	";
}
/* Load scripts for IE compatibility */
add_action('wp_head','globalrec_extra_scripts_styles',999);

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
	'capability_type' => 'page'
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
	'capability_type' => 'page'
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
	'capability_type' => 'page'
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
	'capability_type' => 'wpo',
	'capabilities' => array(
		'publish_posts' => 'publish_wpos',
		'edit_posts' => 'edit_wpos',
		'edit_others_posts' => 'edit_others_wpos',
		'delete_posts' => 'delete_wpos',
		'delete_others_posts' => 'delete_others_wpos',
		'read_private_posts' => 'read_private_wpos',
		'edit_post' => 'edit_wpo',
		'delete_post' => 'delete_wpo',
		'read_post' => 'read_wpo',
	),
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
	'capability_type' => 'page'
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
	'capability_type' => 'page'
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
	'capability_type' => 'page'
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
	'capability_type' => 'page'
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
	'capability_type' => 'page'
	)
);
flush_rewrite_rules( false );
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
register_taxonomy( 'law-type', 'law-report', array(
	'hierarchical' => true,
	'label' => 'Type',
	'query_var' => true,
	'rewrite' => array( 'slug' => 'law-type' ) ) );
}

//create multiple taxonomies for waste picker organizations
add_action( 'init', 'build_wpo_taxonomies', 0 );

function build_wpo_taxonomies() {

global $prefix_wpo;

$wpoTaxonomies = array(
	$prefix_wpo . 'language' => 'Language',
	$prefix_wpo . 'member-type' => 'Member type',
	$prefix_wpo . 'scope' => 'Organizational Reach',
	$prefix_wpo . 'organization-type' => 'Type',
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

/* Map wpo post type capabilities */
add_filter( 'map_meta_cap', 'globalrec_map_meta_cap', 10, 4 );
function globalrec_map_meta_cap( $caps, $cap, $user_id, $args ) {

	/* If editing, deleting, or reading a wpo, get the post and post type object. */
	if ( 'edit_wpo' == $cap || 'delete_wpo' == $cap || 'read_wpo' == $cap ) {
		$post = get_post( $args[0] );
		$post_type = get_post_type_object( $post->post_type );
		/* Set an empty array for the caps. */
		$caps = array();
	}

	/* If editing a wpo, assign the required capability. */
	if ( 'edit_wpo' == $cap ) {
		if ( $user_id == $post->post_author )
			$caps[] = $post_type->cap->edit_posts;
		else
			$caps[] = $post_type->cap->edit_others_posts;
	}

	/* If deleting a wpo, assign the required capability. */
	elseif ( 'delete_wpo' == $cap ) {
		if ( $user_id == $post->post_author )
			$caps[] = $post_type->cap->delete_posts;
		else
			$caps[] = $post_type->cap->delete_others_posts;
	}

	/* If reading a private wpo, assign the required capability. */
	elseif ( 'read_wpo' == $cap ) {
		if ( 'private' != $post->post_status )
			$caps[] = 'read';
		elseif ( $user_id == $post->post_author )
			$caps[] = 'read';
		else
			$caps[] = $post_type->cap->read_private_posts;
	}

	/* Return the capabilities required by the user. */
	return $caps;
}

/*
 * ADD CUSTOM ROLES
 * Waste Picker Organizer role
 * on theme activation
 *
 * and
 *
 * REMOVE CUSTOM ROLES
 * on theme deactivation
 */
//add_action('init', 'globalrec_add_custom_roles');
add_action('after_switch_theme', 'globalrec_add_custom_roles');
function globalrec_add_custom_roles() {
	$wpo_caps = array(
		'publish_wpos' => false,
		'edit_wpos' => true,
		'edit_others_wpos' => false,
		'delete_wpos' => true,
		'delete_others_wpos' => false,
		'read_private_wpos' => true,
		'edit_wpo' => true,
		'delete_wpo' => true,
		'read_wpo' => true,
		// more standard capabilities here
		'read' => true,
		'edit_posts' => true,
		'delete_posts' => true,

	);
	$wpo = add_role( 'globalrec_wpo','Waste Picker Organizer',$wpo_caps);

	if ( null !== $wpo ) { return; }
	else {
		remove_role('globalrec_wpo');
		$wpo = add_role( 'globalrec_wpo','Waste Picker Organizer',$wpo_caps);
	}
}
add_action('switch_theme', 'globalrec_remove_custom_roles');
function globalrec_remove_custom_roles() {
	remove_role('globalrec_wpo');
}

/*
 * ADD EXTRA CAPABILITIES
 * to roles
 * on theme activation
 *
 * and
 *
 * REMOVE EXTRA CAPABILITIES
 * on theme deactivation
 */
$roles_to_change = array('administrator','editor');
$capabilities_to_add = array('publish_wpos','edit_wpos','edit_others_wpos','delete_wpos','delete_others_wpos','read_private_wpos','edit_wpo','delete_wpo','read_wpo');
add_action( 'after_switch_theme', 'globalrec_add_caps_to_roles', 10 );
function globalrec_add_caps_to_roles() {
	global $wp_roles;
	global $roles_to_change;
	global $capabilities_to_add;
	foreach ( $roles_to_change as $r ) {
		get_role( $r );
		foreach ( $capabilities_to_add as $c ) {
			$wp_roles->role_objects[$r]->add_cap( $c );
		}
	}
}
add_action( 'switch_theme', 'globalrec_remove_caps_to_roles', 10 );
function globalrec_remove_caps_to_roles() {
	global $wp_roles;
	global $roles_to_change;
	global $capabilities_to_add;
	foreach ( $roles_to_change as $r ) {
		get_role( $r );
		// Could use the get_role() wrapper here since this function is never
		// called as a one off.  It is always called to alter the role as
		// stored in the DB.
		$wp_roles->role_objects[ $r ]->remove_cap( $c );
	}
}

/*
 * ADD ALL USERS TO THE AUTHOR SELECT FIELD
 * in both quick edit and single edit pages
 *
 * by default WordPress outputs admins, editors and authors.
 * now contributors and other custom roles are also shown
 *
 * http://wordpress.stackexchange.com/questions/50827/select-subscriber-as-author-of-post-in-admin-panel
 */
add_filter('wp_dropdown_users', 'globalrec_dropdown_users');
function globalrec_dropdown_users($output) {

	global $post;
	$users = get_users();

	$output = "<select id='post_author_override' name='post_author_override' class=''>";

	foreach($users as $user) {
		$sel = ($post->post_author == $user->ID)?"selected='selected'":'';
		$output .= '<option value="'.$user->ID.'"'.$sel.'>'.$user->user_login.'</option>';
	}
	$output .= "</select>";

	return $output;
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
	$posts = get_posts( array(
		'posts_per_page' => -1,
		'post_type' => 'waste-picker-org',
		'orderby' => 'title',
		'order' => 'ASC',
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
		'id' => 'bio-waste-picker-country',
		'title' => 'Waste Picker Country',
		'pages' => array('bio'), // post type
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(
			array(
				'name' => 'Country',
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
		'title' => 'Post written by someone else different from the user in GlobalRec',
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
				'name' => 'Feed/RSS of the organization',
				'desc' => 'ex: http://globalrec.org/feed',
				'id' => $prefixwpg . 'rss',
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
				'name' => 'Street Name',
				'desc' => 'ex: ',
				'id' => $prefixwpg . 'street_name',
				'type' => 'text_medium',
			),
			array(
				'name' => 'Street Number',
				'desc' => 'ex: ',
				'id' => $prefixwpg . 'street_number',
				'type' => 'text_medium',
			),
			array(
				'name' => 'Postal Code',
				'desc' => 'ex: ',
				'id' => $prefixwpg . 'postal_code',
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
				'desc' => 'Select if the organization is<br><strong>Members are multi sector</strong>: if waste pickers and other workers in the informal economy are part of the same organization.<br>
									<strong>Members are waste picker organizations</strong>: if the organization comprises several waste pickers groups<br>
									<strong>Members are waste pickers</strong>: if the organization is formed exclusively or mostly by waste pickers<br>
									<strong>Members employ waste pickers</strong>: if waste pickers are paid by members of the organization to work for them<br>
									<strong>Potential supporters</strong>: an organization that could potentially work with or support the activity of waste pickers<br>
									<strong>Waste picker Support organization</strong>: an organization that is working to support waste pickers’ livelihoods<br>',
				'id' => $prefix_wpo . 'member-type',
				'taxonomy' => $prefix_wpo . 'member-type',
				'type' => 'taxonomy_multicheck',
			),
			array(
				'name' => 'Occupation of Members',
				'desc' => '<strong>Itinerant buyers</strong>: collect recyclables in exchange for payment or barter, generally using vehicles into fixed routes<br>
<strong>Itinerant workers</strong>: work is temporary, not all year round or it is not their main activity or source of income<br>
<strong>Scrap dealers</strong>: buy scrap to sell for profit<br>
<strong>Solid Waste managers</strong>:
in charge of waste prevention, collection, disposal (among other) activities<br>
<strong>Street Sweepers</strong>: cleans the streets<br>
<strong>Waste collectors</strong>: collect waste as main activity (sorting or selling materials is not their primary activity)<br>
<strong>Waste pickers</strong>: collect, sort, sell and recover materials that someone else has thrown away. (e.g of names: <em>rag picker, reclaimer, binner, informal recycler, poacher, salvager, scavenger</em>)',
				'id' => $prefix_wpo . 'member-occupation',
				'taxonomy' => $prefix_wpo . 'member-occupation',
				'type' => 'taxonomy_multicheck',
			),
			array(
				'name' => __('Organization Type'),
				'desc' => 'Select one type or more depending on your organization.',
				'id' => $prefix_wpo . 'organization-type',
				'taxonomy' => $prefix_wpo . 'organization-type',
				'type' => 'taxonomy_multicheck',
			),
			array(
				'name' => __('Organization Reach'),
				'desc' => 'Select where the organization has members.',
				'id' => $prefix_wpo . 'scope',
				'taxonomy' => $prefix_wpo . 'scope',
				'type' => 'taxonomy_multicheck',
			),
			array(
				'name' => 'Workplace of Members',
				'desc' => 'Select the main sites where members work.',
				'id' => $prefix_wpo . 'workplace-members',
				'taxonomy' => $prefix_wpo . 'workplace-members',
				'type' => 'taxonomy_multicheck',
			),
			array(
				'name' => 'Membership',
				'desc' => 'Select yes if they are paying a membership fee or have another kind of affiliation in order to become a member of the organization.',
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
				'desc' => 'Indicate the number of women in the organization.',
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
				'desc' => 'Describe how the organization is organized/structured (e.g: if has president).',
				'id' => $prefixwpg . 'structure',
				'type' => 'textarea',
			),
			array(
				'name' => 'Objectives',
				'desc' => '',
				'id' => $prefixwpg . 'objectives',
				'type' => 'textarea',
			),
			array(
				'name' => 'Education and training',
				'desc' => 'Select one or more activities the organization is involved in.',
				'id' => $prefixwpg . 'education_training',
				'taxonomy' => $prefix_wpo . 'education-training',
				'type' => 'taxonomy_multicheck',
			),
			array(
				'name' => 'Formally registered',
				'desc' => 'Select if the organization is officially registered and has legal status.',
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
				'desc' => 'Input the names of the organizations you currently have a partnership with separated by commas.',
				'id' => $prefixwpg . 'partnering_organizations',
				'type' => 'text_small',
			),
			array(
				'name' => 'Affiliations',
				'desc' => 'Select one or more type of organization you are affiliated to.',
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
				'desc' => 'Add the number of people that are members of  your organizations’ credit or savings scheme. Ex: "125"',
				'id' => $prefixwpg . 'credit_members',
				'type' => 'text_small',
			),
			array(
				'name' => 'Safety & Technology',
				'desc' => 'Select one or more items of equipment used by your members.',
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
				'desc' => 'Select the one that is more frequent / likely to happen.',
				'id' => $prefix_wpo . 'municipality-how',
				'taxonomy' => $prefix_wpo . 'municipality-how',
				'type' => 'taxonomy_multicheck',
			),
			array(
				'name' => 'What kind of relationship exists with the municipality?',
				'desc' => 'Select the one according to your situation.',
				'id' => $prefix_wpo . 'municipality-what',
				'taxonomy' => $prefix_wpo . 'municipality-what',
				'type' => 'taxonomy_multicheck'
			),
			array(
				'name' => 'Types of materials collected',
				'desc' => 'Select all the materials your organization collects.',
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
				'desc' => 'Select all the activities your organization does.',
				'id' => $prefix_wpo . 'activities',
				'taxonomy' => $prefix_wpo . 'activities',
				'type' => 'taxonomy_multicheck',
			),
			array(
				'name' => 'Sorting spaces',
				'desc' => 'Select if your organization has any. Sorting workshop: A space used to sort recyclables and new items are made from materials collected. Sorting center: a space where materials collected are sorted by type, stored and sold on.',
				'id' => $prefix_wpo  . 'sorting-spaces',
				'taxonomy' => $prefix_wpo . 'sorting-spaces',
				'type' => 'taxonomy_multicheck',
			),
			array(
				'name' => 'Treatment of organic materials',
				'desc' => 'Select all the ones your organization is involved in.',
				'id' => $prefix_wpo . 'treatment-organic-materials',
				'taxonomy' => $prefix_wpo . 'treatment-organic-materials',
				'type' => 'taxonomy_multicheck',
			),
			array(
				'name' => 'Challenges to access waste',
				'desc' => 'Select all the challenges your organization faces.',
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
	//$countries = ''; TODO test if define variable outside works
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
	
	//Custom field to select a City for a Waste Picker Group
	$posts = query_posts( array(
		'posts_per_page' => -1,
		'post_type' => 'city',
		'orderby' => 'title',
		'order' => 'ASC',
		));
	
	$cities = array();
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
				'desc' => 'Select the city where the waste picker group operates. If more than one (e.g. a national based organization), select the city of their main headquarters or office.',
				'id' => $prefixwpg . 'cityselect', //"cityselect" because "city" is alread used
				'type' => 'select',
				'options' =>  $cities, //one to many relationship. One waste picker group contains multiple members (bios)
				'default' => '-',
			),
		),
	);
	wp_reset_query();
	//Custom field to select a Country for a Waste Picker Group
	$posts = query_posts( array( //TODO the dropdown list in dashboard when selecting a country: items are cuadruplicated (the four languages)
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
		'id' => 'waste-picker-country',
		'title' => 'Waste Picker Group Country',
		'pages' => array('waste-picker-org'), // post type
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(
			array(
				'name' => 'Waste Picker Group Country',
				'desc' => 'Select the country where the waste picker group operates. If more than one (e.g. an international organization), select the country of their main headquarters or office.',
				'id' => $prefixwpg . 'countryselect', //"countryselect" beacuse "country" is alread used
				'type' => 'select',
				'options' =>  $countries //one to many relationship. One waste picker group contains multiple members (bios)
			),
		),
	);
	wp_reset_query();
	
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


function languages_list(){
	if ( function_exists ( 'icl_get_languages' ) ) { //check if fuction rom wpml exists
    $languages = icl_get_languages('skip_missing=0');
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
}

//Creates functions to work if WPML is not active
function icl_link_to_element_check($id,$type){
	if ( function_exists ( 'icl_link_to_element' ) ) { //check if fuction rom wpml exists
		icl_link_to_element( $id , $type );
	} else {
		//TODO insert element title with link
		echo get_cat_name( $id  );
	}
}
function icl_object_id_check($id,$type){
	if ( function_exists ( 'icl_object_id' ) ) { //check if fuction rom wpml exists
		return icl_object_id( $id , $type, true );
	} else {
		return $id;
	}
}

// Function to list values of custom metaboxes with multiple values (multicheck). Used in Waste Picker Group list and single
function list_of_items($postid=1,$value=1,$name=1){
	$items = get_post_meta($postid,$value,true);
	if ($items!='') {
		echo "<dt>".$name."</dt>";
		echo "<dd>";
		foreach($items as $item) {
			echo  $item == 'ngo' ? 'NGO' : ucfirst($item);
			echo "<br>";
		}
		echo "</dd>";
	}
}
add_action( 'wp', 'list_of_items' );

// Function to list taxonomy terms of Waste Picker Organization in dt-dd format
function list_taxonomy_terms($post_id=0,$slug='',$name='') {
	$term_list = wp_get_post_terms($post_id, $slug, array("fields" => "all"));
	if (!empty($term_list)) { //checks in the array is not empty
		foreach ( $term_list as $key => $item) {
			$term_name = $item->name;
			$term_slug = $item->slug;
			if ( $key == 0) { //for the first item
				echo "<dt>" .$name. "</dt>";
				echo "<dd>";
			} else { //if there is more than one item adds a comma to separate items
				echo ", ";
			}
			echo "<a href='/".$slug."/".$term_slug."' title='".$term_name."'>".ucfirst($term_name)."</a>";
		}
		echo "</dd>";
	}
}

//Function to list single values and uppercase firt letter. Used in Waste Picker Group single
function display_item($postid=1,$value=1,$name=1){
	$item = get_post_meta($postid,$value,true);
	if ($item!='') {
		echo "<dt>".$name."</dt><dd>".ucfirst($item)."</dd>";
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
					'tax_query' => array(
						array(
							'taxonomy' => 'wpg-member-type',
							'field'    => 'slug',
							'terms'    => array('waste picker support organization','potential supporters'),
							'operator' => 'NOT IN',
						),
					),
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

	//Stores terms for language taxonomy
	$language_terms = get_terms( 'wpg-language' );
	$member_type_terms = get_terms( 'wpg-member-type' );
	$scope_terms = get_terms( 'wpg-scope' );
	
	//Creates array
	foreach ($language_terms as $key) {
		$languages[$key->name] = $key->name;
	}
	foreach ($member_type_terms as $key) {
		$member_types[$key->name] = $key->name;
	}
	foreach ($scope_terms as $key) {
		$scopes[$key->name] = $key->name;
	}
	$scopes= array_merge(array_flip(array('local','regional','national')), $scopes);
	
	//Creates options for multicheck in html
	$options_languages = "";
	while ( $language = current($languages) ) {
		$options_languages .= "<div class='checkbox'><label><input type='checkbox' name='language_list[]' value='" .key($languages). "'>" .ucfirst(key($languages)). "</label></div>";
		next($languages);
	}
	
	$options_member_types = "";
	while ( $member_type = current($member_types) ) {
		$options_member_types .= "<div class='checkbox'><label><input type='checkbox' name='members_list[]'' value='" .key($member_types). "'>" .ucfirst(key($member_types)). "</label></div>";
		next($member_types);
	}
	
	$options_scopes = "";
	while ( $scope = current($scopes) ) {
		$options_scopes .= "<div class='checkbox'><label><input type='checkbox' name='scopes_list[]'' value='" .key($scopes). "'>" .ucfirst(key($scopes)). "</label></div>";
		next($scopes);
	}
	
	$form_out = "
	<h2>". __('Submit information about your organization','globalrec') ."</h2>
<form id='globalrec-form-content' method='post' action='" .$action. "' enctype='multipart/form-data'>
<div class='row'>
	<div class='form-horizontal col-md-10'>
		<legend>". __('Contact information','globalrec') ."</legend>
		<div class='form-group'>
			<label for='globalrec-form-waw-name' class='col-sm-4 control-label'>". __('Name of Organization','globalrec') ."</label>
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
			<label for='globalrec-form-waw-telephone' class='col-sm-4 control-label'>". __('Telephone','globalrec') ."</label>
			<div class='col-sm-6'>
	 			<input class='form-control req' type='text' value='' name='globalrec-form-waw-telephone' />
				<p class='help-block'><small>". __('Please write it with the country code','globalrec') ."</small></p>
			</div>
		</div>
		<div class='form-group'>
			<label for='globalrec-form-waw-city' class='col-sm-4 control-label'>". __('City','globalrec') ."</label>
			<div class='col-sm-6'>
	 			<input class='form-control req' type='text' value='' name='globalrec-form-waw-city' />
				<p class='help-block'><small>". __('City were the organization belongs to','globalrec') ."</small></p>
			</div>
		</div>
		<div class='form-group'>
			<label for='globalrec-form-waw-country' class='col-sm-4 control-label'>". __('Country','globalrec') ."</label>
			<div class='col-sm-6'>
	 			<input class='form-control req' type='text' value='' name='globalrec-form-waw-country' />
				<p class='help-block'><small>". __('Country were the organization belongs to','globalrec') ."</small></p>
			</div>
		</div>
		<div class='form-group'>
			<label for='globalrec-form-waw-website' class='col-sm-4 control-label'>". __('Website','globalrec') ."</label>
			<div class='col-sm-6'>
				<input class='form-control req' type='text' value='' name='globalrec-form-waw-website' />
				<p class='help-block'><small>". __('URL of the organizations website. Ex: http://globalrec.org','globalrec') ."</small></p>
			</div>
		</div>
		<div class='form-group'>
			<label class='col-sm-4 control-label'>". __('Language','globalrec') ."</label>
			<div class='col-sm-6'>
				" .$options_languages. "
			</div>
		</div>
		<!--<div class='form-group'>
			<label for='globalrec-form-waw-avatar' class='col-sm-4 control-label'>". __('Image or Logo','globalrec') ."</label>
			<div class='col-sm-6'>
				<input type='file' name='globalrec-form-waw-avatar' />
				<input type='hidden' name='MAX_FILE_SIZE' value='4000000' />
			<p class='help-block'><small>". __('Image or logotype of the organization. Not bigger than<strong> 4MB</strong> and <strong>must be JPG, PNG or GIF</strong>.','globalrec') ."</small></p>
			</div>
		</div>-->

		<legend>". __('Primary Information','globalrec') ."</legend>
		<div class='form-group'>
			<label class='col-sm-4 control-label'>". __('Type of members','globalrec') ."</label>
			<div class='col-sm-6'>
				" .$options_member_types. "
			</div>
		</div>
		<div class='form-group'>
			<label class='col-sm-4 control-label'>". __('Organizational Reach','globalrec') ."</label>
			<div class='col-sm-6'>
				". $options_scopes ."
			</div>
		</div>
		<div class='form-group'>
			<label for='globalrec-form-waw-comments' class='col-sm-4 control-label'>". __('Comments','globalrec') ."</label>
			<div class='col-sm-6'>
				<textarea class='form-control' name='globalrec-form-waw-comments' rows='3'></textarea>
			</div>
		</div>
		<div class='form-group'>
		  <div class='col-sm-offset-4 col-sm-6'>
		  	<input class='btn btn-default' type='submit' value='". __('Send','globalrec') ."' name='globalrec-form-waw-submit' />
				<span class='help-block'><small><strong>". __('All fields are required. Do not leave them empty!','globalrec') ."</strong></small></span>
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
	$location_form = $perma."?form=success";
	$error = "<div class='alert alert-danger'>
		<p>One or more fields were empty or did not have a correct format. Please try again.</p>
		<p>Uno o varios campos están vacíos o no tienen un formato válido.</p>
		<p>En cualquier caso el formulario no se envió correctamente. Por favor, inténtalo de nuevo.</p>
	</div>";
	$success = "<div class='alert alert-success'>
		<p>Your form has been sent correctly: we havereceived your data. We'll get in contact with you for further steps before publication in the WAW database. Thanks!</p>
		<p>El formulario ha sido enviado correctamente: hemos recibido tus datos. Vamos a revisarlos y nos pondremos en contacto con el email que nos has proporcionado. Gracias.</p>
		</div>";

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
	$wpg_telephone = sanitize_text_field( $_POST['globalrec-form-waw-telephone'] );
	$wpg_website = sanitize_text_field( $_POST['globalrec-form-waw-website'] );
	$city = sanitize_text_field( $_POST['globalrec-form-waw-city'] );
	$country = sanitize_text_field( $_POST['globalrec-form-waw-country'] );
	//terms
	$wpg_language = $_POST['language_list'];
	$wpg_members_type = $_POST['members_list'];
	$wpg_scope = $_POST['scopes_list'];
	$wpg_comments = sanitize_text_field( $_POST['globalrec-form-waw-comments'] );
	
	// check that all required fields were filled
	$fields = array(
		//'title' => $wpg_name, TODO how to check name exists and not include it in this array (used for custom field inserts)
		'_wpg_email' => $wpg_mail,
		'_wpg_phone1' => $wpg_telephone,
		'city' => $city,
		'country' => $country,
		//'_wpg_website' => $wpg_website, Website doesn-t need to be obligatory
	);
	
	$terms = array(
		'wpg-language' => $wpg_language,
		'wpg-member-type' => $wpg_members_type,
		'wpg-scope' => $wpg_scope,
	);
	
	foreach ( $fields as $name => $field ) {
		echo $name.' is: '. $field. '<br>';
		if ( $field == '' ) {
			echo $error;
			echo 'Por lo menos un campo está vacio. // At least one field is empty: '. $name. $field;
			globalrec_waw_form();
			return;
		}
	}
	// end checking

	// if everything ok, do insert

	// insert waste picker group
	$wpg_id = wp_insert_post(array(
		'post_type' => 'waste-picker-org',
		'post_status' => 'draft',
		'post_author' => 1,
		'post_title' => $wpg_name,
		'post_content' => $wpg_comments,
	));

	if ( $wpg_id == 0 ) {
		echo $error;
		globalrec_waw_form();
		return;
	}

	// insert custom fields
	reset($fields);
	while ( $field = current($fields) ) {//TODO do not use current, becasue it is the title, and it is not a custom field
		add_post_meta($wpg_id, key($fields), $field, TRUE);
		next($fields);
	}
	
	//echo "the id is " .$wpg_id. ".<br>";
	
	// insert taxonomies
	foreach ( $terms as $key => $value ) {
		//echo "insert: ".$value." in" . $key .".<br>";
		wp_set_object_terms( $wpg_id, $value, $key);
	}
	
	wp_redirect( $location_form );
	exit;

} // end insert wpg data in database

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

//Creates array that counts number of taxonomy terms for unique terms!
function count_tax_array($the_array) {
	foreach ($the_array as $key => $value) { //Flattens array
		$the_array_clean[$key] = isset($value[0]->name) ? $value[0]->name : "not known"; //prevents from crashing when value is empty
	}
	$the_array_count = array_count_values($the_array_clean); //counts values of organizations with the same organization type
	unset($the_array);
	$the_array = $the_array_count;
	arsort($the_array);
	return $the_array;
}

//Creates array that counts number of taxonomy terms for multiple terms, like types of materials collected
function count_multiterm_tax_array($the_array) {
	$j = 0;
	$the_array_clean = [];
	foreach ($the_array as $key => $value) {
		if ( empty($the_array[$key]) ) {//if the item is empty
			//do nothing
		} else { //the item is not empty
			$number_items = count($the_array[$key]);
			for ($i = 0; $i < $number_items; $i++) {
				$number_items = count($the_array[$key]);
				$the_array_clean[$j] = $the_array[$key][$i]->name;
				$j = $j + 1;
			}
		}
	}
	$the_array_count = array_count_values($the_array_clean); //counts values of organizations with the same organization type
	unset($the_array);
	$the_array = $the_array_count;
	arsort($the_array);
	return $the_array;
}

//Hooks archive.php to display unlimited waste picker organizations in taxonomy term pages
add_action( 'pre_get_posts', 'be_change_event_posts_per_page' );
function be_change_event_posts_per_page( $query ) {
$prefix_wpo = 'wpg-';
$waw_taxonomies = array( //TODO deduplicate from archive.php
	$prefix_wpo . 'language',
	$prefix_wpo . 'member-type',
	$prefix_wpo . 'scope',
	$prefix_wpo . 'organization-type',
	$prefix_wpo . 'member-occupation',
	$prefix_wpo . 'workplace-members',
	$prefix_wpo . 'membership',
	$prefix_wpo . 'education-training',
	$prefix_wpo . 'affiliations',
	$prefix_wpo . 'funding',
	$prefix_wpo . 'member-benefits',
	$prefix_wpo . 'safety-technology',
	$prefix_wpo . 'municipality-how',
	$prefix_wpo . 'municipality-what',
	$prefix_wpo . 'material-type',
	$prefix_wpo . 'activities',
	$prefix_wpo . 'sorting-spaces',
	$prefix_wpo . 'treatment-organic-materials',
	$prefix_wpo . 'challenges-access-waste',
	$prefix_wpo . 'status',
	);
	if (is_tax($waw_taxonomies)) {//TODO change if new taxonomies are created for the standard post
		if( $query->is_main_query() && $query->is_archive() ) {
			$query->set( 'posts_per_page', '-1' );
			$query->set( 'orderby', 'title' );
			$query->set( 'order', 'ASC' );
		}
	}
}

// Countries in continents for filtering organizations in the WAW database
$asia = array('india','indonesia','philippines');
$africa = array('South Africa','Ghana','Ghana','Mali','Kenya','Uganda','Cameroon','Senegal', 'Democratic Republic of Congo','Benin');
$europe = array('France','Spain','Germany','Serbia','Italy');
$latinamerica = array('brazil','colombia','peru','argentina', 'chile','Nicaragua','Ecuador', 'Bolivia','Mexico','Uruguay','Paraguay','Venezuela', 'Panama','Honduras','Costa Rica','Dominican Republic');
$northamerica = array('Canada','USA','United States of America');
$all = array_merge($asia , $africa, $europe , $latinamerica , $northamerica );

//Adds table of translated posts. Used in page-newsletter-creation.php
function translated_post_table ($title,$array) {
	$result = "<tr><td><h4>".$title."</h4></td><td></td><td></td><td></td></tr>";
	foreach ($array as $key => $value ) {
		$idValue = $value->ID;
		//gets id of articles in each language
		$id_en = icl_object_id($idValue, 'post', false, 'en');
		$id_es = icl_object_id($idValue, 'post', false, 'es');
		$id_pt= icl_object_id($idValue, 'post', false, 'pt-br');
		$id_fr = icl_object_id($idValue, 'post', false, 'fr');
		//gets summaries of articles in each lenguage
		$summary_en = get_post_meta( $id_en , '_gr_post-summary', true );
		$summary_es = get_post_meta( $id_es , '_gr_post-summary', true );
		$summary_pt = get_post_meta( $id_pt , '_gr_post-summary', true );
		$summary_fr = get_post_meta( $id_fr , '_gr_post-summary', true );
		$tick = "";

			if (!empty($summary_en) || !empty($summary_es) || !empty($summary_pt) || !empty($summary_br)) { //checks if the summary of the article in each language is not empty
				$tick = ' <span class="glyphicon glyphicon-ok"></span>';
			}
		$result .= "<tr><td style='background-color:#FF0;'><a href='". $value->guid ."'>". $value->post_title . "</a>". $tick . " [" .get_post_status ( $idValue )  . "]" ."</td>";
		$tick = ""; //resets value of tick to nothing in case there is no summary for that article
		if (ICL_LANGUAGE_CODE == 'en') { } else {
			$result .= empty($id_en) ? "<td></td>" : "<td><a href='". get_permalink($id_en) ."'>". get_the_title( $id_en ) ."</a> <strong>[" . get_post_status ( $id_en )  ."]</strong></td>";}	
		if (ICL_LANGUAGE_CODE == 'es') { } else {
			$result .= empty($id_es) ? "<td></td>" : "<td><a href='". get_permalink($id_es) ."'>". get_the_title( $id_es ) ."</a> <strong>[" . get_post_status ( $id_es )  ."]</strong></td>";}
		if (ICL_LANGUAGE_CODE == 'pt-br') { } else {
			$result .= empty($id_pt) ? "<td></td>" : "<td><a href='". get_permalink($id_pt) ."'>". get_the_title( $id_pt ) ."</a> <strong>[" . get_post_status ( $id_pt )  ."]</strong></td>";}
		if (ICL_LANGUAGE_CODE == 'fr') { } else {
			$result .= empty($id_fr) ? "<td></td>" : "<td><a href='". get_permalink($id_fr) ."'>". get_the_title( $id_fr ) ."</a> <strong>[" . get_post_status ( $id_fr )  ."]</strong></td>";
		}
		$result .= "</tr>";
	}
	return $result;
}

// Remove WPML Widget from Wordpress dashboard
function wpml_remove_dashboard_widget() {
    remove_meta_box( 'icl_dashboard_widget', 'dashboard', 'side' );
}
add_action('wp_dashboard_setup', 'wpml_remove_dashboard_widget' );
