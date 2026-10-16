<?php
/**
 * ============================================================================
 * Big Altay Design System (BADS)
 * Direction Treatment (Профиль лечения) Page Orchestrator
 * ============================================================================
 */

if (!defined('ABSPATH')) {
    exit;
}
?>

<main class="bads-direction-treatment-page">

    <?php
    // Блок 1. Первый экран (Hero + Хлебные крошки + Нав-меню)
    get_template_part('template-parts/pages/direction-treatment/hero/hero');
	
	// Блок 1.1. Компактная форма быстрой консультации (Только телефон + кнопка)
    get_template_part('template-parts/pages/direction-treatment/quick-form/quick-form');

    // Блок 2. Заболевания и показания
    get_template_part('template-parts/pages/direction-treatment/indications/indications');

    // Блок 3. Методы лечения
    get_template_part('template-parts/pages/direction-treatment/methods/methods');

    // Блок 4. Противопоказания
    get_template_part('template-parts/pages/direction-treatment/contraindications/contraindications');

    // Блок 5. Программы лечения
    get_template_part('template-parts/pages/direction-treatment/programs/programs');

    // Блок 6. Что входит в путёвку
    get_template_part('template-parts/pages/direction-treatment/included/included');

    // Блок 7. Санатории с данным профилем лечения
    get_template_part('template-parts/pages/direction-treatment/sanatoriums/sanatoriums');

    // Блок 8. Другие профили лечения
    get_template_part('template-parts/pages/direction-treatment/other-profiles/other-profiles');

    // Блок 9. FAQ по лечению
    get_template_part('template-parts/pages/direction-treatment/faq/faq');

    // Блок 10. Форма подбора и консультации
    get_template_part('template-parts/pages/direction-treatment/form/form');
    ?>

</main>
