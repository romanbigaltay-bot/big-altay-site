<?php
/*
Template Name: Sticky Test
*/


?>

<main>

<style>

body{
    margin:0;
}

.sticky-test{
    padding:80px 0;
}

.sticky-container{
    width:min(1200px, calc(100% - 48px));
    margin:auto;
}

.sticky-grid{
    display:grid;
    grid-template-columns:420px minmax(0,1fr);
    gap:32px;
    align-items:start;
}

.sticky-sidebar{

    position:sticky;
    top:24px;

    display:flex;
    flex-direction:column;
    gap:16px;

}

.card{

    padding:24px;

    border-radius:24px;

    background:#eef7ff;

    border:1px solid #b7dfff;

}

.content{

    display:flex;
    flex-direction:column;
    gap:24px;

}

.block{

    padding:32px;

    border-radius:24px;

    background:#f7f7f7;

}

@media(max-width:992px){

    .sticky-grid{

        grid-template-columns:1fr;

    }

    .sticky-sidebar{

        position:static;

    }

}

</style>

<section class="sticky-test">

    <div class="sticky-container">

        <div class="sticky-grid">

            <aside class="sticky-sidebar">

                <div class="card">

                    <h3>Навигация</h3>

                    <?php for($i=1;$i<=15;$i++): ?>

                        <p>Пункт <?= $i ?></p>

                    <?php endfor; ?>

                </div>

                <div class="card">

                    <h3>CTA</h3>

                    <p>Консультация</p>

                </div>

            </aside>

            <div class="content">

                <?php for($i=1;$i<=20;$i++): ?>

                    <div class="block">

                        <h2>Блок <?= $i ?></h2>

                        <p>

                            Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                            Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.

                        </p>

                        <p>

                            Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                            Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.

                        </p>

                        <p>

                            Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                            Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.

                        </p>

                    </div>

                <?php endfor; ?>

            </div>

        </div>

    </div>

</section>

</main>

<?php  ?>