<section class="promotion-cta">

    <div class="container">

        <div class="promotion-cta__inner">

            <h2 class="promotion-cta__title">

                Подберем самое выгодное предложение именно для вас!

            </h2>

            <?php

            get_template_part(
                'components/forms/b24-form-compact',
                null,
                [
                    'form_id'        => 'promotion-archive',
                    'button_text'    => 'Получить специальное предложение',
                    'success_target' => 'promotion-archive-form',
                    'success_url'    => '/thank-you/main/'
                ]
            );

            ?>

        </div>

    </div>

</section>