<?php

function replace_class_name( $block_wrapper_attributes, $block_name ) {
    if (str_contains($block_wrapper_attributes, 'class="') !== false) {
        $block_wrapper_attributes = str_replace('class="', 'class="' . "$block_name ", $block_wrapper_attributes);
    } else {
        $block_wrapper_attributes = 'class=' . "$block_name " . $block_wrapper_attributes . '"';
    }
    return $block_wrapper_attributes;
}