<?php

/**
 * Post Slides
 * @author JaW Templates <http://www.jawtemplates.com>
 * @copyright (c) 2013, CCB, spol. s r.o.
 * @version 1.0
 */
add_action('init', 'register_jaw_portfolio');


add_action('add_meta_boxes', 'add_custom_meta_box_jaw_portfolio');
add_action('save_post', 'save_custom_meta_jaw_portfolio');

function register_jaw_portfolio() {
    global $jaw_customposts_class;
    $data = $jaw_customposts_class->getData();
    $rewrite = 'jaw_portfolio';
    if (isset($data['active']['jaw_portfolio']['rewrite'])) {
        $rewrite = $data['active']['jaw_portfolio']['rewrite'];
    }

    $labels = array(
        'name' => __('Portfolio', 'jaw_cp'),
        'singular_name' => __('Portfolio Item', 'jaw_cp'),
        'add_new' => __('Add New', 'jaw_cp'),
        'add_new_item' => __('Add New Portfolio Item', 'jaw_cp'),
        'edit_item' => __('Edit Portfolio Item', 'jaw_cp'),
        'new_item' => __('New Portfolio Item', 'jaw_cp'),
        'view_item' => __('View Portfolio Item', 'jaw_cp'),
        'search_items' => __('Search Portfolio Items', 'jaw_cp'),
        'not_found' => __('No portfolio items found', 'jaw_cp'),
        'not_found_in_trash' => __('No portfolio items found in Trash', 'jaw_cp'),
        'parent_item_colon' => __('Parent Portfolio:', 'jaw_cp'),
    );

    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'description' => __('Custom Post Type - Portfolio Pages', 'jaw_cp'),
        'supports' => array('title', 'editor', 'excerpt'),
        'taxonomies' => array('jaw-portfolio-category'),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 20,
        'menu_icon' => plugins_url('images/portfolio.png', __FILE__),
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => array('slug' => $rewrite),
        'capability_type' => 'post'
    );

    register_post_type('jaw-portfolio', $args);

    // "Portfolio Categories" Custom Taxonomy
    $labels = array(
        'name' => __('Portfolio Categories', 'jaw_cp'),
        'singular_name' => __('Portfolio Category', 'jaw_cp'),
        'search_items' => __('Search Portfolio Categories', 'jaw_cp'),
        'all_items' => __('All Portfolio Categories', 'jaw_cp'),
        'parent_item' => __('Parent Portfolio Category', 'jaw_cp'),
        'parent_item_colon' => __('Parent Portfolio Category:', 'jaw_cp'),
        'edit_item' => __('Edit Portfolio Category', 'jaw_cp'),
        'update_item' => __('Update Portfolio Category', 'jaw_cp'),
        'add_new_item' => __('Add New Portfolio Category', 'jaw_cp'),
        'new_item_name' => __('New Portfolio Category Name', 'jaw_cp'),
        'menu_name' => __('Portfolio Categories', 'jaw_cp')
    );

    $args = array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'jaw-portfolio-category')
    );

    register_taxonomy('jaw-portfolio-category', array('jaw-portfolio'), $args);
}

function add_custom_meta_box_jaw_portfolio() {
    add_meta_box(
            'jaw_portfolio_meta_box', // $id
            __('Portfolio Settings', 'jaw_cp'), // $title
            'show_custom_meta_box_jaw_portfolio', // $callback
            'jaw-portfolio', // $page
            'normal', // $context
            'high'); // $priority
}

// The Callback Meta Boxes
function show_custom_meta_box_jaw_portfolio() {
    global $custom_meta_portfolio, $post;

    // Use nonce for verification
    echo '<input type="hidden" name="custom_meta_portfolio" value="' . wp_create_nonce(basename(__FILE__)) . '" />';

    // Begin the field table and loop
    echo '<table class="form-table" ng-controller="customPostAdmin">';
    foreach ((array) $custom_meta_portfolio as $field) {
        // get value of this field if it exists for this post
        $meta = get_post_meta($post->ID, $field['id'], false);
        if (isset($meta[0])) {
            $meta = $meta[0];
        } else if (isset($field['std'])) {
            $meta = $field['std'];
        } else {
            $meta = '';
        }

        // begin a table row with
        echo '<tr>
				<th><label for="' . $field['id'] . '">' . $field['label'] . '</label></th>
				<td>';
        switch ($field['type']) {
            // text
            case 'text':
                echo '<input type="text" name="' . $field['id'] . '" id="' . $field['id'] . '" value="' . $meta . '" size="50" />
								<br /><span class="description">' . $field['desc'] . '</span>';
                break;
            // textarea
            case 'textarea':
                echo '<textarea name="' . $field['id'] . '" id="' . $field['id'] . '" cols="60" rows="4">' . $meta . '</textarea>
								<br /><span class="description">' . $field['desc'] . '</span>';
                break;


            case 'media_picker':
                $a_default = 'init_edit(\'' . $field['id'] . '\',json_decode(\'' . addslashes(str_replace('"', '\'', $meta)) . '\'));';
                echo '<span ng-init="' . $a_default . '" ></span>';
                echo '<div gallerypicker ng-model="edit[\'' . $field['id'] . '\']" name="' . $field['id'] . '"></div>';
                break;

            case 'simplemediapicker':
                $a_default = 'init_edit(\'' . $field['id'] . '\',json_decode(\'' . addslashes(str_replace('"', '\'', $meta)) . '\'));';
                echo '<span ng-init="' . $a_default . '" ></span>';
                echo '<div simplemediapicker ng-model="edit[\'' . $field['id'] . '\']" name="' . $field['id'] . '" mod="image" ></div>';
                break;

            case 'select':
                $a_default = 'init_edit(\'' . $field['id'] . '\',\'' . $meta . '\');';
                echo '<div class="portfolio_select">';
                $angular = 'ng-model="edit[\'' . $field['id'] . '\']" ng-init="' . $a_default . '"';
                echo '<select class="portfolio_select " name="' . $field['id'] . '" id="' . $field['id'] . '"  ' . $angular . '>';
                if (isset($field['options']) && count($field['options']) > 0)
                    foreach ((array) $field['options'] as $select_ID => $option) {
                        echo '<option id="' . $select_ID . '" value="' . $select_ID . '" ' . selected($meta, $select_ID, false) . ' >' . $option . '</option>';
                    }
                echo '</select></div>';
                break;
        } //end switch
        echo '</td></tr>';
    } // end foreach
    echo '</table>'; // end table
}

// Save the Data - Metaboxes
function save_custom_meta_jaw_portfolio($post_id) {
    global $custom_meta_portfolio;

    // verify nonce
    // if (!wp_verify_nonce($_POST['custom_meta_box_nonce'], basename(__FILE__)))

    if (!isset($_POST['custom_meta_portfolio']) || !wp_verify_nonce($_POST['custom_meta_portfolio'], basename(__FILE__)))
        return $post_id;
    // check autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return $post_id;
    // check permissions
    if ('page' == $_POST['post_type']) {
        if (!current_user_can('edit_page', $post_id))
            return $post_id;
    } elseif (!current_user_can('edit_post', $post_id)) {
        return $post_id;
    }

    // loop through fields and save the data
    foreach ((array) $custom_meta_portfolio as $field) {
        if ($field['type'] == 'tax_select')
            continue;
        $old = get_post_meta($post_id, $field['id'], true);
        $new = $_POST[$field['id']];
        if ($new && $new != $old) {
            update_post_meta($post_id, $field['id'], $new);
        } elseif ('' == $new && $old) {
            delete_post_meta($post_id, $field['id'], $old);
        }
    } // enf foreach
}

?>
