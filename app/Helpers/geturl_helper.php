<?php
if (!function_exists('get_url')) {
    function get_url($segmentNumber, $segmentValue)
    {
        $uri = current_url(true);
        $total = $uri->getTotalSegments();

        if ($total < $segmentNumber) {
            return false;
        }

        return $uri->getSegment($segmentNumber) == $segmentValue;
    }
}
