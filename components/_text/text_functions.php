<?php

/**
 * Регистрация виджета
 */
class Text_Widget extends WP_Widget_Text {

	public function __construct() {
		parent::__construct();
	}

	public function widget( $args, $instance ) {

		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

		$widget_text = ! empty( $instance['text'] ) ? $instance['text'] : '';

		/**
		 * Filter the content of the Text widget.
		 *
		 * @since 2.3.0
		 * @since 4.4.0 Added the `$this` parameter.
		 *
		 * @param string $widget_text The widget content.
		 * @param array $instance Array of settings for the current widget.
		 * @param WP_Widget_Text $this Current Text widget instance.
		 */
		$text = apply_filters( 'widget_text', $widget_text, $instance, $this );

		echo $args['before_widget'];
		if ( ! empty( $title ) ) {
			echo $args['before_title'] . $title . $args['after_title'];
		} ?>
		<div class="ya-text"><?php echo ! empty( $instance['filter'] ) ? wpautop( $text ) : $text; ?></div>
		<?php
		echo $args['after_widget'];
	}

}

add_action( 'widgets_init', function () {
	register_widget( 'Text_Widget' );
} );


/**
 * Компонент acf
 */

$components_acf[] = array(
	'key'        => '57973e7aabf57',
	'name'       => 'text',
	'label'      => 'Текст',
	'display'    => 'block',
	'sub_fields' => array(
		array(
			'key'               => 'field_57973e98abf58',
			'label'             => 'Колонки',
			'name'              => 'rows',
			'type'              => 'repeater',
			'instructions'      => '',
			'required'          => 0,
			'conditional_logic' => 0,
			'wrapper'           => array(
				'width' => '',
				'class' => '',
				'id'    => '',
			),
			'min'               => '',
			'max'               => '',
			'layout'            => 'block',
			'button_label'      => 'Добавить колонку',
			'sub_fields'        => array(
				array(
					'key'               => 'field_57973ec1abf59',
					'label'             => 'Текст',
					'name'              => 'text',
					'type'              => 'wysiwyg',
					'instructions'      => '',
					'required'          => 0,
					'conditional_logic' => 0,
					'wrapper'           => array(
						'width' => '',
						'class' => '',
						'id'    => '',
					),
					'default_value'     => '',
					'tabs'              => 'visual',
					'toolbar'           => 'full',
					'media_upload'      => 1,
				),
			),
		),
	),
	'min'        => '',
	'max'        => '',
);
