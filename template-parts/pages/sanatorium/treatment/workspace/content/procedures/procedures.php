<?php

if (!defined('ABSPATH')) {
    exit;
}

if (!have_rows('treatments_procedures')) {
    return;
}

$items = [];

while (have_rows('treatments_procedures')) {
    the_row();

    $items[] = [
        'title'   => get_sub_field('treatments_procedures-name'),
        'content' => get_sub_field('treatments_procedures-description'),
    ];
}

get_template_part(
    'template-parts/ui/tabs',
    null,
    [
        'items'  => $items,
        'active' => 0,
    ]
);