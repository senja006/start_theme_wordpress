<?php

$logo_href = 'href="' . get_home_url() . '"';

if ( is_front_page() ) {
	$logo_href = '';
}

?>

<?php if ( get_theme_mod( 'logo_img' ) ) : ?>
	<div class="ya-logo">
		<a <?php echo $logo_href ?> class="ya-logo__a">
			<img src="<?php echo esc_url( get_theme_mod( 'logo_img' ) ); ?>" alt="Логотип"
			     width="<?php echo get_theme_mod( 'logo_width' ) ?>"
			     height="<?php echo get_theme_mod( 'logo_height' ) ?>"/>
		</a>
	</div>
<?php endif; ?>


