<?php
/**
 * The default template for displaying product/small content
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

    <article id="product-<?php the_ID(); ?>"  <?php post_class(array('element', 'col-lg-2', 'product-style-10')); ?>   
             sort_name="<?php echo(StrToLower(get_the_title())); ?>"  
             sort_date="<?php the_time("Y-m-d H:i:s"); ?>" 
             sort_rating="<?php echo (($post->rating > 0) ? ((int) ($post->rating * 50)) : '0'); ?>" 
             sort_popular="<?php echo get_comments_number();     //if(jwOpt::get_option('fbcomments_switch','0')=='0'){echo get_comments_number(); }else{echo jwFacebook::get_fb_comments_count(get_the_ID()); }             ?>"
             >
        <div class="box ">
            <?php do_action('woocommerce_before_shop_loop_item'); ?>
            <?php
            if (jwOpt::get_option('woo_animation', 'simple') != 'off') {
                $gallery = $product->get_gallery_attachment_ids();
                if (isset($gallery[0])) {
                    $img = wp_get_attachment_image_src($gallery[0], "woo-size-small");
                    $class = 'hower_image_' . jwOpt::get_option('woo_animation', 'simple');
                }
            }
            ?>
            <div class="image <?php echo $class; ?>">
                <?php
                echo '<a href="' . $link . '" title="' . get_the_title() . '">';

                jwUtils::the_post_thumbnail('woo-size-small');
                if (isset($img[0])) {
                    echo '<img class="woo_second_image" src="';
                    echo $img[0];
                    echo '" />';
                }
                echo '</a>';
                ?>

                <?php if ($product->is_featured()) { ?>
                    <div class="featured-bar">
                        <span><?php _e('Featured product', 'jawtemplates') ?></span>
                    </div>
                <?php } ?>
            </div>

            <div class="product-info-bar">
                <?php do_action('woocommerce_before_shop_loop_item_title'); ?>
            </div>

            <div class="product-box">
                <h2>
                    <a href="<?php echo $link; ?>" class="post_name"><?php echo jwUtils::crop_length(get_the_title(), jaw_template_get_var('letter_excerpt_title', jwOpt::get_option('letter_excerpt_title',-1))); ?></a>
                </h2>   <!-- Title -->

                <div class="price">   <!-- Price -->
                    <?php
                    echo wc_price($product->get_price());
                    ?>
                </div>
            </div>
            <?php do_action('woocommerce_after_shop_loop_item_title'); ?>
            <?php do_action('woocommerce_after_shop_loop_item'); ?>
        </div>
    </article>
<?php
}