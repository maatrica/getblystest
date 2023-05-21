<?php

/**
* Custom Functions
*/

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
*/

function bootstrap_example_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on bootstrap example, use a find and replace
		* to change 'bootstrap-example' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'bootstrap-example', get_template_directory() . '/languages' );

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
			'primary-menu' => esc_html__( 'Primary', 'bootstrap-example' ),
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
			'bootstrap_example_custom_background_args',
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
add_action( 'after_setup_theme', 'bootstrap_example_setup' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function bootstrap_example_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'bootstrap-example' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'bootstrap-example' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

}
add_action( 'widgets_init', 'bootstrap_example_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function bootstrap_example_scripts() {
	wp_enqueue_style( 'bootstrap-example-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_enqueue_style( 'bootstrap-example-bootstrap-css', get_template_directory_uri(). '/css/bootstrap.min.css', array(),  false );

	wp_enqueue_script( 'bootstrap-example-bootstrap-scripts', get_template_directory_uri() . '/js/bootstrap.bundle.min.js', array(), _S_VERSION, true );

}
add_action( 'wp_enqueue_scripts', 'bootstrap_example_scripts' );


//custommenu
function custom_menu(){
   $menu_name = 'primary-menu';
        if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_name ] ) ):
          $menu = wp_get_nav_menu_object( $locations[$menu_name]);
          $menu_items = wp_get_nav_menu_items($menu->term_id);
          $menu_list = '<ul class="nav col-md-4 justify-content-end">';
            foreach ( (array) $menu_items as $key => $menu_item ) {
                $cur = "";
                  if( ( ($menu_item->object == 'page') && (is_page($menu_item->object_id)) ) || ( ($menu_item->object == 'category') && (is_category($menu_item->object_id)) ) ) 
                    $cur = "active";
                    $title = $menu_item->title;
                    $url = $menu_item->url;
                    $menu_list .= '<li class="nav-item"><a class="nav-link px-2 text-muted'.$cur.'" href="' . $url . '">' . $title . '</a></li>';
                  }
                  $menu_list .= '</ul>';
                  echo $menu_list;
          endif;
}

//search redirect to 404 page
function page_not_found_search_template( $template ) {
    if( ! have_posts() ) {
        $template = locate_template( array( '404.php' ) );
    }
    return $template;
}
add_filter( 'search_template', 'page_not_found_search_template' );



//map location latitude
add_action( 'edit_form_after_title', 'latitude_metabox' );
add_action( 'save_post', 'save_latitude_metabox' );

function latitude_metabox()
{
    global $post;
    $key = 'latitude';

    if ( empty ( $post ) || 'post' !== get_post_type( $GLOBALS['post'] ) )
        return;

    if ( ! $content = get_post_meta( $post->ID, $key, TRUE ) )
        $content = '';

    printf(
        '<p><label for="%1$s_id">Enter Latitude of Location
        <input type="text" name="%1$s" id="%1$s_id" value="%2$s" class="all-options" />
        </label></p>',
        $key,
        esc_attr( $content )
    );
}

function save_latitude_metabox( $post_id )
{
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
        return;

    if ( ! current_user_can( 'edit_post', $post_id ) )
        return;

    $key = 'latitude';

    if ( isset ( $_POST[ $key ] ) )
        return update_post_meta( $post_id, $key, $_POST[ $key ] );

    delete_post_meta( $post_id, $key );
}


//map location longitude
add_action( 'edit_form_after_title', 'longitude_metabox' );
add_action( 'save_post', 'save_longitude_metabox' );

function longitude_metabox()
{
    global $post;
    $key = 'longitude';

    if ( empty ( $post ) || 'post' !== get_post_type( $GLOBALS['post'] ) )
        return;

    if ( ! $content = get_post_meta( $post->ID, $key, TRUE ) )
        $content = '';

    printf(
        '<p><label for="%1$s_id">Enter Longitude of Location
        <input type="text" name="%1$s" id="%1$s_id" value="%2$s" class="all-options" />
        </label></p>',
        $key,
        esc_attr( $content )
    );
}

function save_longitude_metabox( $post_id )
{
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
        return;

    if ( ! current_user_can( 'edit_post', $post_id ) )
        return;

    $key = 'longitude';

    if ( isset ( $_POST[ $key ] ) )
        return update_post_meta( $post_id, $key, $_POST[ $key ] );

    delete_post_meta( $post_id, $key );
}