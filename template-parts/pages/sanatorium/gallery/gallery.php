<?php
/**
 * ============================================================================
 * Sanatorium
 * Gallery
 * ============================================================================
 */

$images = [];

if (have_rows('sanatorium_about-photo')) {

    while (have_rows('sanatorium_about-photo')) {

        the_row();

        $image = get_sub_field('sanatorium_about-photo-img');

        if ($image) {
            $images[] = $image;
        }

    }

}

if (empty($images)) {
    return;
}

$layout = bads_gallery_build_layout($images);

?>

<section
    id="gallery"
    class="bads-section bads-section--lg">

    <div class="bads-container">

        <?php
        get_template_part(
            'template-parts/ui/title',
            null,
            [
                'title' => 'Фотогалерея',
                'level' => 'h2',
                'class' => 'u-visually-hidden',
            ]
        );
        ?>

        <?php foreach ($layout as $segment) : ?>

            <div class="bads-gallery">

                <?php foreach ($segment['items'] as $item) : ?>

                    <a
                        href="<?= esc_url(wp_get_attachment_image_url($item['image'], 'full')); ?>"
                        class="bads-gallery__item bads-gallery__item--<?= esc_attr($item['shape']); ?>"
                        data-fancybox="fancybox-gallery"
                    >

                        <?php

                        $ratio = match ($item['shape']) {

                            '2x2' => 'square',
                            '1x2' => 'portrait',
                            '2x1' => 'landscape',
                            default => 'square',

                        };

                        get_template_part(
                            'template-parts/ui/media',
                            null,
                            [
                                'image'   => $item['image'],
                                'size'    => 'large',
                                'ratio'   => $ratio,
                                'rounded' => true,
                            ]
                        );

                        ?>

                    </a>

                <?php endforeach; ?>

            </div>

        <?php endforeach; ?>

    </div>

</section>