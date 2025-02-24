<?php
function custom_excerpt_by_chars($excerpt) {
    return mb_strimwidth($excerpt, 0, 200, '...');
}
add_filter('get_the_excerpt', 'custom_excerpt_by_chars');

function custom_excerpt_more($more) {
    return ' <a href="' . get_permalink() . '">Read More</a>';
}
add_filter('excerpt_more', 'custom_excerpt_more');
