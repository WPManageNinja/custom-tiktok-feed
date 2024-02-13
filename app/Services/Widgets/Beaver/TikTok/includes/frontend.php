<?php

if (!defined('ABSPATH')) {
    exit;
}

$template_id = $settings->template_id;
if(!$settings->template_id){
    return;
}
echo wp_kses_post(do_shortcode('[wp_social_ninja id="'.esc_html($template_id).'" platform="tiktok"]'));