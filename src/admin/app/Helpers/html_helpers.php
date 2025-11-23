<?php

use Spatie\HtmlElement\HtmlElement;

if (!function_exists('el')) {
    function el(string $tag, $attributes = null, $content = null): string
    {
        return HtmlElement::render(...func_get_args());
    }
}