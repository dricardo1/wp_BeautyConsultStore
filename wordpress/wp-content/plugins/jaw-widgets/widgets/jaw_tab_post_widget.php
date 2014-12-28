<?php

/**
 * Prints 4 types of feed:
 * Popular ( posts )
 * Recent ( posts )
 * Comments ( comment )
 * Tags ( in post table )
 * 
 * 
 * informace jsou ve funkci widget, doporucuju kazdou promenou vardumpnout
 */
class jaw_tab_post_widget extends jaw_default_widget {

    /**
     *  Defining the widget options
     */
    protected $options = array(
        /*         * *************************************************************************** */
        /* POPULAR AREA
          /***************************************************************************** */
        0 => array('id' => 'popular_show',
            'description' => 'Show popular posts ',
            'type' => 'checkbox', // [[ text, check, select ]]
            'default' => 1),
        1 => array('id' => 'popular_title',
            'description' => 'Popular posts title:',
            'type' => 'text', // [[ text, check, select ]]
            'default' => 'Popular'),
        2 => array('id' => 'popular_categories',
            'description' => 'Exclude / include categories by id. E.g. 1,5,-8:',
            'type' => 'text', // [[ text, check, select ]]
            'default' => ''),
        3 => array('id' => 'popular_num_of_posts',
            'description' => 'Number of popular posts to show:',
            'type' => 'text', // [[ text, check, select ]]
            'default' => '5'),
        /*         * *************************************************************************** */
        /* RECENT AREA
          /***************************************************************************** */
        4 => array('id' => 'recent_show',
            'description' => 'Show recent posts ',
            'type' => 'checkbox', // [[ text, check, select ]]
            'default' => 1),
        5 => array('id' => 'recent_title',
            'description' => 'Recent posts title:',
            'type' => 'text', // [[ text, check, select ]]
            'default' => 'Recent'),
        6 => array('id' => 'recent_categories',
            'description' => 'Exclude / include categories by id. E.g. 1,5,-8:',
            'type' => 'text', // [[ text, check, select ]]
            'default' => ''),
        7 => array('id' => 'recent_num_of_posts',
            'description' => 'Number of recent posts to show:',
            'type' => 'text', // [[ text, check, select ]]
            'default' => '5'),
        /*         * *************************************************************************** */
        /* COMMENTS AREA 
          /***************************************************************************** */
        8 => array('id' => 'comments_show',
            'description' => 'Show recent comments ',
            'type' => 'checkbox', // [[ text, check, select ]]
            'default' => 1),
        9 => array('id' => 'comments_title',
            'description' => 'recent comments title:',
            'type' => 'text', // [[ text, check, select ]]
            'default' => 'Comments'),
        10 => array('id' => 'comments_num_of_posts',
            'description' => 'Number of recent comments to show:',
            'type' => 'text', // [[ text, check, select ]]
            'default' => '5'),
        /*         * *************************************************************************** */
        /* TAGS AREA
          /***************************************************************************** */
        11 => array('id' => 'tags_show',
            'description' => 'Show tags ',
            'type' => 'checkbox', // [[ text, check, select ]]
            'default' => 1),
        12 => array('id' => 'tags_title',
            'description' => 'tags title:',
            'type' => 'text', // [[ text, check, select ]]
            'default' => 'Tags'),
        13 => array('id' => 'tags_num_of_posts',
            'description' => 'Number of tags to show:',
            'type' => 'text', // [[ text, check, select ]]
            'default' => '5'),
        /*         * *************************************************************************** */
        /* RATINGS AREA
          /***************************************************************************** */
        16 => array('id' => 'ratings_show',
            'description' => 'Show rating`s posts',
            'type' => 'checkbox', // [[ text, check, select ]]
            'default' => 1),
        17 => array('id' => 'ratings_title',
            'description' => 'Ratings title:',
            'type' => 'text', // [[ text, check, select ]]
            'default' => 'Ratings'),
        18 => array('id' => 'ratings_categories',
            'description' => 'Exclude / include categories by id. E.g. 1,5,-8:',
            'type' => 'text', // [[ text, check, select ]]
            'default' => ''),
        19 => array('id' => 'rats_num_of_posts',
            'description' => 'Number of rating`s posts to show:',
            'type' => 'text', // [[ text, check, select ]]
            'default' => '3'),
    );

    /**
     * Registering the widget to the wordpress
     */
    function jaw_tab_post_widget() {
        
        $options = array('classname' => 'tab_post_widget', 'description' => "Theme styled recent and popular posts, comments and tags to be displayed in a preview tabs");
        $controls = array('width' => 250, 'height' => 200);
        $this->WP_Widget('tab_posts', 'J&W - Tab Posts Widget', $options, $controls);
    }

    /*     * *************************************************************************** */
    /*     * *************************************************************************** */
    /*     * *************************************************************************** */
    /* EDIT THIS FUNCTION
      /***************************************************************************** */
    /*     * *************************************************************************** */
    /*     * *************************************************************************** */

    private function _print_widget($args, $instance, $feedData) {
        global $post;
        /*
         * data naleznes ve stdClass feedData.
         * Ma nasledujici attributy:
         * - popular_posts			// klasicky post
         * - recent_posts			// klasicky post
         * - recent_comments		// class comment
         * - tags					// class tag
         * 
         * !! V pripade ze tisknes post, je moznost ze se neaplikuji vsechny 
         * filtry ( napr na post content nebo excerpt). Pokud by to blblo, tak :
         * 
         * foreach( $feedData->popular_posts as $post ) {
         * 	setup_postdata( $post );
         * 	the_title(), the_content() || get_the_title(), get_the_content;
         * }
         * 
         * jinak presny struktury jednotlivych trid neznam, resil bych to stejne
         * jak ty var_dump, tak v tom neporadim :(
         * 
         * pokud nejsou zadna data, tak je promenna nastavena na null
         */
        
        $ret['args'] = $args;
        $ret['instance'] = $instance;
        $ret['feedData'] = $feedData;
        
        jaw_template_set_data($ret,$this);
        echo jaw_get_template_part('jaw_tab_post_widget','widgets');
        
    }

    /**
     * Printing widget, called by wordpress
     */
    function widget($args, $instance) {
        $feedData = $this->_collect_data($instance);
        $this->_print_widget($args, $instance, $feedData);
    }

    /*     * *************************************************************************** */
    /* COLLECTING DATA
      /***************************************************************************** */

    private function _collect_data($instance) {
        $feedData = new stdClass();
        $feedData->number_of_sections = 0;
        $feedData->popular_posts = null;
        $feedData->recent_posts = null;
        $feedData->recent_comments = null;
        $feedData->tags = null;
        $feedData->ratings = null;


        if (isset($instance['popular_show']) && $instance['popular_show'] == 1) {
            $popular_posts = $this->_get_popular_posts($instance);
            if (!empty($popular_posts)) {
                $feedData->popular_posts = $popular_posts;
                $feedData->number_of_sections++;
            }
        }

        if (isset($instance['recent_show']) && $instance['recent_show'] == 1) {
            $recent_posts = $this->_get_recent_posts($instance);
            if (!empty($recent_posts)) {
                $feedData->recent_posts = $recent_posts;
                $feedData->number_of_sections++;
            }
        }

        if (isset($instance['comments_show']) && $instance['comments_show'] == 1) {
            $recent_comments = $this->_get_recent_comments($instance);
            if (!empty($recent_comments)) {
                $feedData->recent_comments = $recent_comments;
                $feedData->number_of_sections++;
            }
        }

        if (isset($instance['tags_show']) && $instance['tags_show'] == 1) {
            $tags = $this->_get_tags($instance);
            if (!empty($tags)) {
                $feedData->tags = $tags;
                $feedData->number_of_sections++;
            }
        }
        if (isset($instance['ratings_show']) && $instance['ratings_show'] == 1) {
            $ratings = $this->_get_ratings_posts($instance);
            if (!empty($ratings)) {
                $feedData->ratings = $ratings;
                $feedData->number_of_sections++;
            }
        }

        return $feedData;
    }

    private function _get_tags($instance) {
        $args = array('number' => $instance['tags_num_of_posts']);
        $tags = get_tags($args);
        return $tags;
    }

    private function _get_recent_comments($instance) {
        $args = array('number' => $instance['comments_num_of_posts'], 'status' => 'approve');
        $comments = get_comments($args);
        return $comments;
    }

    private function _get_popular_posts($instance) {
        $args = array('orderby' => 'comment_count', 'order' => 'desc', 'numberposts' => $instance['popular_num_of_posts']);
        if (!empty($instance['popular_categories']))
            $args['category'] = $instance['popular_categories'];
        $posts = get_posts($args);
        return $posts;
    }

    private function _get_recent_posts($instance) {
        $args = array('orderby' => 'post_date', 'order' => 'desc', 'numberposts' => $instance['recent_num_of_posts']);
        if (!empty($instance['recent_categories']))
            $args['category'] = $instance['recent_categories'];
        $posts = get_posts($args);
        return $posts;
    }

    private function _get_ratings_posts($instance) {
        $args = array('orderby' => 'post_date', 'order' => 'desc', 'numberposts' => $instance['rats_num_of_posts'], 'meta_key' => 'fw_rating_overal', 'meta_value' => '1');
        if (!empty($instance['ratings_categories']))
            $args['category'] = $instance['ratings_categories'];
        $posts = get_posts($args);
        return $posts;
    }

}
