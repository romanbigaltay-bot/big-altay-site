<?php

if (!defined('ABSPATH')) {
    exit;
}

/*
|--------------------------------------------------------------------------
| Страница импорта
|--------------------------------------------------------------------------
*/

add_action(
    'admin_menu',
    function () {

        add_submenu_page(
            'edit.php?post_type=news',
            'Импорт новостей',
            'Импорт новостей',
            'manage_options',
            'news-import',
            'big_altay_news_import_page'
        );

    }
);

/*
|--------------------------------------------------------------------------
| Настройки импортера
|--------------------------------------------------------------------------
*/

function big_altay_get_import_limit()
{
    return intval(
        get_option(
            'big_altay_import_limit',
            3
        )
    );
}

/*
|--------------------------------------------------------------------------
| Журнал импортера
|--------------------------------------------------------------------------
*/

function big_altay_add_import_log($message)
{
    $logs = get_option(
        'big_altay_import_log',
        []
    );

    array_unshift(
        $logs,
        current_time(
            'd.m.Y H:i:s'
        )
        . ' — '
        . $message
    );

    $logs = array_slice(
        $logs,
        0,
        30
    );

    update_option(
        'big_altay_import_log',
        $logs
    );
}

function big_altay_get_import_log()
{
    return get_option(
        'big_altay_import_log',
        []
    );
}

//--------------------------------------------------------------------

function big_altay_news_import_page()
{

if (
    isset($_POST['save_import_settings'])
    && check_admin_referer(
        'big_altay_save_import_settings'
    )
) {

    update_option(
        'big_altay_import_limit',
        max(
            1,
            intval(
                $_POST['import_limit']
            )
        )
    );

    echo '<div class="notice notice-success"><p>';

    echo 'Настройки сохранены';

    echo '</p></div>';
}
	
	$import_limit =
    big_altay_get_import_limit();
	
    ?>

    <div class="wrap">
		
		<style>

.big-altay-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
    margin: 20px 0;
}

.big-altay-card {
    background: #fff;
    border: 1px solid #dcdcde;
    border-radius: 8px;
    padding: 20px;
}

.big-altay-card h2 {
    margin-top: 0;
}

</style>

        <h1>Импорт новостей из Алтай Курорт</h1>
		
		<hr>
		
		<div class="big-altay-grid">
			
			<div class="big-altay-card">

			<h2>Настройки импортера</h2>

			<form method="post">

				<?php wp_nonce_field(
					'big_altay_save_import_settings'
				); ?>

				<table class="form-table">

					<tr>

						<th>
							Сколько новостей проверять
						</th>

						<td>

							<input
								type="number"
								name="import_limit"
								value="<?php echo esc_attr($import_limit); ?>"
								min="1"
								max="100"
							>

						</td>

					</tr>

				</table>

				<input
					type="hidden"
					name="save_import_settings"
					value="1"
				>

				<?php submit_button(
					'Применить'
				); ?>

			</form>
				
		</div>

		<?php

			$turizm_status = '✗';
			$zdorove_status = '✗';

			$turizm_feed = fetch_feed(
				'https://altaykyrort.ru/category/turizm/feed/'
			);

			if (!is_wp_error($turizm_feed)) {
				$turizm_status = '✓';
			}

			$zdorove_feed = fetch_feed(
				'https://altaykyrort.ru/category/zdorove/feed/'
			);

			if (!is_wp_error($zdorove_feed)) {
				$zdorove_status = '✓';
			}

			$cron_enabled =
				wp_next_scheduled(
					'big_altay_auto_news_import_morning'
				)
				&&
				wp_next_scheduled(
					'big_altay_auto_news_import_day'
				);

			?>

			<div class="big-altay-card">

				<h2>Диагностика</h2>

				<p>
					<?php echo $turizm_status; ?>
					RSS Туризм доступен
				</p>

				<p>
					<?php echo $zdorove_status; ?>
					RSS Здоровье доступен
				</p>

				<p>
					<?php echo $cron_enabled ? '✓' : '✗'; ?>
					Автоимпорт включен
				</p>

				<p>✓ Проверка дублей включена</p>

				<p>✓ Импорт изображений включен</p>

			</div>
			
		</div>
		
		<?php

			$morning_next = wp_next_scheduled(
				'big_altay_auto_news_import_morning'
			);

			$day_next = wp_next_scheduled(
				'big_altay_auto_news_import_day'
			);

			$logs = big_altay_get_import_log();

			?>

			<div class="big-altay-grid">

				<div class="big-altay-card">

					<h2>Статус автоматического импорта</h2>

					<p>
						<strong>Источник Туризм:</strong><br>
						https://altaykyrort.ru/category/turizm/feed/
					</p>

					<p>
						<strong>Источник Здоровье:</strong><br>
						https://altaykyrort.ru/category/zdorove/feed/
					</p>

					<p>
						<strong>Количество новостей за один запуск:</strong>
						<?php echo big_altay_get_import_limit(); ?>
					</p>

					<p>
						<strong>Запуск №1:</strong>
						05:00 по времени сайта
					</p>

					<p>
						<strong>Запуск №2:</strong>
						10:00 по времени сайта
					</p>

					<p>
						<strong>Фактическое время для Белокурихи:</strong><br>
						09:00 и 14:00
					</p>

					<p>
						<strong>Следующий утренний запуск:</strong><br>
						<?php
						echo $morning_next
							? date_i18n(
								'd.m.Y H:i:s',
								$morning_next
							)
							: 'не запланирован';
						?>
					</p>

					<p>
						<strong>Следующий дневной запуск:</strong><br>
						<?php
						echo $day_next
							? date_i18n(
								'd.m.Y H:i:s',
								$day_next
							)
							: 'не запланирован';
						?>
					</p>

				</div>

				<div class="big-altay-card">

					<h2>Последние операции</h2>

					<?php if (!empty($logs)) : ?>

						<ul>

							<?php foreach ($logs as $log) : ?>

								<li>
									<?php echo esc_html($log); ?>
								</li>

							<?php endforeach; ?>

						</ul>

					<?php else : ?>

						<p>Журнал пока пуст</p>

					<?php endif; ?>

				</div>

			</div>
	
		</div>
		
		<form method="post">

			<?php wp_nonce_field(
				'big_altay_run_auto_import'
			); ?>

			<input
				type="hidden"
				name="run_auto_import"
				value="1"
			>

			<?php submit_button(
				'Запустить автоимпорт сейчас',
				'primary'
			); ?>

		</form>
		
		<div class="big-altay-grid">

    <div class="big-altay-card">

        <h2>Туризм</h2>

        <p>
            <strong>RSS:</strong><br>
            https://altaykyrort.ru/category/turizm/feed/
        </p>

        <form method="post">

            <?php wp_nonce_field(
                'big_altay_import_turizm'
            ); ?>

            <input
                type="number"
                name="turizm_limit"
                value="1"
                min="1"
                max="100"
            >

            <input
                type="hidden"
                name="run_turizm_import"
                value="1"
            >

            <?php submit_button(
                'Импортировать туризм',
                'secondary'
            ); ?>

        </form>

    </div>

    <div class="big-altay-card">

        <h2>Здоровье</h2>

        <p>
            <strong>RSS:</strong><br>
            https://altaykyrort.ru/category/zdorove/feed/
        </p>

        <form method="post">

            <?php wp_nonce_field(
                'big_altay_import_zdorove'
            ); ?>

            <input
                type="number"
                name="zdorove_limit"
                value="1"
                min="1"
                max="100"
            >

            <input
                type="hidden"
                name="run_zdorove_import"
                value="1"
            >

            <?php submit_button(
                'Импортировать здоровье',
                'secondary'
            ); ?>

        </form>

    </div>

</div>

    <?php

    /*
    -------------------------------------
    Туризм
    -------------------------------------
    */

    if (
    isset($_POST['run_turizm_import'])
    && check_admin_referer(
        'big_altay_import_turizm'
    )
) {

    $limit = intval(
        $_POST['turizm_limit']
    );

    $items = big_altay_read_feed(
        'https://altaykyrort.ru/category/turizm/feed/',
        $limit
    );

    if (is_wp_error($items)) {

        echo '<div class="notice notice-error"><p>';

        echo $items->get_error_message();

        echo '</p></div>';

        return;
    }

    echo '<div class="notice notice-success"><p>';

    echo 'RSS успешно прочитан';

    echo '</p></div>';

    foreach ($items as $item) {

		$post_id = big_altay_create_news(
			$item
		);

		if ($post_id) {

			echo '<div class="notice notice-success"><p>';

			echo 'Создана новость ID: '
				. intval($post_id);

			echo '</p></div>';

		}
	}
}

    /*
	-------------------------------------
	Здоровье
	-------------------------------------
	*/

	if (
		isset($_POST['run_zdorove_import'])
		&& check_admin_referer(
			'big_altay_import_zdorove'
		)
	) {

		$limit = intval(
			$_POST['zdorove_limit']
		);

		$items = big_altay_read_feed(
			'https://altaykyrort.ru/category/zdorove/feed/',
			$limit
		);

		if (is_wp_error($items)) {

			echo '<div class="notice notice-error"><p>';

			echo $items->get_error_message();

			echo '</p></div>';

			return;
		}

		echo '<div class="notice notice-success"><p>';

		echo 'RSS успешно прочитан';

		echo '</p></div>';

		foreach ($items as $item) {

			$post_id =
				big_altay_create_news(
					$item
				);

			if ($post_id) {

				echo '<div class="notice notice-success"><p>';

				echo 'Создана новость ID: '
					. intval($post_id);

				echo '</p></div>';

			}

		}

	}
	
		/*
		-------------------------------------
		Запустить автоимпорт
		-------------------------------------
		*/

		if (
			isset($_POST['run_auto_import'])
			&&
			check_admin_referer(
				'big_altay_run_auto_import'
			)
		) {

			echo '<div class="notice notice-info"><p>';

			echo 'Запущен полный автоимпорт...';

			echo '</p></div>';

			big_altay_auto_news_import_callback();

			echo '<div class="notice notice-success"><p>';

			echo 'Автоимпорт завершён';

			echo '</p></div>';

		}
}

//----------------------------------------------------------

function big_altay_read_feed($url, $limit = 1)
{
    include_once ABSPATH . WPINC . '/feed.php';

    add_filter(
        'wp_feed_cache_transient_lifetime',
        '__return_zero'
    );

    $feed = fetch_feed(
        add_query_arg(
            '_nocache',
            time(),
            $url
        )
    );

    remove_filter(
        'wp_feed_cache_transient_lifetime',
        '__return_zero'
    );

    if (is_wp_error($feed)) {
        return $feed;
    }

    $items = $feed->get_items(
        0,
        $limit
    );

    if (is_admin() && !empty($items)) {

        echo '<div class="notice notice-info"><p>';

        echo 'Первая новость RSS: '
            . esc_html(
                $items[0]->get_title()
            );

        echo '</p></div>';
    }

    return $items;
}

//---------------------------------------------------------

function big_altay_download_image(
    $image_url,
    $post_id
) {

    if (empty($image_url)) {
        return 0;
    }

    require_once ABSPATH . 'wp-admin/includes/file.php';
    require_once ABSPATH . 'wp-admin/includes/media.php';
    require_once ABSPATH . 'wp-admin/includes/image.php';

    $attachment_id = media_sideload_image(
        $image_url,
        $post_id,
        null,
        'id'
    );

    if (is_wp_error($attachment_id)) {
        return 0;
    }

    return intval($attachment_id);
}

//-------------------------------------------

function big_altay_create_news($item)
{
    $title = $item->get_title();

    $data = $item->get_item_tags(
        'http://purl.org/rss/1.0/modules/content/',
        'encoded'
    );

    if (!empty($data[0]['data'])) {

        $content = $data[0]['data'];

    } else {

        $content = $item->get_description();
    }

    $content = preg_replace(
        '~<p>Сообщение.*?</p>~si',
        '',
        $content
    );

    $source_url = $item->get_link();

    if (
        big_altay_news_exists(
            $source_url
        )
    ) {

        if (is_admin()) {

            echo '<div class="notice notice-warning"><p>';

            echo 'Новость уже существует: '
                . esc_html($title);

            echo '</p></div>';

        }
		
		big_altay_add_import_log(
			'Дубль: '
			. $title
		);
		
        return 0;
    }

    $image_url = big_altay_get_og_image(
        $source_url
    );

    /*
    -------------------------------------
    Дата публикации из RSS
    -------------------------------------
    */

    $timestamp = $item->get_date('U');

    $post_date = date(
        'Y-m-d H:i:s',
        $timestamp
    );

    $post_date_gmt = gmdate(
        'Y-m-d H:i:s',
        $timestamp
    );

    /*
    -------------------------------------
    Создаем новость
    -------------------------------------
    */

    $post_id = wp_insert_post([
        'post_type'      => 'news',
        'post_status'    => 'publish',
        'post_title'     => $title,
        'post_content'   => $content,
        'post_date'      => $post_date,
        'post_date_gmt'  => $post_date_gmt,
    ]);

    if (!$post_id) {
        return 0;
    }

    update_post_meta(
        $post_id,
        '_source_url',
        $source_url
    );

    $attachment_id = big_altay_download_image(
        $image_url,
        $post_id
    );

    if ($attachment_id) {

        update_post_meta(
            $post_id,
            'news_promo',
            $attachment_id
        );
    }
	
	big_altay_add_import_log(
		'Создана новость: '
		. $title
	);

    return $post_id;
}
//----------------------------------------------

function big_altay_get_og_image($url)
{
    $response = wp_remote_get(
        $url,
        [
            'timeout' => 20
        ]
    );

    if (
        is_wp_error($response)
    ) {
        return '';
    }

    $html = wp_remote_retrieve_body(
        $response
    );

    preg_match(
        '/property=["\']og:image["\']\s+content=["\']([^"\']+)["\']/i',
        $html,
        $matches
    );

    return $matches[1] ?? '';
}

//-------------------------------------------------------

function big_altay_news_exists($source_url)
{
    $posts = get_posts([
        'post_type'      => 'news',
        'post_status'    => 'any',
        'posts_per_page' => 1,
        'meta_key'       => '_source_url',
        'meta_value'     => $source_url,
        'fields'         => 'ids',
    ]);

    return !empty($posts);
}

/*
|--------------------------------------------------------------------------
| Автоматический импорт
|--------------------------------------------------------------------------
*/

add_action(
    'big_altay_auto_news_import',
    'big_altay_auto_news_import_callback'
);

function big_altay_auto_news_import_callback()
{
	big_altay_add_import_log(
		'Автоимпорт запущен'
	);
    $feeds = [
        'https://altaykyrort.ru/category/turizm/feed/',
        'https://altaykyrort.ru/category/zdorove/feed/',
    ];

    foreach ($feeds as $feed_url) {

        $items = big_altay_read_feed(
			$feed_url,
			big_altay_get_import_limit()
		);

        if (
            is_wp_error($items)
        ) {
            continue;
        }

        foreach ($items as $item) {

            big_altay_create_news(
                $item
            );

        }

    }
	
	big_altay_add_import_log(
		'Автоимпорт завершён'
	);

}

/*
|--------------------------------------------------------------------------
| Два запуска в сутки
|--------------------------------------------------------------------------
*/

add_action(
    'init',
    function () {

        if (
            !wp_next_scheduled(
                'big_altay_auto_news_import_morning'
            )
        ) {

            wp_schedule_event(
                strtotime('05:00:00'),
                'daily',
                'big_altay_auto_news_import_morning'
            );

        }

        if (
            !wp_next_scheduled(
                'big_altay_auto_news_import_day'
            )
        ) {

            wp_schedule_event(
                strtotime('10:00:00'),
                'daily',
                'big_altay_auto_news_import_day'
            );

        }

    }
);

add_action(
    'big_altay_auto_news_import_morning',
    'big_altay_auto_news_import_callback'
);
