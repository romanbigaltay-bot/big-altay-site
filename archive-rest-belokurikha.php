<?php get_header(); ?>

    <main>
        <section class="breadcrumbs">
            <div class="container breadcrumbs__container">
                <ul class="breadcrumbs__list">
                    <li class="breadcrumbs__item">
                        <a href="/" class="breadcrumbs__link">Главная</a>
                    </li>
                    <li class="breadcrumbs__item"><?php the_archive_title() ?></li>
                </ul>
            </div>
        </section>
        <section class="offers">
            <div class="container offers__container">
                <section class="headline-primary">
                    <h2 class="headline-primary__headline"><?php the_archive_title() ?></h2>
                </section>

                <section>
                    <script type="text/javascript" charset="utf-8"
                            src="https://stells.info/assets/js/partner.fire.js"></script>
                    <div class="s-partnership" style="display:none;">SgpnsClaWPTyH62N8lvEzZ966H7ZblFR71clDZ%2FCCzM%3D
                    </div>
                </section>

                <div class="offers__wrapper offers__wrapper--single-column">
                    <div class="offers__list">
                        <?
                        $query_args = array(
                            'post_type' => 'rest-belokurikha',
                            'post_per_page' => 30,
                            'showposts' => 30,
                            'post_status' => 'publish'
                        );
                        ?>
                        <? wp_reset_query();
                        $query = new WP_Query($query_args); ?>
                        <? if ($query->have_posts()) {
                            while ($query->have_posts()) {
                                $query->the_post();
                                get_template_part('template-parts/content/sanatorium', get_post_format());
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </section>

        <section class="anchor"><span id="lead-form"></span></section>
        <section class="lead-form lead-form--secondary">
            <div class="container">
                <p style="padding-top: 30px;"><?php the_field('seo-text', 'option')?></p>
            </div>
            <div class="container lead-form__container">
                <div class="lead-form__left">
                    <p class="lead-form__title">Оставьте заявку,<br>и мы подберем для<br>вас предложение</p>
                </div>
                <? get_template_part('template-parts/components/lead-form', get_post_format(), array('id' => '537',)); ?>
            </div>
        </section>
    </main>

<?php get_footer(); ?>