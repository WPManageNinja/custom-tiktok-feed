<?php
use WPSocialReviews\Framework\Support\Arr;
$profileImage = Arr::get($account, 'profile_image_url', '');
$userName = Arr::get($account, 'name', '');
$mediaUrl = Arr::get($feed, 'media.url', '');
$profileUrl = Arr::get($account, 'profile_url', '');
$displayLikesCount = Arr::get($template_meta, 'post_settings.display_likes_count');
$displayCommentsCount = Arr::get($template_meta, 'post_settings.display_comments_count');
$displayViewsCount = Arr::get($template_meta, 'post_settings.display_views_count');
$displayPlatformIcon = Arr::get($template_meta, 'post_settings.display_platform_icon');

$classNames = 'wpsr-tiktok-feed-author-avatar-wrapper';
if ($displayPlatformIcon === 'false') {
    $classNames .= ' wpsr-tiktok-icon-temp-2-hide';
}
if ($displayLikesCount === 'false' && $displayCommentsCount === 'false' && $displayViewsCount === 'false') {
 $classNames .= ' wpsr-tiktok-feed-author-avatar-wrapper-remove-nested-spacing';
}

?>
<div class="wpsr-tiktok-feed-video-playmode wpsr-feed-link">
    <div class="wpsr-tiktok-feed-link-inner">
        <?php
        /**
         * tiktok_feed_statistics hook.
         *
         * @hooked render_tiktok_feed_statistics 10
         * */
        do_action('custom_feed_for_tiktok/tiktok_feed_statistics', $template_meta, $feed);
        if( is_array($account)){ ?>
            <div class="<?php echo $classNames; ?>">
                <?php if( Arr::get($account, 'profile_image_url') && Arr::get($template_meta, 'post_settings.display_author_photo') === 'true'){ ?>
                    <img src="<?php echo esc_url($profileImage); ?>" alt="<?php echo esc_attr($userName); ?>" class="wpsr-tiktok-feed-author-avatar" />
                <?php } ?>

                <div class="wpsr-feed-avatar-right">
                    <?php if( Arr::get($template_meta, 'post_settings.display_author_name') === 'true'){ ?>
                        <a class="wpsr-tiktok-feed-author-name" href="<?php echo esc_url($profileUrl); ?>" target="_blank" rel="nofollow">
                            <?php echo esc_html($userName); ?>
                        </a>
                    <?php }
                    /**
                     * tiktok_feed_date hook.
                     *
                     * @hooked render_feed_date 10
                     * */
                    do_action('custom_feed_for_tiktok/tiktok_feed_date', $template_meta, $feed);
                    ?>
                </div>
                <?php
                if ($displayPlatformIcon === 'true') {
                    /**
                     * tiktok_feed_icon hook.
                     *
                     * @hooked TiktokTemplateHandler::renderFeedIcon 10
                     * */
                    do_action('custom_feed_for_tiktok/tiktok_feed_icon', $class = 'wpsr-tiktok-icon-temp-2');
                }
                ?>
            </div>
        <?php } ?>
    </div>
</div>

