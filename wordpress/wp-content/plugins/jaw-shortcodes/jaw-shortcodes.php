<?php
/*
  Plugin Name: JaW Shortcodes
  Plugin URI: http://jawtemplates.com
  Description: Package of shortcodes by JaW Templates
  Version: 1.0.6
  Author: JaW Templates
  Author URI: http://jawtemplates.com
 */
if (!class_exists('jaw_shortcodes')) {
    define('JAW_SHORTCODES_DIR', dirname(__FILE__) . "/");
    define('JAW_SHORTCODES_URI', plugins_url('', __FILE__) . "/");

    class jaw_shortcodes {

        private $_version = 200;   // plugin version
        private $_name = 'jaw_shortcodes';       // plugin ID for store option in DB
        private $_data = array();     // data from DB    
        static private $_instance;
        private $_avaible = array(
            'jaw_blog' => array('label' => 'Blog', 'description' => 'Classical blog'),
            'jaw_custom_text' => array('label' => 'Custom Text', 'description' => ''),
            'jaw_divider' => array('label' => 'Divider', 'description' => ''),
            'jaw_page' => array('label' => 'Page', 'description' => ''),
            'jaw_image' => array('label' => 'Image', 'description' => ''),
            'jaw_list' => array('label' => 'List', 'description' => ''),
            'jaw_list_item' => array('label' => 'List item', 'description' => ''),
            'jaw_author' => array('label' => 'Author', 'description' => ''),
            'jaw_quote' => array('label' => 'BlockQuote', 'description' => ''),
            'jaw_section' => array('label' => 'Section', 'description' => ''),
            'jaw_tabs' => array('label' => 'Tabs', 'description' => ''),
            'jaw_tabs_titles' => array('label' => 'Tabs Titles', 'description' => ''),
            'jaw_tabs_title' => array('label' => 'Tabs Title', 'description' => ''),
            'jaw_tabs_contents' => array('label' => 'Tabs Contents', 'description' => ''),
            'jaw_tabs_content' => array('label' => 'Tabs Content', 'description' => ''),
            'jaw_section' => array('label' => 'Section', 'description' => ''),
            'jaw_message' => array('label' => 'Message', 'description' => ''),
            'jaw_sidebar' => array('label' => 'Sidebar', 'description' => ''),
            'jaw_iframe' => array('label' => 'Iframe', 'description' => ''),
            'jaw_accordion' => array('label' => 'Accordion', 'description' => ''),
            'jaw_accordion_item' => array('label' => 'Accordion item', 'description' => ''),
            'jaw_typography' => array('label' => 'Typography', 'description' => ''),
            'jaw_h' => array('label' => 'Columns (h)', 'description' => ''),
            'jaw_google_map' => array('label' => 'Google map', 'description' => ''),
            'jaw_bing_map' => array('label' => 'Bing map', 'description' => ''),
            //'jaw_youtube_feeds' => array('label' => 'Youtube feeds', 'description' => ''),
            'jaw_y_video' => array('label' => 'Youtube video', 'description' => ''),
            'jaw_countdown' => array('label' => 'Countdown', 'description' => ''),
            'jaw_icon' => array('label' => 'Icon', 'description' => ''),
            'jaw_v_video' => array('label' => 'Vimeo video', 'description' => ''),
            'jaw_qrcode' => array('label' => 'QRcode', 'description' => ''),
            'jaw_custom_code' => array('label' => 'Custom code', 'description' => ''),
            'jaw_button' => array('label' => 'Button', 'description' => ''),
            'jaw_progressbar' => array('label' => 'Progressbar', 'description' => ''),
            'jaw_one_progressbar' => array('label' => 'One Progressbar', 'description' => ''),
            'jaw_panel_box' => array('label' => 'Panel box', 'description' => ''),
            'jaw_blog_carousel' => array('label' => 'Blog carousel', 'description' => ''),
            'jaw_blog_carousel_vertical' => array('label' => 'Blog carousel vertical', 'description' => ''),
            'jaw_woo_carousel' => array('label' => 'Woocommerce Products carousel', 'description' => ''),
            'jaw_woo_carousel_vertical' => array('label' => 'Woocommerce Products carousel vertical', 'description' => ''),
            'jaw_woo_carousel_small' => array('label' => 'Small Woocommerce Products carousel', 'description' => ''),
            'jaw_woo_carousel_vertical_small' => array('label' => 'Small Woocommerce Products carousel vertical', 'description' => ''),
            'jaw_social_icons' => array('label' => 'Social icons', 'description' => ''),
            'jaw_circle_chart' => array('label' => 'Circle chart', 'description' => ''),
            'jaw_chart_item' => array('label' => 'Chart item', 'description' => ''),
            'jaw_cta' => array('label' => 'CTA', 'description' => ''),
            'jaw_comments' => array('label' => 'Comments', 'description' => ''),
            'jaw_paralax_text' => array('label' => 'Paralax text', 'description' => ''),
            'jaw_blog_big' => array('label' => 'Blog big', 'description' => ''),
            'jaw_portfolio' => array('label' => 'Portfolio', 'description' => ''),
            'jaw_faq' => array('label' => 'FAQ', 'description' => ''),
            'jaw_gallery' => array('label' => 'Gallery', 'description' => ''),
            'jaw_slider' => array('label' => 'Slider', 'description' => ''),
            'jaw_testimonial' => array('label' => 'Testimonial', 'description' => ''),
            'jaw_googlefonts' => array('label' => 'Google Fonts', 'description' => ''),
            'jaw_breadcrumbs' => array('label' => 'Breadcrumbs', 'description' => ''),
            'jaw_testimonial_carousel' => array('label' => 'Testimonial carousel', 'description' => ''),
            'jaw_testimonial_carousel_vertical' => array('label' => 'Testimonial carousel vertical', 'description' => ''),
            'jaw_team' => array('label' => 'Team', 'description' => ''),
            'jaw_banner' => array('label' => 'Custom banner', 'description' => ''),
            'jaw_contact' => array('label' => 'Contact', 'description' => ''),
            'jaw_title' => array('label' => 'Title', 'description' => ''),
            'jaw_html_carousel' => array('label' => 'Custom HTML Carousel', 'description' => ''),
            'jaw_login' => array('label' => 'Login', 'description' => ''),
            'jaw_paralax_video' => array('label' => 'Paralax Video', 'description' => '')
        );

        public static function getInstance() {
            if (is_null(self::$_instance)) {
                return self::$_instance = new jaw_shortcodes();
            } else {
                return self::$_instance;
            }
        }

        function __construct() {

//load_plugin_textdomain($this->_name, false, dirname(plugin_basename(__FILE__)) . '/languages/');

            require_once (JAW_SHORTCODES_DIR . "jaw-shortcode_templater.php");
            require_once (JAW_SHORTCODES_DIR . "jaw-shortcode-utils.php");

            require_once (JAW_SHORTCODES_DIR . "editor/simple_elements.php");
            require_once (JAW_SHORTCODES_DIR . "editor/simple_shortcodes.php");

            if (is_admin()) {
                add_action('init', array('jaw_shortcodes', 'jaw_shortcodes_button'));
                add_action('wp_ajax_jaw_shortcodes_ajax', array(&$this, 'jaw_shortcodes_ajax'));

                add_action('admin_enqueue_scripts', array(&$this, 'loadAssets'));
            }
            add_action('after_setup_theme', array(&$this, 'support'));

            if (isset($_POST[$this->_name]) && is_admin()) {
                $active = array();
                if (isset($_POST['typ'])) {
                    foreach ($_POST['typ'] as $value) {
                        $active[$value] = $value;
                    }
                }
                $this->_store($active);
            }

            $this->_data = get_option($this->_name);

            if (!isset($this->_data['active'])) {
                $this->_data['active'] = $this->_avaible;
            }
            if (!isset($this->_data['avaible'])) {
                $this->_data['avaible'] = array_keys($this->_avaible);
            }
            $this->_registerPluginPage();
            if ($this->_data !== false) { // Plugin is initialized.
                $this->_bootloader();
            }
        }

        public function support() {
            add_image_size('slider-size', 488, 455, true);
        }

        private function _bootloader() {
            global $jaw_shortcodes;

            $jaw_shortcodes = array();

            if ($this->_data['active']) {
                foreach ($this->_data['active'] as $key => $short) {
                    if (file_exists(JAW_SHORTCODES_DIR . "shortcodes/" . $key . ".php")) {
                        require_once(JAW_SHORTCODES_DIR . "shortcodes/" . $key . ".php");
                        $jaw_shortcodes[$key] = new $key();
                    } else {
                        echo "<div class='alert alert-warning'>File <strong>" . $key . ".php</strong> is not avalible - <strong>Please check settings of jw-shortcodes plugin</strong></div>";
                    }
                }
            }
        }

        public function getData() {
            return $this->_data;
        }

        private function _store($active, $avaible = null) {
            $theme = wp_get_theme();
            $atts['theme'] = $theme->get('Name');
            $atts['version'] = $theme->get('Version');
            $atts['active'] = $active;
            $atts['plugin'] = $this->_version;
            if (!is_null($avaible)) {
                $atts['avaible'] = $avaible;
            } else { // nacteme dostupne pluginy z DB z predchozi inicializace
                $this->_data = get_option($this->_name);
                $atts['avaible'] = $this->_data['avaible'];
            }
            update_option($this->_name, $atts);
        }

        /**
         * 
         * @param type $plugin
         * @param type $theme
         * @param type $themecheck
         * @return boolean
         */
        private function _checkVersion($plugin) {
            $attrs = $plugin->attributes();
            if ((int) (string) $attrs->vmin <= $this->_version && (int) (string) $attrs->vmax >= $this->_version) {
                return true;  //  Version of plugin is correct
            } else {
                return false; // dont match
            }
        }

        private function _options(SimpleXMLElement $plugin) {
            if ($plugin->children()) {
                $out = null;
                foreach ($plugin->children() as $name => $option) {
                    $out[] = (string) $name;
                }
                return $out;
            }
            return false;
        }

        public function init($plugin, $theme) { // theme run this function
            if ($this->_checkVersion($plugin)) {
                if ($this->_data === false) {
                    $active = $this->_options($plugin);
                    $this->_store($active, $active);
                } else { // updatovalo se neco
                    $avaible = $this->_options($plugin);
                    $this->_store($this->_data['active'], $avaible);
                }
                if (isset($_POST[$this->_name]) && is_admin()) {
// kvuli aktualiyaci udelame redirect, abz se zmenz provedly/zobrazily ihned

                    if (!empty($_SERVER['QUERY_STRING'])) {
                        $query_string = $_SERVER['QUERY_STRING'];
                    } else {
                        $query_string = 'page=' . $this->_name;
                    }

                    wp_redirect(admin_url('plugins.php?' . $query_string));
                }
                return true;
            } else {
                return false;
            }
        }

        private function _registerPluginPage() {
            add_action('admin_menu', array(&$this, 'addPage'));
        }

        public function loadAssets() {

            wp_enqueue_style('editor-style', JAW_SHORTCODES_URI . 'editor/assets/style.css', null, null, 'screen');

            wp_register_script('jaw-elements', JAW_SHORTCODES_URI . 'editor/assets/elements.js', array('jquery'), false, true);
            wp_enqueue_script('jaw-elements');

            wp_register_script('angular', JAW_SHORTCODES_URI . 'editor/assets/lib/angular.min.js', array('jquery'), false, true);
            wp_enqueue_script('angular');

            wp_register_script('angular-bootstrap', JAW_SHORTCODES_URI . 'editor/assets/lib/ui-bootstrap-tpls.min.js', array('jquery'), false, true);
            wp_enqueue_script('angular-bootstrap');

            wp_register_script('gallerypicker', JAW_SHORTCODES_URI . 'editor/assets/angular.gallerypicker.js', array('jquery'), false, true);
            wp_enqueue_script('gallerypicker');

            wp_enqueue_script('shortcode_editor', JAW_SHORTCODES_URI . 'editor/assets/shortcode_editor.js', array('jquery'), '1.0', true);
          
        }

        public function addPage() {
            $page = add_plugins_page('JaW Shortcodes', 'JaW Shortcodes', 'manage_options', $this->_name, array(&$this, 'doPage'));
        }

        public function doPage() {
            if (!current_user_can('manage_options')) {
                wp_die('You do not have sufficient permissions to access this page.');
            }


            echo '<div id="cp-check" class="wrap">';
            echo '<div id="icon-plugins" class="icon32"><br /></div>
            <h2>JaW Shortcodes</h2>';
            echo '<div class="jawcustomposts">';
            echo $this->_form();
            echo '</div>';
            echo '</div>';
        }

        private function _form() {

            ob_start();
            ?>

            <form action="plugins.php?page=<?php echo $this->_name; ?>" method="post">
                <input id="_wpnonce" type="hidden" value="<?php echo wp_create_nonce($this->_name); ?>" name="_wpnonce">
                <p>Turn on and off shorcodes </p>
                <table class="form-table">
                    <tbody>
                        <tr valign="top">
                            <th scope="row">J&W shortcodes:</th>
                            <td>
                                <fieldset>
                                    <legend class="screen-reader-text"><span>Active this shortcodes:</span></legend>
                                    <?php
                                    foreach ((array) $this->_avaible as $key => $item) {
                                        if (in_array($key, $this->_data['avaible'])) {
                                            $checked = in_array($key, array_keys($this->_data['active'])) ? 'checked="checked"' : '';
                                            ?>
                                            <label for="<?php echo $key; ?>">
                                                <input type="checkbox" value="<?php echo $key; ?>" <?php echo $checked ?> id="<?php echo $key; ?>" name="typ[]">
                                                <?php echo esc_attr($this->_avaible[$key]['label']); ?></label>
                                                <?php if ($this->_avaible[$key]['description']) { ?>
                                                <br>
                                                <small><em>(<?php echo esc_attr($this->_avaible[$key]['description']); ?>)</em></small>
                                            <?php } ?>
                                            <br>
                                            <?php
                                        }
                                    }
                                    ?>

                                </fieldset>
                            </td>
                        </tr>
                    </tbody>

                </table>

                <?php submit_button(null, 'primary', $this->_name); ?>
            </form>


            <?php
            return ob_get_clean();
        }

        public static function jaw_shortcodes_button() {
            if (!current_user_can('edit_posts') && !current_user_can('edit_pages')) {
                return;
            }

            if (get_user_option('rich_editing') == 'true') {
                add_filter('mce_external_plugins', array('jaw_shortcodes', 'add_jawshortcodes'));
                add_filter('mce_buttons', array('jaw_shortcodes', 'register_button'));
            }
        }

        public static function register_button($buttons) {
            //array_push($buttons, "|", "jaw_shortcodes");
            $buttons[] = "jaw_shortcodes";
            // print_r($buttons);die(0);
            return $buttons;
        }

        public static function add_jawshortcodes($parray) {
            global $wp_version;
            if ($wp_version <= 3.8) {
                $parray['jaw_shortcodes'] = JAW_SHORTCODES_URI . 'editor/editor_old.min.js';
            } else { //wp 3.9+
                $parray['jaw_shortcodes'] = JAW_SHORTCODES_URI . 'editor/editor_new.min.js';
            }

            return $parray;
        }

        public function jaw_shortcodes_ajax() {

            if (isset($_POST['type'])) {
                $type = $_POST['type'];
            } else {
                $type = 'default';
            }
            if (isset($_POST['data'])) {
                $data = $_POST['data'];
            } else {
                $data = null;
            }
            $shortcode_function = 'shortcode_' . $type;
            $shortcode = '';
            if (method_exists('jwSimpleShort', $shortcode_function)) {
                $shortcode .= jwSimpleShort::$shortcode_function($data);
            } else {
                $shortcode .= jwSimpleShort::shortcode_default('jaw_' . $type, $data);
            }

            echo ($shortcode);
            die();
        }

    }
    $scds = jaw_shortcodes::getInstance();
}