<div id="mega-menu" class="mega-menu">

    <div class="mega-menu__container">

        <button
            type="button"
            class="mega-menu__close"
            id="mega-menu-close"
        >
            Закрыть ✕
        </button>

        <div class="mega-menu__content">

            <?php
            get_template_part(
                'template-parts/components/mega-menu/mega-menu-nav'
            );
            ?>

            <?php
            get_template_part(
                'template-parts/components/mega-menu/mega-menu-form'
            );
            ?>

        </div>

    </div>

</div>