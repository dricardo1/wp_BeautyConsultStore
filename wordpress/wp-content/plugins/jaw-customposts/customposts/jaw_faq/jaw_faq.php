<?php

/**
 * Post Faq
 * @author JaW Templates <http://www.jawtemplates.com>
 * @copyright (c) 2013, CCB, spol. s r.o.
 * @version 1.0
 */
add_action('init', 'register_jaw_faq');


//add_action('add_meta_boxes', 'add_custom_meta_box_jaw_faq');
add_action('save_post', 'save_custom_meta_jaw_faq');

function register_jaw_faq() {
    global $jaw_customposts_class;
    $data = $jaw_customposts_class->getData();
    $rewrite = 'jaw_faq';
    if (isset($data['active']['jaw_faq']['rewrite'])) {
        $rewrite = $data['active']['jaw_faq']['rewrite'];
    }
    
    $labels = array(
        'name' => __('FAQ', 'jaw_cp'),
        'singular_name' => __('FAQ Item', 'jaw_cp'),
        'add_new' => __('Add New', 'jaw_cp'),
        'add_new_item' => __('Add New FAQ Item', 'jaw_cp'),
        'edit_item' => __('Edit FAQ Item', 'jaw_cp'),
        'new_item' => __('New FAQ Item', 'jaw_cp'),
        'view_item' => __('View FAQ Item', 'jaw_cp'),
        'search_items' => __('Search FAQ Items', 'jaw_cp'),
        'not_found' => __('No FAQ items found', 'jaw_cp'),
        'not_found_in_trash' => __('No FAQ items found in Trash', 'jaw_cp'),
        'parent_item_colon' => __('Parent FAQ:', 'jaw_cp'),
    );

    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'description' => __('Custom Post Type - Faq Pages', 'jaw_cp'),
        'supports' => array('title', 'editor'),
        'taxonomies' => array('jaw-faq-category'),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 20,
        'menu_icon' => plugins_url('images/faq.png', __FILE__),
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => array('slug' => $rewrite),
        'capability_type' => 'post'
    );

    register_post_type('jaw-faq', $args);

    // "Faq Categories" Custom Taxonomy
    $labels = array(
        'name' => __('Faq Categories', 'jaw_cp'),
        'singular_name' => __('Faq Category', 'jaw_cp'),
        'search_items' => __('Search Faq Categories', 'jaw_cp'),
        'all_items' => __('All Faq Categories', 'jaw_cp'),
        'parent_item' => __('Parent Faq Category', 'jaw_cp'),
        'parent_item_colon' => __('Parent Faq Category:', 'jaw_cp'),
        'edit_item' => __('Edit Faq Category', 'jaw_cp'),
        'update_item' => __('Update Faq Category', 'jaw_cp'),
        'add_new_item' => __('Add New Faq Category', 'jaw_cp'),
        'new_item_name' => __('New Faq Category Name', 'jaw_cp'),
        'menu_name' => __('Faq Categories', 'jaw_cp')
    );

    $args = array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'jaw-faq-category')
    );

    register_taxonomy('jaw-faq-category', array('jaw-faq'), $args);
}

function add_custom_meta_box_jaw_faq() {
    add_meta_box(
            'jaw_faq_meta_box', // $id
            __('Faq Settings', 'jaw_cp'), // $title
            'show_custom_meta_box_jaw_faq', // $callback
            'jaw-faq', // $page
            'normal', // $context
            'high'); // $priority
}

// The Callback Meta Boxes
function show_custom_meta_box_jaw_faq() {
    global $custom_meta_faq, $post;
    // Use nonce for verification
    if (isset($custom_meta_faq)) {
        echo '<input type="hidden" name="custom_meta_box_nonce" value="' . wp_create_nonce(basename(__FILE__)) . '" />';

        // Begin the field table and loop
        echo '<table class="form-table">';
        foreach ((array) $custom_meta_faq as $field) {
            // get value of this field if it exists for this post
            $meta = get_post_meta($post->ID, $field['id'], true);
            // begin a table row with
            echo '<tr>
				<th><label for="' . $field['id'] . '">' . $field['label'] . '</label></th>
				<td>';
            switch ($field['type']) {
                // text
                case 'text':
                    echo '<input type="text" name="' . $field['id'] . '" id="' . $field['id'] . '" value="' . $meta . '" size="30" />
								<br /><span class="description">' . $field['desc'] . '</span>';
                    break;
                // textarea
                case 'textarea':
                    echo '<textarea name="' . $field['id'] . '" id="' . $field['id'] . '" cols="60" rows="4">' . $meta . '</textarea>
								<br /><span class="description">' . $field['desc'] . '</span>';
                    break;

                // repeatable image
            } //end switch
            echo '</td></tr>';
        } // end foreach
        echo '</table>'; // end table
    }
}

// Save the Data - Metaboxes
function save_custom_meta_jaw_faq($post_id) {
    global $custom_meta_fields;

    // verify nonce
    // if (!wp_verify_nonce($_POST['custom_meta_box_nonce'], basename(__FILE__)))

    if (!isset($_POST['custom_meta_box_nonce']) || !wp_verify_nonce($_POST['custom_meta_box_nonce'], basename(__FILE__)))
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
    foreach ((array) $custom_meta_fields as $field) {
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
