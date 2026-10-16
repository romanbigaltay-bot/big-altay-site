<?php

if (!defined('ABSPATH')) {
    exit;
}

if (!have_rows('treatments_gallery')) {
    return;
}

the_row();

$image = get_sub_field('treatments_gallery-image');

if (empty($image)) {
    return;
}

get_template_part(
    'template-parts/ui/media',
    null,
    [
        'image'   => $image,
        'size'    => 'large',
        'ratio'   => 'landscape',
        'rounded' => true,
    ]
);

reset_rows();