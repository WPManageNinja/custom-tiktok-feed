<?php
use WPSocialReviews\Framework\Support\Arr;
$mediaUrl = esc_url( Arr::get($feed, 'media.url', ''));
?>
<h3 class="wpsr-feed-description-link">
    <a href="<?php echo $mediaUrl ?>" data-num-words-trim="<?php echo esc_attr($content_length);?>" target="_blank" rel="nofollow" class="wpsr-tiktok-feed-video-playmode">
        <?php echo wp_kses($message, $allowed_tags); ?>
    </a>
</h3>