<?php
/**
 * airco functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package airco
 */

require_once('inc/cpt.php'); //Include CPT class
require_once('inc/leads.php'); //Include Leads class


if ( ! function_exists( 'airco_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function airco_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on airco, use a find and replace
	 * to change 'airco' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'airco', get_template_directory() . '/languages' );

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
	add_theme_support( 'custom-background', apply_filters( 'airco_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
endif;
add_action( 'after_setup_theme', 'airco_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function airco_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'airco_content_width', 640 );
}
add_action( 'after_setup_theme', 'airco_content_width', 0 );

include(get_template_directory() . '/inc/wp_bootstrap_navwalker.php');

// /**
//  * Class bootstrap_4_walker_nav_menu
//  */
// class bootstrap_4_walker_nav_menu extends Walker_Nav_menu {

//     function start_lvl( &$output, $depth, $args = array() ){ // ul
//         $indent = str_repeat("\t",$depth); // indents the outputted HTML
//         $submenu = ($depth > 0) ? ' sub-menu' : '';
//         $output .= "\n$indent<ul class=\"dropdown-menu$submenu depth_$depth\">\n";
//     }

//     function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ){ // li a span

//         $indent = ( $depth ) ? str_repeat("\t",$depth) : '';

//         $li_attributes = '';
//         $class_names = $value = '';

//         $classes = empty( $item->classes ) ? array() : (array) $item->classes;

//         $classes[] = ($args->walker->has_children) ? 'dropdown' : '';
//         $classes[] = ($item->current || $item->current_item_anchestor) ? 'active' : '';
//         $classes[] = 'nav-item';
//         $classes[] = 'nav-item-' . $item->ID;
//         if( $depth && $args->walker->has_children ){
//             $classes[] = 'dropdown-menu';
//         }

//         $class_names =  join(' ', apply_filters('nav_menu_css_class', array_filter( $classes ), $item, $args ) );
//         $class_names = ' class="' . esc_attr($class_names) . '"';

//         $id = apply_filters('nav_menu_item_id', 'menu-item-'.$item->ID, $item, $args);
//         $id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';

//         $output .= $indent . '<li ' . $id . $value . $class_names . $li_attributes . '>';

//         $attributes = ! empty( $item->attr_title ) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
//         $attributes .= ! empty( $item->target ) ? ' target="' . esc_attr($item->target) . '"' : '';
//         $attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
//         $attributes .= ! empty( $item->url ) ? ' href="' . esc_attr($item->url) . '"' : '';

//         $attributes .= ( $args->walker->has_children ) ? ' class="nav-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"' : ' class="nav-link"';

//         $item_output = $args->before;
//         $item_output .= ( $depth > 0 ) ? '<a class="dropdown-item"' . $attributes . '>' : '<a' . $attributes . '>';
//         $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
//         $item_output .= '</a>';
//         $item_output .= $args->after;

//         $output .= apply_filters ( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );

//     }

// }

///CREATE TESTIMONIAL CPT
$quote = new Custom_Post_Type(
    'Testimonial',
    array(
        'supports'			 => array( 'title', 'editor', 'revisions' ),
        'menu_icon'			 => 'dashicons-format-quote',
        'has_archive' 		 => true,
        'menu_position'      => null,
        'public'             => true,
        'publicly_queryable' => true,
    )
);

$quote->add_taxonomy( 'Testimonial Category' );

$quote->add_meta_box(
    'Author Info',
    array(
        'Name' 			=> 'text',
        'Company' 		=> 'text'
    )
);

//CREATE LEAD MGMT SYS
$leads = new Custom_Post_Type(
    'Lead',
    array(
        'supports'			 => array( 'title' ),
        'menu_icon'			 => 'dashicons-star-empty',
        'has_archive' 		 => false,
        'menu_position'      => null,
        'public'             => false,
        'publicly_queryable' => false,
    )
);

$leads->add_meta_box(
    'Lead Info',
    array(
        'Name' 			=> 'locked',
        'Date' 			=> 'locked',
        'Phone Number'	=> 'locked',
        'Email Address'	=> 'locked',
        'Message' 		=> 'locked'
    )
);

$leads->add_taxonomy( 'Type' );


/*
 * Custom Post Type for services
 */
/*add_action( 'init', 'create_post_type' );
function create_post_type() {
    register_post_type( 'services',
        array(
            'labels' => array(
                'name' => __( 'Services' ),
                'singular_name' => __( 'Service' )
            ),
            'public' => true,
            'has_archive' => true,
        )
    );
}*/

$services = new Custom_Post_Type(
	'Services',
	array(
		'supports'			 => array( 'title' ),
		'menu_icon'			 => 'dashicons-media-document',
		'has_archive' 		 => true,
		'menu_position'      => null,
		'public'             => true,
		'publicly_queryable' => true,
		'labels' => array(
			'name' => __( 'Services' ),
			'singular_name' => __( 'Service' )
		),
	)
);

$services->add_meta_box(
	'Page Content',
	array(
		'Page Content' 	=> 'wysiwyg'
	)
);

$services->add_meta_box(
	'Home Page Content',
	array(
		'Home Page Content' 	=> 'wysiwyg'
	)
);

// This theme uses wp_nav_menu() in one location.
register_nav_menus( array(
    'primary' => esc_html__( 'Primary', 'airco' ),
) );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function airco_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'airco' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'airco' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'airco_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function airco_scripts() {
	wp_enqueue_style( 'airco-style', get_stylesheet_uri() );

	wp_enqueue_script( 'airco-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'airco-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'airco_scripts' );

//Send an email
function sendEmail(
    $sendadmin = array(
        'to'		=> 'support@kerigan.com',
        'from'		=> 'Website <noreply@kerigan.com>',
        'subject'	=> 'Email from website',
        'receipt'	=> FALSE
    ),
    $templatetop = '<!doctype html><html><head><meta charset="utf-8"></head><body bgcolor="#E8EDE9" style="background-color:#E8EDE9;"><table cellpadding="0" cellspacing="0" border="0" align="center" style="width:650px; background:#FFF;" bgcolor="#FFF" ><tbody><tr><td>',
    $emaildata = array(
        'headline'	=> 'This is an email from the website!',
        'introcopy'	=> 'If we weren\'t testing, there would be stuff here.',
        'filedata' => '',
        'fileinfo' => ''
    ),
    $templatebot = '</td></tr></tbody></table>'){

    $eol = "\r\n";

    //build headers
    $headers = 'From: ' . $sendadmin['from'] . $eol;
    if($sendadmin['cc'] != ''){ $headers .= 'Cc: ' . $sendadmin['cc'] . $eol; }
    if($sendadmin['bcc'] != ''){ $headers .= 'Bcc: ' . $sendadmin['bcc'] . $eol; }
    if($sendadmin['replyto'] != ''){ $headers .= 'Reply-To: ' . $sendadmin['replyto'] . $eol; }

    $headers .= 'MIME-Version: 1.0' . $eol;


    //start building the email (if attachment)
    if($emaildata['fileinfo']!='' && $emaildata['filedata']!=''){


        //file info
        $mime_boundary = md5(time());
        $name = $emaildata['fileinfo']['filename'];
        $type = $emaildata['fileinfo']['filetype'];
        $data = $emaildata['filedata'];
        //mixed content type
        $headers .= "Content-Type: multipart/mixed;boundary=\"" . $mime_boundary . "\"". $eol;

        //add attachment
        $emailcontent  = "--".$mime_boundary . $eol;
        $emailcontent .= "Content-Type: ".$type."; name=\"".$name."\"" . $eol;
        $emailcontent .= "Content-Transfer-Encoding: base64".$eol;
        $emailcontent .= "Content-Disposition: attachment".$eol.$eol;
        $emailcontent .= $data . $eol;
        $emailcontent .= "--".$mime_boundary . $eol; //transition to new content type

        //add html email content type
        $emailcontent .= "Content-Type: text/html; charset=\"utf-8\"" . $eol;
        $emailcontent .= "Content-Transfer-Encoding: 8bit" . $eol . $eol;

        // fancy html part
        $emailcontent .= $templatetop . $eol . $eol;
        $emailcontent .= '<h2>'.$emaildata['headline'].'</h2>';
        $emailcontent .= '<p>'.$emaildata['introcopy'].'</p>';
        $emailcontent .= $templatebot . $eol . $eol;

        $emailcontent .= "--".$mime_boundary."--" . $eol . $eol; //close text/html part


    }else{ //no attachment
        $headers .= 'Content-type: text/html; charset=utf-8' . $eol;
        $emailcontent  = $templatetop . $eol . $eol;
        $emailcontent .= '<h2>'.$emaildata['headline'].'</h2>';
        $emailcontent .= '<p>'.$emaildata['introcopy'].'</p>';
        $emailcontent .= $templatebot . $eol . $eol;
    }

    mail( $sendadmin['to'], $sendadmin['subject'], $emailcontent, $headers );

}


/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

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
