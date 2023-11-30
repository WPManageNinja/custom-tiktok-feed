<?php
use WPSocialReviews\Framework\Support\Arr;
?>
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