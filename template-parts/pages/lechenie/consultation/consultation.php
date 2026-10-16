<?php
if (!defined('ABSPATH')) { exit; }
?>
<section class="bads-section bads-section--xl" style="background-color: var(--color-primary); color: #fff;">
    <div class="bads-container bads-container--md">
        <div class="bads-stack bads-stack--xl bads-stack--text-center">
            
            <?php
            get_template_part('template-parts/ui/title', null, [
                'title'    => 'Остались вопросы по бронированию?',
                'subtitle' => 'Позвоните нам или закажите обратный звонок. Мы работаем ежедневно с 08:00 до 20:00 (МСК+4).',
                'level'    => 'h2',
                'align'    => 'center',
            ]);
            ?>

            <div class="bads-cluster bads-cluster--center bads-cluster--md">
                <?php
                get_template_part('template-parts/ui/button', null, [
                    'text'    => '8 (800) 500-00-00',
                    'url'     => 'tel:88005000000',
                    'variant' => 'secondary', // Белая кнопка или контурная
                    'size'    => 'lg',
                ]);
                ?>
                <?php
                get_template_part('template-parts/ui/button', null, [
                    'text'    => 'Заказать звонок',
                    'url'     => '#consultation',
                    'variant' => 'outline', 
                    'size'    => 'lg',
                ]);
                ?>
            </div>

        </div>
    </div>
</section>
