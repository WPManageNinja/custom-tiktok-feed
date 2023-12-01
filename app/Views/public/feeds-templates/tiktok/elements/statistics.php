<?php
use WPSocialReviews\Framework\Support\Arr;
$likesCount = Arr::get($feed, 'statistics.like_count', '');
$commentsCount = Arr::get($feed, 'statistics.comment_count', '');
$viewsCount = Arr::get($feed, 'statistics.view_count', '');
?>
<div class="wpsr-tiktok-feed-statistics">
    <div class="wpsr-tiktok-feed-reactions">
        <?php if( Arr::get($template_meta, 'post_settings.display_likes_count') === 'true'){ ?>
            <div class="wpsr-tiktok-feed-reactions-icon-like wpsr-tiktok-feed-reactions-icon"></div>
            <div class="wpsr-tiktok-feed-reaction-count">
                <?php echo esc_html($likesCount) ?>
            </div>
        <?php } ?>
        <?php if( Arr::get($template_meta, 'post_settings.display_comments_count') === 'true'){ ?>
            <div class="wpsr-tiktok-feed-reactions-icon-comment wpsr-tiktok-feed-reactions-icon"></div>
            <div class="wpsr-tiktok-feed-reaction-count">
                <?php echo esc_html($commentsCount) ?>
            </div>
        <?php } ?>
        <?php if( Arr::get($template_meta, 'post_settings.display_views_count') === 'true'){ ?>
            <div class="wpsr-tiktok-feed-reactions-icon-play wpsr-tiktok-feed-reactions-icon"></div>
            <div class="wpsr-tiktok-feed-reaction-count">
                <?php echo esc_html($viewsCount) ?>
            </div>
        <?php } ?>
    </div>
</div>