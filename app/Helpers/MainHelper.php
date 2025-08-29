<?php

if (!function_exists('format_label')) {
    function format_label(string $text): string
    {
        return collect(explode('_', $text))
            ->map(function ($word) {
                return strlen($word) <= 3 ? strtoupper($word) : ucfirst($word);
            })
            ->join(' ');
    }
}
