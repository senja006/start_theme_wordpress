<?php


/**
 * Компонент acf
 */
$acf_columns = array(
	'key'        => '57d5669fc1415',
	'name'       => 'columns',
	'label'      => 'Колонки',
	'display'    => 'block',
	'sub_fields' => array(
		array(
			'key'               => 'field_57d566a69828f',
			'label'             => 'Левая колонка',
			'name'              => 'columns_left',
			'type'              => 'flexible_content',
			'instructions'      => '',
			'required'          => 0,
			'conditional_logic' => 0,
			'wrapper'           => array(
				'width' => '',
				'class' => '',
				'id'    => '',
			),
			'button_label'      => 'Добавить в левую колонку',
			'min'               => '',
			'max'               => '',
			'layouts'           => array()
		),
		array(
			'key'               => 'field_57d566a69828a',
			'label'             => 'Основное содержание',
			'name'              => 'columns_middle',
			'type'              => 'flexible_content',
			'instructions'      => '',
			'required'          => 0,
			'conditional_logic' => 0,
			'wrapper'           => array(
				'width' => '',
				'class' => '',
				'id'    => '',
			),
			'button_label'      => 'Добавить в основное содержание',
			'min'               => '',
			'max'               => '',
			'layouts'           => array()
		),
		array(
			'key'               => 'field_57d5793798290',
			'label'             => 'Правая колонка',
			'name'              => 'columns_right',
			'type'              => 'flexible_content',
			'instructions'      => '',
			'required'          => 0,
			'conditional_logic' => 0,
			'wrapper'           => array(
				'width' => '',
				'class' => '',
				'id'    => '',
			),
			'button_label'      => 'Добавить в правую колонку',
			'min'               => '',
			'max'               => '',
			'layouts'           => array()
		),
		array(
			'key'               => 'field_57d6a60cac3f1',
			'label'             => 'Выровнять боковую колонку по центру',
			'name'              => 'flex_all_center',
			'type'              => 'true_false',
			'instructions'      => '',
			'required'          => 0,
			'conditional_logic' => 0,
			'wrapper'           => array(
				'width' => '',
				'class' => '',
				'id'    => '',
			),
			'message'           => '',
			'default_value'     => 0,
		),
	)
);
