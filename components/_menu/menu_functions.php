<?php

/**
 * Регистрация виджета меню
 */
class Menu_Widget extends WP_Widget {

	public function __construct() {
		$widget_ops = array(
			'description'                 => 'Добавьте меню',
			'customize_selective_refresh' => true,
		);
		parent::__construct( 'menu_widget', 'Меню', $widget_ops );
	}

	public function widget( $args, $instance ) {
		// Get menu
		$nav_menu = ! empty( $instance['nav_menu'] ) ? wp_get_nav_menu_object( $instance['nav_menu'] ) : false;

		if ( ! $nav_menu ) {
			return;
		}

		echo $args['before_widget'];

		$nav_menu_args = array(
			'fallback_cb' => '',
			'menu'        => $nav_menu,
			'container'   => false,
			'menu_class'  => 'ya-menu__list-ul',
			'walker'      => new Ya_Menu()
		);

		include 'menu.php';

		echo $args['after_widget'];
	}

	public function form( $instance ) {
		$nav_menu = isset( $instance['nav_menu'] ) ? $instance['nav_menu'] : '';

		// Get menus
		$menus = wp_get_nav_menus();

		// If no menus exists, direct the user to go and create some.
		?>
		<p class="nav-menu-widget-no-menus-message" <?php if ( ! empty( $menus ) ) {
			echo ' style="display:none" ';
		} ?>>
			<?php
			if ( isset( $GLOBALS['wp_customize'] ) && $GLOBALS['wp_customize'] instanceof WP_Customize_Manager ) {
				$url = 'javascript: wp.customize.panel( "nav_menus" ).focus();';
			} else {
				$url = admin_url( 'nav-menus.php' );
			}
			?>
			<?php echo sprintf( __( 'No menus have been created yet. <a href="%s">Create some</a>.' ), esc_attr( $url ) ); ?>
		</p>
		<div class="nav-menu-widget-form-controls" <?php if ( empty( $menus ) ) {
			echo ' style="display:none" ';
		} ?>>
			<p>
				<label for="<?php echo $this->get_field_id( 'nav_menu' ); ?>"><?php _e( 'Select Menu:' ); ?></label>
				<select id="<?php echo $this->get_field_id( 'nav_menu' ); ?>"
				        name="<?php echo $this->get_field_name( 'nav_menu' ); ?>">
					<option value="0"><?php _e( '&mdash; Select &mdash;' ); ?></option>
					<?php foreach ( $menus as $menu ) : ?>
						<option
							value="<?php echo esc_attr( $menu->term_id ); ?>" <?php selected( $nav_menu, $menu->term_id ); ?>>
							<?php echo esc_html( $menu->name ); ?>
						</option>
					<?php endforeach; ?>
				</select>
			</p>
		</div>
		<?php
	}

	public function update( $new_instance, $old_instance ) {
		return $new_instance;
	}
}

add_action( 'widgets_init', function () {
	register_widget( 'Menu_Widget' );
} );


/**
 * Класс формирования меню
 */
class Ya_Menu extends Walker_Nav_Menu {

	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$classes[] = 'ya-menu__list-li';

		$args = apply_filters( 'nav_menu_item_args', $args, $item, $depth );

		$class_names         = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
		$activeMenuItemClass = ( in_array( 'current-menu-item', $item->classes ) || in_array( 'current-menu-parent', $item->classes ) ) ? ' ya-active' : '';
		$class_names         = $class_names ? ' class="' . esc_attr( $class_names ) . $activeMenuItemClass . '"' : '';

		$id = apply_filters( 'nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args, $depth );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

		$output .= $indent . '<li' . $id . $class_names . '>';

		$atts           = array();
		$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
		$atts['target'] = ! empty( $item->target ) ? $item->target : '';
		$atts['rel']    = ! empty( $item->xfn ) ? $item->xfn : '';
		$atts['href']   = ! empty( $item->url ) ? $item->url : '';

		$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

		$attributes = '';
		foreach ( $atts as $attr => $value ) {
			if ( ! empty( $value ) && ! in_array( 'current-menu-item', $item->classes ) && 'href' === $attr ) {
				$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}

		/** This filter is documented in wp-includes/post-template.php */
		$title = apply_filters( 'the_title', $item->title, $item->ID );

		$title = apply_filters( 'nav_menu_item_title', $title, $item, $args, $depth );

		$item_output = $args->before;
		$item_output .= '<a class="ya-menu__list-text"' . $attributes . '>';
		$item_output .= $args->link_before . $title . $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}

	public function end_el( &$output, $item, $depth = 0, $args = array() ) {
		$output .= "</li>\n";
	}

	public function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat( "\t", $depth );
		$output .= "\n$indent<ul class=\"ya-menu__list-ul\">\n";
	}

}

function custom_active_menu( $classes, $item ) {

	/**
	 * Для вывода записей блога
	 */
	if ( is_category() || is_singular( 'post' ) ) {
		if ( get_option( 'page_for_posts' ) == $item->object_id ) {
			$classes[] = 'ya-active';
		}
	}

	/**
	 * Для вывода курсов
	 */
	if ( ( is_tax( 'category_course' ) ) || is_singular( 'course' ) ) {
		$title_page_in_menu = $item->title;
		$page_courses_id    = get_theme_mod( 'pages_courses' );
		$pages              = get_pages();
		wp_reset_postdata();

		foreach ( $pages as $post ) {
			if ( $post->ID == $page_courses_id && $post->post_title == $title_page_in_menu ) {
				$classes[] = 'ya-active';
			}
		}
	}

	return $classes;
}

add_filter( 'nav_menu_css_class', 'custom_active_menu', 10, 2 );