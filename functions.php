<?php


// enables wigitized sidebars
if (function_exists('register_sidebar')
)

    // Sidebar Widget
    // Location: the sidebar
    register_sidebar(array('name' => 'Sidebar',
        'before_widget' => '<div class="widget-area widget-sidebar"><ul>',
        'after_widget' => '</ul></div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ));
// Header Widget
// Location: right after the navigation
register_sidebar(array('name' => 'Header',
    'before_widget' => '<div class="widget-area widget-header"><ul>',
    'after_widget' => '</ul></div>',
    'before_title' => '<h4>',
    'after_title' => '</h4>',
));
// Footer Widget
// Location: at the top of the footer, above the copyright
register_sidebar(array('name' => 'Footer',
    'before_widget' => '<div class="widget-area widget-footer">',
    'after_widget' => '</div>',
    'before_title' => '<h4>',
    'after_title' => '</h4>',
));
// The Alert Widget
// Location: displayed on the top of the home page, right after the header, right before the loop, within the content area
register_sidebar(array('name' => 'Alert',
    'before_widget' => '<div class="widget-area widget-alert"><ul>',
    'after_widget' => '</ul></div>',
    'before_title' => '<h4>',
    'after_title' => '</h4>',
));

// post thumbnail support
add_theme_support('post-thumbnails');

// removes inline width and height attributes from images
function remove_thumbnail_dimensions( $html ) {
	$html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
	return $html;
}
add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10 );
add_filter( 'image_send_to_editor', 'remove_thumbnail_dimensions', 10 );
add_filter( 'the_content', 'remove_thumbnail_dimensions', 10);

set_post_thumbnail_size( 243, 140, false ); // 50 pixels wide by 50 pixels tall, resize mode
add_image_size( 'page-thumb', 243, 140, false );

// adds the post thumbnail to the RSS feed
function cwc_rss_post_thumbnail($content)
{
    global $post;
    if (has_post_thumbnail($post->ID)) {
        $content = '<p>' . get_the_post_thumbnail($post->ID) .
            '</p>' . get_the_content();
    }
    return $content;
}

add_filter('the_excerpt_rss', 'cwc_rss_post_thumbnail');
add_filter('the_content_feed', 'cwc_rss_post_thumbnail');
// remove_gallery_css
	function remove_gallery_css( $css ) {
	return preg_replace( "#<style type='text/css'>(.*?)</style>#s", '', $css );
}
add_filter( 'gallery_style', 'remove_gallery_css' );
 // remove br tag from defaut galerry
function fy_neutra_gallery_break($output) {
    return preg_replace('/<br[^>]*>/', '', $output);
}
add_filter('the_content', 'fy_neutra_gallery_break', 11, 2);
 // remove thumbnail from defaut galerry
	function exclude_thumbnail_from_gallery($null, $attr){
    if (!$thumbnail_ID = get_post_thumbnail_id())
        return $null; // no point carrying on if no thumbnail ID

    // temporarily remove the filter, otherwise endless loop!
    remove_filter('post_gallery', 'exclude_thumbnail_from_gallery');

    // pop in our excluded thumbnail
    if (!isset($attr['exclude']) || empty($attr['exclude']))
        $attr['exclude'] = array($thumbnail_ID);
    elseif (is_array($attr['exclude']))
        $attr['exclude'][] = $thumbnail_ID;

    // now manually invoke the shortcode handler
    $gallery = gallery_shortcode($attr);

    // add the filter back
    add_filter('post_gallery', 'exclude_thumbnail_from_gallery', 10, 2);

    // return output to the calling instance of gallery_shortcode()
    return $gallery;
}
add_filter('post_gallery', 'exclude_thumbnail_from_gallery', 10, 2);




// custom menu support
add_theme_support('menus');
if (function_exists('register_nav_menus')) {
    register_nav_menus(
        array(
            'header-menu' => 'Header Menu',

        )
    );
}

// custom background support
add_custom_background();

// custom header image support
define('NO_HEADER_TEXT', true);
define('HEADER_IMAGE', '%s/images/default-header.png'); // %s is the template dir uri
define('HEADER_IMAGE_WIDTH', 1068); // use width and height appropriate for your theme
define('HEADER_IMAGE_HEIGHT', 300);
// gets included in the admin header
function admin_header_style()
{
    ?>
<style type="text/css">
    #headimg {
        width: <?php echo HEADER_IMAGE_WIDTH; ?>px;
        height: <?php echo HEADER_IMAGE_HEIGHT; ?>px;
    }
</style><?php
}

add_custom_image_header('', 'admin_header_style');

// adds Post Format support
// learn more: http://codex.wordpress.org/Post_Formats
// add_theme_support( 'post-formats', array( 'aside', 'gallery','link','image','quote','status','video','audio','chat' ) );

// removes detailed login error information for security
add_filter('login_errors', create_function('$a', "return null;"));

// removes the WordPress version from your header for security
function wb_remove_version()
{
    return '<!--built on the Whiteboard Framework-->';
}

add_filter('the_generator', 'wb_remove_version');


// Removes Trackbacks from the comment cout
add_filter('get_comments_number', 'comment_count', 0);
function comment_count($count)
{
    if (!is_admin()) {
        global $id;
        $comments_by_type = &separate_comments(get_comments('status=approve&post_id=' . $id));
        return count($comments_by_type['comment']);
    } else {
        return $count;
    }
}

// invite rss subscribers to comment
function rss_comment_footer($content)
{
    if (is_feed()) {
        if (comments_open()) {
            $content .= 'Comments are open! <a href="' . get_permalink() . '">Add yours!</a>';
        }
    }
    return $content;
}

// custom excerpt ellipses for 2.9+
function custom_excerpt_more($more)
{
    return '<a href="' . get_permalink( $post->ID ) . '" class="btn read-more">' . '1' . '</a>';
}

add_filter('excerpt_more', 'custom_excerpt_more');
function new_excerpt_more( $more ) {
	global $post;
	return '<a href="' . get_permalink( $post->ID ) . '" class="btn read-more">' . '2' . '</a>';
}
add_filter( 'excerpt_more', 'new_excerpt_more' );
// no more jumping for read more link
function no_more_jumping($post)
{
    return ' ' . 'Saiba mais' . '';
}
add_filter('excerpt_more', 'no_more_jumping');

function custom_excerpt( $text ) { // custom 'read more' link
	if ( strpos( $text, '[...]' ) ) {
		$excerpt = strip_tags( str_replace( '[...]', '<br /><a class="btn read-more" href="' . get_permalink() . '">4</a>', $text ) );
	} else {
		$excerpt = '' . strip_tags( $text ) . '<br />';
   }
	return $excerpt;
}

add_filter( 'the_excerpt', 'custom_excerpt' );

// Limite do excerpt
function excerpt($num) {
$limit   = $num + 1;
$excerpt = explode( ' ', get_the_excerpt(), $limit );
array_pop( $excerpt );
$excerpt = implode( " ", $excerpt ) . "...";
echo $excerpt;
}

function content( $num ) {
	$theContent = get_the_content();
	$output     = preg_replace( '/<img[^>]+./', '', $theContent );
	$limit      = $num + 1;
	$content    = explode( ' ', $output, $limit );
	array_pop( $content );
	$content = implode( " ", $content ) . "...";
	echo $content;
}

function title( $num ) {
	$limit = $num + 1;
	$title = explode( ' ', get_the_title(), $limit );
	array_pop( $excerpt );
	$title = implode( " ", $title ) . "...";
	echo $title;
}



// category id in body and post class
function category_id_class($classes)
{
    global $post;
    foreach ((get_the_category($post->ID)) as $category)
        $classes [] = 'cat-' . $category->cat_ID . '-id';
    return $classes;
}

add_filter('post_class', 'category_id_class');
add_filter('body_class', 'category_id_class');

// adds a class to the post if there is a thumbnail
function has_thumb_class($classes)
{
    global $post;
    if (has_post_thumbnail($post->ID)) {
        $classes[] = 'has_thumb';
    }
    return $classes;
}

add_filter('post_class', 'has_thumb_class');

// post_type_supports
add_post_type_support( 'page', 'excerpt' );

// Twitter Botstraps CSS Drowpdown menu
/*class Bootstrap_Walker_Nav_Menu extends Walker_Nav_Menu
{

    function start_lvl(&$output, $depth)
    {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"dropdown-menu\">\n";
    }

    function start_el(&$output, $item, $depth, $args)
    {
        global $wp_query;

        $indent = ($depth) ? str_repeat("\t", $depth) : '';

        $class_names = $value = '';

        $classes = empty($item->classes) ? array() : (array)$item->classes;
        $classes[] = ($args->has_children) ? 'dropdown' : '';
        $classes[] = ($item->current || $item->current_item_ancestor) ? 'active' : '';
        $classes[] = 'menu-item-' . $item->ID;

        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
        $class_names = ' class="' . esc_attr($class_names) . '"';

        $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args);
        $id = strlen($id) ? ' id="' . esc_attr($id) . '"' : '';

        $output .= $indent . '<li' . $id . $value . $class_names . '>';

        $attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
        $attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
        $attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
        $attributes .= !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';
        $attributes .= ($args->has_children) ? ' class="dropdown-toggle" data-toggle="dropdown"' : '';

        // new addition for active class on the a tag
        if (in_array('current-menu-item', $classes)) {
            $attributes .= ' class="active"';
        }

        $item_output = $args->before;
        $item_output .= '<a' . $attributes . '>';
        $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
        //$item_output .= '</a>';
        $item_output .= ($args->has_children) ? ' <b class="caret"></b></a>' : '</a>';
        $item_output .= $args->after;

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }

    function display_element($element, &$children_elements, $max_depth, $depth = 0, $args, &$output)
    {
        if (!$element)
            return;
        $id_field = $this->db_fields['id'];

        //display this element
        if (is_array($args[0]))
            $args[0]['has_children'] = !empty($children_elements[$element->$id_field]);
        else if (is_object($args[0]))
            $args[0]->has_children = !empty($children_elements[$element->$id_field]);
        $cb_args = array_merge(array(&$output, $element, $depth), $args);
        call_user_func_array(array(&$this, 'start_el'), $cb_args);

        $id = $element->$id_field;

        // descend only when the depth is right and there are childrens for this element
        if (($max_depth == 0 || $max_depth > $depth + 1) && isset($children_elements[$id])) {

            foreach ($children_elements[$id] as $child) {

                if (!isset($newlevel)) {
                    $newlevel = true;
                    //start the child delimiter
                    $cb_args = array_merge(array(&$output, $depth), $args);
                    call_user_func_array(array(&$this, 'start_lvl'), $cb_args);
                }
                $this->display_element($child, $children_elements, $max_depth, $depth + 1, $args, $output);
            }
            unset($children_elements[$id]);
        }

        if (isset($newlevel) && $newlevel) {
            //end the child delimiter
            $cb_args = array_merge(array(&$output, $depth), $args);
            call_user_func_array(array(&$this, 'end_lvl'), $cb_args);
        }

        //end this element
        $cb_args = array_merge(array(&$output, $element, $depth), $args);
        call_user_func_array(array(&$this, 'end_el'), $cb_args);
    }
}   */

/**
 * Add breadcrumbs functionality to your WordPress theme
 *
 * Once you have included the function in your functions.php file
 * you can then place the following anywhere in your theme templates
 * if(function_exists('bavota_breadcrumbs')) bavota_breadcrumbs();
 *
 * @c.bavota - http://bavotasan.com
 */
function bavota_breadcrumbs()
{
    if (!is_home()) {
        echo '<nav id="breadcrumb" class="breadcrumb span3">';

        if (is_category() || is_single()) {

            if (is_single()) {
                echo ' <span class="divider">&lt;</span> ';
                echo 'Você está em';
                echo ' <span class="divider">&lt;</span> ';
            }
            the_category(' <span class="divider">&lt;</span> ');
        } elseif (is_page()) {
            echo 'Você está em ';
        }
        echo '<span class="divider">&lt;</span><a href="' . home_url('/') . '">Home</a>';
        echo '</nav>';
    }
}

// add_action( 'admin_init', 'theme_options_init' );
// add_action( 'admin_menu', 'theme_options_add_page' );

// Init plugin options to white list our options
// function theme_options_init(){
// 	register_setting( 'tat_options', 'tat_theme_options', 'theme_options_validate' );
// }

// Load up the menu page
// function theme_options_add_page() {
// 	add_theme_page( __( 'Theme Options', 'tat_theme' ), __( 'Theme Options', 'tat_theme' ), 'edit_theme_options', 'theme_options', 'theme_options_do_page' );
// }

// begin LifeGuard Assistant
// learn more about the LifeGuard Assistant: http://wplifeguard.com/lifeguard-plugin/
// learn more about the affiliate program: http://wplifeguard.com/affiliates/
add_action('admin_menu', 'lgap_add_pages');
function lgap_add_pages()
{
    add_menu_page(__('Help', 'menu-test'), __('Help', 'menu-test'), 'read', 'lifeguard-assistant-plugin', 'lgap_main_page');
}

function lgap_main_page()
{
    echo "<h2>" . __('Help', 'menu-test') . "</h2>";
    // place your affiliate ID between the " on the following line
    $lgap_aff = "";
    // get your affiliate ID here: http://wplifeguard.com/wp-admin/profile.php?page=affiliateearnings
    echo '
		<style type="text/css">
			#wplg { font-family: "Varela",Helvetica,Trebuchet MS,Verdana,"DejaVu Sans",sans-serif; }
			#wplg a:link,#wplg a:visited { color: #21759b; text-decoration: none; }
			#wplg a:hover { color: #d54e21; }
			.wplg-video { background: #f6f6f6; border: 1px solid #dadada; padding: 12px; margin: 0 12px 12px 0; float: left; }
			.wplg-clear { clear: both; }
			.wplg-green-button { box-shadow:inset 0 0 3px rgba(0,0,0,.1); font-size: 20px; line-height: 32px; height: 32px; width: 434px; margin: 0 12px 12px 0; text-align: center; display: block; border: 2px solid #9abf89; background: #7da742; color: #f1ffeb !important; text-shadow: 0 0 3px rgba(125,167,66,.75); }
			.wplg-green-button:hover { border: 2px solid #c0e1aa; background: #8ac636; }
			.wplg-green-button:active { border: 2px solid #88a65e; background: #5d822a; }
		</style>
		<link href="http://fonts.googleapis.com/css?family=Varela" rel="stylesheet" type="text/css">
		<div id="wplg">
			<p>Need help with WordPress? Here is a collection of free WordPress video tutorials from <a href="http://wplifeguard.com/' . $lgap_aff . '">wpLifeGuard</a> to help you get going. <a href="http://wplifeguard.com/get-access/' . $lgap_aff . '">Get access to more videos.</a></p>
			<div class="wplg-video"><iframe src="http://player.vimeo.com/video/32852753?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" width="412" height="309" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>
			<div class="wplg-video"><iframe src="http://player.vimeo.com/video/32856785?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" width="412" height="309" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>
			<div class="wplg-video"><iframe src="http://player.vimeo.com/video/32857648?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" width="412" height="309" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>
			<div class="wplg-video"><iframe src="http://player.vimeo.com/video/32860297?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" width="412" height="309" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>
			<div class="wplg-video"><iframe src="http://player.vimeo.com/video/32872861?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" width="412" height="309" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>
			<div class="wplg-video"><iframe src="http://player.vimeo.com/video/32878118?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" width="412" height="309" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>
			<div class="wplg-video"><iframe src="http://player.vimeo.com/video/32881530?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" width="412" height="309" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>
			<div class="wplg-video"><iframe src="http://player.vimeo.com/video/32864178?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" width="412" height="309" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>
			<div class="wplg-video"><iframe src="http://player.vimeo.com/video/32863614?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" width="412" height="309" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>
			<div class="wplg-video"><iframe src="http://player.vimeo.com/video/32862744?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" width="412" height="309" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>
			<div class="wplg-video"><iframe src="http://player.vimeo.com/video/32857481?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" width="412" height="309" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>
			<div class="wplg-clear"></div>
			<a class="wplg-green-button" href="http://wplifeguard.com/get-access/' . $lgap_aff . '">Get Full Access Now</a>
		</div>
		';
}

// end LifeGuard Assistant
?>