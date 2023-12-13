<?php
use WPSocialReviews\Framework\Support\Arr;

if (!empty($feeds) && is_array($feeds)) {
    $feed_type = Arr::get($template_meta, 'source_settings.feed_type');
    $column = isset($template_meta['column_number']) ? $template_meta['column_number'] : 4;
    $columnClass = 'wpsr-col-' . $column;
    $layout_type = isset($template_meta['layout_type']) && defined('WPSOCIALREVIEWS_PRO') ? $template_meta['layout_type'] : 'grid';

    // Check if the feed type is user_feed and the pro version is not defined
    if ($feed_type !== 'user_feed' && !defined('WPSOCIALREVIEWS_PRO')) {
        echo '<p>' . __('You need to upgrade to pro to use this feature.', 'ninja-tiktok-feed') . '</p>';
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
                do_action('ninja_tiktok_feed/tiktok_feed_template_item_wrapper_before', $template_meta);
            }
            $userID = Arr::get($feed, 'user.id');
            $videoID = Arr::get($feed, 'id');
            $videoLink = 'https://www.tiktok.com/@' . $userID . '/video/' . $videoID;
            ?>
            <div role="group" class="wpsr-tiktok-feed-item <?php echo ($layout_type === 'carousel' && defined('WPSOCIALREVIEWS_PRO')) ? 'swiper-slide' : ''; ?>">
                <?php if ($feed_type === 'user_feed') {
                    if ($displayPlatformIcon === 'true') {
                        /**
                         * tiktok_feed_icon hook.
                         *
                         * @hooked TiktokTemplateHandler::renderFeedIcon 10
                         * */
                        do_action('ninja_tiktok_feed/tiktok_feed_icon', $class = 'wpsr-tiktok-icon-outer');
                    }
                    ?>
                    <div class="wpsr-tiktok-feed-inner">
                        <div class="wpsr-tiktok-feed-statistics">
                            <a href="<?php echo esc_url($videoLink); ?>" class="wpsr-tiktok-feed-video-preview wpsr-tiktok-feed-video-playmode wpsr-feed-link" target="_blank" rel="nofollow">
                            </a>

                            <div class="wpsr-tiktok-icon-position" data-feed_type="<?php echo esc_attr($feed_type); ?>" data-index="<?php echo esc_attr($index); ?>" data-playmode="<?php echo esc_attr($template_meta['post_settings']['display_mode']); ?>" data-template-id="<?php echo esc_attr($templateId); ?>">
                                <?php if ($displayPlatformIcon === 'true') {
                                    /**
                                     * tiktok_feed_icon hook.
                                     *
                                     * @hooked TiktokTemplateHandler::renderFeedIcon 10
                                     * */
                                    do_action('ninja_tiktok_feed/tiktok_feed_icon', $class = 'wpsr-tiktok-icon');
                                } ?>
                                <div>
                                    <?php
                                    /**
                                     * tiktok_feed_description hook.
                                     *
                                     * @hooked TiktokTemplateHandler::renderFeedDescription 10
                                     * */
                                    do_action('ninja_tiktok_feed/tiktok_feed_description', $feed, $template_meta);

                                    /**
                                     * tiktok_feed_author hook.
                                     *
                                     * @hooked TiktokTemplateHandler::renderFeedAuthor 10
                                     * */
                                    do_action('ninja_tiktok_feed/tiktok_feed_author', $feed, $template_meta, $displayStatistics = 'false');
                                    ?>
                                </div>
                            </div>
                        </div>

                        <div class="wpsr-tiktok-feed-content-wrapper">
                            <div class="wpsr-tiktok-feed-playmode wpsr-tiktok-feed-inner" data-feed_type="<?php echo esc_attr($feed_type); ?>" data-index="<?php echo esc_attr($index); ?>" data-playmode="<?php echo esc_attr($template_meta['post_settings']['display_mode']); ?>" data-template-id="<?php echo esc_attr($templateId); ?>">
                                <?php
                                /**
                                 * tiktok_feed_media hook.
                                 *
                                 * @hooked TiktokTemplateHandler::renderFeedMedia 10
                                 * */
                                do_action('ninja_tiktok_feed/tiktok_feed_media', $feed, $template_meta);
                                ?>

                                <div class="wpsr-tiktok-feed-video-info">
                                    <div>
                                        <?php
                                        /**
                                         * tiktok_feed_media hook.
                                         *
                                         * @hooked TiktokTemplateHandler::renderFeedAuthor 10
                                         * */
                                        do_action('ninja_tiktok_feed/tiktok_feed_author', $feed, $template_meta, $displayStatistics = 'true');
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <?php if ($layout_type !== 'carousel') { ?>
                </div>
            <?php }
        }
    }
}
?>
