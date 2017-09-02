<?php
/**
 * _s functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package _s
 */

if ( ! function_exists( '_pawar2018_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function _pawar2018_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on _s, use a find and replace
	 * to change 'Pawar2018' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'Pawar2018', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	register_nav_menus( array(
	    'header-menu'   => __( 'Header Menu' ),
		'ndj-menu'   => __( 'NDJ Menu' ),
	    'footer-menu'   => __( 'Footer Menu' ),
	    'donate-button' => __( 'Donate Button' )
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( '_pawar2018_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	// Register string to be translated in admin UI
	if ( function_exists( 'pll_register_string' ) ) {
		pll_register_string( 'Events title', 'Events', 'Events');
		pll_register_string( 'Events CTA title', "Let's Talk", 'Events');
		pll_register_string( 'Events CTA text', 'Looking to host an event?', 'Events');
		pll_register_string( 'Events CTA button', 'Contact Us', 'Events');
		pll_register_string( 'Events CTA URL', '/get-involved', 'Events');
		pll_register_string( 'Eventbrite date format', 'l, F d \a\t g:i a', 'Events');
		pll_register_string( 'Signup title', 'Newsletter', 'Footer');
		pll_register_string( 'Signup text', 'Stay in the loop.', 'Footer');
		pll_register_string( 'Signup button', 'Subscribe', 'Footer');
		pll_register_string( 'Signup URL', '/newsletter', 'Footer');
		pll_register_string( 'Organization', 'Ameya Pawar for Governor', 'Footer');
		pll_register_string( 'Disclaimer', 'Paid For By Ameya Pawar For Governor.', 'Footer');
	}
}
endif;
add_action( 'after_setup_theme', '_pawar2018_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function _pawar2018_content_width() {
	$GLOBALS['content_width'] = apply_filters( '_pawar2018_content_width', 640 );
}
add_action( 'after_setup_theme', '_pawar2018_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function _pawar2018_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Index Sidebar', 'Pawar2018' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'Pawar2018' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Post Sidebar', 'Pawar2018' ),
		'id'            => 'sidebar-2',
		'description'   => esc_html__( 'Add widgets here.', 'Pawar2018' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
}
add_action( 'widgets_init', '_pawar2018_widgets_init' );

/**
 * Enqueue scripts and styles.
 */

function theme_scripts(){
  function add_defer_attribute($tag, $handle) {
      if ( '_pawar2018-script' !== $handle )
          return $tag;
      return str_replace( ' src', ' defer src', $tag );
  }

  add_filter('script_loader_tag', 'add_defer_attribute', 10, 2);
  wp_register_script('_pawar2018-script', get_template_directory_uri() . '/js/main.min.js', array(), rand(), true);
  wp_enqueue_script('_pawar2018-script');
  wp_enqueue_style('_pawar2018-style', get_stylesheet_uri(), array(), rand());
}

add_action( 'wp_enqueue_scripts', 'theme_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Header and footer menu customizations
 */
require get_template_directory() . '/inc/menus.php';

/*
 $new_role = add_role('event_team_lead',
            'Event Team Lead',
            array(
                'read' => true,
                'edit_posts' => false,
                'delete_posts' => false,
                'publish_posts' => false,
                'upload_files' => true,
            )
        );
		if ( null !== $new_role ) {
		    echo 'Yay! New role created!';
		}
		else {
		    echo 'Oh... the basic_contributor role already exists.';
		}

function pawar_add_role_caps() {
    // Add the roles you'd like to administer the custom post types
    $roles = array('event_team_lead','editor','administrator');
    // Loop through each role and assign capabilities
    foreach($roles as $the_role) {

         $role = get_role($the_role);

                 $role->add_cap( 'read' );
                 $role->add_cap( 'read_event');
                 $role->add_cap( 'read_private_event' );
                 $role->add_cap( 'edit_event' );
                 $role->add_cap( 'edit_others_event' );
                 $role->add_cap( 'edit_published_event' );
				 $role->add_cap( 'publish_event' );
                 $role->add_cap( 'delete_others_event' );
                 $role->add_cap( 'delete_private_event' );
                 $role->add_cap( 'delete_published_event' );

    }
}
*/

add_action( 'pre_get_posts',  'set_posts_per_page'  );
function set_posts_per_page( $query ) {

    global $wp_the_query;

    if ( ( ! is_admin() ) && ( $query === $wp_the_query ) && ( $query->is_search() ) ) {
        $query->set( 'posts_per_page', 5 );
    }
    elseif ( ( ! is_admin() ) && ( $query === $wp_the_query ) && ( $query->is_archive() ) ) {
        $query->set( 'posts_per_page', 5 );
    }

    return $query;
}

function wpdocs_custom_excerpt_length( $length ) {
    return 20;
}
add_filter( 'excerpt_length', 'wpdocs_custom_excerpt_length', 999 );

function custom_excerpt_more( $more ) {
	return '...';
}
add_filter( 'excerpt_more', 'custom_excerpt_more' );
