<section class="online-booking" id="online-booking">
    <div class="container online-booking__container">
        
        <div class="online-booking__grid">

            <div class="online-booking__header">
                <h3 class="online-booking__title">Оставьте заявку!</h3>
                <p class="online-booking__subtitle">
                    Мы свяжемся с вами, уточним детали и подберём лучший вариант отдыха
                </p>
            </div>

            <div class="online-booking__box">
                <?php
				
				$current_slug = get_post_field('post_name');

				$thank_you_pages = [
					'belokuriha' 	 => '/thank-you/sanatorij-belokuriha/',
					'katun'      	 => '/thank-you/sanatorij-katun/',
					'sibir'     	 => '/thank-you/sanatorij-sibir/',
					'sovremennik-18' => '/thank-you/sovremennik-18/',
				];

				$success_url =
					$thank_you_pages[$current_slug]
					?? '/thank-you/';
				
                    get_template_part(
                        'components/forms/b24-form',
                        null,
                        [
                            'form_id' => 'online-booking',
                            'button_text' => 'Отправить',
                            'success_target' => 'online-booking-success',
							'success_url' => $success_url,
                            'centered' => false // Отключаем центрирование формы для аккуратного вида
                        ]
                    );
                ?>
            </div>          
            
        </div>
        
    </div>
</section>