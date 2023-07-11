<?php
if (!function_exists('get_url')) {
    function get_url($segmentValue)
    {
        $currentURL = uri_string();

        if ($segmentValue === 'dashboard') {
            return $currentURL === '';
        }

        return strpos($currentURL, $segmentValue) !== false;
    }
}
