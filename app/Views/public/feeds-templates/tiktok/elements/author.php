<?php
use WPSocialReviews\Framework\Support\Arr;
$profileImage = Arr::get($feed, 'user.profile_image_url', '');
$userName = Arr::get($feed, 'user.name', '');
$mediaUrl = Arr::get($feed, 'media.url', '');
?>
<div class="wpsr-tiktok-feed-video-playmode wpsr-feed-link">
    <div class="wpsr-tiktok-feed-link-inner">
        <?php
        /**
         * tiktok_feed_statistics hook.
         *
         * @hooked render_tiktok_feed_statistics 10
         * */
        do_action('ninja_tiktok_feed/tiktok_feed_statistics', $displayStatistics, $template_meta, $feed);
        if( is_array($account)){ ?>
            <div class="wpsr-tiktok-feed-author-avatar-wrapper">
                <?php if( Arr::get($account, 'profile_image_url') && Arr::get($template_meta, 'post_settings.display_author_photo') === 'true'){ ?>
                    <img src="<?php echo esc_url($profileImage); ?>" alt="<?php echo esc_attr($userName); ?>" class="wpsr-tiktok-feed-author-avatar" />
                <?php } ?>

                <div class="wpsr-feed-avatar-right">
                    <?php if( Arr::get($template_meta, 'post_settings.display_author_name') === 'true'){ ?>
                        <a href="<?php echo esc_url($mediaUrl); ?>" target="_blank" rel="nofollow">
                            <?php echo esc_html($userName); ?>
                        </a>
                    <?php }
                    /**
                     * tiktok_feed_date hook.
                     *
                     * @hooked render_feed_date 10
                     * */
                    do_action('ninja_tiktok_feed/tiktok_feed_date', $template_meta, $feed);
                    ?>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

