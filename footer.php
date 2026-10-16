<?php
$phone = get_field('phone_1', 2) ?: '8 800 500-07-34';
$phone_clean = preg_replace('/[^0-9+]/', '', $phone);
$address = get_field('address', 2) ?: 'г. Белокуриха, ул. Славского, 47';
$vk_url = get_field('vk', 2) ?: 'https://vk.com/bolshoyaltay';
?>
<footer class="footer">
    <div class="container footer__container">
        <div class="footer-column">
            <div class="footer-column__logo">
                <a href="/">
                    <picture>
                        <source srcset="<?= get_template_directory_uri(); ?>/img/header/logo.webp" type="image/webp">
                        <img src="<?= get_template_directory_uri(); ?>/img/header/logo.png" alt="Большой Алтай"
                             class="footer-column__logo-img">
                    </picture>
                </a>
            </div>
            <div class="footer-column__copyright">© <?= date('Y'); ?>, Все права защищены</div>
            <a href="/privacy.pdf" class="footer-column__privacy" target="_blank">Политика конфиденциальности</a><br>
			<a href="/soglasie-na-obrabotku-personalnyh-dannyh/" class="footer-column__privacy" target="_blank">Согласие на обработку персональных данных</a>
        </div>
        <div class="footer-column">
            <nav class="footer-column-menu">
                <ul class="footer-column-menu__list">
                    <li class="footer-column-menu__item">
                        <a href="/divisions/" class="footer-column-menu__link hover">О нас</a>
                    </li>
                    <li class="footer-column-menu__item">
                        <a href="/sanatorium/" class="footer-column-menu__link hover">Санатории</a>
                    </li>
                    <li class="footer-column-menu__item">
                        <a href="/lechenie/" class="footer-column-menu__link hover">Лечение</a>
                    </li>
                    <li class="footer-column-menu__item">
                        <a href="/rest-belokurikha/" class="footer-column-menu__link hover">Отдых в Белокурихе</a>
                    </li>
                    <li class="footer-column-menu__item">
                        <a href="/rest-altai-mountains/" class="footer-column-menu__link hover">Отдых в Горном Алтае</a>
                    </li>
                    <li class="footer-column-menu__item">
                        <a href="/rest-belokurikha/baza-otdyha-kalina-krasnaya/" class="footer-column-menu__link hover">Калина красная</a>
                    </li>
                    <li class="footer-column-menu__item">
                        <a href="/new-year/" class="footer-column-menu__link hover">Новый год в Белокурихе</a>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="footer-column">
            <nav class="footer-column-menu">
                <ul class="footer-column-menu__list">                    
                    <li class="footer-column-menu__item">
                        <a href="/tours/" class="footer-column-menu__link hover">Туры</a>
                    </li>
                    <li class="footer-column-menu__item">
                        <a href="/excursions/" class="footer-column-menu__link hover">Экскурсии</a>
                    </li>
                    <li class="footer-column-menu__item">
                        <a href="/transfer/" class="footer-column-menu__link hover">Трансфер</a>
                    </li>
                    <li class="footer-column-menu__item">
                        <a href="/promotions/" class="footer-column-menu__link hover">Акции</a>
                    </li>
                    <li class="footer-column-menu__item">
                        <a href="/news/" class="footer-column-menu__link hover">Новости</a>
                    </li>
                    <li class="footer-column-menu__item">
                        <a href="/partners/" class="footer-column-menu__link hover">Партнерам</a>
                    </li>
                    <li class="footer-column-menu__item">
                        <a href="/contacts/" class="footer-column-menu__link hover">Контакты</a>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="footer-column">
            <address class="footer-contacts">
                <a href="tel:<?= esc_attr($phone_clean); ?>" class="footer-contacts__link">
                    <span class="footer-contacts__icon">
                        <picture>
                            <source srcset="<?= get_template_directory_uri(); ?>/img/header/phone.svg"
                                    type="image/webp">
                            <img src="<?= get_template_directory_uri(); ?>/img/header/phone.svg" alt="Телефон"
                                 class="footer-contacts__img">
                        </picture>
                    </span>
                    <span class="footer-contacts__title"><?= esc_html($phone); ?></span>
                </a>
                <div class="footer-contacts__address"><?= esc_html($address); ?></div>
            </address>
            <div class="footer-column__socials" style="display: flex; align-items: center; gap: 8px; margin-bottom: 16px;">
                <!-- MAX Bot -->
                <a 
                    href="https://max.ru/id2203004205_bot" 
                    target="_blank" 
                    rel="noopener noreferrer" 
                    class="bads-btn bads-btn--icon-only bads-btn--icon-32"
                    aria-label="<?= esc_attr__('Открыть чат с ботом MAX', 'bigaltay'); ?>"
                    title="<?= esc_attr__('Оперативный чат в MAX', 'bigaltay'); ?>"
                >
                    <span 
                        class="bads-brand-icon bads-brand-icon--max" 
                        style="--brand-mask: url('<?= get_template_directory_uri(); ?>/assets/images/brands/max.svg');"
                        aria-hidden="true"
                    ></span>
                </a>

                <!-- VK -->
                <a 
                    href="<?= esc_url($vk_url); ?>" 
                    target="_blank" 
                    rel="noopener noreferrer" 
                    class="bads-btn bads-btn--icon-only bads-btn--icon-32"
                    aria-label="<?= esc_attr__('Сообщество ВКонтакте', 'bigaltay'); ?>"
                    title="<?= esc_attr__('ВКонтакте', 'bigaltay'); ?>"
                >
                    <span 
                        class="bads-brand-icon bads-brand-icon--vk" 
                        style="--brand-mask: url('<?= get_template_directory_uri(); ?>/assets/images/brands/vk.svg');"
                        aria-hidden="true"
                    ></span>
                </a>
            </div>
            <div class="footer-column__action" style="margin-top: 14px;">
                <?php 
                get_template_part('template-parts/ui/button', null, [
                    'text'    => 'Получить консультацию',
                    'variant' => 'primary',
                    'size'    => 'sm',
                    'type'    => 'button',
                    'attrs'   => [
                        'data-modal-target'  => '#bads-consultation-modal',
                        'data-modal-trigger' => '',
                    ],
                ]);
                ?>
            </div>
        </div>
        <div class="footer-column footer-column--mobile">
            <div class="footer-column__copyright">© <?= date('Y'); ?>, Все права защищены</div>
            <a href="/privacy.pdf" class="footer-column__privacy" target="_blank">Политика конфиденциальности</a>
        </div>
    </div>
</footer>

<div class="menu-hamburger" id="menu-hamburger">
    <div class="container menu-hamburger__container">
        <div class="menu-hamburger__wrapper">
            <nav class="menu-hamburger__nav">
                <ul class="menu-hamburger__list">
                    <li class="menu-hamburger__item">
                        <a href="/sanatorium/" class="menu-hamburger__link hover">Санатории</a>
                    </li>
                    <li class="menu-hamburger__item">
                        <a href="/lechenie/" class="menu-hamburger__link hover">Лечение</a>
                    </li>
                    <li class="menu-hamburger__item">
                        <a href="/rest-belokurikha/" class="menu-hamburger__link hover">Отдых в Белокурихе</a>
                    </li>
                    <li class="menu-hamburger__item">
                        <a href="/rest-altai-mountains/" class="menu-hamburger__link hover">Отдых в Горном Алтае</a>
                    </li>
                    <li class="menu-hamburger__item">
                        <a href="/rest-belokurikha/baza-otdyha-kalina-krasnaya/" class="menu-hamburger__link hover">Калина красная</a>
                    </li>
                    <li class="menu-hamburger__item">
                        <a href="/tours/" class="menu-hamburger__link hover">Туры</a>
                    </li>
                    <li class="menu-hamburger__item">
                        <a href="/excursions/" class="menu-hamburger__link hover">Экскурсии</a>
                    </li>
                    <li class="menu-hamburger__item">
                        <a href="/transfer/" class="menu-hamburger__link hover">Трансфер</a>
                    </li>
                    <li class="menu-hamburger__item">
                        <a href="/new-year/" class="menu-hamburger__link hover">Новый год в Белокурихе</a>
                    </li>
                    <li class="menu-hamburger__item">
                        <a href="/promotions/" class="menu-hamburger__link hover">Акции</a>
                    </li>
                    <li class="menu-hamburger__item">
                        <a href="/news/" class="menu-hamburger__link hover">Новости</a>
                    </li>
                    <li class="menu-hamburger__item">
                        <a href="/partners/" class="menu-hamburger__link hover">Партнерам</a>
                    </li>
                    <li class="menu-hamburger__item">
                        <a href="/contacts/" class="menu-hamburger__link hover">Контакты</a>
                    </li>
                </ul>
            </nav>
            <div class="menu-hamburger__right">
                <button class="menu-hamburger__close" type="button" id="menu-hamburger-close">Закрыть</button>
                <section class="popup-form" id="popup-form">
                    <div class="popup-form__title">Оставьте заявку, и мы подберем для вас предложение</div>
                    <div class="popup-form__box">
                        <?php echo do_shortcode('[contact-form-7 id="538"]'); ?>
                    </div>
                    <div class="popup-form-success__message">
                        <strong>Спасибо за заявку!</strong><br/>Она будет обработана в ближайшее время
                    </div>
                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            try {
                                var privacyCheckbox = document.getElementById('privacy-538');
                                var submitButton = document.getElementById('privacy-btn-538');

                                privacyCheckbox.addEventListener('change', function () {
                                    submitButton.disabled = !privacyCheckbox.checked;
                                });
                                submitButton.disabled = !privacyCheckbox.checked;
                            } catch (e) {
                            }
                        });
                    </script>
                </section>
            </div>
        </div>
    </div>
</div>
<a href="#top" class="scroll-to-top" style="display:none;">
    <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
        <g clip-path="url(#clip0_908_4482)">
            <path d="M9.25111 2.32538C9.05189 2.12641 8.78184 2.01465 8.50028 2.01465C8.21871 2.01465 7.94866 2.12641 7.74944 2.32538L3.74099 6.33171C3.54167 6.53104 3.42969 6.80137 3.42969 7.08326C3.42969 7.36514 3.54167 7.63548 3.74099 7.8348C3.94031 8.03412 4.21065 8.1461 4.49253 8.1461C4.77441 8.1461 5.04475 8.03412 5.24407 7.8348L7.43778 5.6418V13.8124C7.43778 14.0942 7.54972 14.3645 7.74898 14.5637C7.94823 14.763 8.21849 14.8749 8.50028 14.8749C8.78207 14.8749 9.05232 14.763 9.25158 14.5637C9.45084 14.3645 9.56278 14.0942 9.56278 13.8124V5.6418L11.7558 7.8348C11.8545 7.93349 11.9716 8.01178 12.1006 8.06519C12.2295 8.1186 12.3677 8.1461 12.5073 8.1461C12.6469 8.1461 12.7851 8.1186 12.9141 8.06519C13.043 8.01178 13.1602 7.93349 13.2589 7.8348C13.3576 7.7361 13.4358 7.61894 13.4893 7.48999C13.5427 7.36104 13.5702 7.22283 13.5702 7.08326C13.5702 6.94368 13.5427 6.80547 13.4893 6.67652C13.4358 6.54757 13.3576 6.43041 13.2589 6.33171L9.25111 2.32538Z" fill="white"/>
        </g>
        <defs>
            <clipPath id="clip0_908_4482">
                <rect width="17" height="17" fill="white"/>
            </clipPath>
        </defs>
    </svg>
</a>
</div>

<?php
// BADS Global Consultation Modal (Bitrix24)
get_template_part('template-parts/components/consultation-modal/consultation-modal');
?>
<!--popup-->
<div id="same-page" class="popup" style="display:none;max-width:500px;">
    <div class="popup__title">Оставьте заявку</div>
    <div class="popup__description">Оставьте свои данные и мы перезвоним!</div>
    <?php get_template_part('template-parts/components/popup-lead-form-same', get_post_format(), array('id' => '4257',)); ?>
</div>

<? wp_footer(); ?>
<!-- BEGIN CONVERSUS -->
<script type="text/javascript">
  (function(i,s,o,g,a,m,id=4548){
    i["PVWatcherObj"]={ver:1.01};
    a=s.createElement(o);
    Object.assign(a,{PVWatcherID:id,async:1,src:g+"?"+(new Date).getTime()});
    m=s.getElementsByTagName(o)[0];
    m.parentNode.insertBefore(a,m);
  })(window,document,"script","//lk.conversus.pro/smartvoronka/watcher-prod/pv.temporary.js");
</script>
<!-- END CONVERSUS -->
</body>
</html>