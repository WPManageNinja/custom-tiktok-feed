<?php
use WPSocialReviews\Framework\Support\Arr;
$userID = Arr::get($feed, 'user.id', '');
$feedID = Arr::get($feed, 'id', '');
$previewImage = Arr::get($feed, 'media.preview_image_url', '');
$description = Arr::get($feed, 'description', '');
$videoUrl = 'https://www.tiktok.com/@'.$userID.'/video/'.$feedID;

?>
<div class="wpsr-tiktok-feed-image">
    <a href="<?php echo esc_url($videoUrl); ?>" class="wpsr-tiktok-feed-video-preview wpsr-tiktok-feed-video-playmode wpsr-feed-link" target="_blank" rel="nofollow">
        <img src="<?php echo esc_url($previewImage); ?>" alt="<?php echo esc_attr($description); ?>"/>
        <?php if ($template_meta['post_settings']['display_play_icon'] === 'true'): ?>
            <div class="wpsr-tiktok-feed-video-play">
                <div class="wpsr-tiktok-feed-video-play-icon"></div>
            </div>
        <?php endif; ?>
    </a>
</div>
