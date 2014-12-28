<?php

class jwShortcodeUtils {

    public static function crop_length($string = '', $max_length = 50) {
        if (strlen($string) > $max_length) {
            return mb_substr($string, 0, $max_length, 'UTF-8') . ' ...';
        } else {
            return $string;
        }
    }
    
    /**
         * funkce: get_video_info
         * vrací z url adresy (např: http://vimeo.com/26609463) jen ID, název domény a náhledy ve 3 velikostech.
         * 
         * @param type $name Description
         * @return type Description
         * 
         */
        public static function get_video_info($video_url) {
            $ret = new video_info();
            if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $video_url, $match)) {
                $ret->id = $match[1];
                $ret->domain = 'youtube';
                $ret->thumbnails['thumbnail_small'] = "http://img.youtube.com/vi/" . $ret->id . "/default.jpg";
                $ret->thumbnails['thumbnail_medium'] = "http://img.youtube.com/vi/" . $ret->id . "/mqdefault.jpg";
                $ret->thumbnails['thumbnail_large'] = "http://img.youtube.com/vi/" . $ret->id . "/hqdefault.jpg";
            } else if (preg_match('/^http:\/\/(www\.)?vimeo\.com\/(clip\:)?(\d+).*$/', $video_url, $match)) {
                $ret->id = $match[3];
                $ret->domain = 'vimeo';
                //u vimea jde do thumbnails více informací (např: description, date, nuber of likes ...)
                $thumbnails = (wp_remote_request("http://vimeo.com/api/v2/video/" . $ret->id . ".php"));
                $thumbnails = unserialize($thumbnails['body']);
                $ret->thumbnails = $thumbnails[0];
            } else if (preg_match('/^http(s)?:\/\/(www\.)?vine\.co\/v\/(.*?)(\/.*)?$/', $video_url, $match)) {
                $ret->id = $match[3];
                $ret->domain = 'vine';
                //u vimea jde do thumbnails více informací (např: description, date, nuber of likes ...)
                $ret->thumbnails['thumbnail_medium'] = jwUtils::get_vine_thumbnail($ret->id);
            } else {
                $ret->id = $video_url;
            }
            return $ret;
        }

}

?>
