<?php get_header(); ?>
<?php global $wp_query; ?>
<?php
jaw_template_set_var('posts', $wp_query);
$post_types = jwOpt::get_option('search_posttypes', array('post', 'page'));

if (sizeof($post_types) > 0) {
    foreach ($post_types as $i => $type) {
        $q = array();
        $q = $wp_query->query_vars;

        if ($type == 'product' && isset($_GET['orderby'])) {
            $price = explode('-', $_GET['orderby']);
            if (count($price) > 1) {
                $q['orderby'] = $price[0];
                $q['order'] = $price[1];
            }
        }

        $q['post_type'] = $type;

        $query = new WP_Query($q);
        jaw_template_set_var($type, $query);
        
    }
}
?> 
<!-- Row for main content area -->
<div id="content" class="<?php echo implode(' ', jwLayout::content_width()); ?> columns builder-section" role="main">

    <h1><?php _e('Search Results for', 'jawtemplates'); ?> "<?php echo get_search_query(); ?>"</h1>
    <?php
    get_template_part('loop', 'search');
    ?>

</div><!-- End Content row -->

<?php
get_sidebar();

get_footer();
