<?php
use WPSocialReviews\Framework\Support\Arr;
$userID = esc_attr( Arr::get($feed, 'user.id', ''));
$feedID = esc_attr( Arr::get($feed, 'id', ''));
$previewImage = esc_url( Arr::get($feed, 'media.preview_image_url', ''));
$description = esc_attr( Arr::get($feed, 'description', ''));
$videoUrl = 'https://www.tiktok.com/@'.$userID.'/video/'.$feedID;

?>
<div class="wpsr-tiktok-feed-image">
    <a href="<?php echo $videoUrl ?>" class="wpsr-tiktok-feed-video-preview wpsr-tiktok-feed-video-playmode wpsr-feed-link" target="_blank" rel="nofollow">
        <img src="<?php echo $previewImage ?>" alt="<?php echo $description ?>"/>
        <?php if ($template_meta['post_settings']['display_play_icon'] === 'true'): ?>
            <div class="wpsr-tiktok-feed-video-play">
                <div class="wpsr-tiktok-feed-video-play-icon"></div>
            </div>
        <?php endif; ?>
    </a>
</div>
