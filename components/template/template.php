<?php
/**
 * Output sidebar
 */
?>
<?php dynamic_sidebar( 'name_sidebar' ); ?>

===================
<?php
/**
 * Output email
 */
?>
<a href="mailto:<?php echo antispambot( esc_attr( $email ) ); ?>"
   class="ya-contacts-info__list-a"><?php echo antispambot( $email ); ?></a>

===================
<?php
/**
 * Custom post type and the taxonomies
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
 * Sort by meta
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
 * Create current url
 */

$current_url = strtolower(explode('/', $_SERVER['SERVER_PROTOCOL'])[0]) . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
?>

<?php

/**
 * Number format (001)
 */

str_pad( $num, 3, '0', STR_PAD_LEFT );

?>

<img src="<?php echo wp_get_attachment_image_src( $component['bg_img'], 'home_banner_bg' )[0]; ?>" alt="<?php echo esc_attr( get_post_meta( $component['bg_img'], '_wp_attachment_image_alt', true ) ); ?>">
