<?php
use WPSocialReviews\Framework\Support\Arr;
$mediaUrl = Arr::get($feed, 'media.url', '');
?>
<div class="wpsr-feed-description-link">
    <p class="wpsr-feed-description-text wpsr-tiktok-feed-content wpsr_add_read_more wpsr_show_less_content">
        <?php
        if ($trim_title_words) {
            echo esc_html(wp_trim_words($message, $trim_title_words, '...'));
        } else {
            echo esc_html($message);
        }
        ?>
    </p>
</div>