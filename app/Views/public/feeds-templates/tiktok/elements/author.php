<?php
use WPSocialReviews\Framework\Support\Arr;
$profileImage = Arr::get($feed, 'user.profile_image_url', '');
$userName = Arr::get($feed, 'user.name', '');
$mediaUrl = Arr::get($feed, 'media.url', '');
?>
<div class="wpsr-tiktok-feed-video-playmode wpsr-feed-link">
    <?php if( is_array($account)){ ?>
        <?php if( Arr::get($account, 'profile_image_url') && Arr::get($template_meta, 'post_settings.display_author_photo') === 'true'){ ?>
            <img src="<?php echo esc_url($profileImage) ?>" alt="<?php echo esc_attr($userName); ?>" class="wpsr-tiktok-feed-author-avatar">
        <?php } ?>

        <div class="wpsr-feed-avatar-right">
            <?php if( Arr::get($template_meta, 'post_settings.display_author_name') === 'true'){ ?>
                <a href="<?php echo esc_url($mediaUrl) ?>" target="_blank" rel="nofollow">
                    @<?php echo $userName; ?>
                </a>
            <?php }
            if(defined('WPSOCIALREVIEWS_PRO') && Arr::get($template_meta,'post_settings.display_date') === 'true') {
                /**
                 * tiktok_feed_date hook.
                 *
                 * @hooked TiktokTemplateHandler::renderFeedDate 10
                 * */
                do_action('ninja_tiktok_feed/tiktok_feed_date', $feed);
            }
            do_action('ninja_tiktok_feed/tiktok_feed_statistics', $displayStatistics, $template_meta, $feed);
            ?>
        </div>
    <?php } ?>
</div>

