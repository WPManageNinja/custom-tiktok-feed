<?php

use WPSocialReviews\Framework\Support\Arr;

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
$classes[] = 'wpsr-tiktok-feed-' . esc_attr($template) . '';
$classes[] = 'wpsr-tiktok-' . esc_attr($feed_type) . '';
$classes[] = $layout_type === 'carousel' && defined('WPSOCIALREVIEWS_PRO') ? 'wpsr-tiktok-feed-slider-activate' : '';
$classes[] = $layout_type === 'masonry' ? 'wpsr-tiktok-feed-masonry-activate' : '';
$classes[] = 'wpsr-tiktok-feed-template-' . esc_attr($templateId) . '';

$classes[] = Arr::get($feed_settings, 'post_settings.equal_height') === 'true' ? 'wpsr-has-equal-height' : '';
$classes[] = $feed_settings['layout_type'] === 'timeline' ? 'wpsr-tiktok-feed-layout-standard' : '';
$desktop_column_number   = Arr::get($feed_settings, 'responsive_column_number.desktop');

$header_settings = $feed_settings['header_settings'];
$profile_photo_hide_class = $header_settings['display_profile_photo'] === 'false' ? 'wpsr-tiktok-feed-profile-pic-hide' : '';


echo '<div  id="wpsr-tiktok-feed-' . esc_attr($templateId) . '" class="' . esc_attr(implode(' ', $classes)) . '" ' . esc_attr(implode(' ',
        $dataAttrs)) . '  data-column="' . esc_attr($desktop_column_number) . '">';
echo '<div class="wpsr-loader">
        <div class="wpsr-spinner-animation"></div>
    </div>';
echo '<div class="wpsr-container">';

if ($header_settings['display_header'] === 'true' && !empty($header)) {
    echo '<div class="wpsr-row">
        <div class="wpsr-tiktok-feed-header wpsr-col-12 ' . ($header_settings['display_profile_photo'] === 'false' ? 'wpsr-tiktok-feed-profile-pic-hide' : '') . '">
            <div class="wpsr-tiktok-feed-user-info-wrapper">
                <div class="wpsr-tiktok-feed-user-info-head">
                    <div class="wpsr-tiktok-feed-header-info">';
                        if ($header['avatar_url'] && $header_settings['display_profile_photo'] === 'true') {
                            echo '<a rel="nofollow" href="' . esc_url($header['profile_deep_link']) . '" target="_blank" class="wpsr-tiktok-feed-user-profile-pic">
                                    <img src="' . esc_url($header['avatar_url']) . '" alt="' . esc_attr($header['display_name']) . '">
                                  </a>';
                        }

                        echo '<div class="wpsr-tiktok-feed-user-info">
                                <div class="wpsr-tiktok-feed-user-info-name-wrapper">';
                        if ($header['display_name'] && $header_settings['display_page_name'] === 'true') {
                            echo '<a class="wpsr-tiktok-feed-user-info-name" rel="nofollow" href="' . esc_url($header['profile_deep_link']) . '" title="' . esc_attr($header['display_name']) . '" target="_blank">
                                      ' . esc_html($header['display_name']) . '
                                  </a>';
                        }
                        echo '</div>';

                        if (defined('WPSOCIALREVIEWS_PRO')) {
                            /**
                             * tiktok_feed_bio_description hook.
                             *
                             * @hooked render_tiktok_feed_bio_description 10
                             * */
                            do_action('ninja_tiktok_feed/tiktok_feed_bio_description', $header_settings, $header);

                            /**
                             * tiktok_feed_statistics hook.
                             *
                             * @hooked render_tiktok_feed_statistics 10
                             * */
                            do_action('ninja_tiktok_feed/tiktok_header_statistics', $header_settings, $header);
                        }

                echo' </div>
            </div>';

            if ($feed_settings['follow_button_settings']['display_follow_button'] === 'true' && $feed_settings['follow_button_settings']['follow_button_position'] !== 'footer') {
                do_action('ninja_tiktok_feed/tiktok_follow_button', $feed_settings, $header);
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

echo '<div class="' . esc_attr($rowClasses) . ' wpsr-tiktok-all-feed wpsr_feeds wpsr-column-gap-' . esc_attr($column_gaps) . '">';
?>
