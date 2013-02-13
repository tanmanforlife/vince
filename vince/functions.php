<?php
/**
 * @package WordPress
 * @subpackage The Crest
 */

/**
 * Make theme available for translation
 * Translations can be filed in the /languages/ directory
 */
load_theme_textdomain( 'The Crest', get_template_directory() . '/languages' );

$locale = get_locale();
$locale_file = get_template_directory() . "/languages/$locale.php";
if ( is_readable( $locale_file ) )
	require_once( $locale_file );

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 640;

/**
 * Add jQuery
 */
function add_jquery_script() {
    wp_deregister_script( 'jquery' );
    wp_register_script( 'jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js');
    wp_enqueue_script( 'jquery' );
}    
add_action('wp_enqueue_scripts', 'add_jquery_script');

/**
 * This theme uses wp_nav_menus() for the header menu, utility menu and footer menu.
 */
register_nav_menus( array(
	'primary' => __( 'Primary Menu', 'The Crest' ),
	'footer' => __( 'Footer Menu', 'The Crest' ),
    'footer_store' => __( 'Footer Store', 'The Crest' ),
	'utility' => __( 'Utility Menu', 'The Crest' )
) );

/** 
 * Add default posts and comments RSS feed links to head
 */
add_theme_support( 'automatic-feed-links' );

/**
 * This theme uses post thumbnails
 */
add_theme_support( 'post-thumbnails' );

/**
 *	This theme supports editor styles
 */

//add_editor_style("/css/layout-style.css");


function limit_words($string, $word_limit) {
 
    // creates an array of words from $string (this will be our excerpt)
    // explode divides the excerpt up by using a space character
 
    $words = explode(' ', $string);
 
    // this next bit chops the $words array and sticks it back together
    // starting at the first word '0' and ending at the $word_limit
    // the $word_limit which is passed in the function will be the number
    // of words we want to use
    // implode glues the chopped up array back together using a space character
 
    return implode(' ', array_slice($words, 0, $word_limit));
 
}

/**
 *	Replace the default welcome 'Howdy' in the admin bar with something more professional.
 */
function admin_bar_replace_howdy($wp_admin_bar) {
    $account = $wp_admin_bar->get_node('my-account');
    $replace = str_replace('Howdy,', 'Welcome,', $account->title);            
    $wp_admin_bar->add_node(array('id' => 'my-account', 'title' => $replace));
}
add_filter('admin_bar_menu', 'admin_bar_replace_howdy', 25);

/**
 * This enables post formats. If you use this, make sure to delete any that you aren't going to use.
 */
//add_theme_support( 'post-formats', array( 'aside', 'audio', 'image', 'video', 'gallery', 'chat', 'link', 'quote', 'status' ) );

/**
 * Register widgetized area and update sidebar with default widgets
 */
function handcraftedwp_widgets_init() {
	register_sidebar( array (
		'name' => __( 'Sidebar', 'themename' ),
		'id' => 'sidebar',
		'before_widget' => '<aside id="%1$s" class="widget %2$s" role="complementary">',
		'after_widget' => "</aside>",
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	) );
}
add_action( 'init', 'handcraftedwp_widgets_init' );

// Home Page Sidebar
if(function_exists('register_sidebar'))
    register_sidebar(array(
    'name' => 'Home Page',
    'id' => 'home-sb',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => "</div>",
    'before_title' => '<h4 class="widget-title">',
    'after_title' =>'</h4>',
));

/*
 * Remove senseless dashboard widgets for non-admins. (Un)Comment or delete as you wish.
 */
function remove_dashboard_widgets() {
	global $wp_meta_boxes;

	//unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']); // Plugins widget
	//unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']); // WordPress Blog widget
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']); // Other WordPress News widget
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']); // Right Now widget
	//unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']); // Quick Press widget
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']); // Incoming Links widget
	//unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']); // Recent Drafts widget
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']); // Recent Comments widget
}


// For non-admins, add action to Hide Dashboard Widgets and Admin Menu Items you just set above
// Don't forget to comment out the admin check to see that changes :)
if (!current_user_can('manage_options')) {
	add_action('wp_dashboard_setup', 'remove_dashboard_widgets'); // Add action to hide dashboard widgets
	add_action('admin_head', 'themename_configure_dashboard_menu'); // Add action to hide admin menu items
}

?>
<?php // asynchronous google analytics: mathiasbynens.be/notes/async-analytics-snippet
//	 change the UA-XXXXX-X to be your site's ID
/*add_action('wp_footer', 'async_google_analytics');
function async_google_analytics() { ?>
	<script>
	var _gaq = [['_setAccount', 'UA-XXXXX-X'], ['_trackPageview']];
		(function(d, t) {
			var g = d.createElement(t),
				s = d.getElementsByTagName(t)[0];
			g.async = true;
			g.src = ('https:' == location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			s.parentNode.insertBefore(g, s);
		})(document, 'script');
	</script>
<?php }*/ ?>
<?php /*
 * A default custom post type. DELETE from here to the end if you don't want any custom post types
 */
/*add_action('init', 'create_boilertemplate_cpt');
function create_boilertemplate_cpt() 
{
  $labels = array(
    'name' => _x('HandcraftedWPTemplate CPT', 'post type general name'),
    'singular_name' => _x('HandcraftedWPTemplate CPT Item', 'post type singular name'),
    'add_new' => _x('Add New', 'handcraftedwptemplate_robot'),
    'add_new_item' => __('Add New Item'),
    'edit_item' => __('Edit Item'),
    'new_item' => __('New Item'),
    'view_item' => __('View Item'),
    'search_items' => __('Search Items'),
    'not_found' =>  __('No items found'),
    'not_found_in_trash' => __('No items found in Trash'), 
    'parent_item_colon' => ''
  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    'show_ui' => true, 
    'query_var' => true,
    'rewrite' => true,
    'capability_type' => 'page',
    'hierarchical' => false,
    'menu_position' => 20,
    'supports' => array('title','editor')
  ); 
  register_post_type('handcraftedwptemplate_robot',$args);
}*/
/*
 * This is for a custom icon with a colored hover state for your custom post types. You can download the custom icons here 
 http://randyjensenonline.com/thoughts/wordpress-custom-post-type-fugue-icons/
 */
/*add_action( 'admin_head', 'cpt_icons' );
function cpt_icons() {
    ?>
    <style type="text/css" media="screen">
        #menu-posts-handcraftedwptemplaterobot .wp-menu-image {
            background: url(<?php bloginfo('template_url') ?>/images/robot.png) no-repeat 6px -17px !important;
        }
		#menu-posts-handcraftedwptemplaterobot:hover .wp-menu-image, #menu-posts-handcraftedwptemplaterobot.wp-has-current-submenu .wp-menu-image {
            background-position:6px 7px!important;
        }
    </style>
<?php }*/

// Don't close PHP here, it's a very weird bug!!
//Initiating Features Post Type

function create_features_type() {
        register_post_type('featurepost', 
            array(
                'labels' => array(
                    'name' => __('Features'),
                    'singular_name' => __('Feature')    
                ),
                'public' => true,
                'menu_position' => 2,
                'rewrite' => array('slug' => 'features'), 
                'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail' )
            )
        );
    }
add_action('init', create_features_type);

//Initiating News Post Type
function create_news_type() {
    global $wp_rewrite;
    register_post_type('newspost', 
        array(
            'labels' => array(
                'name' => __('News'),
                'singular_name' => __('News'),
            ),
            'public' => true,
            'publicly_queryable' => true,
            'menu_position' => 3,
            'has_archive' => true,
            'rewrite' => array('slug' => 'news'), 
            'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail', 'category' ),
            'taxonomies' => array('category')
        )
    );
    $wp_rewrite->flush_rules();
}
add_action('init', create_news_type);

//Initiating Film Post Type
    function create_film_post() {
        register_post_type('film', 
            array(
                'labels' => array(
                    'name' => __('Films'),
                    'singular_name' => __('Film')    
                ),
                'public' => true,
                'menu_position' => 2,
                'rewrite' => array('slug' => 'film'),
                'supports' => array( 'title', 'excerpt', 'thumbnail' )
            )
        );
    }
add_action('init', create_film_post);

//Initiating Featured Products Type
function create_featured_products() {
    register_post_type('featured_products', 
        array(
            'labels' => array(
                'name' => __('Featured Products'),
                'singular_name' => __('Product')    
            ),
            'public' => true,
            'menu_position' => 4,
            'rewrite' => array('slug' => 'featured-products'),
            'supports' => array( 'title' ),
        )
    );
}
add_action('init', create_featured_products);


//Initiating Event Post Type
function create_event_type() {
    register_post_type('event', 
        array(
            'labels' => array(
                'name' => __('Events'),
                'singular_name' => __('Event')    
            ),
            'public' => true,
            'menu_position' => 3,
            'rewrite' => array('slug' => 'events'),
            'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail' ),
        )
    );
}
add_action('init', create_event_type);


//Initiating Product Post Type
function create_product_type() {
    register_post_type('product', 
        array(
            'labels' => array(
                'name' => __('Products'),
                'singular_name' => __('Product')    
            ),
            'public' => true,
            'menu_position' => 4,
            'rewrite' => array('slug' => 'products'),
            'supports' => array( 'title' ),
        )
    );
}
add_action('init', create_product_type);


function init_category($request) {
    $vars = $request->query_vars;
    if (is_category() && !is_category('newspost') && !array_key_exists('post_type', $vars)) :
        $vars = array_merge(
            $vars,
            array('post_type' => 'any')
        );
        $request->query_vars = $vars;
    endif;
    return $request;
}
add_filter('pre_get_posts', 'init_category');

?>