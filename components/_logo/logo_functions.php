<?php

/**
 * Виджет логотипа
 */
class Logo_Widget extends WP_Widget {

	public function __construct() {
		$widget_ops = array(
			'description' => 'Логотип сайта',
		);
		parent::__construct( 'logo_widget', 'Логотип', $widget_ops );
	}

	public function widget( $args, $instance ) {
		echo $args['before_widget'];
		include 'logo.php';
		echo $args['after_widget'];
	}

	public function form( $instance ) {
		echo '<p></p>';
	}

	public function update( $new_instance, $old_instance ) {
		return $new_instance;
	}
}

add_action( 'widgets_init', function () {
	register_widget( 'Logo_Widget' );
} );

/**
 * Настройка логотипа в кастомайзере
 */

function logo_customize_register( $wp_customize ) {
	$wp_customize->add_setting( 'logo_img', array(
		'default'   => '',
		'transport' => 'refresh',
	) );
	$wp_customize->add_setting( 'logo_width', array(
		'default'   => '',
		'transport' => 'refresh',
	) );
	$wp_customize->add_setting( 'logo_height', array(
		'default'   => '',
		'transport' => 'refresh',
	) );

	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'logo_img',
			array(
				'label'    => 'Логотип',
				'section'  => 'title_tagline',
				'settings' => 'logo_img',
				'priority' => 9
			)
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'logo_width',
			array(
				'label'       => 'Ширина логотипа',
				'section'     => 'title_tagline',
				'settings'    => 'logo_width',
				'description' => 'Указывается в том случае, если исходный размер изображения отличается от необходимого',
				'priority'    => 9
			)
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'logo_height',
			array(
				'label'       => 'Высота логотипа',
				'section'     => 'title_tagline',
				'settings'    => 'logo_height',
				'description' => 'Указывается в том случае, если исходный размер изображения отличается от необходимого',
				'priority'    => 9
			)
		)
	);
}

add_action( 'customize_register', 'logo_customize_register' );