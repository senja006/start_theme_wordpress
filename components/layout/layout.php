<div class="ya-content">
	<div class="ya-container">
		<div class="ya-content__row">
			<div class="ya-content__main">
				<?php
				if ( have_rows( 'components', $template_page ) ) {
					while ( have_rows( 'components', $template_page ) ) {
						the_row();
						$component_name = get_row_layout();
						require TEMPLATEPATH . '/components/' . $component_name . '/' . $component_name . '.php';
					}
				} elseif ( have_posts() ) {
					while ( have_posts() ) : the_post();
						the_content();
					endwhile;
				}
				?>
			</div>
		</div>
	</div>
</div>
