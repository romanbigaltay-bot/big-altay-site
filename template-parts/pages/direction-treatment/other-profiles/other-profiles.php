<?php
/**
 * ============================================================================
 * Big Altay Design System (BADS)
 * Direction Treatment / Block 8: Other Treatment Profiles
 * ============================================================================
 */

if (!defined('ABSPATH')) {
    exit;
}

$title = get_field('direction_other_title') ?: 'Другие профили лечения';
$subtitle = get_field('direction_other_subtitle') ?: 'Смежные направления курортной терапии, доступные в здравницах Белокурихи';

$other_profiles = get_field('direction_other_profiles');

if (empty($other_profiles) || !is_array($other_profiles)) {
    $other_profiles = [
        [
            'title'       => 'Лечение нервной системы',
            'description' => 'Терапия неврозов, вегетососудистой дистонии, хронической усталости и последствий стрессов.',
            'url'         => home_url('/lechenie/nervnaya-sistema/'),
            'badge'       => 'Неврология',
        ],
        [
            'title'       => 'Лечение сердечно-сосудистой системы',
            'description' => 'Программы при гипертонии, ИБС и атеросклерозе с использованием азотно-кремнистых ванн.',
            'url'         => home_url('/lechenie/serdechno-sosudistaya-sistema/'),
            'badge'       => 'Кардиология',
        ],
        [
            'title'       => 'Лечение органов пищеварения',
            'description' => 'Гастроэнтерологические курсы, диетотерапия и питьевое лечение природной минеральной водой.',
            'url'         => home_url('/lechenie/organy-pishchevareniya/'),
            'badge'       => 'Гастроэнтерология',
        ],
        [
            'title'       => 'Лечение опорно-двигательного аппарата',
            'description' => 'Бальнеогрязелечение остеохондроза, артрозов, суставов и позвоночника на Алтае.',
            'url'         => home_url('/lechenie/oporno-dvigatelnyy-apparat/'),
            'badge'       => 'Опорно-двигательный',
        ],
    ];
}
?>

<section class="bads-section bads-section--md">
    <div class="bads-container">

        <?php
        get_template_part(
            'template-parts/ui/title',
            null,
            [
                'title'    => $title,
                'subtitle' => $subtitle,
                'level'    => 'h2',
                'divider'  => true,
            ]
        );
        ?>

        <div class="bads-grid bads-grid--4 bads-grid--gap-md" style="margin-top: var(--space-xl);">
            <?php foreach ($other_profiles as $prof): ?>
                <?php
                $p_title = $prof['title'] ?? '';
                $p_desc  = $prof['description'] ?? '';
                $p_url   = $prof['url'] ?? home_url('/lechenie/');
                $p_badge = $prof['badge'] ?? '';
                ?>
                <div class="bads-card bads-card--bordered bads-card--padding-md" style="display: flex; flex-direction: column; justify-content: space-between; border-radius: var(--radius-md); background: #ffffff; transition: transform 0.2s ease, box-shadow 0.2s ease;">
                    <div class="bads-stack bads-stack--xs">
                        <?php if ($p_badge): ?>
                            <div>
                                <span class="bads-badge bads-badge--neutral" style="font-size: 11.5px; font-weight: 600; padding: 3px 8px; border-radius: var(--radius-pill);">
                                    <?= esc_html($p_badge); ?>
                                </span>
                            </div>
                        <?php endif; ?>

                        <h3 class="bads-title bads-title--h4" style="margin: 0; font-size: 1.1rem; line-height: 1.35; color: var(--color-text-primary);">
                            <?= esc_html($p_title); ?>
                        </h3>

                        <p style="margin: 0; font-size: 13.5px; line-height: 1.55; color: var(--color-text-secondary);">
                            <?= esc_html($p_desc); ?>
                        </p>
                    </div>

                    <div style="margin-top: var(--space-md); padding-top: var(--space-xs); border-top: 1px solid var(--color-border, rgba(0,0,0,0.06));">
                        <a href="<?= esc_url($p_url); ?>" style="display: inline-flex; align-items: center; gap: 4px; font-size: 13px; font-weight: 600; color: var(--color-primary); text-decoration: none;">
                            Смотреть профиль →
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>
