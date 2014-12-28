<?php
/**
 * The default template for displaying product/color content
 */
?>

<?php
if (class_exists('WooCommerce')) {

    global $post, $product;
    $class = "";
    
    $link = get_permalink();
    if (jaw_template_get_var('catalog_mode', 'off') == 'on') {
        $link = add_query_arg( 'catalog_mode', 'on', $link);
    }
    
    ?>

    <article id="product-<?php the_ID(); ?>"  <?php post_class(array('element', 'col-lg-3', 'product-style-1', 'product-animate')); ?>   
             sort_name="<?php echo(StrToLower(get_the_title())); ?>"  
             sort_date="<?php the_time("Y-m-d H:i:s"); ?>" 
             sort_rating="<?php echo (($post->rating > 0) ? ((int) ($post->rating * 50)) : '0'); ?>" 
             sort_popular="<?php echo get_comments_number();     //if(jwOpt::get_option('fbcomments_switch','0')=='0'){echo get_comments_number(); }else{echo jwFacebook::get_fb_comments_count(get_the_ID()); }           ?>"
             >
        <div class="box ">
            <?php do_action('woocommerce_before_shop_loop_item'); ?>
            <?php
            if (jwOpt::get_option('woo_animation', 'simple') != 'off') {
                $gallery = $product->get_gallery_attachment_ids();
                if (isset($gallery[0])) {
                    $img = wp_get_attachment_image_src($gallery[0], "woo-size");
                    $class = 'hower_image_' . jwOpt::get_option('woo_animation', 'simple');
                }
            }
            ?>
            <div class="image <?php echo $class; ?>">
                <?php
                echo '<a href="' . $link . '" title="' . get_the_title() . '">';
                jwUtils::the_post_thumbnail('woo-size');
                if (isset($img[0])) {
                    echo '<img class="woo_second_image" src="';
                    echo $img[0];
                    echo '" />';
                }
                echo '</a>';
                ?>          
            </div>

            <div class="product-info-bar">
                <?php do_action('woocommerce_before_shop_loop_item_title'); ?>
            </div>

            <div class="product-box">
                
                <?php
                    $class_rating = array();
                    $rating = jwRender::metaRating();

                    if (strlen(trim($rating)) == 0) {
                        $class_rating[] = "rating-none";
                    }
                    ?>
                
                <h2 class="<?php echo implode(' ', $class_rating); ?>">
                    <a href="<?php echo $link; ?>" class="post_name"><?php echo jwUtils::crop_length(get_the_title(), jaw_template_get_var('letter_excerpt_title', jwOpt::get_option('letter_excerpt_title', -1))); ?></a>
                </h2>   <!-- Title -->
                <?php echo jwUtils::crop_length(jwRender::get_the_excerpt(), jaw_template_get_var('letter_excerpt', jwOpt::get_option('letter_excerpt', -1))); ?>
                <div class="product-box-info">
                    
                    

                    <div class="rating <?php echo implode(' ', $class_rating); ?>">
                        <?php echo $rating; ?>  <!-- RATING -->
                        <div class="clear"></div>
                    </div>
                    <div class="price">   <!-- Price -->
                        <?php
                        echo wc_price($product->get_price()); 
                        ?>
                    </div>
                    <div class="clear"></div>                
                </div>
                <div class="product-box-buttons">
                    <div class="addtocart">
                        <?php woocommerce_get_template('loop/add-to-cart.php'); ?>
                    </div>

                    <?php if (is_plugin_active('yith-woocommerce-wishlist/init.php')) { ?>
                        <div class="addtowishlist">
                            <span class="icon-plus-circle2"></span><?php echo do_shortcode('[yith_wcwl_add_to_wishlist]'); ?>
                        </div>
                    <?php } ?>

                    <div class="clear"></div>    
                </div>

                <?php do_action('woocommerce_after_shop_loop_item_title'); ?>
                <?php do_action('woocommerce_after_shop_loop_item'); ?>

                <div class="clear"></div>
            </div> 
        </div>
    </article>

    <?php
} 