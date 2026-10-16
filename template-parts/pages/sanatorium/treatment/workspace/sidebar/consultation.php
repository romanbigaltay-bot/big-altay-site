<?php

if (!defined('ABSPATH')) {
    exit;
}
?>

<div class="bads-stack bads-stack--lg">

    <?php
    get_template_part(
        'template-parts/ui/title',
        null,
        [
            'title' => 'Нужна консультация?',
            'level' => 'h3',
            'size'  => 'sm',
        ]
    );
    ?>

    <div class="bads-content">

        <p>
            Поможем подобрать санаторий и программу лечения под ваши задачи.
        </p>

    </div>

    <?php
    get_template_part(
        'template-parts/ui/button',
        null,
        [
            'text'    => 'Получить консультацию',
            'url'     => '#lead-form',
            'variant' => 'primary',
            'class'   => 'bads-btn--full',
        ]
    );
    ?>

</div>