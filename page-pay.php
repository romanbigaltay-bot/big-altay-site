<?php get_header(); ?>

    <main>
        <section class="breadcrumbs">
            <div class="container breadcrumbs__container">
                <ul class="breadcrumbs__list">
                    <li class="breadcrumbs__item">
                        <a href="/" class="breadcrumbs__link">Главная</a>
                    </li>
                    <li class="breadcrumbs__item"><? the_title(); ?></li>
                </ul>
            </div>
        </section>
        <section class="post">
            <div class="container">
                <section class="headline-primary">
                    <h1 class="headline-primary__headline"><? the_title(); ?></h1>
                </section>
                <section class="post-body post-body--pay">
                    <div class="post-body__text">
                        <?= the_content(); ?>
                    </div>
                </section>
            </div>

            <section class="anchor"><span id="lead-form"></span></section>
            <section class="lead-form lead-form--secondary">
                <div class="container lead-form__container">
                    <div class="lead-form__left">
                        <p class="lead-form__title">Оставьте заявку,<br>и мы подберем для<br>вас
                            предложение</p>
                    </div>
                    <? get_template_part('template-parts/components/lead-form', get_post_format(), array('id' => '537',)); ?>
                </div>
            </section>
        </section>
    </main>

<?php get_footer(); ?>