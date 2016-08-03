<?php

function register_post_type_social() {
	$args = array(
		'label'               => null,
		'labels'              => array(
			'name'               => 'Социальные сети',
			'singular_name'      => 'Социальная сеть',
			'add_new'            => 'Добавить новую',
			'add_new_item'       => 'Добавить новую социальную сеть',
			'edit_item'          => 'Редактировать социальную сеть',
			'new_item'           => 'Новая социальная сеть',
			'view_item'          => 'Посмотреть социальную сеть',
			'search_items'       => 'Найти социальную сеть',
			'not_found'          => 'Социальная сеть не найдена',
			'not_found_in_trash' => 'Социальная сеть в корзине не найдена',
			'parent_item_colon'  => '',
			'menu_name'          => 'Соц. сети'
		),
		'description'         => '',
		'public'              => false,
		'publicly_queryable'  => false,
		'exclude_from_search' => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => null,
		'menu_icon'           => 'dashicons-share',
		'hierarchical'        => false,
		'supports'            => array( 'title' ),
		'taxonomies'          => array(),
		'has_archive'         => false,
		'rewrite'             => false,
		'query_var'           => true,
		'show_in_nav_menus'   => false,
	);

	register_post_type( 'social', $args );
}

function social_post_type_messages( $messages ) {
	global $post, $post_ID;

	$messages['social'] = array(
		0  => '', // Данный индекс не используется.
		1  => 'Социальная сеть обновлена.',
		2  => 'Параметр обновлён.',
		3  => 'Параметр удалён.',
		4  => 'Социальная сеть обновлена.',
		5  => isset( $_GET['revision'] ) ? sprintf( 'Социальная сеть восстановлена из редакции: %s', wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6  => 'Социальная сеть опубликована.',
		7  => 'Социальная сеть сохранена.',
		8  => 'Отправлено на проверку.',
		9  => sprintf( 'Запланировано на публикацию: <strong>%1$s</strong>', date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ) ),
		10 => 'Черновик обновлён.'
	);

	return $messages;
}

add_action( 'init', 'register_post_type_social' );
add_filter( 'post_updated_messages', 'social_post_type_messages' );

function register_acf_components_social() {

	if ( function_exists( 'acf_add_local_field_group' ) ):

		acf_add_local_field_group( array(
			'key'                   => 'group_5795a9e84c4b2',
			'title'                 => 'Настройки социальной сети',
			'fields'                => array(
				array(
					'key'               => 'field_5795c231a2cc2',
					'label'             => 'В какую сеть производить шаринг?',
					'name'              => 'source',
					'type'              => 'select',
					'instructions'      => '',
					'required'          => 1,
					'conditional_logic' => 0,
					'wrapper'           => array(
						'width' => '',
						'class' => '',
						'id'    => '',
					),
					'choices'           => array(
						'none'        => 'Нет в списке',
						'twitter'     => 'Twitter',
						'facebook'    => 'Facebook',
						'linkedin'    => 'Linkedin',
						'googleplus'  => 'Google Plus',
						'email'       => 'Email',
						'whatsapp'    => 'Whatsapp',
						'telegram'    => 'Telegram',
						'viber'       => 'Viber',
						'pinterest'   => 'Pinterest',
						'tumblr'      => 'Tumblr',
						'hackernews'  => 'Hackernews',
						'reddit'      => 'Reddit',
						'vk'          => 'VK.com',
						'buffer'      => 'Buffer',
						'xing'        => 'Xing',
						'line'        => 'Line',
						'instapaper'  => 'Instapaper',
						'pocket'      => 'Pocket',
						'digg'        => 'Digg',
						'stumbleupon' => 'StumbleUpon',
						'flipboard'   => 'Flipboard',
						'weibo'       => 'Weibo',
						'renren'      => 'Renren',
						'myspace'     => 'Myspace',
						'blogger'     => 'Blogger',
						'baidu'       => 'Baidu',
						'okru'        => 'Ok.ru',
					),
					'default_value'     => array(
						'none' => 'none',
					),
					'allow_null'        => 0,
					'multiple'          => 0,
					'ui'                => 0,
					'ajax'              => 0,
					'placeholder'       => '',
					'disabled'          => 0,
					'readonly'          => 0,
				),
				array(
					'key'               => 'field_5795afeca596c',
					'label'             => 'URL адрес',
					'name'              => 'url',
					'type'              => 'url',
					'instructions'      => '',
					'required'          => 1,
					'conditional_logic' => 0,
					'wrapper'           => array(
						'width' => '',
						'class' => '',
						'id'    => '',
					),
					'default_value'     => '',
					'placeholder'       => '',
				),
				array(
					'key'               => 'field_5795a9ff27904',
					'label'             => 'Текст кнопки',
					'name'              => 'button_text',
					'type'              => 'text',
					'instructions'      => '',
					'required'          => 1,
					'conditional_logic' => 0,
					'wrapper'           => array(
						'width' => '',
						'class' => '',
						'id'    => '',
					),
					'default_value'     => '',
					'placeholder'       => '',
					'prepend'           => '',
					'append'            => '',
					'maxlength'         => '',
					'readonly'          => 0,
					'disabled'          => 0,
				),
				array(
					'key'               => 'field_5795aa4027905',
					'label'             => 'Цвет фона',
					'name'              => 'bg_color',
					'type'              => 'color_picker',
					'instructions'      => '',
					'required'          => 1,
					'conditional_logic' => 0,
					'wrapper'           => array(
						'width' => '',
						'class' => '',
						'id'    => '',
					),
					'default_value'     => '',
				),
			),
			'location'              => array(
				array(
					array(
						'param'    => 'post_type',
						'operator' => '==',
						'value'    => 'social',
					),
				),
			),
			'menu_order'            => 0,
			'position'              => 'normal',
			'style'                 => 'default',
			'label_placement'       => 'top',
			'instruction_placement' => 'label',
			'hide_on_screen'        => '',
		) );

	endif;

}

add_action( 'register_acf_components', 'register_acf_components_social' );


/**
 * Регистрация виджета
 */
class Social_Widget extends WP_Widget {

	public function __construct() {
		$widget_ops = array(
			'description'                 => '',
			'customize_selective_refresh' => true,
		);
		parent::__construct( 'social_widget', 'Социальные сети', $widget_ops );
	}

	public function widget( $args, $instance ) {
		echo $args['before_widget'];

		if ( ! empty( $instance['title'] ) && empty( $instance['subtitle'] ) ) {
			echo $args['before_title'] . $instance['title'] . $args['after_title'];
		} elseif ( ! empty( $instance['title'] ) && ! empty( $instance['subtitle'] ) ) {
			echo $args['before_title'] . $instance['title'] . $args['before_subtitle'] . $instance['subtitle'] . $args['after_subtitle'] . $args['after_title'];
		}

		include 'social.php';
		echo $args['after_widget'];
	}

	public function form( $instance ) {
		$title    = ! empty( $instance['title'] ) ? $instance['title'] : '';
		$subtitle = ! empty( $instance['subtitle'] ) ? $instance['subtitle'] : '';

		?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>">Заголовок:</label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>"
			       name="<?php echo $this->get_field_name( 'title' ); ?>" type="text"
			       value="<?php echo esc_attr( $title ); ?>"/></p>
		<p><label for="<?php echo $this->get_field_id( 'subtitle' ); ?>">Подзаголовок:</label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'subtitle' ); ?>"
			       name="<?php echo $this->get_field_name( 'subtitle' ); ?>" type="text"
			       value="<?php echo esc_attr( $subtitle ); ?>"/></p>

		<?php
	}

	public function update( $new_instance, $old_instance ) {
		return $new_instance;
	}
}

add_action( 'widgets_init', function () {
	register_widget( 'Social_Widget' );
} );