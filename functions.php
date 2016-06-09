<?php

/**
 * Автоматическая установка необходимых плагинов темы
 */

require_once dirname(__FILE__) . '/class-tgm-plugin-activation.php';

add_action('tgmpa_register', 'my_theme_register_required_plugins');

function my_theme_register_required_plugins()
{

    $plugins = array(

        array(
            'name' => 'Cyr to Lat enhanced',
            'slug' => 'cyr3lat',
            'required' => true,
        ),
        array(
            'name' => 'JP Widget Visibility',
            'slug' => 'jetpack-widget-visibility',
            'required' => true,
        ),

    );

    $config = array(
        'id' => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '',                      // Default absolute path to bundled plugins.
        'menu' => 'tgmpa-install-plugins', // Menu slug.
        'parent_slug' => 'themes.php',            // Parent menu slug.
        'capability' => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
        'has_notices' => true,                    // Show admin notices or not.
        'dismissable' => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg' => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message' => '',                      // Message to output right before the plugins table.
        'strings' => array(
            'page_title' => __('Установите необходимые плагины', 'theme-slug'),
            'menu_title' => __('Необходимые плагины', 'theme-slug'),
            'installing' => __('Установка плагина: %s', 'theme-slug'), // %s = plugin name.
            'oops' => __('Что-то пошло не так с API плагина.', 'theme-slug'),
            'notice_can_install_required' => _n_noop(
                'Эта тема требует следующий плагин: %1$s.',
                'Эта тема требует следующий плагины: %1$s.',
                'theme-slug'
            ), // %1$s = plugin name(s).
            'notice_can_install_recommended' => _n_noop(
                'Эта тема рекомендует следующий плагин: %1$s.',
                'Эта тема рекомендует следующий плагины: %1$s.',
                'theme-slug'
            ), // %1$s = plugin name(s).
            'notice_cannot_install' => _n_noop(
                'Извините, но у вас нет необходимых разрешений на установку %1$s плагина.',
                'Извините, но у вас нет необходимых разрешений по установку %1$s плагинов.',
                'theme-slug'
            ), // %1$s = plugin name(s).
            'notice_ask_to_update' => _n_noop(
                'Этот плагин должен быть обновлен до последней версии, чтобы обеспечить максимальную совместимость с этой темой: %1$s.',
                'Эти плагины должен быть обновлены до последней версии, чтобы обеспечить максимальную совместимость с этой темой: %1$s.',
                'theme-slug'
            ), // %1$s = plugin name(s).
            'notice_ask_to_update_maybe' => _n_noop(
                'Существует обновление для плагина: %1$s.',
                'Существует обновление для плагинов: %1$s.',
                'theme-slug'
            ), // %1$s = plugin name(s).
            'notice_cannot_update' => _n_noop(
                'Извините, но у вас нет необходимых разрешений для обновления %1$s плагина.',
                'Извините, но у вас нет необходимых разрешений для обновления %1$s плагинов.',
                'theme-slug'
            ), // %1$s = plugin name(s).
            'notice_can_activate_required' => _n_noop(
                'Следующий обязательный плагин в настоящее время неактивен: %1$s.',
                'Следующие обязательные плагины в настоящее время неактивны: %1$s.',
                'theme-slug'
            ), // %1$s = plugin name(s).
            'notice_can_activate_recommended' => _n_noop(
                'Следующий рекомендуемый плагин в настоящее время неактивен: %1$s.',
                'Следующие рекомендуемые плагины в настоящее время неактивны: %1$s.',
                'theme-slug'
            ), // %1$s = plugin name(s).
            'notice_cannot_activate' => _n_noop(
                'Извините, но у вас нет необходимых разрешений для активации %1$s плагина.',
                'Извините, но у вас нет необходимых разрешений для активации %1$s плагинов.',
                'theme-slug'
            ), // %1$s = plugin name(s).
            'install_link' => _n_noop(
                'Начните устанавливать плагин',
                'Начните устанавливать плагины',
                'theme-slug'
            ),
            'update_link' => _n_noop(
                'Начните обновление плагина',
                'Начните обновление плагинов',
                'theme-slug'
            ),
            'activate_link' => _n_noop(
                'Начало активации плагина',
                'Начало активации плагинов',
                'theme-slug'
            ),
            'return' => __('Вернуться к списку необходимых плагинов', 'theme-slug'),
            'plugin_activated' => __('Плагин успешно активирован.', 'theme-slug'),
            'activated_successfully' => __('Этот плагин активирован успешно:', 'theme-slug'),
            'plugin_already_active' => __('Никаких действий не принимается. Плагин %1$s уже активен.', 'theme-slug'),  // %1$s = plugin name(s).
            'plugin_needs_higher_version' => __('Плагин не активируется. Необходима более новая версия %s для этой темы. Пожалуйста, обновите плагин.', 'theme-slug'),  // %1$s = plugin name(s).
            'complete' => __('Все плагины установлены и успешно активированы. %1$s', 'theme-slug'), // %s = dashboard link.
            'contact_admin' => __('Пожалуйста, обратитесь к администратору этого сайта за помощью.', 'tgmpa'),

            'nag_type' => 'updated', // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
        ),
    );

    tgmpa($plugins, $config);
}

/**
 * Удаление стандартных виджетов Wordpress
 */
function unregister_default_wp_widgets()
{
    unregister_widget('WP_Widget_Pages');
    unregister_widget('WP_Widget_Calendar');
    unregister_widget('WP_Widget_Archives');
    unregister_widget('WP_Widget_Links');
    unregister_widget('WP_Widget_Meta');
    unregister_widget('WP_Widget_Search');
//    unregister_widget('WP_Widget_Text');
    unregister_widget('WP_Widget_Categories');
    unregister_widget('WP_Widget_Recent_Posts');
    unregister_widget('WP_Widget_Recent_Comments');
    unregister_widget('WP_Widget_RSS');
    unregister_widget('WP_Widget_Tag_Cloud');
    unregister_widget('WP_Nav_Menu_Widget');
}

add_action('widgets_init', 'unregister_default_wp_widgets', 1);


/**
 * Удаление лишней информации из head
 */

remove_action('wp_head', 'feed_links', 2); // Удаляет ссылки RSS-лент записи и комментариев
remove_action('wp_head', 'feed_links_extra', 3); // Удаляет ссылки RSS-лент категорий и архивов
remove_action('wp_head', 'rsd_link'); // Удаляет RSD ссылку для удаленной публикации
remove_action('wp_head', 'wlwmanifest_link'); // Удаляет ссылку Windows для Live Writer
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0); // Удаляет короткую ссылку
remove_action('wp_head', 'wp_generator'); // Удаляет информацию о версии WordPress
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0); // Удаляет ссылки на предыдущую и следующую статьи
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_styles', 'print_emoji_styles');
remove_action('wp_head', 'rest_output_link_wp_head', 10);
remove_action('wp_head', 'wp_oembed_add_discovery_links', 10);


/**
 * Удаление стандартных скриптов
 */

function deregister_default_scripts()
{
    if (!is_admin()) {
        wp_deregister_script('jquery');
    }
}

add_action('wp_print_scripts', 'deregister_default_scripts', 100);