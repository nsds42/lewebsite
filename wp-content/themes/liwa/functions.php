<?php
global $theme_option;
if ( !class_exists( 'ReduxFramework' ) && file_exists( dirname( __FILE__ ) . '/ReduxFramework/ReduxCore/framework.php' ) ) {
    require_once( dirname( __FILE__ ) . '/ReduxFramework/ReduxCore/framework.php' );
}
if ( !isset( $redux_demo ) && file_exists( dirname( __FILE__ ) . '/ReduxFramework/sample/sample-config.php' ) ) {
    require_once( dirname( __FILE__ ) . '/ReduxFramework/sample/sample-config.php' );
}
//Custom fields:
require_once dirname( __FILE__ ) . '/framework/bfi_thumb-master/BFI_Thumb.php';
require_once dirname( __FILE__ ) . '/framework/Custom-Metaboxes/metabox-functions.php';
require_once dirname( __FILE__ ) . '/framework/post_type.php';
require_once dirname( __FILE__ ) . '/framework/tabbed.php';
require_once dirname( __FILE__ ) . '/framework/wp_bootstrap_navwalker.php';

//Define Text Doimain
$textdomain = 'liwa';
$lang = get_template_directory_uri() . '/languages';
load_theme_textdomain($textdomain, $lang);
//Theme Set up:
function liwa_theme_setup() {
    /*
     * This theme uses a custom image size for featured images, displayed on
     * "standard" posts and pages.
     */
	add_theme_support( 'custom-header' ); 
	add_theme_support( 'custom-background' );
	
    add_theme_support( 'post-thumbnails' );
    // Adds RSS feed links to <head> for posts and comments.
    add_theme_support( 'automatic-feed-links' );
    // Switches default core markup for search form, comment form, and comments
    // to output valid HTML5.
    add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );
    //Post formats
    add_theme_support( 'post-formats', array(
        'aside', 'image',  'video', 'audio', 'quote', 'link', 'gallery'
    ) );
    // This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => 'Navigation',		
	) );
    // This theme uses its own gallery styles.
	add_filter( 'use_default_gallery_style', '__return_false' );
    add_shortcode('gallery', '__return_false');
}
add_action( 'after_setup_theme', 'liwa_theme_setup' );
if ( ! isset( $content_width ) ) $content_width = 900;

function liwa_theme_scripts_styles() {
	global $theme_option;
	$protocol = is_ssl() ? 'https' : 'http';

    /**** Google fonts ****/
	wp_enqueue_style( 'Font-Open+Sans', "$protocol://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700", true);
	wp_enqueue_style( 'Font-Raleway', "$protocol://fonts.googleapis.com/css?family=Raleway:800", true);
	wp_enqueue_style( 'base', get_template_directory_uri().'/css/base.css');
	wp_enqueue_style( 'responsive', get_template_directory_uri().'/css/responsive.css');
	wp_enqueue_style( 'icons', get_template_directory_uri().'/css/icons.css');
	wp_enqueue_style( 'style', get_stylesheet_uri(), array(), '2014-07-10' );
	wp_enqueue_style( 'animate', get_template_directory_uri().'/css/animate.css');
	wp_enqueue_style( 'colors-schema', get_template_directory_uri().'/css/colors/blue.css');
	
	//wp_enqueue_style( 'flexslider', get_template_directory_uri().'/css/flexslider.css');
	
	wp_enqueue_style( 'color', get_template_directory_uri().'/framework/color.php');
	//if($theme_option['rtl']==1){wp_enqueue_style( 'rtl', get_template_directory_uri().'/rtl.css');	}
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
    wp_enqueue_script( 'comment-reply' );
	if ( !is_page_template( 'page-templates/contact.php' ) ) {
		wp_enqueue_script("jquery");
	}
	//Javascript
	if ( is_page_template( 'page-templates/contact.php' ) ) {
		wp_enqueue_script("jquery.min", get_template_directory_uri()."/js/jquery.min.js",array(),false,true);
	}
	wp_enqueue_script("themepunch.plugins", get_template_directory_uri()."/js/jquery.themepunch.plugins.min.js",array(),false,true);
	wp_enqueue_script("themepunch.revolution", get_template_directory_uri()."/js/jquery.themepunch.revolution.min.js",array(),false,true);
	wp_enqueue_script("themepunch.showbizpro", get_template_directory_uri()."/js/jquery.themepunch.showbizpro.min.js",array(),false,true);
	wp_enqueue_script("easing", get_template_directory_uri()."/js/jquery.easing.min.js",array(),false,true);
	wp_enqueue_script("tooltips", get_template_directory_uri()."/js/jquery.tooltips.min.js",array(),false,true);
	wp_enqueue_script("magnific", get_template_directory_uri()."/js/jquery.magnific-popup.min.js",array(),false,true);
	wp_enqueue_script("superfish", get_template_directory_uri()."/js/jquery.superfish.js",array(),false,true);
	wp_enqueue_script("twitter", get_template_directory_uri()."/js/jquery.twitter.js",array(),false,true);
	wp_enqueue_script("flexslider", get_template_directory_uri()."/js/jquery.flexslider.js",array(),false,true);
	wp_enqueue_script("jpanelmenu", get_template_directory_uri()."/js/jquery.jpanelmenu.js",array(),false,true);
	//wp_enqueue_script("contact", get_template_directory_uri()."/js/jquery.contact.js",array(),false,true); 
	wp_enqueue_script("isotope", get_template_directory_uri()."/js/jquery.isotope.min.js",array(),false,true);
	wp_enqueue_script("modernizr", get_template_directory_uri()."/js/modernizr.custom.js",array(),false,true);
	wp_enqueue_script("easy-pie-chart", get_template_directory_uri()."/js/jquery.easy-pie-chart.js",array(),false,true);
	wp_enqueue_script("modules", get_template_directory_uri()."/js/modules.js",array(),false,true);
	wp_enqueue_script("custom", get_template_directory_uri()."/js/custom.js",array(),false,true);
	
	/**** Google Maps ****/
	wp_enqueue_script("gmap.api", "$protocol://maps.google.com/maps/api/js?sensor=true",array(),false,true);
	wp_enqueue_script("gmaps", get_template_directory_uri()."/js/jquery.gmaps.min.js",array(),false,true);
	
}
add_action( 'wp_enqueue_scripts', 'liwa_theme_scripts_styles' );

if(!function_exists('liwa_custom_frontend_style')){
	function liwa_custom_frontend_style(){
	global $theme_option;
	echo '<style type="text/css">'.$theme_option['custom-css'].'</style>';
}
}
add_action('wp_head', 'liwa_custom_frontend_style');

if(!function_exists('liwa_custom_frontend_scripts')){
	function liwa_custom_frontend_scripts(){
	global $theme_option;
	echo $theme_option['google_id'];
}
}
add_action('wp_footer', 'liwa_custom_frontend_scripts');
//Custom Excerpt Function
function liwa_do_shortcode($content) {
    global $shortcode_tags;
    if (empty($shortcode_tags) || !is_array($shortcode_tags))
        return $content;
    $pattern = get_shortcode_regex();
    return preg_replace_callback( "/$pattern/s", 'do_shortcode_tag', $content );
}
// Widget Sidebar
function liwa_widgets_init() {
	register_sidebar( array(
        'name'          => __( 'Primary Sidebar', 'liwa' ),
        'id'            => 'sidebar-1',        
		'description'   => __( 'Appears in the sidebar section of the site.', 'liwa' ),        
		'before_widget' => '<div id="%1$s" class="widget %2$s">',        
		'after_widget'  => '</div>',        
		'before_title'  => '<h3 class="headline">',        
		'after_title'   => '</h3><span class="line"></span><div class="clearfix"></div>'
    ) );
	register_sidebar( array(
		'name'          => __( 'Shop Sidebar', 'liwa' ),
		'id'            => 'sidebar-shop',
		'description'   => __( 'Main sidebar that appears on the left.', 'liwa' ),
		'before_widget' => '<div class="widget sidebar_shop %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h5 class="headline">',
		'after_title'   => '</h5><span class="line"></span><div class="clearfix"></div>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer One Widget Area', 'liwa' ),
		'id'            => 'footer-area-1',
		'description'   => __( 'Footer Widget that appears on the Footer.', 'liwa' ),
		'before_widget' => '<div id="%1$s" class="widget clearfix %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Footer Two Widget Area', 'liwa' ),
		'id'            => 'footer-area-2',
		'description'   => __( 'Footer Widget that appears on the Footer.', 'liwa' ),
		'before_widget' => '<div id="%1$s" class="widget clearfix %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Footer Three Widget Area', 'liwa' ),
		'id'            => 'footer-area-3',
		'description'   => __( 'Footer Widget that appears on the Footer.', 'liwa' ),
		'before_widget' => '<div id="%1$s" class="widget clearfix %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Footer Fourth Widget Area', 'liwa' ),
		'id'            => 'footer-area-4',
		'description'   => __( 'Footer Widget that appears on the Footer.', 'liwa' ),
		'before_widget' => '<div id="%1$s" class="widget clearfix %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>',
	) ); 
}
add_action( 'widgets_init', 'liwa_widgets_init' );
//Register Form 
function liwa_register_a_user(){
	global $current_user, $wp_roles;
    get_currentuserinfo();
  if(isset($_GET['do']) && $_GET['do'] == 'register'):
    $errors = array();
    if(empty($_POST['user']) || empty($_POST['email']) || empty($_POST['pass']) || empty($_POST['first-name']) || empty($_POST['last-name']) || empty($_POST['pass1'])) $errors[] = 'Please enter a user name and e-mail.';

    $user_login = esc_attr($_POST['user']);
    $user_email = esc_attr($_POST['email']);
    $user_passw  = esc_attr($_POST['pass']);
    $first_name = esc_attr($_POST['first-name']);
    $last_name = esc_attr($_POST['last-name']);
    $pass1 = esc_attr($_POST['pass1']);

    $sanitized_user_login = sanitize_user($user_login);
    $user_email = apply_filters('user_registration_email', $user_email);
    $user_passw = apply_filters('user_registration_pass', $user_passw);
    $first = sanitize_user($first_name);

    if(!is_email($user_email)) $errors[] = 'Invalid e-mail.';
    elseif(email_exists($user_email)) $errors[] = 'This email is already registered.';

    if(empty($sanitized_user_login) || !validate_username($user_login)) $errors[] = 'Invalid user name.';
    elseif(username_exists($sanitized_user_login)) $errors[] = 'User name already exists.';
    if($pass1 != $user_passw ){$errors[] = 'Invalid re-enter password.Password must be the same';}
    if(empty($errors)):
      $user_pass = $user_passw;
      $user_id = wp_create_user($sanitized_user_login, $user_pass, $user_email);var_dump($user_id);
    if ( !empty( $_POST['first-name'] ) ){
    update_user_meta( $user_id, 'first_name', esc_attr( $_POST['first-name'] ) );}
    if ( !empty( $_POST['last-name'] ) ){
    update_user_meta( $user_id, 'last_name', esc_attr( $_POST['last-name'] ) );}
      if(!$user_id):
        $errors[] = 'Registration failed';
      else:
        update_user_option($user_id, 'default_password_nag', true, true);
        wp_new_user_notification($user_id, $user_pass);
      endif;
    endif;

    if(!empty($errors)) define('REGISTRATION_ERROR', serialize($errors));
    else define('REGISTERED_A_USER', $user_email);
  endif;
}
add_action('template_redirect', 'liwa_register_a_user');

function add_class_previous($format){
  $format = str_replace('href=', 'class="icon-left-open-big" href=', $format);
  return $format;
}
function add_class_next($format){
  $format = str_replace('href=', 'class="icon-right-open-big" href=', $format);
  return $format;
}
add_filter('next_post_link', 'add_class_next');
add_filter('previous_post_link', 'add_class_previous');
//function tag widgets
function liwa_tag_cloud_widget($args) {
	$args['number'] = 0; //adding a 0 will display all tags
	$args['largest'] = 18; //largest tag
	$args['smallest'] = 11; //smallest tag
	$args['unit'] = 'px'; //tag font unit
	$args['format'] = 'list'; //ul with a class of wp-tag-cloud
	$args['exclude'] = array(20, 80, 92); //exclude tags by ID
	return $args;
}
add_filter( 'widget_tag_cloud_args', 'liwa_tag_cloud_widget' );
function liwa_excerpt() {
  global $theme_option;
  if(isset($theme_option['blog_excerpt'])){
    $limit = $theme_option['blog_excerpt'];
  }else{
    $limit = 30;
  }
  $excerpt = explode(' ', get_the_excerpt(), $limit);
  if (count($excerpt)>=$limit) {
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt).'...';
  } else {
    $excerpt = implode(" ",$excerpt);
  }
  $excerpt = preg_replace('`[[^]]*]`','',$excerpt);
  return $excerpt;
}

//pagination
function liwa_pagination($prev = '<i class="icon-chevron-left"></i>', $next = '<i class="icon-chevron-right"></i>', $pages='') {
    global $wp_query, $wp_rewrite;
    $wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;
    if($pages==''){
        global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
    }
    $pagination = array(
		'base' 			=> str_replace( 999999999, '%#%', get_pagenum_link( 999999999 ) ),
		'format' 		=> '',
		'current' 		=> max( 1, get_query_var('paged') ),
		'total' 		=> $pages,
		'prev_text' => __($prev,'liwa'),
        'next_text' => __($next,'liwa'),		'type'			=> 'list',
		'end_size'		=> 3,
		'mid_size'		=> 3
);
    $return =  paginate_links( $pagination );
	echo str_replace( "<ul class='page-numbers'>", '<ul>', $return );
}
//Get thumbnail url
function liwa_thumbnail_url($size){
    global $post;
    //$url = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()),$size );
    if($size==''){
        $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
         return $url;
    }else{
        $url = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), $size);
         return $url[0];
    }
}
function liwa_post_nav() {
    global $post;
    // Don't print empty markup if there's nowhere to navigate.
    $previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
    $next     = get_adjacent_post( false, '', false );
    if ( ! $next && ! $previous )
        return;
    ?>
	<ul class="pager clearfix">
	  <li class="previous">
		<?php previous_post_link( '%link', _x( ' &larr; Older Item', 'Previous post link', 'nevermind' ) ); ?>
	  </li>
	  <li class="next">
		<?php next_post_link( '%link', _x( 'Newer Item &rarr;', 'Next post link', 'nevermind' ) ); ?>
	  </li>
	</ul>   
<?php
}
function liwa_search_form( $form ) {
    $form = '
		<form role="search" method="get" id="searchform" class="searchForm" action="' . home_url( '/' ) . '" >
			<input type="text" size="16" placeholder="Search" value="' . get_search_query() . '" name="s" id="s" />
			<input type="submit" class="submitSearch" value="Ok">
		</form>
	';
    return $form;
}
add_filter( 'get_search_form', 'liwa_search_form' );
//Custom comment List:

// Comment Form
function liwa_theme_comment($comment, $args, $depth) {
    //echo 's';
   $GLOBALS['comment'] = $comment; ?>
   
   <li id="li-comment-<?php comment_ID() ?>" data-appear-top-offset="-100" data-animated="fadeInRight">
		<div id="<?php comment_ID() ?>" class="comment">
			<div class="avatar"><?php echo get_avatar($comment,$size='100',$default='http://0.gravatar.com/avatar/ad516503a11cd5ca435acc9bb6523536?s=70' ); ?></div>
			<div class="comment-des"><div class="arrow-comment"></div>
				<div class="comment-by"><strong><?php printf(__('%s','liwa'), get_comment_author_link()) ?></strong><span class="date"><?php $d = "M j, Y"; printf(get_comment_date($d)) ?></span><span class="reply"><i class="icon-reply"></i> <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?></span></div>
				<?php if ($comment->comment_approved == '0'){ ?>
					 <em><?php _e('Your comment is awaiting moderation.','liwa') ?></em>
					 <br />
				<?php }else{ ?>
				<p><?php comment_text() ?></p>
				<?php } ?>
			</div>
			<div class="clearfix"></div>
		</div>
	</li>
<?php
}
function liwa_breadcrumbs() {
       /* === OPTIONS === */
    $text['home']     = 'Home'; // text for the 'Home' link
    $text['category'] = 'Archive by Category "%s"'; // text for a category page
    $text['tax']       = 'Archive for "%s"'; // text for a taxonomy page
    $text['search']   = 'Search Results for "%s" Query'; // text for a search results page
    $text['tag']      = 'Posts Tagged "%s"'; // text for a tag page
    $text['author']   = 'Articles Posted by %s'; // text for an author page
    $text['404']      = 'Error 404'; // text for the 404 page
 
    $showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
    $showOnHome  = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
    $delimiter   = ''; // delimiter between crumbs
    $before      = '<li class="active">'; // tag before the current crumb
    $after       = '</li>'; // tag after the current crumb
    /* === END OF OPTIONS === */
 
    global $post;
    $homeLink = home_url() . '/';
    $linkBefore = '<li>';
    $linkAfter = '</li>';
    $linkAttr = ' rel="v:url" property="v:title"';
    $link = $linkBefore . '<a' . $linkAttr . ' href="%1$s">%2$s</a>' . $linkAfter;
 
    if (is_home() || is_front_page()) {
 
        if ($showOnHome == 1) echo '<div id="crumbs"><a href="' . $homeLink . '">' . $text['home'] . '</a></div>';
 
    } else {
 
        echo '<nav id="breadcrumbs"><ul><li>You are here:</li>' . sprintf($link, $homeLink, $text['home']) . $delimiter;
 
        
        if ( is_category() ) {
            $thisCat = get_category(get_query_var('cat'), false);
            if ($thisCat->parent != 0) {
                $cats = get_category_parents($thisCat->parent, TRUE, $delimiter);
                $cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
                $cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
                echo $cats;
            }
            echo $before . sprintf($text['category'], single_cat_title('', false)) . $after;
 
        } elseif( is_tax() ){
            $thisCat = get_category(get_query_var('cat'), false);
            if ($thisCat->parent != 0) {
                $cats = get_category_parents($thisCat->parent, TRUE, $delimiter);
                $cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
                $cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
                echo $cats;
            }
            echo $before . sprintf($text['tax'], single_cat_title('', false)) . $after;
        
        }elseif ( is_search() ) {
            echo $before . sprintf($text['search'], get_search_query()) . $after;
 
        } elseif ( is_day() ) {
            echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
            echo sprintf($link, get_month_link(get_the_time('Y'),get_the_time('m')), get_the_time('F')) . $delimiter;
            echo $before . get_the_time('d') . $after;
 
        } elseif ( is_month() ) {
            echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
            echo $before . get_the_time('F') . $after;
 
        } elseif ( is_year() ) {
            echo $before . get_the_time('Y') . $after;
 
        } elseif ( is_single() && !is_attachment() ) {
            if ( get_post_type() != 'post' ) {
                $post_type = get_post_type_object(get_post_type());
                $slug = $post_type->rewrite;
                printf($link, $homeLink . '/' . $slug['slug'] . '/', $post_type->labels->singular_name);
                if ($showCurrent == 1) echo $delimiter . $before . get_the_title() . $after;
            } else {
                $cat = get_the_category(); $cat = $cat[0];
                $cats = get_category_parents($cat, TRUE, $delimiter);
                if ($showCurrent == 0) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
                $cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
                $cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
                echo $cats;
                if ($showCurrent == 1) echo $before . get_the_title() . $after;
            }
 
        } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
            $post_type = get_post_type_object(get_post_type());
            echo $before . $post_type->labels->singular_name . $after;
 
        } elseif ( is_attachment() ) {
            $parent = get_post($post->post_parent);
            $cat = get_the_category($parent->ID); $cat = $cat[0];
            $cats = get_category_parents($cat, TRUE, $delimiter);
            $cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
            $cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
            echo $cats;
            printf($link, get_permalink($parent), $parent->post_title);
            if ($showCurrent == 1) echo $delimiter . $before . get_the_title() . $after;
 
        } elseif ( is_page() && !$post->post_parent ) {
            if ($showCurrent == 1) echo $before . get_the_title() . $after;
 
        } elseif ( is_page() && $post->post_parent ) {
            $parent_id  = $post->post_parent;
            $breadcrumbs = array();
            while ($parent_id) {
                $page = get_page($parent_id);
                $breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));
                $parent_id  = $page->post_parent;
            }
            $breadcrumbs = array_reverse($breadcrumbs);
            for ($i = 0; $i < count($breadcrumbs); $i++) {
                echo $breadcrumbs[$i];
                if ($i != count($breadcrumbs)-1) echo $delimiter;
            }
            if ($showCurrent == 1) echo $delimiter . $before . get_the_title() . $after;
 
        } elseif ( is_tag() ) {
            echo $before . sprintf($text['tag'], single_tag_title('', false)) . $after;
 
        } elseif ( is_author() ) {
             global $author;
            $userdata = get_userdata($author);
            echo $before . sprintf($text['author'], $userdata->display_name) . $after;
 
        } elseif ( is_404() ) {
            echo $before . $text['404'] . $after;
        }
 
        if ( get_query_var('paged') ) {
            if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() );
            if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
        }
 
        echo '</ul></nav>';
 
    }
}  

/**** Woocommerce Custom ****/ 
/**
 * Breadcrumbs
 *
 * @see woocommerce_breadcrumb()
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
add_action( 'woocommerce_before_main_content_brc', 'woocommerce_breadcrumb', 20, 0 );

if ( ! function_exists( 'woocommerce_breadcrumb' ) ) {
/**
 * Output the WooCommerce Breadcrumb
 *
 * @access public
 * @return void
 */
	function woocommerce_breadcrumb( $args = array() ) {

		$defaults = apply_filters( 'woocommerce_breadcrumb_defaults', array(
			'delimiter'   => ' &#47; ',
			'wrap_before' => '',
			'wrap_after'  => '',
			'before'      => '',
			'after'       => '',
			'home'        => _x( 'Home', 'breadcrumb', 'woocommerce' ),
		) );

		$args = wp_parse_args( $args, $defaults );
		wc_get_template( 'global/breadcrumb.php', $args );
	}
}
function woocommerce_output_related_products() {
woocommerce_related_products(3,4); // Display 4 products in rows of 2
}

/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.4.0
 * @author     Thomas Griffin <thomasgriffinmedia.com>
 * @author     Gary Jones <gamajo.com>
 * @copyright  Copyright (c) 2014, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/thomasgriffin/TGM-Plugin-Activation
 */
/**
 * Include the TGM_Plugin_Activation class.
 */
require_once dirname( __FILE__ ) . '/framework/class-tgm-plugin-activation.php';
add_action( 'tgmpa_register', 'liwa_theme_register_required_plugins' );
/**
 * Register the required plugins for this theme.
 *
 * In this example, we register two plugins - one included with the TGMPA library
 * and one from the .org repo.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
 
 
function liwa_theme_register_required_plugins() {
    /**
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(
             // This is an example of how to include a plugin from a private repo in your theme.
        array(
            'name'               => 'Verga Theme Page Builder', // The plugin name.
            'slug'               => 'Aqua-Page-Builder-master', // The plugin slug (typically the folder name).
            'source'             => get_template_directory_uri() . '/framework/plugins/Aqua-Page-Builder-master.zip', // The plugin source.
            'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ),		
		array(
            'name'               => 'Slider Revolution', // The plugin name.
            'slug'               => 'revslider', // The plugin slug (typically the folder name).
            'source'             => get_template_directory_uri() . '/framework/plugins/revslider.zip', // The plugin source.
            'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ),
        // This is an example of how to include a plugin from the WordPress Plugin Repository.
		array(
            'name'      => 'Contact Form 7',
            'slug'      => 'contact-form-7',
            'required'  => true,
        ),
		array(
            'name'      => 'Plugin Woocommerce',
            'slug'      => 'woocommerce',
            'required'  => true,
        ),
    );
    /**
     * Array of configuration settings. Amend each line as needed.
     * If you want the default strings to be available under your own theme domain,
     * leave the strings uncommented.
     * Some of the strings are added into a sprintf, so see the comments at the
     * end of each line for what each argument will be.
     */
    $config = array(
        'default_path' => '',                      // Default absolute path to pre-packaged plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.
        'strings'      => array(
            'page_title'                      => __( 'Install Required Plugins', 'tgmpa' ),
            'menu_title'                      => __( 'Install Plugins', 'tgmpa' ),
            'installing'                      => __( 'Installing Plugin: %s', 'tgmpa' ), // %s = plugin name.
            'oops'                            => __( 'Something went wrong with the plugin API.', 'tgmpa' ),
            'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'tgmpa' ), // %1$s = plugin name(s).
            'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'tgmpa' ), // %1$s = plugin name(s).
            'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'tgmpa' ), // %1$s = plugin name(s).
            'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'tgmpa' ), // %1$s = plugin name(s).
            'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'tgmpa' ), // %1$s = plugin name(s).
            'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'tgmpa' ), // %1$s = plugin name(s).
            'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'tgmpa' ), // %1$s = plugin name(s).
            'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'tgmpa' ), // %1$s = plugin name(s).
            'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'tgmpa' ),
            'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins', 'tgmpa' ),
            'return'                          => __( 'Return to Required Plugins Installer', 'tgmpa' ),
            'plugin_activated'                => __( 'Plugin activated successfully.', 'tgmpa' ),
            'complete'                        => __( 'All plugins installed and activated successfully. %s', 'tgmpa' ), // %s = dashboard link.
            'nag_type'                        => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
        )
    );
    tgmpa( $plugins, $config );
}
?>