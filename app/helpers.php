<?php

if (!function_exists('trimmed_output_buffer')) {
    function trimmed_output_buffer($callback)
    {
        ob_start();
        $callback();

        return trim(ob_get_clean());
    }
}

if (!function_exists('color_opacity')) {
    function color_opacity($hex, $a)
    {
        list($r, $g, $b) = sscanf($hex, '#%02x%02x%02x');

        $r = $r * $a + 255 * (1 - $a);
        $g = $g * $a + 255 * (1 - $a);
        $b = $b * $a + 255 * (1 - $a);

        return sprintf('rgb(%s,%s,%s)', $r, $g, $b);
    }
}

if (!function_exists('trimmed_empty')) {
    function trimmed_empty($val)
    {
        return empty(trim((string) $val));
    }
}

if (!function_exists('prepend_subdomain')) {
    function prepend_subdomain($subdomain)
    {
        $scheme = parse_url(config('app.url'), PHP_URL_SCHEME);
        $host = parse_url(config('app.url'), PHP_URL_HOST);

        return sprintf('%s://%s.%s', $scheme, $subdomain, $host);
    }
}
