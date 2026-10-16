<?php
/**
 * BADS News Archive List
 *
 * @package BADS
 */

if (!defined('ABSPATH')) {
    exit;
}

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$query_args = array(
    'post_type'      => 'news',
    'post_status'    => 'publish',
    'posts_per_page' => 9,
    'paged'          => $paged,
);

wp_reset_query();
$query = new WP_Query($query_args);
?>

<section class="bads-section u-pb-2xl">
    <div class="bads-container">
        
        <!-- 3 Columns Grid -->
        <div class="bads-grid bads-grid--3" id="news-grid">
            <?php
            if ($query->have_posts()) {
                while ($query->have_posts()) {
                    $query->the_post();
                    get_template_part('template-parts/content/news');
                }
            } else {
                echo '<div class="u-text-muted">Новостей пока нет.</div>';
            }
            ?>
        </div>

        <?php if ($query->max_num_pages > 1) { ?>
            <div class="u-text-center u-mt-xl">
                <button class="bads-btn bads-btn--outline bads-btn--lg" id="load-more-news" data-page="2" data-max-pages="<?php echo $query->max_num_pages; ?>">
                    <span class="bads-btn__label">Показать ещё</span>
                </button>
            </div>
        <?php } ?>

    </div>
</section>

<script>
    jQuery(document).ready(function ($) {
        $('#load-more-news').on('click', function () {
            var button = $(this);
            var currentPage = parseInt(button.data('page'));
            var maxPages = parseInt(button.data('max-pages'));
            var label = button.find('.bads-btn__label');

            if (currentPage > maxPages) return;

            $.ajax({
                url: '<?php echo admin_url('admin-ajax.php'); ?>',
                type: 'POST',
                data: {
                    action: 'load_more_news',
                    page: currentPage
                },
                beforeSend: function () {
                    label.text('Загрузка...');
                    button.addClass('is-loading');
                },
                success: function (response) {
                    button.removeClass('is-loading');
                    if (response) {
                        $('#news-grid').append(response);
                        button.data('page', currentPage + 1);
                        label.text('Показать ещё');
                        if (currentPage + 1 > maxPages) {
                            button.hide();
                        }
                    } else {
                        button.hide();
                    }
                },
                error: function () {
                    button.removeClass('is-loading');
                    label.text('Показать ещё');
                }
            });
        });
    });
</script>