<div class="lead-form__right" id="form-contacts-popup-same">

    <?php
    get_template_part(
        'components/forms/b24-form',
        null,
        [
            'form_id' => 'popup-request',
            'button_text' => 'Оставить заявку',
            'success_target' => 'form-contacts-popup-same',
			'centered' => true
        ]
    );
    ?>  
</div>