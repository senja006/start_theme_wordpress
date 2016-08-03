<?php

get_header();
get_template_part( 'components/header/header' );
// $template_page = 193;
// $single_component_name = 'article';
require TEMPLATEPATH . '/components/layout/layout.php';
get_template_part( 'components/footer/footer' );
get_footer();
