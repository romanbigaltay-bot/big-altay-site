<?php

if (!defined('ABSPATH')) {
    exit;
}

?>

<section  class="anchor"> <span id="consultation" ></span> </section>

<section  class="bads-section bads-section--lg">	
	
    <div class="bads-container bads-container--md">

        <div class="bads-stack bads-stack--xl bads-stack--text-center">

            <?php
            get_template_part(
                'template-parts/ui/title',
                null,
                [
                    'title' => 'Подберем санаторий и профиль лечения именно для вас!',
                    'level' => 'h2',
                    'size'  => 'h3',
                    'align' => 'center',
                ]
            );
            ?>

            <?php
            get_template_part(
                'components/forms/b24-form-compact',
                null,
                [
                    'form_id'        => 'treatment-archive',
                    'form_title'     => 'Подбор санатория и профиля лечения',
                    'button_text'    => 'Получить консультацию специалиста',
                    'success_target' => 'treatment-archive-form',
                    'success_url'    => '/thank-you/lechenie/',
                ]
            );
            ?>

        </div>

    </div>

</section>