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

                <div class="offers__wrapper">
                    <div class="filter">
                        <div class="filter__navigation">
                            <div class="filter__button" id="filterOpen">
                                <img src="<?= get_template_directory_uri(); ?>/img/main/filter.svg" alt="Фильтр">
                            </div>
                        </div>

                        <div class="filter__wrapper" id="filter">
                            <div class="filter__button-close" id="filterClose">
                                <img src="<?= get_template_directory_uri(); ?>/img/main/close.svg" alt="Закрыть">
                            </div>
                            <div class="filter__title">Фильтр</div>
                            <div class="filter__tab ac">
                                <button type="button" class="filter__trigger ac-trigger">Цена</button>
                                <div class="filter__panel ac-panel">
                                    <div class="filter__body filter__body--price">
                                        <input type="number" name="priceFrom" value="2000" placeholder="от 2000" min="1000"
                                               max="20000" step="100">
                                        <input type="number" name="priceTo" value="10000" placeholder="до 10000" min="1000"
                                               max="20000" step="100">
                                    </div>
                                </div>
                            </div>
                            <? display_acf_checkbox_values('sanatorium_stars', 598); ?>
                            <? display_acf_checkbox_values('sanatorium_filter-food', 598); ?>
                            <? if ($type == '') {
                                display_acf_checkbox_values('sanatorium_filter-treatment', 598);
                                display_acf_checkbox_values('sanatorium_filter-treatment-children', 598);
                            } ?>
                            <? display_acf_checkbox_values('sanatorium_filter-pool', 598); ?>
                            <? display_acf_checkbox_values('sanatorium_filter-with-children', 598); ?>
                            <? display_acf_checkbox_values('sanatorium_filter-infrastructure', 598); ?>
                            <? display_acf_checkbox_values('sanatorium_filter-rental', 598); ?>
                            <? display_acf_checkbox_values('sanatorium_filter-possibilities', 598); ?>
                            <? display_acf_checkbox_values('sanatorium_filter-distance', 598); ?>
                        </div>
                    </div>

                    <script>
                        function sendAjaxRequest() {
                            var xhr = new XMLHttpRequest();
                            xhr.onreadystatechange = function () {
                                if (xhr.readyState === XMLHttpRequest.DONE) {
                                    if (xhr.status === 200) {
                                        // Обработка успешного ответа от сервера
                                        updateResults(xhr.responseText);
                                    } else {
                                        // Обработка ошибки
                                        console.error('Ошибка при отправке запроса');
                                    }
                                }
                            };

                            var formData = new FormData();
                            var filterInputs = document.querySelectorAll('.filter__body input');
                            var checkboxValues = {};

                            filterInputs.forEach(function (input) {
                                if (input.type === 'checkbox') {
                                    if (!checkboxValues[input.name]) {
                                        checkboxValues[input.name] = [];
                                    }

                                    if (input.checked) {
                                        checkboxValues[input.name].push(input.value);
                                    }
                                } else {
                                    formData.append(input.name, input.value);
                                }
                            });

                            var urlParams = new URLSearchParams(window.location.search);
                            var typeParam = urlParams.get('type');
                            if (typeParam) {
                                formData.append('type', typeParam);
                            }

                            formData.append('limit', 30);

                            Object.keys(checkboxValues).forEach(function (name) {
                                checkboxValues[name].forEach(function (value) {
                                    formData.append(name + '[]', value);
                                });
                            });

                            formData.append('action', 'filter_sanatoriums');

                            xhr.open('POST', '/wp-admin/admin-ajax.php', true);
                            xhr.send(formData);
                        }

                        function updateResults(results) {
                            var filterResults = document.getElementById('filter-results');
                            filterResults.innerHTML = results;
                        }

                        function handleFormChanges() {
                            var filterForms = document.querySelectorAll('.filter__body');
                            filterForms.forEach(function (filterForm) {
                                filterForm.addEventListener('input', function () {
                                    sendAjaxRequest();
                                });
                            });
                        }

                        handleFormChanges();
                    </script>

                    <div class="offers__list" id="filter-results">
                        <?
                        $query_args = array(
                            'post_type' => 'sanatorium',
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

        <script>
            document.getElementById("filterOpen").addEventListener("click", function () {
                document.getElementById("filter").classList.add("filter__wrapper--open");
            });
            document.getElementById("filterClose").addEventListener("click", function () {
                document.getElementById("filter").classList.remove("filter__wrapper--open");
            });
        </script>

        <section class="anchor"><span id="lead-form"></span></section>
        <section class="lead-form lead-form--secondary">
            <div class="container">
                <p style="padding-top: 30px;"><?php the_field('seo-text', 'option')?></p>
            </div>
            <div class="container lead-form__container">

                <div class="lead-form__left">
                    <p class="lead-form__title">Оставьте заявку,<br>и мы подберем для<br>вас предложение!</p>
                </div>
                <? get_template_part('template-parts/components/lead-form', get_post_format(), array('id' => '537',)); ?>
            </div>

        </section>
    </main>

<?php get_footer(); ?>