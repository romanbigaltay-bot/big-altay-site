<div class="lead-form__right" id="form-contacts-popup">

    <?php
	$current_slug = get_post_field('post_name');

		$thank_you_pages = [
			'sanatorij-belokuriha' => '/thank-you/sanatorij-belokuriha/',
			'sanatorij-katun'      => '/thank-you/sanatorij-katun/',
			'sanatorij-sibir'      => '/thank-you/sanatorij-sibir/',
		];

		if (is_front_page()) {
			$success_url = '/thank-you/main/';
		} else {
			$success_url = $thank_you_pages[$current_slug] ?? '/thank-you/';
		}
	
    get_template_part(
        'components/forms/b24-form',
        null,
        [
            'form_id' => 'popup-consult',
            'button_text' => 'Получить консультацию',
            'success_target' => 'form-contacts-popup',
			'success_url' => $success_url,
			'centered' => true
        ]
    );
    ?>
</div>