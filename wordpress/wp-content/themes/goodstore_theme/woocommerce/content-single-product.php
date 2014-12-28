<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * Override this template by copying it to yourtheme/woocommerce/content-single-product.php
 *
 * @author      WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

/**
 * woocommerce_before_single_product hook
 *
 * @hooked woocommerce_show_messages - 10
 */
do_action('woocommerce_before_single_product');

$catalog_mode_class = '';
$catalog_mode = 0;
if (isset($_GET['catalog_mode']) && $_GET['catalog_mode'] == 'on') {
    $catalog_mode = 1;
    $catalog_mode_class = 'catalog_mode_on';
    jaw_template_set_var('catalog_mode', 'on');
}
?>

<div itemscope itemtype="http://schema.org/Product" id="product-<?php the_ID(); ?>" <?php post_class($catalog_mode_class); ?>>

    <?php
    /**
     * woocommerce_show_product_images hook
     *
     * @hooked woocommerce_show_product_sale_flash - 10
     * @hooked woocommerce_show_product_images - 20
     */
    do_action('woocommerce_before_single_product_summary');
    ?>

    <div class="summary entry-summary">

        <?php
        /**
         * woocommerce_single_product_summary hook
         *
         * @hooked woocommerce_template_single_title - 5
         * @hooked woocommerce_template_single_price - 10
         * @hooked woocommerce_template_single_excerpt - 20
         * @hooked woocommerce_template_single_add_to_cart - 30
         * @hooked woocommerce_template_single_meta - 40
         * @hooked woocommerce_template_single_sharing - 50
         */
        if (function_exists('woocommerce_get_template')) {

            global $post, $product;

            woocommerce_get_template('single-product/title.php');

            echo '<div class="price-container">';
            woocommerce_get_template('single-product/price.php');
            echo '</div>';

            $class_dr = '';
            $rating = jwRender::metaRating();
            if (strlen(trim($rating))) {
                $class_dr = 'rating-show';
                echo '<div class="rating">';
                echo $rating;
                echo '<div class="clear"></div>';
                echo '</div>';
            }

            echo '<div class="clear"></div>';

            if ($catalog_mode == 0) {
                echo '<div class="description-container">';
                woocommerce_get_template('single-product/short-description.php');
                echo '</div>';
            } else if ($catalog_mode == 1) {
                echo '<div class="description-container ' . $class_dr . '">';
                echo do_shortcode(get_post_meta(get_the_ID(), '_prod_product_custom_desc', true));
                echo '</div>';
            }

            $product_link_product = get_post_meta(get_the_ID(), '_prod_product_link', true);
            if (strlen($product_link_product) == 0) {
                $product_link_product = '2';
            }

            $product_link = jwOpt::get_option('woo_product_product_link', 'on');

            $link_to_product = get_permalink();
            $custom_link = get_post_meta(get_the_ID(), '_prod_product_custom_link', true);

            if (strlen($custom_link) > 0) {
                $link_to_product = trim($custom_link);
            }

            if (($catalog_mode == 1 && $product_link_product == '1') || ($catalog_mode == 1 && $product_link == '1' && $product_link_product == '2')) {
                echo '<div class="no-catalog-product-page">';
                echo '<a class="button" href="' . $link_to_product . '">' . __('View product', 'jawtemplates') . '</a>';
                echo '</div>';
            }

            switch ($product->product_type) {
                case 'variable':

                    // Enqueue variation scripts
                    wp_enqueue_script('wc-add-to-cart-variation');

                    // Load the template
                    woocommerce_get_template('single-product/add-to-cart/variable.php', array(
                        'available_variations' => $product->get_available_variations(),
                        'attributes' => $product->get_variation_attributes(),
                        'selected_attributes' => $product->get_variation_default_attributes()
                    ));
                    break;
                case 'grouped':
                     wc_get_template( 'single-product/add-to-cart/grouped.php', array(
                			'grouped_product'    => $product,
                			'grouped_products'   => $product->get_children(),
                			'quantites_required' => false
                		) );
                    break;
                case 'simple':
                    woocommerce_get_template('single-product/add-to-cart/simple.php');
                    break;
                case 'external':
                    if (!$product->get_product_url()) {
                        break;
                    }
                    woocommerce_get_template('single-product/add-to-cart/external.php', array(
                        'product_url' => $product->get_product_url(),
                        'button_text' => $product->get_button_text()
                    ));
                    break;
                case 'bundle':
                    do_action('woocommerce_bundle_add_to_cart');
                    break;
            }

            if (is_plugin_active('yith-woocommerce-wishlist/init.php')) {
                echo '<div class="addtowishlist">';
                echo '<span class="icon-plus-circle2"></span>' . do_shortcode('[yith_wcwl_add_to_wishlist]');
                echo '</div>';
            }

            if (is_plugin_active('yith-woocommerce-compare/init.php')) {
                echo '<div class="comparebutton">';
                echo '<span class="icon-plus-circle2"></span>' . do_shortcode('[yith_compare_button]');
                echo '</div>';
            }

            echo '<div class="clear"></div>';

            woocommerce_get_template('single-product/meta.php');

            if (jwOpt::get_option('woo_social_share', '1') == '1') {
                woocommerce_get_template('single-product/share.php');
                get_template_part('woocommerce/single-product/socialshare');
            }
        }
        ?>

    </div><!-- .summary -->
    <div class="clear"></div>

    <?php
    /**
     * woocommerce_after_single_product_summary hook
     *
     * @hooked woocommerce_output_product_data_tabs - 10
     * @hooked woocommerce_output_related_products - 20
     */
    do_action('woocommerce_after_single_product_summary');
    ?>

</div><!-- #product-<?php the_ID(); ?> -->

<?php
do_action('woocommerce_after_single_product');
