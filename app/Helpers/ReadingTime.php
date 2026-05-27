<?php

if (!function_exists('readingTime')) {

    function readingTime($content)
    {
        $text = strip_tags($content);

        $words = str_word_count($text);

        $minutes = ceil($words / 200);

        return max(1, $minutes).' min read';
    }
}