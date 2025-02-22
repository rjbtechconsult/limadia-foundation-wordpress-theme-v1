<?php
/**
 * Limadia Entity Foundation V1 functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Limadia_Entity_Foundation_V1
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function limadia_entity_foundation_v1_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Limadia Entity Foundation V1, use a find and replace
		* to change 'limadia-entity-foundation-v1' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'limadia-entity-foundation-v1', get_template_directory() . '/languages' );

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

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'limadia-entity-foundation-v1' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'limadia_entity_foundation_v1_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'limadia_entity_foundation_v1_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function limadia_entity_foundation_v1_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'limadia_entity_foundation_v1_content_width', 640 );
}
add_action( 'after_setup_theme', 'limadia_entity_foundation_v1_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function limadia_entity_foundation_v1_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'limadia-entity-foundation-v1' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'limadia-entity-foundation-v1' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'limadia_entity_foundation_v1_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function limadia_entity_foundation_v1_scripts() {
	$theme_uri = get_template_directory_uri(); // If using a child theme, use get_stylesheet_directory_uri()
	// wp_enqueue_style( 'limadia-entity-foundation-v1-style', get_stylesheet_uri(), array(), _S_VERSION );
	// wp_style_add_data( 'limadia-entity-foundation-v1-style', 'rtl', 'replace' );

	// Core Stylesheets
    wp_enqueue_style('bootstrap', $theme_uri . '/css/bootstrap.min.css');
    wp_enqueue_style('jquery-ui', $theme_uri . '/css/jquery-ui.min.css');
    wp_enqueue_style('animate', $theme_uri . '/css/animate.css');
    wp_enqueue_style('plugin-collections', $theme_uri . '/css/css-plugin-collections.css');
    wp_enqueue_style('menuzord', $theme_uri . '/css/menuzord-skins/menuzord-boxed.css');
    wp_enqueue_style('style-main', $theme_uri . '/css/style-main.css');
    wp_enqueue_style('preloader', $theme_uri . '/css/preloader.css');
    wp_enqueue_style('custom-bootstrap-margin-padding', $theme_uri . '/css/custom-bootstrap-margin-padding.css');
    wp_enqueue_style('responsive', $theme_uri . '/css/responsive.css');
    // wp_enqueue_style('custom-style', $theme_uri . '/css/style.css'); // Uncomment if you need it

    // Revolution Slider CSS
    wp_enqueue_style('rev-slider-settings', $theme_uri . '/js/revolution-slider/css/settings.css');
    wp_enqueue_style('rev-slider-layers', $theme_uri . '/js/revolution-slider/css/layers.css');
    wp_enqueue_style('rev-slider-navigation', $theme_uri . '/js/revolution-slider/css/navigation.css');

    // Theme Skin
    wp_enqueue_style('theme-skin', $theme_uri . '/css/colors/theme-skin-yellow.css');

	// Enqueue JavaScript Files
	wp_enqueue_script( 'limadia-entity-foundation-v1-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, false );
    wp_enqueue_script('jquery-2.2.0', $theme_uri . '/js/jquery-2.2.0.min.js', array(), null, false);
    wp_enqueue_script('jquery-ui', $theme_uri . '/js/jquery-ui.min.js', array('jquery-2.2.0'), null, false);
    wp_enqueue_script('bootstrap', $theme_uri . '/js/bootstrap.min.js', array('jquery-2.2.0'), null, false);
    wp_enqueue_script('plugin-collection', $theme_uri . '/js/jquery-plugin-collection.js', array('jquery-2.2.0'), null, false);

    // Revolution Slider Scripts
    wp_enqueue_script('rev-tools', $theme_uri . '/js/revolution-slider/js/jquery.themepunch.tools.min.js', array('jquery-2.2.0'), null, false);
    wp_enqueue_script('rev-main', $theme_uri . '/js/revolution-slider/js/jquery.themepunch.revolution.min.js', array('rev-tools'), null, false);

	// Footer Scripts (Custom & Slider Extensions)
    wp_enqueue_script('custom-script', $theme_uri . '/js/custom.js', array('jquery-2.2.0'), null, true);
    wp_enqueue_script('rev-ext-actions', $theme_uri . '/js/revolution-slider/js/extensions/revolution.extension.actions.min.js', array('rev-main'), null, true);
    wp_enqueue_script('rev-ext-carousel', $theme_uri . '/js/revolution-slider/js/extensions/revolution.extension.carousel.min.js', array('rev-main'), null, true);
    wp_enqueue_script('rev-ext-kenburn', $theme_uri . '/js/revolution-slider/js/extensions/revolution.extension.kenburn.min.js', array('rev-main'), null, true);
    wp_enqueue_script('rev-ext-layeranimation', $theme_uri . '/js/revolution-slider/js/extensions/revolution.extension.layeranimation.min.js', array('rev-main'), null, true);
    wp_enqueue_script('rev-ext-migration', $theme_uri . '/js/revolution-slider/js/extensions/revolution.extension.migration.min.js', array('rev-main'), null, true);
    wp_enqueue_script('rev-ext-navigation', $theme_uri . '/js/revolution-slider/js/extensions/revolution.extension.navigation.min.js', array('rev-main'), null, true);
    wp_enqueue_script('rev-ext-parallax', $theme_uri . '/js/revolution-slider/js/extensions/revolution.extension.parallax.min.js', array('rev-main'), null, true);
    wp_enqueue_script('rev-ext-slideanims', $theme_uri . '/js/revolution-slider/js/extensions/revolution.extension.slideanims.min.js', array('rev-main'), null, true);
    wp_enqueue_script('rev-ext-video', $theme_uri . '/js/revolution-slider/js/extensions/revolution.extension.video.min.js', array('rev-main'), null, true);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'limadia_entity_foundation_v1_scripts' );


/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

// Include favicons in header
function add_favicons() {
    ?>
    <link href="<?php echo get_template_directory_uri(); ?>/images/favicon.png" rel="shortcut icon" type="image/png">
    <link href="<?php echo get_template_directory_uri(); ?>/images/apple-touch-icon.png" rel="apple-touch-icon">
    <link href="<?php echo get_template_directory_uri(); ?>/images/apple-touch-icon-72x72.png" rel="apple-touch-icon" sizes="72x72">
    <link href="<?php echo get_template_directory_uri(); ?>/images/apple-touch-icon-114x114.png" rel="apple-touch-icon" sizes="114x114">
    <link href="<?php echo get_template_directory_uri(); ?>/images/apple-touch-icon-144x144.png" rel="apple-touch-icon" sizes="144x144">
    <?php
}
add_action('wp_head', 'add_favicons');


// Dynamic Menu
function register_custom_menus() {
    register_nav_menus(array(
        'primary_menu' => __('Primary Menu', 'limadia-entity-foundation-v1'),
    ));
}
add_action('init', 'register_custom_menus');

// Handle menu dropdowns
class Custom_Walker_Nav_Menu extends Walker_Nav_Menu {
    // Start Level (Submenu)
    function start_lvl( &$output, $depth = 0, $args = null ) {
        $output .= '<ul class="dropdown">';
    }

    // End Level (Closing Submenu)
    function end_lvl( &$output, $depth = 0, $args = null ) {
        $output .= '</ul>';
    }

    // Start Element (Menu Item)
    function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
        // Check if the menu item has children
        $has_children = in_array('menu-item-has-children', (array) $item->classes);

        // Check if the current menu item is active
        $active_class = in_array('current-menu-item', (array) $item->classes) ? 'active' : '';

        // Generate the list item classes
        $class_names = trim(implode(' ', array_filter([
            'menu-item-' . $item->ID, // Unique menu item ID class
            $active_class,            // Active class
            $has_children ? 'has-dropdown' : '' // Dropdown indicator
        ])));

        // Output the list item
        $output .= '<li class="' . esc_attr($class_names) . '">';
        $output .= '<a href="' . esc_url($item->url) . '">' . esc_html($item->title) . '</a>';
    }

    // End Element (Closing Menu Item)
    function end_el( &$output, $item, $depth = 0, $args = null ) {
        $output .= '</li>';
    }
}

// Handle Side bar menu
class Sidebar_Walker_Nav_Menu extends Walker_Nav_Menu {
    // Start Level (Submenu)
    function start_lvl( &$output, $depth = 0, $args = null ) {
        $output .= '<ul class="nav nav-list tree">';
    }

    // End Level (Closing Submenu)
    function end_lvl( &$output, $depth = 0, $args = null ) {
        $output .= '</ul>';
    }

    // Start Element (Menu Item)
    function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
        // Check if the menu item has children
        $has_children = in_array('menu-item-has-children', (array) $item->classes);

        // Check if the current menu item is active
        $active_class = in_array('current-menu-item', (array) $item->classes) ? 'active' : '';

        if ($has_children) {
            // Parent menu item
            $output .= '<li class="' . esc_attr($active_class) . '">';
            $output .= '<a class="tree-toggler nav-header">' . esc_html($item->title);
            $output .= ' <i class="fa fa-angle-down"></i></a>';
        } else {
            // Regular menu item
            $output .= '<li class="' . esc_attr($active_class) . '">';
            $output .= '<a href="' . esc_url($item->url) . '">' . esc_html($item->title) . '</a>';
        }
    }

    // End Element (Closing Menu Item)
    function end_el( &$output, $item, $depth = 0, $args = null ) {
        $output .= '</li>';
    }
}

// Gallery CPT
include get_template_directory() . '/cpts/gallery-cpt.php';


