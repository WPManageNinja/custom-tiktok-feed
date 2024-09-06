<?php
use WPSocialReviews\Framework\Support\Arr;
use WPSocialReviews\App\Services\Helper;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

$userID = Arr::get($feed, 'user.id', '');
$feedID = Arr::get($feed, 'id', '');
$previewImage = Arr::get($feed, 'media.preview_image_url', '');
$description = Arr::get($feed, 'text', '');
$display_mode = Arr::get($template_meta, 'post_settings.display_mode');
$media_url = Arr::get($feed, 'media_url', '');
$default_media = Arr::get($feed, 'default_media', '');
$imgClass = (!str_contains($media_url, 'placeholder') ? 'wpsr-tt-post-img wpsr-show' : 'wpsr-tt-post-img wpsr-hide');
$videoUrl = 'https://www.tiktok.com/@'.$userID.'/video/'.$feedID;

$attrs = [
    'class'  => 'class="wpsr-tiktok-feed-video-preview wpsr-tiktok-feed-video-playmode wpsr-feed-link wpsr-animated-background"',
    'target' => $display_mode !== 'none' ? 'target="_blank"' : '',
    'rel'    => 'rel="nofollow"',
    'href'   =>  $display_mode !== 'none' ? 'href="'.esc_url($videoUrl).'"' : '',
];

?>
    <div class="wpsr-tt-post-media">
    <?php if ($display_mode !== 'none'): ?>
        <a <?php Helper::printInternalString(implode(' ', $attrs)); ?>>
    <?php else: ?>
        <div class="wpsr-tiktok-feed-video-preview wpsr-tiktok-feed-video-playmode wpsr-feed-link ">
    <?php endif; ?>
            <img class="<?php echo esc_attr($imgClass) ?>" src="<?php echo esc_url($media_url ? $media_url : $default_media); ?>" alt="<?php echo esc_attr($description); ?>"/>
    <?php if ($display_mode !== 'none'): ?>
        </a>
    <?php else: ?>
        </div>
    <?php endif; ?>
    </div>

