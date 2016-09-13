<?php
if($template_page) {
	$content = apply_filters('the_content', get_post_field('post_content', $template_page));
}else{
	$content = apply_filters('the_content', get_the_content());
}
?>

<div class="ya-text ya-typography-styles">
	<div class="ya-text__row ya-cols-1">
		<div class="ya-col">
			<p><?php echo $content; ?></p>
		</div>
	</div>
</div>

