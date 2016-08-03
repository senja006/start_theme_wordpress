<?php if ( have_rows( 'rows' ) ) : ?>
	<div class="ya-text">
		<div class="ya-text__row">
			<?php while ( have_rows( 'rows' ) ) : the_row(); ?>
				<div class="ya-col">
					<?php the_sub_field( 'text' ); ?>
				</div>
			<?php endwhile; ?>
		</div>
	</div>
<?php endif; ?>