<div class="ya-content">
	<div class="ya-container">
		<div class="ya-content__row">
			<div class="ya-content__main">
				<?php
				while ( have_posts() ) {
					the_post();
					$components = carbon_get_the_post_meta( 'components', 'complex' );
					foreach ( $components as $component ) {
						$carbon_data    = carbon_get_component_data( $component );
						$component      = $carbon_data[0];
						$component_name = $carbon_data[1];
						require TEMPLATEPATH . '/components/' . $component_name . '/' . $component_name . '.php';
					}
				}
				?>
			</div>
		</div>
	</div>
</div>
