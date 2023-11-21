<?php
use WPSocialReviews\Framework\Support\Arr;
?>
<div class="wpsr-tiktok-feed-video-playmode wpsr-feed-link">
    <?php if( is_array($account)){ ?>
        <?php if( Arr::get($account, 'profile_image_url') && Arr::get($template_meta, 'post_settings.display_author_photo') === 'true'){ ?>
        <img src="<?php echo $feed['user']['profile_image_url']; ?>" alt="<?php echo $feed['user']['name']; ?>" class="wpsr-tiktok-feed-author-avatar">
        <?php } ?>

        <div class="wpsr-feed-avatar-right">
            <?php if( Arr::get($template_meta, 'post_settings.display_author_name') === 'true'){ ?>
                <a href="<?php echo $feed['media']['url']; ?>" target="_blank" rel="nofollow">
                    @<?php echo $feed['user']['name']; ?>
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
            if ( defined('WPSOCIALREVIEWS_PRO') && $displayStatistics === 'true' ) { ?>
                <div class="wpsr-tiktok-feed-statistics">
                    <div class="wpsr-tiktok-feed-reactions">
                        <?php if( Arr::get($template_meta, 'post_settings.display_likes_count') === 'true'){ ?>
                            <div class="wpsr-tiktok-feed-reactions-icon-like wpsr-tiktok-feed-reactions-icon"></div>
                            <div class="wpsr-tiktok-feed-reaction-count">
                                <?php echo Arr::get($feed, 'statistics.like_count', '') ?>
                            </div>
                        <?php } ?>
                        <?php if( Arr::get($template_meta, 'post_settings.display_comments_count') === 'true'){ ?>
                            <div class="wpsr-tiktok-feed-reactions-icon-comment wpsr-tiktok-feed-reactions-icon"></div>
                            <div class="wpsr-tiktok-feed-reaction-count">
                                <?php echo Arr::get($feed, 'statistics.comment_count', '') ?>
                            </div>
                        <?php } ?>
                        <?php if( Arr::get($template_meta, 'post_settings.display_views_count') === 'true'){ ?>
                            <div class="wpsr-tiktok-feed-reactions-icon-play wpsr-tiktok-feed-reactions-icon"></div>
                            <div class="wpsr-tiktok-feed-reaction-count">
                                <?php echo Arr::get($feed, 'statistics.view_count', ''); ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>
        </div>
    <?php } ?>
</div>

