<?php
/**
 * ============================================================================
 * Big Altay Design System (BADS)
 * UI / Tabs Group
 * ============================================================================
 */

$args = wp_parse_args($args ?? [], [

    'groups' => [],
    'gap'    => 'xl',
    'class'  => '',

]);

if (empty($args['groups']) || !is_array($args['groups'])) {
    return;
}

$classes = [

    'bads-tabs-group',
    'bads-tabs-group--gap-' . sanitize_html_class($args['gap']),

];

if (!empty($args['class'])) {
    $classes[] = sanitize_html_class($args['class']);
}

$class = implode(' ', $classes);

?>

<div class="<?= esc_attr($class); ?>">

    <?php foreach ($args['groups'] as $group_index => $group) : ?>

        <?php
        $group_args = wp_parse_args($group, [
            'title'    => '',
            'subtitle' => '',
            'tabs'     => [],
            'active'   => 0,
            'class'    => '',
        ]);

        if (empty($group_args['tabs']) || !is_array($group_args['tabs'])) {
            continue;
        }
        ?>

        <div class="bads-tabs-group__item">

            <?php if (!empty($group_args['title']) || !empty($group_args['subtitle'])) : ?>

                <div class="bads-stack bads-stack--sm">

                    <?php
                    get_template_part(
                        'template-parts/ui/title',
                        null,
                        [
                            'title'    => $group_args['title'],
                            'subtitle' => $group_args['subtitle'],
                            'level'    => 'h3',
                            'divider'  => false,
                        ]
                    );
                    ?>

                </div>

            <?php endif; ?>

            <?php
            get_template_part(
                'template-parts/ui/tabs',
                null,
                [
                    'items'  => $group_args['tabs'],
                    'active' => (int) $group_args['active'],
                    'class'  => $group_args['class'],
                ]
            );
            ?>

        </div>

    <?php endforeach; ?>

</div>