<div class="mega-menu__form">

    <h3>
        Оставьте заявку,
        и мы подберем для вас предложение
    </h3>

    <?php
    get_template_part(
        'components/forms/b24-booking-form',
        null,
        [
            'form_id' => 'mega-menu-booking',
            'button_text' => 'Подобрать',
            'success_target' => 'mega-menu-success'
        ]
    );
    ?>

    <div
        id="mega-menu-success"
        class="mega-menu-success"
    >
        Спасибо за заявку!
    </div>

</div>