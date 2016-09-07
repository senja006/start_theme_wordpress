<?php

function register_acf_components( $components ) {
	if ( function_exists( 'acf_add_local_field_group' ) ) {

		acf_add_local_field_group( array(
			'key'                   => 'group_578f7be34ead4',
			'title'                 => 'Конструктор',
			'fields'                => array(
				array(
					'key'               => 'field_578f7c1a685d2',
					'label'             => 'Компоненты',
					'name'              => 'components',
					'type'              => 'flexible_content',
					'instructions'      => '',
					'required'          => 0,
					'conditional_logic' => 0,
					'wrapper'           => array(
						'width' => '',
						'class' => '',
						'id'    => '',
					),
					'button_label'      => 'Выбрать компонент',
					'min'               => '',
					'max'               => '',
					'layouts'           => $components,
				),
			),
			'location'              => array(
				array(
					array(
						'param'    => 'post_type',
						'operator' => '==',
						'value'    => 'post',
					),
				),
				array(
					array(
						'param'    => 'post_type',
						'operator' => '==',
						'value'    => 'page',
					),
				),
				array(
					array(
						'param'    => 'post_type',
						'operator' => '==',
						'value'    => 'course',
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
	}
}

add_action( 'register_acf_components', 'register_acf_components', 10, 1 );


/**
 * Получение массива компонентов
 */

function get_my_components( $arr ) {
	$components = array();
	foreach ( $arr as $component ) {
		$name                = $component['acf_fc_layout'];
		$components[ $name ] = $component;
	}

	return $components;
}