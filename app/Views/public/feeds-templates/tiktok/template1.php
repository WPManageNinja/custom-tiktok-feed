<?php
use WPSocialReviews\Framework\Support\Arr;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

if (!empty($feeds) && is_array($feeds)) {
    $feed_type = Arr::get($template_meta, 'source_settings.feed_type');
    $column = isset($template_meta['column_number']) ? $template_meta['column_number'] : 4;
    $columnClass = 'wpsr-col-' . $column;
    $layout_type = isset($template_meta['layout_type']) && defined('WPSOCIALREVIEWS_PRO') ? $template_meta['layout_type'] : 'grid';
    $animation_img_class = $layout_type === 'carousel' ? 'wpsr-animated-background' : '';

    // Check if the feed type is user_feed and the pro version is not defined
    if ($feed_type !== 'user_feed' && !defined('WPSOCIALREVIEWS_PRO')) {
        echo '<p>' . esc_html__('You need to upgrade to pro to use this feature.', 'custom-feed-for-tiktok') . '</p>';
        return;
    }

    // Check if post_settings exist in template_meta, if not, return
    if (!Arr::get($template_meta, 'post_settings')) {
        return;
    }

    $displayPlatformIcon = Arr::get($template_meta, 'post_settings.display_platform_icon');

    foreach ($feeds as $index => $feed) {
        if ($index >= $sinceId && $index <= $maxId) {
            if ($layout_type !== 'carousel') {
                do_action('custom_feed_for_tiktok/tiktok_feed_template_item_wrapper_before', $template_meta);
            }
            $userName = Arr::get($feed, 'user.name');
            $feedID = Arr::get($feed, 'id');
            $imageOptimization = Arr::get($image_settings, 'optimized_images');
            $gdprEnabled = Arr::get($image_settings, 'has_gdpr');
            $imageResolution = Arr::get($template_meta, 'post_settings.resolution');
            $dataPlayMode = Arr::get($template_meta, 'post_settings.display_mode');
            ?>
            <div tabindex="0" role="group" class="wpsr-tiktok-feed-item wpsr-tt-post <?php echo ($layout_type === 'carousel' && defined('WPSOCIALREVIEWS_PRO')) ? 'swiper-slide' : ''; ?>"
                 data-post_id="<?php echo esc_attr($feedID); ?>"
                 data-user_name="<?php echo esc_attr($userName); ?>"
                 data-image_size="<?php echo esc_attr($imageResolution); ?>"
            >
                <div class="wpsr-tiktok-feed-playmode wpsr-tiktok-feed-inner"
                     data-feed_type="<?php echo esc_attr($feed_type); ?>"
                     data-index="<?php echo esc_attr($index); ?>"
                     data-playmode="<?php echo esc_attr($dataPlayMode); ?>"
                     data-template-id="<?php echo esc_attr($templateId); ?>"
                     data-optimized_images="<?php echo esc_attr($imageOptimization); ?>"
                     data-has_gdpr="<?php echo esc_attr($gdprEnabled); ?>"
                     data-image_size="<?php echo esc_attr($imageResolution); ?>"
                >
                    <div class="wpsr-tiktok-feed-image">
                    <?php
                    /**
                     * tiktok_feed_media hook.
                     *
                     * @hooked TiktokTemplateHandler::renderFeedMedia 10
                     * */
                    do_action('custom_feed_for_tiktok/tiktok_feed_media', $feed, $template_meta);

                   if ($feed_type === 'user_feed') { ?>
                        <div class="wpsr-tiktok-feed-content-box">
                            <?php if ($template_meta['post_settings']['display_play_icon'] === 'true'): ?>
                                <div class="wpsr-tiktok-feed-video-play">
                                    <div class="wpsr-tiktok-feed-video-play-icon"></div>
                                </div>
                            <?php endif; ?>

                            <?php
                            if ($displayPlatformIcon === 'true') {
                                /**
                                 * tiktok_feed_icon hook.
                                 *
                                 * @hooked TiktokTemplateHandler::renderFeedIcon 10
                                 * */
                                 do_action('custom_feed_for_tiktok/tiktok_feed_icon', $class = 'wpsr-tiktok-icon-outer');
                            }

                            /**
                             * tiktok_feed_statistics hook.
                             *
                             * @hooked render_tiktok_feed_statistics 10
                             * */
                            do_action('custom_feed_for_tiktok/tiktok_feed_statistics', $template_meta, $feed);

                            /**
                             * tiktok_feed_author hook.
                             *
                             * @hooked TiktokTemplateHandler::renderFeedAuthor 10
                             * */
                            do_action('custom_feed_for_tiktok/tiktok_feed_author', $feed, $template_meta);
                            ?>
                        </div>
                    <?php } ?>
                    <?php if($layout_type === 'carousel'){ ?>
                        <div class="<?php echo esc_attr($animation_img_class); ?>"></div>
                    <?php } ?>
                    </div>
                    <div class="wpsr-tiktok-feed-image-hover-over-content">
                        <?php
                        if ($displayPlatformIcon === 'true') {
                            /**
                             * tiktok_feed_icon hook.
                             *
                             * @hooked TiktokTemplateHandler::renderFeedIcon 10
                             * */
                             do_action('custom_feed_for_tiktok/tiktok_feed_icon', $class = 'wpsr-tiktok-icon');
                        }
                        /**
                         * tiktok_feed_description hook.
                         *
                         * @hooked TiktokTemplateHandler::renderFeedDescription 10
                         * */
                        do_action('custom_feed_for_tiktok/tiktok_feed_description', $feed, $template_meta);

                        /**
                         * tiktok_feed_author_name hook.
                         *
                         * @hooked render_author_name 10
                         * */
                        do_action('custom_feed_for_tiktok/tiktok_feed_author_name', $feed, $template_meta);
                        ?>
                    </div>
                </div>
            </div>
            <?php if ($layout_type !== 'carousel') { ?>
                </div>
            <?php }
        }
    }
}
?>
