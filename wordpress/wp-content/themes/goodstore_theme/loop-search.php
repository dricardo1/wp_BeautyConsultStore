<?php
global $post, $wp_query, $jaw_data;
$content_width = jwLayout::content_width();
?>
<div  class=" row ">
    <div class="<?php echo implode(' ', $content_width); ?>">

        <div class="jaw-tabs row">
            <div class="<?php echo implode(' ', $content_width); ?>">
                <ul class="nav nav-tabs" >   
                    <?php
                    $post_types = jwOpt::get_option('search_posttypes', array('post', 'page'));
                    
                    $first = '';
                    $search_in = '';
                    
                    if (!isset($_GET['orderby'])) {
                        $first = 'active';                        
                    } else {
                        $search_in = 'product';
                    }
                    
                    if (sizeof($post_types) > 0) {
                        foreach ($post_types as $i => $type) {
                            $obj = get_post_type_object($type);
                            if ($type == 'product' && $search_in == 'product') {
                                $first = 'search-'.$type.' active';
                                $search_in = 'search-product';
                            } else {
                                if ($first == 'active') {
                                    $first = 'search-' . $type . ' active';
                                } else {
                                    $first = 'search-'.$type;
                                }
                            }
                            echo '<li class="' . $first . '"><a data-toggle="tab" href="#search_' . $type . '">' . $obj->labels->name . '</a></li>';
                            if ($type == 'product') {
                                echo '<div class="woo-sort-cat-form">';
                                    woocommerce_catalog_ordering();
                                echo '</div>';
                            }
                            $first = '';
                        }
                    }
                    ?>
                </ul>
                <div class="tab-content" >
                    <?php
                    $post_types = jwOpt::get_option('search_posttypes', array('post', 'page'));

                    $first = '';
                    $search_in = '';
                    
                    if (!isset($_GET['orderby'])) {
                        $first = 'active in';                        
                    } else {
                        $search_in = 'product';
                    }
                    if (sizeof($post_types) > 0) {
                        foreach ($post_types as $i => $type) {
                            jaw_template_inc_counter('pagination');
                            $class = '';
                            if ($type == 'product') {
                                $class = 'woocommerce';
                            }
                            if ($type == 'product' && $search_in == 'product') {
                                $first = 'active in';
                                $search_in = '';
                            }
                            ?>
                            <div class="tab-pane fade <?php echo $first . ' ' . implode(' ', $content_width); ?>" id="search_<?php echo $type; ?>">
                                <div class="element_iso row  jaw_paginated_<?php echo jaw_template_get_counter('pagination') . ' ' . $class; ?>">
                                    <?php
                                    $wp_query = jaw_template_get_var($type);

                                    if (have_posts()) {
                                        while (have_posts()) : the_post();
                                            ?>

                                            <?php
                                            switch (get_post_type()) {
                                                case 'post':
                                                    echo jaw_get_template_part('content-middle', 'content');
                                                    break;
                                                case 'product':
                                                    echo jaw_get_template_part('content-product-0', 'woocommerce');
                                                    break;
                                                case 'jaw-portfolio':
                                                    $type_p = get_post_meta(get_the_ID(), 'portfolio_type', true);
                                                    echo jaw_get_template_part('content-portfolio-' . $type_p, 'custom-posts');
                                                    break;
                                                case 'jaw-team':
                                                    echo jaw_get_template_part('content-team', 'custom-posts');
                                                    break;
                                                case 'jaw-testimonial':
                                                    echo jaw_get_template_part('content-testimonial', 'custom-posts');
                                                    break;
                                                case 'jaw-faq':
                                                    echo jaw_get_template_part('content-faq', 'custom-posts');
                                                    break;
                                                default:
                                                    echo jaw_get_template_part('content-custom', 'custom-posts');
                                                    break;
                                            }
                                        endwhile;
                                    } else {
                                        ?>
                                        <div class="notice <?php echo implode(' ', $content_width); ?>">
                                            <p class="bottom"><?php _e('We are sorry, no results were found. You can try to find some related posts using the search function.', 'jawtemplates'); ?></p>
                                            <?php get_search_form(); ?>
                                        </div>
                                        	 
                                    <?php }
                                    ?>
                                </div>
                                <div class="clear"></div>
                                <?php echo jwRender::pagination(jwOpt::get_option('blog_pagination', 'number')); ?>
                            </div>
                            <?php
                            $first = '';
                        }
                    }
                    ?>

                </div>

            </div>
        </div>
    </div>
</div>