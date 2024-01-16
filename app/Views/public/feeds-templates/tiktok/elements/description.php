<?php
use WPSocialReviews\Framework\Support\Arr;
$mediaUrl = Arr::get($feed, 'media.url', '');
?>
<div class="wpsr-feed-description-link">
    <p data-num-words-trim="<?php echo esc_attr($content_length);?>" >
        <?php echo wp_kses($message, $allowed_tags); ?>
    </p>
</div>