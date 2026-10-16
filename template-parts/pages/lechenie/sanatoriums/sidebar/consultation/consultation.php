<?php

if (!defined('ABSPATH')) {
    exit;
}

?>

<div class="bads-card bads-card--glass bads-card--padding-lg">

    <div class="bads-stack bads-stack--lg">

        <?php
        get_template_part(
            'template-parts/ui/title',
            null,
            [
                'title'    => 'Нужна консультация?',
                'subtitle' => 'Поможем подобрать санаторий и программу лечения под ваши задачи.',
                'level'    => 'h4',
            ]
        );
        ?>

        <?php
        get_template_part(
            'template-parts/ui/button',
            null,
            [
                'text'    => 'Получить консультацию',
                'url'     => '#consultation',
                'variant' => 'primary',
                'size'    => 'md',
            ]
        );
        ?>

    </div>

</div>