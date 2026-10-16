<div
    class="news-subscribe-popup"
    id="news-subscribe-popup"
>

    <div
        class="news-subscribe-popup__overlay"
    ></div>

    <div
        class="news-subscribe-popup__window"
    >

        <button
            type="button"
            class="news-subscribe-popup__close"
            aria-label="Закрыть"
        >
            ×
        </button>

        <h3 class="news-subscribe-popup__title">
            Подписка на новости
        </h3>

        <p class="news-subscribe-popup__text">
            Получайте новости, специальные предложения и актуальную информацию на вашу электронную почту.
        </p>

        <form
            id="news-subscribe-form"
            class="news-subscribe-form"
        >

            <div class="lead-form-main__fields">

                <div class="lead-form-main__field">

                    <input
                        type="text"
                        name="name"
                        class="lead-form-main__input lead-form-main__input--name"
                        placeholder="Ваше имя"
                    >

                </div>

                <div class="lead-form-main__field">

                    <input
                        type="email"
                        name="email"
                        class="lead-form-main__input lead-form-main__input--email"
                        placeholder="Email*"
                        required
                    >

                </div>

            </div>

            <label class="lead-form-main__privacy">

                <span class="lead-form-main__privacy-inner">

                    <input
                        type="checkbox"
                        id="news-subscribe-privacy"
                    >

                    <span>
                        Даю согласие на обработку и хранение
                        моих персональных данных.
                    </span>

                </span>

            </label>

            <button
                type="submit"
                class="btn lead-form-main__btn"
                disabled
            >
                Подписаться
            </button>

            <div class="lead-form-main__message"></div>

        </form>

    </div>

</div>