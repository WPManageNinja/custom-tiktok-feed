<?php

use WPSocialReviews\Framework\Support\Arr;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

//carousel
$dataAttrs  = array();
$sliderData = array();
if ($layout_type === 'carousel') {
    $sliderData = array(
        'autoplay'               => $feed_settings['carousel_settings']['autoplay'],
        'autoplay_speed'         => $feed_settings['carousel_settings']['autoplay_speed'],
        'responsive_slides_to_show'  => Arr::get($feed_settings, 'carousel_settings.responsive_slides_to_show'),
        'responsive_slides_to_scroll'  => Arr::get($feed_settings, 'carousel_settings.responsive_slides_to_scroll'),
        'navigation'             => $feed_settings['carousel_settings']['navigation'],
    );
}

$dataAttrs[] = $layout_type === 'carousel' && defined('WPSOCIALREVIEWS_PRO') ? 'data-slider_settings=' . json_encode($sliderData) . '' : '';
$feed_type = Arr::get($feed_settings, 'source_settings.feed_type');

// wrapper classes
$classes   = array('wpsr-tiktok-feed-wrapper', 'wpsr-feed-wrap', 'wpsr_content');
$classes[] = $template === 'template2' ? 'wpsr-tiktok-feed-template2' : '';
$classes[] = 'wpsr-tiktok-feed-' . esc_attr($template) . '';
$classes[] = 'wpsr-tiktok-' . esc_attr($feed_type) . '';
$classes[] = $layout_type === 'carousel' && defined('WPSOCIALREVIEWS_PRO') ? 'wpsr-tiktok-feed-slider-activate' : '';
$classes[] = $layout_type === 'masonry' ? 'wpsr-tiktok-feed-masonry-activate' : '';
$classes[] = 'wpsr-tiktok-feed-template-' . esc_attr($templateId) . '';

$classes[] = Arr::get($feed_settings, 'post_settings.equal_height') === 'true' ? 'wpsr-has-equal-height' : '';
$classes[] = Arr::get($feed_settings, 'layout_type') === 'timeline' ? 'wpsr-tiktok-feed-layout-standard' : '';
$desktop_column_number   = Arr::get($feed_settings, 'responsive_column_number.desktop');

$header_settings = Arr::get($feed_settings, 'header_settings');
$display_profile_photo = Arr::get($header_settings, 'display_profile_photo');
$profile_photo_hide_class = $display_profile_photo === 'false' ? 'wpsr-tiktok-feed-profile-pic-hide' : '';
$display_header = Arr::get($header_settings, 'display_header');

echo '<div  id="wpsr-tiktok-feed-' . esc_attr($templateId) . '" class="' . esc_attr(implode(' ', $classes)) . '" ' . esc_attr(implode(' ',
        $dataAttrs)) . '  data-column="' . esc_attr($desktop_column_number) . '">';
echo '<div class="wpsr-loader">
        <div class="wpsr-spinner-animation"></div>
    </div>';
echo '<div class="wpsr-container">';

if ($display_header === 'true' && !empty($header)) {
    $avatar_url = Arr::get($header, 'avatar_url', '');
    $display_name = Arr::get($header, 'display_name', '');
    $profile_deep_link = Arr::get($header, 'profile_deep_link', '');

    echo '<div class="wpsr-row">
        <div class="wpsr-tiktok-feed-header wpsr-col-12 ' . ($header_settings['display_profile_photo'] === 'false' ? 'wpsr-tiktok-feed-profile-pic-hide' : '') . '">
            <div class="wpsr-tiktok-feed-user-info-wrapper">
                <div class="wpsr-tiktok-feed-user-info-head">
                    <div class="wpsr-tiktok-feed-header-info">';
                        if ($avatar_url && $header_settings['display_profile_photo'] === 'true') {
                            echo '<a rel="nofollow" href="' . esc_url($profile_deep_link) . '" target="_blank" class="wpsr-tiktok-feed-user-profile-pic">
                                    <img src="' . esc_url($avatar_url) . '" alt="' . esc_attr($display_name) . '">
                                  </a>';
                        }

                        echo '<div class="wpsr-tiktok-feed-user-info">
                                <div class="wpsr-tiktok-feed-user-info-name-wrapper">';
                        if ($display_name && $header_settings['display_page_name'] === 'true') {
                            echo '<a class="wpsr-tiktok-feed-user-info-name" rel="nofollow" href="' . esc_url($profile_deep_link) . '" title="' . esc_attr($display_name) . '" target="_blank">
                                      ' . esc_html($display_name) . '
                                  </a>';
                        }
                        echo '</div>';

                        /**
                         * tiktok_feed_bio_description hook.
                         *
                         * @hooked render_tiktok_feed_bio_description 10
                         * */
                        do_action('custom_feed_for_tiktok/tiktok_feed_bio_description', $header_settings, $header);

                        /**
                         * tiktok_feed_statistics hook.
                         *
                         * @hooked render_tiktok_feed_statistics 10
                         * */
                        do_action('custom_feed_for_tiktok/tiktok_header_statistics', $header_settings, $header, $translations);

                echo' </div>
            </div>';

            if ($feed_settings['follow_button_settings']['display_follow_button'] === 'true' && $feed_settings['follow_button_settings']['follow_button_position'] !== 'footer') {
                do_action('custom_feed_for_tiktok/tiktok_follow_button', $feed_settings, $header);
            }
    echo '</div>
        </div>
      </div>
    </div>';
}

echo '<div class="wpsr-tiktok-feed-wrapper-inner">';
if ($layout_type === 'carousel' && defined('WPSOCIALREVIEWS_PRO')) {
    echo '<div class="swiper-container" tabindex="0">';
}
$rowClasses = $layout_type === 'carousel' && defined('WPSOCIALREVIEWS_PRO') ? 'swiper-wrapper' : 'wpsr-row';

echo '<div class="' . esc_attr($rowClasses) . ' wpsr-tt-all-feed wpsr_feeds wpsr-column-gap-' . esc_attr($column_gaps) . '">';
?>
