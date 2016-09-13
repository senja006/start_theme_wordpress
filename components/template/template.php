<?php
/**
 * Вывод места для виджетов
 */
?>
<?php dynamic_sidebar( 'name_sidebar' ); ?>

===================
<?php
/**
 * Вывод email
 */
?>
<a href="mailto:<?php echo antispambot( esc_attr( $email ) ); ?>"
   class="ya-contacts-info__list-a"><?php echo antispambot( $email ); ?></a>

===================
<?php
/**
 * Запрос кастомного поста и опеределенной таксономии
 */

$category_reviews_id = get_sub_field( 'category_reviews' );
$reviews             = new WP_Query( array(
	'post_type'      => 'reviews',
	'post_status'    => 'publish',
	'posts_per_page' => - 1,
	'tax_query'      => array(
		array(
			'taxonomy' => 'category_reviews',
			'field'    => 'id',
			'terms'    => $category_reviews_id
		)
	)
) );
?>

==================
<?php
/**
 * Вывод с сортировкой по мета полю
 */

$tests = new WP_Query( array(
	'post_type'      => 'test',
	'post_status'    => 'publish',
	'posts_per_page' => - 1,
	'meta_key'       => 'sort',
	'orderby'        => 'meta_value_num',
	'order'          => 'ASC'
) );

wp_reset_postdata();

?>


<?php
/**
 * Определение текущего url
 */

$current_url = strtolower(explode('/', $_SERVER['SERVER_PROTOCOL'])[0]) . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
?>
