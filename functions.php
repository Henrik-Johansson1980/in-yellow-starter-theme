<?php
/**
 * InYellow Starter Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage inyellowstarter
 * @since inyellowstarter 1.0
 */

/**
 * Table of Contents:
 * Theme Support
 * Required Files
 * Register Styles
 * Register Scripts
 * Register Menus
 * Custom Logo
 * WP Body Open
 * Register Sidebars
 * Enqueue Block Editor Assets
 * Enqueue Classic Editor Styles
 * Block Editor Settings
 */

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function inyellowstarter_theme_support() {

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Custom background color.
	add_theme_support(
		'custom-background',
		array(
			'default-color' => 'f5efe0',
		)
	);

	// Custom Header (Footer) image.
	$args = array(
		'default-image'      => get_template_directory_uri() . 'img/default-image.jpg',
		'default-text-color' => '000',
		'width'              => 1000,
		'height'             => 500,
		'flex-width'         => true,
		'flex-height'        => true,
	);

	add_theme_support( 'custom-header', $args );

	// Set content-width.
	global $content_width;
	if ( ! isset( $content_width ) ) {
		$content_width = 640; // Sidebar: 320px margin: 40px.
	}

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// Set post thumbnail size.
	set_post_thumbnail_size( 1200, 9999 );

	// Custom logo.
	$logo_width  = 120;
	$logo_height = 90;

	// If the retina setting is active, double the recommended width and height.
	if ( get_theme_mod( 'retina_logo', false ) ) {
		$logo_width  = floor( $logo_width * 2 );
		$logo_height = floor( $logo_height * 2 );
	}

	add_theme_support(
		'custom-logo',
		array(
			'height'      => $logo_height,
			'width'       => $logo_width,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

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
			'script',
			'style',
		)
	);

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on InYellow Starter, use a find and replace
	 * to change 'inyellowstarter' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'inyellowstarter' );

	// Add support for full and wide align images.
	add_theme_support( 'align-wide' );

	// Add support for responsive embeds.
	add_theme_support( 'responsive-embeds' );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
}

add_action( 'after_setup_theme', 'inyellowstarter_theme_support' );

/**
 * REQUIRED FILES
 * Include required files.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Register and enqueue styles
 */
function inyellowstarter_register_styles() {

	$theme_version = wp_get_theme()->get( 'Version' );

	wp_enqueue_style( 'inyellowstarter-style', get_stylesheet_uri(), array(), $theme_version );

	// Font Awesome .
	wp_enqueue_style( 'inyellowstarter-fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css', array(), $theme_version );

	// Google Fonts .
	wp_enqueue_style( 'inyellowstarter-googlefonts', 'https://fonts.googleapis.com/css2?family=PT+Mono&family=PT+Sans+Caption&family=PT+Sans+Narrow:wght@400;700&family=PT+Sans:wght@400;700&family=PT+Serif+Caption&family=PT+Serif:ital,wght@0,400;0,700;1,400;1,700&display=swap', array(), $theme_version );
}

add_action( 'wp_enqueue_scripts', 'inyellowstarter_register_styles' );

/**
 * Register and Enqueue Scripts.
 */

/*
Enqueue scripts
function inyellowstarter_register_scripts() {

	$theme_version = wp_get_theme()->get( 'Version' );

	if ( ( ! is_admin() ) && is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_script( 'inyellowstarter-js', get_template_directory_uri() . '/assets/js/index.js', array(), $theme_version, false );
	wp_script_add_data( 'inyellowstarter-js', 'async', true );

}

add_action( 'wp_enqueue_scripts', 'inyellowstarter_register_scripts' );
phpcs:ignore */

/**
 * Fix skip link focus in IE11.
 *
 * This does not enqueue the script because it is tiny and because it is only for IE11,
 * thus it does not warrant having an entire dedicated blocking script being loaded.
 *
 * @link https://git.io/vWdr2
 */
function inyellowstarter_skip_link_focus_fix() {
	// The following is minified via `terser --compress --mangle -- assets/js/skip-link-focus-fix.js`.
	?>
	<script>
	/(trident|msie)/i.test(navigator.userAgent)&&document.getElementById&&window.addEventListener&&window.addEventListener("hashchange",function(){var t,e=location.hash.substring(1);/^[A-z0-9_-]+$/.test(e)&&(t=document.getElementById(e))&&(/^(?:a|select|input|button|textarea)$/i.test(t.tagName)||(t.tabIndex=-1),t.focus())},!1);
	</script>
	<?php
}

add_action( 'wp_print_footer_scripts', 'inyellowstarter_skip_link_focus_fix' );

/**
 * Register navigation menus uses wp_nav_menu in five places.
 */
function inyellowstarter_menus() {

	$locations = array(
		'header'  => __( 'Main Top Menu', 'inyellowstarter' ),
		'sidebar' => __( 'Sidebar Expanded Menu', 'inyellowstarter' ),
		'footer'  => __( 'Footer Menu', 'inyellowstarter' ),
		'social'  => __( 'Social Menu', 'inyellowstarter' ),
	);

	register_nav_menus( $locations );
}

add_action( 'init', 'inyellowstarter_menus' );


if ( ! function_exists( 'wp_body_open' ) ) {

	/**
	 * Shim for wp_body_open, ensuring backward compatibility with versions of WordPress older than 5.2.
	 */
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
}

/**
 * Register widget areas.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function inyellowstarter_sidebar_registration() {

	// Arguments used in all register_sidebar() calls.
	$shared_args = array(
		'before_title'  => '<h2 class="widget-title subheading heading-size-3">',
		'after_title'   => '</h2>',
		'before_widget' => '<div class="widget %2$s"><div class="widget-content">',
		'after_widget'  => '</div></div>',
	);

	// Sidebar.
	register_sidebar(
		array_merge(
			$shared_args,
			array(
				'name'        => __( 'Sidebar', 'inyellowstarter' ),
				'id'          => 'sidebar-1',
				'description' => __( 'Widgets in this area will be displayed in the sidebar.', 'inyellowstarter' ),
			)
		)
	);

	// Footer.
	register_sidebar(
		array_merge(
			$shared_args,
			array(
				'name'        => __( 'Footer', 'inyellowstarter' ),
				'id'          => 'sidebar-footer',
				'description' => __( 'Widgets in this area will be displayed in the footer.', 'inyellowstarter' ),
			)
		)
	);

}

add_action( 'widgets_init', 'inyellowstarter_sidebar_registration' );

/**
 * Change Customizer settings for custom Header /Footer.
 *
 * @param object $wp_customize The WP Customize object.
 */
function inyellowstarter_customizer( $wp_customize ) {
	$wp_customize->get_section( 'header_image' )->title       = esc_html__( 'Footer Image', 'inyellowstarter' );
	$wp_customize->get_section( 'header_image' )->description = esc_html__( '***Note: This says header but actually controls the footer image.', 'inyellowstarter' );

}
add_action( 'customize_register', 'inyellowstarter_customizer' );
