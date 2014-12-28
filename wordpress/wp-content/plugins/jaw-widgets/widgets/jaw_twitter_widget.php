<?php
/* * **
 * Twitter widget - nejdriv se podiva do cache. pokud neni, nebo je prosla
 * pak stahne pomoci wp_remote tweety. Je potreba doplnit funkce _getOption
 * a _setOption vasima j(e)wOptions.
 * 
 * samotne tisknuti je ve funkci widget( $args, $instance). Pokud jsou data
 * null, pak se nepodarilo spojeni a netisknout :)
 * 
 * 
 * 
 * 
 */

class jaw_twitter_widget extends jaw_default_widget {

    private static $_model = null;

    /**
     *  Defining the widget options
     */
    protected $options = array(
        0 => array('id' => 'widget_title',
            'description' => 'Title',
            'type' => 'text',
            'default' => 'Latest Tweets'),
        1 => array('id' => 'user_name',
            'description' => 'User name (don`t forget set Twitter API in Theme Options -> Advanced)',
            'type' => 'text',
            'default' => ''),
        2 => array('id' => 'tweet_count',
            'description' => 'Tweet count',
            'type' => 'text',
            'default' => '3'),
        3 => array('id' => 'tweet_actualizate',
            'description' => 'Actualize every X minutes',
            'type' => 'text',
            'default' => '60'),
    );

    /**
     * Registering the widget to the wordpress
     */
    function jaw_twitter_widget() {
        $options = array('classname' => 'jwTwitterWidget', 'description' => "Theme-based Twitter preview");
        $controls = array('width' => 250, 'height' => 200);
        $this->WP_Widget('jwTwitterWidget', 'J&W - Twitter Widget', $options, $controls);
    }

    /**
     * Printing widget, called by wordpress
     */
    function widget($args, $instance) {
        $model = $this->_getModel();
        if (!isset($instance['user_name']) || $instance['user_name'] == '') {
            $tw = new stdClass();
            $tw->tweet = 'Please set Twitter user name in jwTwitter widget';
            $tweets = array(1 => $tw);
        }else{
            $tweets = $model->getTweets($instance['user_name'], $instance['tweet_count'], $instance['tweet_actualizate']);   
        }
        
        $ret['args'] = $args;
        $ret['instance'] = $instance;
        $ret['tweets'] = $tweets;
        jaw_template_set_data($ret,$this);
        echo jaw_get_template_part('jaw_twitter_widget','widgets');
        
    }

    /**
     * @return jwTwitterModel
     */
    private function _getModel() {
        if (self::$_model == null) {
            self::$_model = new jwTwitterModel();
        }

        return self::$_model;
    }

}

class oneTweet {

    public $name = null;
    public $tweet = null;
    public $date = null;
    public $dateUnparsed = null;

}

class jwTwitterModel {

    private function _time_elapsed_array($time) {
        $etime = time() - $time;

        if ($etime < 1) {
            $toReturn = array(0, 'seconds');
            return $toReturn;
        }

        $a = array(12 * 30 * 24 * 60 * 60 => 'year',
            30 * 24 * 60 * 60 => 'month',
            24 * 60 * 60 => 'day',
            60 * 60 => 'hour',
            60 => 'minute',
            1 => 'second'
        );

        $ab = array(
            'second' => 0,
            'minute' => 1,
            'hour' => 2,
            'day' => 3,
            'month' => 4,
            'year' => 5,
        );

        foreach ($a as $secs => $str) {
            $d = $etime / $secs;
            if ($d >= 1) {

                $r = floor($d);
                $toReturn = array();
                $toReturn[] = $r;
                $toReturn[] = $ab[$str];
                $toReturn[] = ($d - $r) * $secs;
                $toReturn[] = $str . ($r > 1 ? 's' : '');
                $toReturn[] = $r . ' ' . $str . ($r > 1 ? 's' : '');

                return $toReturn;
            }
        }
    }

    private function timeToString($seconds, $sentence) {
        $sec_new = substr($seconds, 5);
        $sec_new = strtotime($sec_new);

        $firstTime = $this->_time_elapsed_array($sec_new);

        $replacement = $firstTime[4];
        if ($firstTime[1] > 0) {

            $secondTime = $this->_time_elapsed_array(time() - $firstTime[2]);
            $replacement .= ', ' . $secondTime[4];
        }
        $toReturn = sprintf($sentence, $replacement);


        return $toReturn;
    }

    private function _getOption($namespace, $name) {
        return get_option($namespace . '_' . $name);
    }

    private function _setOption($namespace, $name, $value) {
        update_option($namespace . '_' . $name, $value);
    }

    /**
     * @return array[oneTweet]
     */
    public function getTweets($username, $numOfTweets, $cachingInterval, $sentence = 'About %s ago') {

        require_once JAW_WIDGETS_DIR . '/OAuth/OAuth.php';
        require_once JAW_WIDGETS_DIR . '/OAuth/twitteroauth.php';

        //$username = fOpt::Get('twitter', 'username');
        $username_hash = base64_encode($username);
        $namespace = 'twt_' . $username_hash;
        $cachingIntervalInMinutes = $cachingInterval;
        $numberOfTweets = $numOfTweets;

        $twitter_feed = $this->_getOption($namespace, 'rss_feed');
        if ($twitter_feed != null)
            $twitter_feed = unserialize($twitter_feed);

        $cache_time = $this->_getOption($namespace, 'last_actualization');
        if ($cache_time == null || ( $cache_time + ( 60 * $cachingIntervalInMinutes ) ) < time() || $twitter_feed == null) {


            $connection = new TwitterOAuth(jwOpt::get_option('tw_consumer_id', ''), jwOpt::get_option('tw_consumer_secret', ''), jwOpt::get_option('tw_access_id', ''), jwOpt::get_option('tw_access_secret', ''));
            $search_feed3 = "https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=" . $username . "&count=" . $numOfTweets;
            $reponse = $connection->get($search_feed3);
            // var_dump($reponse);


            if ($reponse instanceof WP_Error)
                return null;

            if (isset($reponse->errors)) {
                $return = new oneTweet();
                switch ($reponse->errors[0]->code) {
                    case 32: $return->tweet = 'Please check setting Twitter API in Theme Options -> Advanced?';
                        break;
                    case 88: $return->tweet = 'Rate limit exceeded, please check "Actualize every X minutes" item in Twitter J&W Widget. Recommended value is 60.';
                        break;
                    case 215: $return->tweet = 'Don`t you have set Twitter API in Theme Options -> Advanced?';
                        break;
                    default: $return->tweet = 'Your user name is probably wrong<br>Please check it';
                        break;
                }
                return array(1 => $return);
            }

            $twitter_parsed_data = array();

            foreach ($reponse as $i => $tweet) {
                $twitter_parsed_data[$i]['description'] = $tweet->text;
                $twitter_parsed_data[$i]['date'] = $tweet->created_at;
            }

            $twitter_feed = $twitter_parsed_data;

            $twitter_parsed_data = serialize($twitter_parsed_data);
            $this->_setOption($namespace, 'rss_feed', $twitter_parsed_data);
            $this->_setOption($namespace, 'last_actualization', time());
        } else {
            
        }

        if (empty($twitter_feed))
            return null;
        $tweetCollection = array();
        foreach ($twitter_feed as $tweetUnparsed) {   
            $tweet = new oneTweet();
            $tweet->tweet = $this->_replaceContent($tweetUnparsed['description'], $username);
            $tweet->name = $username;
            $tweet->date = $this->timeToString($tweetUnparsed['date'], $sentence);
            $tweet->dateUnparsed = $tweetUnparsed['date'];
            $tweetCollection[] = $tweet;
        }
        return $tweetCollection;
    }

    private function _replaceContent($tweetContent, $username) {
        $tweetContentWithoutUsername = str_replace($username . ':', '', $tweetContent);
        $tweetContentWithLinks = preg_replace('!((?:www|http://)[^ ]+)!', '<a href="\1">\1</a>', $tweetContentWithoutUsername);
        return $tweetContentWithLinks;
    }

}