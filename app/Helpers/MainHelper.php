<?php

if (!function_exists('format_label')) {
    function format_label(string|null $text): string
    {
        if(!$text) return "-";

        $exceptions = ['dan', 'atau', 'yang', 'dari', 'ke', 'di', 'ada'];

        $words = explode('_', strtolower(trim($text)));

        return collect($words)
            ->map(function ($word, $index) use ($exceptions) {
                if (in_array($word, $exceptions)) {
                    return $index === 0 ? ucfirst($word) : $word;
                }

                return strlen($word) <= 3
                    ? strtoupper($word)
                    : ucfirst($word);
            })
            ->join(' ');
    }
}
