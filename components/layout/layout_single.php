<div class="ya-content">
	<div class="ya-container">
		<div class="ya-content__row">
			<div class="ya-content__main">
				<?php
				if ( have_posts() ) {
					while ( have_posts() ) {
						the_post();
						require TEMPLATEPATH . '/components/' . $single_component_name . '/' . $single_component_name . '.php';
					}
				}
				?>
			</div>
		</div>
	</div>
</div>
