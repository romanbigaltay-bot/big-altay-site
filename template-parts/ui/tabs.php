<?php
/**
 * ============================================================================
 * Big Altay Design System (BADS)
 * UI / Tabs
 * ============================================================================
 * 
 * @param array $args [
 *   'items'        => array [
 *     [
 *       'title'       => string,
 *       'icon'        => string|html (optional),
 *       'content'     => string (html),
 *       'tab_class'   => string (optional),
 *       'tab_attrs'   => array (optional),
 *       'panel_class' => string (optional),
 *       'panel_attrs' => array (optional),
 *     ]
 *   ],
 *   'active'       => int (default: 0),
 *   'variant'      => 'default'|'pills'|'segmented' (default: 'default'),
 *   'size'         => 'sm'|'md'|'lg' (default: 'md'),
 *   'class'        => string (optional),
 *   'nav_class'    => string (optional),
 *   'panels_class' => string (optional),
 *   'id'           => string (optional),
 *   'data_tabs'    => bool (default: true),
 * ]
 */

$args = wp_parse_args($args ?? [], [
    'items'        => [],
    'active'       => 0,
    'variant'      => 'default',
    'size'         => 'md',
    'class'        => '',
    'nav_class'    => '',
    'panels_class' => '',
    'id'           => '',
    'data_tabs'    => true,
]);

if (empty($args['items'])) {
    return;
}

$id = !empty($args['id']) ? sanitize_html_class($args['id']) : wp_unique_id('bads-tabs-');

$classes = [
    'bads-tabs',
];

if (!empty($args['variant']) && $args['variant'] !== 'default') {
    $classes[] = 'bads-tabs--' . sanitize_html_class($args['variant']);
}
if (!empty($args['size'])) {
    $classes[] = 'bads-tabs--' . sanitize_html_class($args['size']);
}
if (!empty($args['class'])) {
    $classes[] = trim($args['class']);
}

$class = implode(' ', array_filter($classes));

$nav_classes = ['bads-tabs__nav'];
if (!empty($args['nav_class'])) {
    $nav_classes[] = trim($args['nav_class']);
}
$nav_class_attr = implode(' ', array_filter($nav_classes));

$panels_classes = ['bads-tabs__panels'];
if (!empty($args['panels_class'])) {
    $panels_classes[] = trim($args['panels_class']);
}
$panels_class_attr = implode(' ', array_filter($panels_classes));
?>

<div
    class="<?= esc_attr($class); ?>"
    <?php if ($args['data_tabs']): ?>data-tabs<?php endif; ?>
    id="<?= esc_attr($id); ?>"
>

    <!-- =====================================================
         Navigation
    ====================================================== -->

    <div
        class="<?= esc_attr($nav_class_attr); ?>"
        role="tablist"
    >

        <?php foreach ($args['items'] as $index => $item) : ?>
            <?php
            $tab_id    = $id . '-tab-' . $index;
            $panel_id  = $id . '-panel-' . $index;
            $active    = ($index === (int) $args['active']);
            $tab_class = ['bads-tabs__tab'];
            if ($active) {
                $tab_class[] = 'bads-tabs__tab--active';
            }
            if (!empty($item['tab_class'])) {
                $tab_class[] = trim($item['tab_class']);
            }

            // Tab attributes
            $tab_attrs = $item['tab_attrs'] ?? [];
            $tab_attrs_html = '';
            if (is_array($tab_attrs)) {
                foreach ($tab_attrs as $attr_name => $attr_val) {
                    $tab_attrs_html .= ' ' . esc_attr($attr_name) . '="' . esc_attr($attr_val) . '"';
                }
            }
            ?>

            <button
                class="<?= esc_attr(implode(' ', array_filter($tab_class))); ?>"
                type="button"
                role="tab"
                id="<?= esc_attr($tab_id); ?>"
                aria-controls="<?= esc_attr($panel_id); ?>"
                aria-selected="<?= $active ? 'true' : 'false'; ?>"
                tabindex="<?= $active ? '0' : '-1'; ?>"
                <?= $tab_attrs_html; ?>
            >
                <?php if (!empty($item['icon'])): ?>
                    <?php if (str_starts_with(trim($item['icon']), '<') || str_ends_with(trim($item['icon']), '.svg')): ?>
                        <?= $item['icon']; ?>
                    <?php else: ?>
                        <?php
                        get_template_part('template-parts/ui/icon', null, [
                            'name'  => $item['icon'],
                            'size'  => $item['icon_size'] ?? 'sm',
                            'class' => 'bads-tabs__tab-icon',
                        ]);
                        ?>
                    <?php endif; ?>
                <?php endif; ?>

                <?php if (!empty($item['title'])): ?>
                    <span class="bads-tabs__tab-text"><?= esc_html($item['title']); ?></span>
                <?php endif; ?>
            </button>
        <?php endforeach; ?>
    </div>

    <!-- =====================================================
         Panels
    ====================================================== -->

    <div class="<?= esc_attr($panels_class_attr); ?>">

        <?php foreach ($args['items'] as $index => $item) : ?>
            <?php
            $tab_id      = $id . '-tab-' . $index;
            $panel_id    = $id . '-panel-' . $index;
            $active      = ($index === (int) $args['active']);
            $panel_class = ['bads-tabs__panel'];
            if ($active) {
                $panel_class[] = 'bads-tabs__panel--active';
            }
            if (!empty($item['panel_class'])) {
                $panel_class[] = trim($item['panel_class']);
            }

            // Panel attributes
            $panel_attrs = $item['panel_attrs'] ?? [];
            $panel_attrs_html = '';
            if (is_array($panel_attrs)) {
                foreach ($panel_attrs as $attr_name => $attr_val) {
                    $panel_attrs_html .= ' ' . esc_attr($attr_name) . '="' . esc_attr($attr_val) . '"';
                }
            }
            ?>

            <div
                class="<?= esc_attr(implode(' ', array_filter($panel_class))); ?>"
                role="tabpanel"
                id="<?= esc_attr($panel_id); ?>"
                aria-labelledby="<?= esc_attr($tab_id); ?>"
                <?= $active ? '' : 'hidden'; ?>
                <?= $panel_attrs_html; ?>
            >
                <?= $item['content'] ?? ''; ?>
            </div>
        <?php endforeach; ?>
    </div>
</div>