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
        // array(
        //     'name' => 'JP Widget Visibility',
        //     'slug' => 'jetpack-widget-visibility',
        //     'required' => true,
        // ),
        // array(
        //     'name' => 'Page Builder',
        //     'slug' => 'siteorigin-panels',
        //     'required' => true,
        // ),
        // array(
        //     'name'               => 'GitHub Updater',
        //     'slug'               => 'github-updater',
        //     'source'             => 'https://github.com/afragen/github-updater/archive/5.4.1.zip',
        //     'required'           => true, // this plugin is required
        //     'external_url'       => 'https://github.com/afragen/github-updater', // page of my plugin
        //     'force_deactivation' => true, // deactivate this plugin when the user switches to another theme
        // ),
        // array(
        //     'name'               => 'WP Sync DB',
        //     'slug'               => 'wp-sync-db',
        //     'source'             => 'https://github.com/wp-sync-db/wp-sync-db/archive/1.5.zip',
        //     'required'           => true, // this plugin is required
        //     'external_url'       => 'https://github.com/wp-sync-db/wp-sync-db', // page of my plugin
        //     'force_deactivation' => true, // deactivate this plugin when the user switches to another theme
        // )

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
// remove_action('wp_head', 'wp_oembed_add_discovery_links', 10);


/**
 * Настройка темы
 */

function set_theme_options()
{
    add_theme_support('title-tag');
    add_theme_support( 'customize-selective-refresh-widgets' );
    //add_theme_support( 'post-thumbnails' );
    //set_post_thumbnail_size( 825, 510, true );
}

add_action('after_setup_theme', 'set_theme_options');
add_filter( 'wp_calculate_image_srcset', '__return_null' );


/**
 * Отключение ненужных пунктов меню в админке
 */

function remove_menus() {
//  remove_menu_page( 'index.php' );                  //Консоль
//  remove_menu_page( 'edit.php' );                   //Записи
//  remove_menu_page( 'upload.php' );                 //Медиафайлы
//  remove_menu_page( 'edit.php?post_type=page' );    //Страницы
//  remove_menu_page( 'edit-comments.php' );          //Комментарии
//  remove_menu_page( 'themes.php' );                 //Внешний вид
//  remove_menu_page( 'plugins.php' );                //Плагины
//  remove_menu_page( 'users.php' );                  //Пользователи
//  remove_menu_page( 'tools.php' );                  //Инструменты
//  remove_menu_page( 'options-general.php' );        //Настройки
}

add_action( 'admin_menu', 'remove_menus' );


/**
 * Удаление стандартных скриптов
 */

function deregister_default_scripts() {
    if ( ! is_admin() && ! is_customize_preview() ) {
        wp_deregister_script( 'jquery' );
    }
}

add_action( 'wp_print_scripts', 'deregister_default_scripts', 100 );


/**
 * Подключение стилей и скриптов
 */

function add_styles_and_scripts()
{
    wp_enqueue_style('my-style', get_template_directory_uri() . '/static/css/main.css');
    wp_enqueue_script('my-script', get_template_directory_uri() . '/static/js/main.js', array(), '', true);
}

function admin_style()
{
    wp_enqueue_style('my-admin-style', get_template_directory_uri() . '/style.css');
}

function add_async_attribute($tag, $handle)
{
    if ('my-script' !== $handle) {
        return $tag;
    }
    return str_replace(' src', ' async src', $tag);
}

function remove_file_version($src)
{
    if (strpos($src, 'ver='))
        $src = remove_query_arg('ver', $src);
    return $src;
}

function my_ajax_data() {
    wp_localize_script( 'my-script', 'ajaxdata',
        array(
            'url' => admin_url( 'admin-ajax.php' ),
            'nonce' => wp_create_nonce( 'ajax_for_my_site' )
        )
    );
}

add_action('wp_enqueue_scripts', 'add_styles_and_scripts');
// add_action( 'wp_enqueue_scripts', 'my_ajax_data', 99 );
add_action('admin_enqueue_scripts', 'admin_style');
add_filter('script_loader_tag', 'add_async_attribute', 10, 2);
add_filter('script_loader_src', 'remove_file_version', 9999);
add_filter('style_loader_src', 'remove_file_version', 9999);


/**
 * Настройка customizer
 */

function mytheme_customize_register($wp_customize)
{
    $wp_customize->add_section( 'email', array(
        'title' => 'Почта'
    ) );

    $wp_customize->add_setting( 'social_img' , array(
        'default'     => '',
        'transport'   => 'refresh',
    ) );

    $wp_customize->add_setting( 'email_to', array(
        'default'   => '',
        'transport' => 'refresh',
    ) );

    $wp_customize->add_setting( 'email_from', array(
        'default'   => '',
        'transport' => 'refresh',
    ) );

    $wp_customize->add_setting( 'email_name_from', array(
        'default'   => '',
        'transport' => 'refresh',
    ) );

    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'social_img',
            array(
                'label'      => 'Изображение для соц. сетей',
                'section'    => 'title_tagline',
                'settings'   => 'social_img'
            )
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'email_to',
            array(
                'label'       => 'Email (куда)',
                'section'     => 'email',
                'settings'    => 'email_to',
                'description' => 'Сюда будут отправлены все уведомления из форм'
            )
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'email_from',
            array(
                'label'       => 'Email (от кого)',
                'section'     => 'email',
                'settings'    => 'email_from',
                'description' => 'Будет указан как email отправителя'
            )
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'email_name_from',
            array(
                'label'       => 'От кого',
                'section'     => 'email',
                'settings'    => 'email_name_from',
                'description' => 'Будет указан как отправитель'
            )
        )
    );
}

add_action('customize_register', 'mytheme_customize_register');


/**
 * Настройка отправки почты
 */

function wp_mail_change_from_name( $email_from ) {
    $from_name = get_theme_mod( 'email_name_from' );

    return $from_name;
}

function wp_mail_change_from( $email_address ) {
    $from = get_theme_mod( 'email_from' );

    return $from;
}

add_filter( 'wp_mail_from_name', 'wp_mail_change_from_name' );
add_filter( 'wp_mail_from', 'wp_mail_change_from' );
add_filter( 'wp_mail_content_type', create_function( '', 'return "text/html";' ) );


/**
 * Настройка текстового редактора
 */
function my_format_TinyMCE( $in ) {

    $in['wordpress_adv_hidden'] = false;

    return $in;
}

function enable_more_buttons_TinyMCE( $buttons ) {

//  $buttons[] = 'fontselect';
    $buttons[] = 'fontsizeselect';
//  $buttons[] = 'styleselect';
    $buttons[] = 'backcolor';
//  $buttons[] = 'newdocument';
    $buttons[] = 'cut';
    $buttons[] = 'copy';
//  $buttons[] = 'charmap';
//  $buttons[] = 'hr';
    $buttons[] = 'visualaid';

    return $buttons;
}

add_filter( 'tiny_mce_before_init', 'my_format_TinyMCE' );
add_filter( 'mce_buttons_3', 'enable_more_buttons_TinyMCE' );


/**
 * Переменные проекта
 */

$components_acf = array();


/**
 * Подключение functions.php компонентов
 */

$dirs_components = scandir( __DIR__ . '/components' );

foreach ( $dirs_components as $dir ) {
    if ( $dir == 'template' ) {
        continue;
    }

    $path = TEMPLATEPATH . '/components/' . $dir . '/' . $dir . '_functions.php';
    if ( file_exists( $path ) ) {
        require_once( $path );
    }
}


/**
 * Регистрация компонентов acf
 */

do_action( 'register_acf_components', $components_acf );
