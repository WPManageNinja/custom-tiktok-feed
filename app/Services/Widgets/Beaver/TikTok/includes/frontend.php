<?php
$template_id = $settings->template_id;
if(!$settings->template_id){
    return;
}
echo do_shortcode('[wp_social_ninja id="'.$template_id.'" platform="tiktok"]');