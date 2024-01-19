<?php
use WPSocialReviews\Framework\Support\Arr;
use WPSocialReviews\App\Services\Helper;

$userID = Arr::get($feed, 'user.id', '');
$feedID = Arr::get($feed, 'id', '');
$previewImage = Arr::get($feed, 'media.preview_image_url', '');
$description = Arr::get($feed, 'text', '');
$display_mode = Arr::get($template_meta, 'post_settings.display_mode');
$videoUrl = 'https://www.tiktok.com/@'.$userID.'/video/'.$feedID;

$attrs = [
    'class'  => 'class="wpsr-tiktok-feed-video-preview wpsr-tiktok-feed-video-playmode wpsr-feed-link"',
    'target' => $display_mode !== 'none' ? 'target="_blank"' : '',
    'rel'    => 'rel="nofollow"',
    'href'   =>  $display_mode !== 'none' ? 'href="'.esc_url($videoUrl).'"' : '',
];

?>
<div class="wpsr-tiktok-feed-image">
    <?php if ($display_mode === 'tiktok'): ?>
        <a <?php Helper::printInternalString(implode(' ', $attrs)); ?>>
    <?php else: ?>
        <div class="wpsr-tiktok-feed-video-preview wpsr-tiktok-feed-video-playmode wpsr-feed-link">
    <?php endif; ?>
            <img src="<?php echo esc_url($previewImage); ?>" alt="<?php echo esc_attr($description); ?>"/>
            <?php if ($template_meta['post_settings']['display_play_icon'] === 'true'): ?>
                <div class="wpsr-tiktok-feed-video-play">
                    <div class="wpsr-tiktok-feed-video-play-icon"></div>
                </div>
            <?php endif; ?>
    <?php if ($display_mode === 'tiktok'): ?>
        </a>
    <?php else: ?>
        </div>
    <?php endif; ?>
</div>
